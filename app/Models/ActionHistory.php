<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    protected $fillable =
    [
        'title',
        'desc',
        'table_name',
        'row_id',
        'created_by',
    ];
}
