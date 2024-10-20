<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CategoryModel;
use App\Models\ActivityModel;
use App\Libraries\Auth;
use App\Libraries\UploadLibrary;
use Ramsey\Uuid\Uuid;
class BackendController extends BaseController
{
    protected $adminModel, $categoryModel, $activityModel;

    public function __construct()
    {
        $this->Auth = new Auth;
        $this->adminModel = new AdminModel();
        $this->categoryModel = new CategoryModel();
        $this->activityModel = new ActivityModel();
    }
    public function index()
    {
        // return redirect()->to(base_url('backend/index'));
        // return redirect()->to(base_url('login'));
        $data['categorys'] = $this->categoryModel->findAll();
        return view('backend/index', $data);
    }


    public function dashboard()
    {
        return view('backend/dashboard');
    }


    public function load_content_user()
    {
        return view('backend/details/load_content_user');
    }
    public function load_content_category()
    {
        $data['categorys'] = $this->categoryModel->findAll();
        return view('backend/details/load_content_category', $data);
    }
    public function load_content_activity()
    {
        $data['activitys'] = $this->activityModel->findAll();
        // var_dump($data['activitys']);exit;
        return view('backend/details/load_content_activity', $data);
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
                    'max_dims[image,1024,768]',
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
            $path_file = $upload->upload('uploads');

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
    public function login()
    {
        return view('backend/login');
    }
    public function register()
    {

    }

}
