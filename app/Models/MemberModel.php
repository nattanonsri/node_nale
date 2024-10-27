<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tb_users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = false;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];


    public function getLoginCountsByDate()
    {
        // $current = CURRENT_DATE;
        $current = date('Y-m-d', strtotime(CURRENT_DATE));
        $new_date1 = date('Y-m-d', strtotime('-1 days', strtotime(CURRENT_DATE)));
        $new_date2 = date('Y-m-d', strtotime('-2 days', strtotime(CURRENT_DATE)));
        $new_date3 = date('Y-m-d', strtotime('-3 days', strtotime(CURRENT_DATE)));
        $new_date4 = date('Y-m-d', strtotime('-4 days', strtotime(CURRENT_DATE)));

        $get_dateTime1 = $this->where('DATE(updated_at)', $current)->countAllResults();
        $get_dateTime2 = $this->where('DATE(updated_at)', $new_date1)->countAllResults();
        $get_dateTime3 = $this->where('DATE(updated_at)', $new_date2)->countAllResults();
        $get_dateTime4 = $this->where('DATE(updated_at)', $new_date3)->countAllResults();
        $get_dateTime5 = $this->where('DATE(updated_at)', $new_date4)->countAllResults();


        return [
            'get_dateTime1' => $get_dateTime1,
            'get_dateTime2' => $get_dateTime2,
            'get_dateTime3' => $get_dateTime3,
            'get_dateTime4' => $get_dateTime4,
            'get_dateTime5' => $get_dateTime5,
        ];

    }


    public function checkDuplicate($data)
    {

        $query = $this->where('first_name', $data['fname'])
            ->where('last_name', $data['lname'])
            ->where('username', $data['username']);

        $result = $query->get();

        if ($result->getNumRows() > 0) {
            return $result->getNumRows();
        } else {

            return $result->getRowArray();
        }
    }
}