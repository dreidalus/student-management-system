<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StudentModel;  
use App\Models\CourseModel;  

class Dashboard extends Controller
{
    public function index()
    {
       
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/authorize/login');  
        }

      
        $studentModel = new StudentModel();
        $studentCount = $studentModel->countAll();  

       
        $courseModel = new CourseModel();
        $courseCount = $courseModel->countAll();  

    
        return view('dashboard/index', [
            'studentCount' => $studentCount,  
            'courseCount' => $courseCount    
        ]);
    }
}
