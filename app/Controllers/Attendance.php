<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\StudentModel;
use CodeIgniter\Controller;

class Attendance extends BaseController
{
    // Ensure the user is logged in
    private function ensureLoggedIn()  
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/authorize/login');
        }
    }

    // Ensure the user has the correct role
    private function ensureRole(array $allowedRoles)
    {
        $role = session()->get('role');
        if (!in_array($role, $allowedRoles)) {
            return redirect()->back()->with('error', 'Access denied.');
        }
    }

    // Display attendance list (accessible by admin, teacher, and student)
    public function index()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher', 'student'])) return $redirect;

        $model = new AttendanceModel();

        // Join attendance with students table to get the full name
        $attendanceData = $model->select('attendance.*, students.first_name, students.last_name')
                                ->join('students', 'students.students_id = attendance.student_id', 'left')
                                ->findAll();

        // Merge the first_name and last_name into a full_name
        foreach ($attendanceData as &$record) {
            $record['student_name'] = $record['first_name'] . ' ' . $record['last_name'];
        }

        $data['attendance'] = $attendanceData;
        return view('attendance/index', $data);
    }

    // Show the add attendance form (accessible by admin and teacher)
    public function add()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

        // Fetch students for the dropdown
        $studentModel = new StudentModel();
        $students = $studentModel->findAll();

        return view('attendance/add', ['students' => $students]); 
    }

    // Store new attendance (accessible by admin and teacher)
    public function store()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

        // Get student ID from POST data
        $studentId = $this->request->getPost('student_id');
        $studentModel = new StudentModel();

        // Ensure the student exists in the students table
        $student = $studentModel->find($studentId);
        if (!$student) {
            return redirect()->back()->withInput()->with('error', 'Invalid student selected. Please select a valid student.');
        }

        // Validation rules
        $rules = [
            'student_id' => 'required|is_not_unique[students.students_id]',  // Ensure student exists
            'date_today' => 'required|valid_date[Y-m-d]',
            'status_student' => 'required',
        ];

        // Perform validation
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all fields correctly.');
        }

        // Insert the attendance record
        $attendanceModel = new AttendanceModel();
        $attendanceModel->save([
            'student_id' => $studentId,  // Storing the student_id correctly
            'student_name' => $student['first_name'] . ' ' . $student['last_name'], // store full name
            'date_today' => $this->request->getVar('date_today'),
            'status_student' => $this->request->getVar('status_student'),
            'remarks' => $this->request->getVar('remarks'),
        ]);
        
        

        // Redirect to the attendance page with success message
        return redirect()->to('/attendance')->with('message', 'Attendance record added successfully');
    }

    // Show the edit attendance form (accessible by admin and teacher)
    public function edit($attendance_id)
{
    if ($redirect = $this->ensureLoggedIn()) return $redirect;
    if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

    $model = new AttendanceModel();
    $attendance = $model->find($attendance_id);

    if (!$attendance) {
        return redirect()->to('/attendance')->with('error', 'Attendance record not found.');
    }

    // Fetch students for the dropdown
    $studentModel = new StudentModel();
    $students = $studentModel->findAll();

    return view('attendance/edit', [
        'attendance' => $attendance,
        'students' => $students
    ]);
}



    // Update attendance (accessible by admin and teacher)
    public function update($attendance_id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;
    
        $model = new AttendanceModel();
        $studentModel = new StudentModel();
    
        // Fetch student ID from POST data
        $studentId = $this->request->getPost('student_id');
        
        // Ensure the student exists in the students table
        $student = $studentModel->find($studentId);
        if (!$student) {
            return redirect()->back()->withInput()->with('error', 'Invalid student selected. Please select a valid student.');
        }
    
        // Validation rules
        $rules = [
            'student_id' => 'required|is_not_unique[students.students_id]',  // Ensure student exists
            'date_today' => 'required|valid_date[Y-m-d]',
            'status_student' => 'required',
        ];
    
        // Perform validation
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all fields correctly.');
        }
    
        // Update the attendance record
        $data = [
            'student_id' => $studentId,  // Storing the student_id correctly
            'student_name' => $student['first_name'] . ' ' . $student['last_name'],
            'date_today' => $this->request->getPost('date_today'),
            'status_student' => $this->request->getPost('status_student'),
            'remarks' => $this->request->getPost('remarks'),
        ];
    
        $model->update($attendance_id, $data);
    
        return redirect()->to('/attendance')->with('message', 'Attendance updated.');
    }
    

    // Delete attendance (can only be accessed by admin)
    public function delete($id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin'])) return $redirect;

        $model = new AttendanceModel();
        $model->delete($id);

        return redirect()->to('/attendance')->with('message', 'Record deleted.');
    }
}
