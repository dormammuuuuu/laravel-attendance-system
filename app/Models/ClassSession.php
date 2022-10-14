<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class ClassSession extends Model
{
    use HasFactory;
    protected $table = 'class_session';
    public $timestamps = false;
    protected $fillable = [
        'class_token',
        'class_date'
    ];
}
