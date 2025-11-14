<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'profile_info';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','full_name','bio','location','website','github_url','linkedin_url','avatar_path','cv_path','created_at','updated_at'];
    protected $useTimestamps = false;
}
