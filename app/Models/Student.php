<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected  $primaryKey = 'id';
    public $fillable = [
        'student_id',
        'name',
        'email',
        'phone',
    ];
}
