<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','title','slug','description','tech_stack','tags','published_at','visibility','github_url','is_public','created_at','updated_at'];
    protected $useTimestamps = false;
    protected $casts = [
        'tags' => 'json',
    ];
}
