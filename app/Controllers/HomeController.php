<?php

namespace App\Controllers;

use App\Models\ActivityAlbumModel;
use App\Models\ActivityBookModel;
use App\Models\ActivityModel;
use App\Models\CategoryModel;
use App\Models\MemberModel;
use Ramsey\Uuid\Uuid;
use App\Libraries\Auth;

class HomeController extends BaseController
{
    protected $categoryModel, $activityModel, $activityBookModel, $activityAlbumModel, $memberModel;
    public function __construct()
    {
        $this->Auth = new Auth;
        $this->categoryModel = new CategoryModel();
        $this->activityModel = new ActivityModel();
        $this->activityBookModel = new ActivityBookModel();
        $this->activityAlbumModel = new ActivityAlbumModel();
        $this->memberModel = new MemberModel();


    }
    public function index()
    {
        $data['categorys'] = $this->categoryModel->findAll();
        $data['activitys'] = $this->activityModel->findAll();
        $data['albums'] = $this->activityAlbumModel->findAll();
        return view('home/index', $data);
    }

    public function load_content_activity()
    {
        $id = $this->request->getPost('id');
        $activity = $this->activityModel->getActivityWhere($id);

        $data['activitys'] = is_array($activity) ? $activity : [$activity];
        return view('home/details/load_content_activity', $data);
    }

    public function activity_book()
    {
        $data['background'] = 'background-color: #F0F0F0';
        $data['bookings'] = $this->activityBookModel->getBookActivity(USER_ID);
        return view('home/shopping/booking_activity', $data);
    }

    public function activity_detail($uuid)
    {
        $data['activity'] = $this->activityModel->where('uuid', $uuid)->first();
        return view('home/details/activity_details', $data);

    }

    public function activity_confirm_booking($user_id = '', $activity_id = '')
    {
        if ($this->request->getPost()) {

            $user_id = $this->request->getPost('user_id');
            $activity_id = $this->request->getPost('activity_id');


            $add_book = [
                'uuid' => Uuid::uuid4()->toString(),
                'activity_id' => $activity_id,
                'user_id' => $user_id,
                'status' => 'padding'
            ];

            $inser_book = $this->activityBookModel->insert($add_book);

            if ($inser_book) {
                $data = ['status' => 200, 'message' => 'รออนุมัติจองกิจกรรม'];
            } else {
                $data = ['status' => 400, 'message' => 'จองกิจกรรมไม่สำเร็จ'];
            }

            return $this->response->setJSON($data);

        }
    }
    public function login()
    {
        return view('home/login');
    }
    public function login_auth()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');


            if (empty($username) || empty($password)) {
                return $this->response->setJSON(['status' => 400, 'message' => 'กรูณากรอก ชื่อผู้ใช้ กับ รหัสผ่าน']);
            }

            $user = $this->memberModel->where('username', $username)->first();

            if (!$user) {
                return $this->response->setJSON(['status' => 400, 'message' => " ไม่มีชื่อผู้ใช้"]);
            }

            if (!password_verify($password, $user['password'])) {
                return $this->response->setJSON(['status' => 400, 'message' => "รหัสผ่านไม่ถูกต้อง"]);
            }

            $sessionData = [
                'isLoggedIn' => true,
                'user_id' => $user['id'],
                'uuid' => $user['uuid'],
                'username' => $user['username'],
                'fullname' => $user['first_name'] . ' ' . $user['last_name'],
            ];
            session()->set($sessionData);

            add_log($user['id'], 'login', 'home/login', $sessionData);

            // $this->createUserSession([
            //     'user_id' => $user['id'],
            //     'session' => session_id(),
            //     'username' => $user['username'],
            // ]);

            return $this->response->setJSON(['status' => 200, 'message' => lang('home.login-success'), 'url_redirect' => base_url('backend')]);
        }
    }

    // private function createUserSession($data)
    // {
    //     $user_id = $data['user_id'] ?? '';
    //     $session = $data['session'] ?? '';
    //     $username = $data['username'] ?? '';
    //     if (!$user_id) {
    //         return false;
    //     }
    //     $sessionData = [
    //         'isLoggedIn' => true,
    //         'user_id' => $user_id,
    //         'username' => $username,
    //         'user_type' => $user_type,
    //     ];
    //     session()->set($sessionData);

    // Stamp Before 2024-01-01 03/2566
    //$this->assignActivityCommart($user_id);

    // $this->levelMemberModel->calculateLevel($user_id);

    // $usageTimeModel = new UsageTimeModel();
    // $usageTimeModel->insert([
    //     'user_id' => $user_id,
    //     'session' => $session,
    //     'login_time' => date('Y-m-d H:i:s')
    // ]);
    // return true;
    // }
    public function register()
    {
        return view('home/register');
    }

    public function check_duplicate()
    {
        $isDuplicate = $this->memberModel->checkDuplicate($this->request->getPost());

        echo json_encode(['isDuplicate' => $isDuplicate]);
        exit;
    }

    public function add_register()
    {
        if ($this->request->getPost()) {
            $fname = $this->request->getPost('fname');
            $lname = $this->request->getPost('lname');
            $birthday = $this->request->getPost('birthday');
            $gender = $this->request->getPost('gender');
            $phone = $this->request->getPost('phone');
            $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $data = [
                'uuid' => Uuid::uuid4()->toString(),
                'first_name' => $fname,
                'last_name' => $lname,
                'birthdate' => !empty($birthday) ? $birthday : '',
                'gender' => $gender,
                'tel' => !empty($phone) ? $phone : '',
                'email' => $email,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1
            ];
            $insert = $this->memberModel->insert($data);

            if ($insert) {
                $data = ['status' => 200, 'message' => lang('home.seve-admin-success')];
            } else {
                $data = ['status' => 400, 'message' => lang('home.seve-admin-error')];
            }


            return $this->response->setJSON($data);
        }
    }

    public function logout()
    {

        session()->destroy();

        return redirect()->to(base_url());

    }

}