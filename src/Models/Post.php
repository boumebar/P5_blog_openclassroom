<?php

namespace App\Models;

use DateTime;

class Post extends Model
{

    protected $table = "post";
    protected $class = Post::class;


    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d F Y');
    }
}
