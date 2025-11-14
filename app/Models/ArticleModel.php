<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','title','slug','body','published_at','is_published','created_at','updated_at'];
    protected $useTimestamps = false;
}
