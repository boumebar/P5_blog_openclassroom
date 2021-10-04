<?php


namespace App\Models;

use App\database\DBConnection;

abstract class Model
{
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    protected function all()
    {
    }

    protected function findById($id)
    {
    }
}
