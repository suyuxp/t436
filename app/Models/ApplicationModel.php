<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationModel extends Model
{
    protected $table = 'applications';

    protected $fillable = [
                            "name",
                            "url",  
                            "priority",
                            "username",     // 如果为空表示公共应用,否则为私有应用
                          ];

    protected $hidden = ['username'];

    public $timestamps = false;
}

