<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CategoryModel;
use App\Models\ActivityModel;
use App\Models\ActivityAlbumModel;
use App\Models\ActivityBookModel;
use App\Models\MemberModel;
use App\Libraries\Auth;
use App\Libraries\UploadLibrary;
use Ramsey\Uuid\Uuid;
class BackendController extends BaseController
{
    protected $adminModel, $memberModal, $categoryModel, $activityModel, $activityAlbumModel, $activityBookModel, $admin_id;

    public function __construct()
    {
        $this->Auth = new Auth;
        $this->adminModel = new AdminModel();
        $this->categoryModel = new CategoryModel();
        $this->activityModel = new ActivityModel();
        $this->activityAlbumModel = new ActivityAlbumModel();
        $this->activityBookModel = new ActivityBookModel();
        $this->memberModal = new MemberModel();
        $this->admin_id = session()->get('admin_id') ?? 0;


    }
    public function index()
    {

        $data['session'] = session();
        $data['categorys'] = $this->categoryModel->findAll();
        return view('backend/index', $data);
    }


    public function load_content_dashboard()
    {

        $data['datetime'] = $this->memberModal->getLoginCountsByDate();
        $data['sum_users'] = $this->memberModal->countAllResults();
        $data['male'] = $this->memberModal->where('gender', 'ผู้ชาย')->countAllResults();
        $data['female'] = $this->memberModal->where('gender', 'ผู้หญิง')->countAllResults();
        return view('backend/details/load_content_dashboard', $data);
    }
    public function load_content_user()
    {
        $data['members'] = $this->memberModal->findAll();
        return view('backend/details/load_content_user', $data);
    }
    public function load_content_administrator()
    {
        $data['admins'] = $this->adminModel->findAll();
        return view('backend/details/load_content_administrator', $data);
    }
    public function load_content_category()
    {
        $data['categorys'] = $this->categoryModel->findAll();
        return view('backend/details/load_content_category', $data);
    }
    public function load_content_activity()
    {
        $data['activitys'] = $this->activityModel->findAll();
        return view('backend/details/load_content_activity', $data);
    }
    public function load_content_album()
    {
        $data['albums'] = $this->activityAlbumModel->findAll();
        return view('backend/details/load_content_album', $data);
    }
    public function load_content_book()
    {
        $data['books'] = $this->activityBookModel->getBookActivity();
        return view('backend/details/load_content_book', $data);
    }

    public function add_category()
    {
        if ($this->request->getPost()) {
            $nameTH = $this->request->getPost('name_th');
            $nameEN = $this->request->getPost('name_en');

            $category = [
                'name_th' => $nameTH,
                'name_en' => $nameEN,
                'status' => '1',
            ];
            $insert = $this->categoryModel->insert($category);

            if ($insert) {
                $response = ['status' => '200', 'message' => 'เพิ่มข้อมูลสำเร็จ'];
            } else {
                $response = ['status' => '400', 'message' => 'เพิ่มข้อมูลไม่สำเร็จ'];
            }
            return $this->response->setJSON($response);
        }
    }
    public function edit_category_modal($id = '')
    {
        $id = $this->request->getPost('id');

        $data['category'] = $this->categoryModel->where('id', $id)->first();
        return view('backend/details/modals/edit_cat_modal', $data);

    }

    public function edit_category($id = '')
    {
        if ($this->request->getPost()) {
            $name_th = $this->request->getPost('name_th');
            $name_en = $this->request->getPost('name_en');


            $edit_cat = [
                'name_th' => $name_th,
                'name_en' => $name_en,
                // 'updated_at' => CURRENT_DATE
            ];

            $update_cat = $this->categoryModel->update($id, $edit_cat);

            if ($update_cat) {
                $response = ['status' => '200', 'message' => 'แก้ไขข้อมูลสำเร็จ'];
            } else {
                $response = ['status' => '400', 'message' => 'แก้ไขข้อมูลไม่สำเร็จ'];
            }
            return $this->response->setJSON($response);
        }
    }
    public function delete_category($id = '')
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');

            $cat_delete = $this->categoryModel->delete($id);

            if ($cat_delete) {
                $response = ['status' => '200', 'message' => 'ลบข้อมูลสำเร็จ'];
            } else {
                $response = ['status' => '400', 'message' => 'ลบข้อมูลไม่สำเร็จ'];
            }
            return $this->response->setJSON($response);
        }
    }

    public function add_activity()
    {
        if ($this->request->getPost()) {

            $this->validateData([], [
                'image' => [
                    'uploaded[image]',
                    'max_size[image,50000]',
                    'mime_in[image,image/png,image/jpg,image/gif,image/PNG,image/JPG,image/GIF]',
                    'ext_in[image,png,jpg,gif,PNG,JPG,GIF]',
                    'max_dims[image,1720,1280]',
                ],
            ]);

            $name = $this->request->getPost('name');
            $category_id = $this->request->getPost('category_id');
            $address = $this->request->getPost('address');
            $price = $this->request->getPost('price');
            $details = $this->request->getPost('details');
            $start_date = $this->request->getPost('start_date');
            $end_date = $this->request->getPost('end_date');

            $file = $this->request->getFile('image');
            $upload = new UploadLibrary($file);
            $path_file = $upload->upload('uploads/activity');

            $data_activity = [
                'uuid' => Uuid::uuid4()->toString(),
                'name' => $name,
                'category_id' => $category_id,
                'address' => $address,
                'price' => $price,
                'details' => $details,
                'image' => $path_file['path_file_name'],
                'start_datetime' => $start_date,
                'end_datetime' => $end_date,
                'status' => '1'
            ];

            $add_activity = $this->activityModel->insert($data_activity);
            if ($add_activity) {
                $response = ['status' => '200', 'message' => 'เพิ่มข้อมูลสำเร็จ'];
            } else {
                $response = ['status' => '400', 'message' => 'เพิ่มข้อมูลไม่สำเร็จ'];
            }

            return $this->response->setJSON($response);
        }
    }

    public function edit_activity_modal($uuid = '')
    {
        $uuid = $this->request->getPost('uuid');
        $data['categorys'] = $this->categoryModel->findAll();
        $data['activity'] = $this->activityModel->where('uuid', $uuid)->first();

        // แปลงรูปแบบวันที่ให้เหมาะสมกับ daterangepicker
        if ($data['activity']) {
            $data['activity']['start_date_formatted'] = date('Y-m-d H:i:s', strtotime($data['activity']['start_datetime']));
            $data['activity']['end_date_formatted'] = date('Y-m-d H:i:s', strtotime($data['activity']['end_datetime']));
        }

        return view('backend/details/modals/edit_activity_modal', $data);
    }
    public function edit_activity($uuid = '')
    {
        $activity = $this->activityModel->where('uuid', $uuid)->first();

        if (!$activity) {
            return $this->response->setJSON([
                'status' => '404',
                'message' => 'ไม่พบข้อมูลกิจกรรม'
            ]);
        }

        $file = $this->request->getFile('image');
        $path_file = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validationRules = [
                'image' => [
                    'uploaded[image]',
                    'max_size[image,50000]',
                    'mime_in[image,image/png,image/jpg,image/gif,image/PNG,image/JPG,image/GIF]',
                    'ext_in[image,png,jpg,gif,PNG,JPG,GIF]',
                    'max_dims[image,1720,1280]',
                ]
            ];

            if (!$this->validate($validationRules)) {
                return $this->response->setJSON([
                    'status' => '400',
                    'message' => 'ไฟล์รูปภาพไม่ถูกต้อง',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $upload = new UploadLibrary($file);
            $uploaded_file = $upload->upload('uploads/activity');

            if (isset($uploaded_file['path_file_name'])) {
                $path_file = $uploaded_file['path_file_name'];

                // ลบรูปเก่าถ้ามี
                if (!empty($activity['image']) && file_exists('uploads/activity/' . $activity['image'])) {
                    unlink('uploads/activity/' . $activity['image']);
                }
            }
        }

        $edit_activity = [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'address' => $this->request->getPost('address'),
            'price' => $this->request->getPost('price'),
            'details' => $this->request->getPost('details'),
            'start_datetime' => $this->request->getPost('start_date'),
            'end_datetime' => $this->request->getPost('end_date'),
        ];


        if (!empty($path_file)) {
            $edit_activity['image'] = $path_file;
        }


        if ($this->activityModel->update($activity['id'], $edit_activity)) {
            return $this->response->setJSON([
                'status' => '200',
                'message' => 'แก้ไขข้อมูลสำเร็จ'
            ]);
        }

        return $this->response->setJSON([
            'status' => '400',
            'message' => 'แก้ไขข้อมูลไม่สำเร็จ'
        ]);
    }
    public function delete_activity($uuid = '')
    {

        if ($this->request->getPost()) {
            $uuid = $this->request->getPost('uuid');
            $activity = $this->activityModel->where('uuid', $uuid)->first();

            $delete_activity = $this->activityModel->delete($activity['id']);

            if ($delete_activity) {
                $response = ['status' => '200', 'message' => 'ลบข้อมูลสำเร็จ'];
            } else {
                $response = ['status' => '400', 'message' => 'ลบข้อมูลไม่สำเร็จ'];
            }
            return $this->response->setJSON($response);
        }
    }

    public function add_album_activcity()
    {
        $this->validateData([], [
            'file' => [
                'uploaded[file]',
                'max_size[file,50000]',
                'mime_in[file,file/png,file/jpg,file/gif,file/PNG,file/JPG,file/GIF]',
                'ext_in[file,png,jpg,gif,PNG,JPG,GIF]',
                'max_dims[file,1720,1280]',
            ],
        ]);

        $file = $this->request->getFile('file');

        $upload = new UploadLibrary($file);
        $pathFile = $upload->upload('uploads/album');


        $add_album = [
            'uuid' => Uuid::uuid4()->toString(),
            'name' => $pathFile['name'],
            'path_images' => $pathFile['path_file_name'],
            'status' => '1',
        ];

        $insert_album = $this->activityAlbumModel->insert($add_album);

        if ($insert_album) {
            $response = ['status' => '200', 'message' => 'เพิ่มข้อมูลสำเร็จ'];
        } else {
            $response = ['status' => '400', 'message' => 'เพิ่มข้อมูลไม่สำเร็จ'];
        }
        return $this->response->setJSON($response);

    }
    public function delete_album_activcity()
    {
        if ($this->request->getPost()) {
            $uuid = $this->request->getPost('uuid');

            $album = $this->activityAlbumModel->where('uuid', $uuid)->first();

            $delete_album = $this->activityAlbumModel->delete($album['id']);

            if ($delete_album) {
                $response = ['status' => '200', 'message' => 'ลบข้อมูลสำเร็จ'];
            } else {
                $response = ['status' => '400', 'message' => 'ลบข้อมูลไม่สำเร็จ'];
            }
            return $this->response->setJSON($response);
        }
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $admin = $this->adminModel->where('username', $username)->first();

            if ($admin && password_verify($password, $admin['password'])) {
                $session = session();
                $sessionData = [
                    'is_admin' => true,
                    'admin_id' => $admin['id'],
                    'uuid' => $admin['uuid'],
                    'username' => $admin['username'],
                ];
                $session->set($sessionData);

                add_log($admin['id'], 'login', 'backend/login', $sessionData);
                // return redirect()->to( base_url('backend'));
                return $this->response->setJSON(['status' => 200, 'message' => 'ล็อกอินสำเร็จ', 'url_redirect' => base_url('backend')]);
            } else {
                return $this->response->setJSON(['status' => 400, 'message' => 'รหัสผ่านไม่ถูกต้อง', 'url_redirect' => '']);
            }


        } else {

            if (session()->get('is_admin')) {
                return redirect()->to(base_url('backend'));
            }
            return view('backend/login');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('backend/login'));
    }

}
