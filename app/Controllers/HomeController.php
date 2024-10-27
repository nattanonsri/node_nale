<?php

namespace App\Controllers;

use App\Models\ActivityAlbumModel;
use App\Models\ActivityBookModel;
use App\Models\ActivityModel;
use App\Models\CategoryModel;

class HomeController extends BaseController
{
    protected $categoryModel, $activityModel, $activityBookModel, $activityAlbumModel;
    public function __construct()
    {

        $this->categoryModel = new CategoryModel();
        $this->activityModel = new ActivityModel();
        $this->activityBookModel = new ActivityBookModel();
        $this->activityAlbumModel = new ActivityAlbumModel();


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
}
