<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tsumiage extends Model
{
    protected $fillable = [
        'name', 'user_id', 'isprivate', 'iscompleted',
    ];
}
