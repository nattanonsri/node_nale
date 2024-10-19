<?php

namespace App\Libraries;

use App\Models\AdminModel;
use CodeIgniter\Database\Config;


class Auth
{
    protected $db;
    protected $session;
    protected $adminProfile;

    public function __construct()
    {
        $this->db = Config::connect();
        $this->session = session(); // ใช้ session ในตัวแปร
        $this->adminProfile = $this->getAdminProfile(); // เรียกใช้ method ที่ดึงข้อมูลของผู้ใช้

        define('LIBRARY_PATH', $this->get_library());

        // ตรวจสอบว่ามีข้อมูลผู้ใช้หรือไม่
        if ($this->adminProfile) {
            $this->setUserSession(); // ตั้งค่าค่าคงที่จาก session
        } else {
            $this->setGuestSession(); // ตั้งค่าค่าคงที่สำหรับผู้ใช้ Guest
        }
    }

    /**
     * ดึงข้อมูลผู้ใช้จาก AdminProfileModel
     * @return array|null
     */
    private function getAdminProfile()
    {
        $admin_model = new AdminModel();
        $uuid = $this->session->get('uuid'); // ดึง uuid จาก session

        if ($uuid) {
            return $admin_model->where('uuid', $uuid)->first();
        }

        return null;
    }

    /**
     * ตั้งค่าค่าคงที่สำหรับผู้ใช้ที่เข้าสู่ระบบ
     */
    private function setUserSession()
    {
        define('IS_ALIVE', true);
        define('SESSION', $this->session->get('session'));
        define('USER_ID', $this->session->get('id'));
        define('USER_UUID', $this->session->get('uuid'));
        define('USER_FULLNAME', $this->session->get('fullname'));
        define('USER_TYPE', $this->session->get('type'));
        // define('DISTRICT_ID', $this->adminProfile['district_id']); // กรณีต้องการดึง district_id
    }

    /**
     * ตั้งค่าค่าคงที่สำหรับผู้ใช้ Guest
     */
    private function setGuestSession()
    {
        define('IS_ALIVE', false);
        define('USER_ID', 'GUEST');
        define('USER_UUID', 0);
    }

    /**
     * ดึง path ของ library จากฐานข้อมูล
     * @return string|null
     */
    public function get_library()
    {
        $result = $this->db->table('tb_library')->select('library_path')->where('library_name', $_SERVER['SERVER_NAME'])->get()->getRow();

        if ($result) {
            return $result->library_path;
        }

        return null;
    }

}