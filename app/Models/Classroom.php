<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classroom';

    protected $fillable = [
        'class_name',
        'class_prof',
        'class_room',
        'class_section',
        'class_token',
        'class_school_year',
    ];

    public function students()
    {
        return $this->hasMany(ClassStudent::class);
    }
}
