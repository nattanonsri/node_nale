<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CategoryModel;
use App\Libraries\Auth;
class BackendController extends BaseController
{
    protected $adminModel, $categoryModel;

    public function __construct()
    {
        $this->Auth = new Auth;
        $this->adminModel = new AdminModel();
        $this->categoryModel = new CategoryModel();
    }
    public function index()
    {
        // return redirect()->to(base_url('backend/index'));
        // return redirect()->to(base_url('login'));
        return view('backend/index');
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
        return view('backend/details/load_content_category',$data);
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
    public function login()
    {
        return view('backend/login');
    }
    public function register()
    {

    }

}
