<?php

namespace App\Models;

use CodeIgniter\Model;

class CampusModel extends Model
{
    protected $table            = 'campuses';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'nama_kampus', 'alamat'];
}