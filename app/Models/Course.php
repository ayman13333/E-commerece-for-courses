<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Video;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'picture',
        'price',
        'rate',
        'views',
        'type'
    ];
    public function videos(){
        return $this->hasMany(Video::class,"course_id","id");
    }
}
