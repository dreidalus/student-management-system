<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $allowedFields = [
        'course_name',
        'course_code',
        'course_information',
        'course_description',
        'course_college'
    ];
}
