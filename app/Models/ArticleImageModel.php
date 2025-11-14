<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleImageModel extends Model
{
    protected $table = 'article_images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['article_id','path','alt','order_index','created_at'];
    protected $useTimestamps = false;
}
