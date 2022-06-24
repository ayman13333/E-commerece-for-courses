<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name',
        'course_id',
        'user_id',
        'user_name',
        'phone',
        'open'
    ];
}
