<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityBookModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tb_activity_book';
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
    protected $deletedField = '';

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


    function getBookActivity()
    {

        $sql = "SELECT 
                book.id, 
                book.uuid,
                CONCAT(user.first_name, ' ', user.last_name) as full_name,
                user.username, 
                act.name as name_activity, 
                cat.name_th as name_category, 
                act.image, 
                act.price, 
                act.start_datetime, 
                act.end_datetime
                FROM tb_activity_book as book
                LEFT JOIN tb_users as user ON user.id = book.user_id
                LEFT JOIN tb_activity as act ON act.id = book.activity_id
                LEFT JOIN tb_category as cat ON cat.id = act.category_id";

        return $this->db->query($sql)->getResult();

    }
}