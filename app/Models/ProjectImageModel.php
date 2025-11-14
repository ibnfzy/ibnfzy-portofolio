<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectImageModel extends Model
{
    protected $table = 'project_images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['project_id','path','alt','order_index','created_at'];
    protected $useTimestamps = false;
}
