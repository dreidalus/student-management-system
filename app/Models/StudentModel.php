<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'students_id';
    protected $allowedFields = ['first_name', 'last_name', 'phone_number', 'email', 'age', 'address', 'courses_id'];
}
