<?php

namespace App\Models;

use CodeIgniter\Model;

class GradesModel extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'grades_id';
    protected $allowedFields = ['student_name', 'year_start', 'year_end', 'grade_first_sem', 'grade_second_sem', 'student_id'];
}
