<?php

namespace App\Controllers;

use App\Models\GradesModel;
use App\Models\StudentModel;
use CodeIgniter\Controller;

class Grades extends BaseController
{
    protected $helpers = ['form'];

    private function ensureLoggedIn()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/authorize/login');
        }
    }

    private function ensureRole(array $allowedRoles)
{
    $role = session()->get('role');
    if (!in_array($role, $allowedRoles)) {
        return redirect()->back()->with('error', 'Access denied.');
    }
}


public function index()
{
   
    if ($redirect = $this->ensureLoggedIn()) return $redirect;

   
    if ($redirect = $this->ensureRole(['admin', 'teacher', 'student'])) return $redirect;

    $model = new GradesModel();

  
    $grades = $model->select('grades.grades_id, students.first_name, students.last_name, 
    grades.year_start, grades.year_end, grades.grade_first_sem, grades.grade_second_sem')
                    ->join('students', 'students.students_id = grades.student_id')
                    ->findAll();

    return view('grades/index', ['grades' => $grades]);
}



    public function add()
{
    if ($redirect = $this->ensureLoggedIn()) return $redirect;
    if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

  
    $studentModel = new \App\Models\StudentModel();
    $students = $studentModel->findAll();


    return view('grades/add', ['students' => $students]);
}

    
    public function store()
{
    if ($redirect = $this->ensureLoggedIn()) return $redirect;
    if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

    $validation = \Config\Services::validation();
    $rules = [
        'student_id' => 'required|numeric',
        'year_start' => 'required|valid_date[Y-m-d]',
        'year_end' => 'required|valid_date[Y-m-d]',
        'grade_first_sem' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[100]',
        'grade_second_sem' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[100]'
    ];

    if (!$this->validate($rules)) {
        return view('grades/add', ['validation' => $validation]);
    }

    $gradesModel = new \App\Models\GradesModel();

    $existing = $gradesModel->where([
        'student_id' => $this->request->getPost('student_id'),
        'year_start' => $this->request->getPost('year_start'),
        'year_end' => $this->request->getPost('year_end')
    ])->first();

    if ($existing) {
        return redirect()->back()->withInput()->with('error', 'Grade record already exists for this student and school year.');
    }

    $studentModel = new StudentModel();
$student = $studentModel->find($this->request->getPost('student_id'));

if (!$student) {
    return redirect()->back()->withInput()->with('error', 'Invalid student selected.');
}

$gradesModel->save([
    'student_id' => $this->request->getPost('student_id'),
    'student_name' => $student['first_name'] . ' ' . $student['last_name'],
    'year_start' => $this->request->getPost('year_start'),
    'year_end' => $this->request->getPost('year_end'),
    'grade_first_sem' => $this->request->getPost('grade_first_sem'),
    'grade_second_sem' => $this->request->getPost('grade_second_sem')
]);


    return redirect()->to('/grades')->with('success', 'Grade added successfully.');
}


public function edit($id)
{
    if ($redirect = $this->ensureLoggedIn()) return $redirect;
    if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

    // Fetch the grade data by ID
    $gradeModel = new \App\Models\GradesModel();
    $grade = $gradeModel->find($id);

    if (!$grade) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Grade record not found.");
    }

    // Fetch students for the dropdown
    $studentModel = new \App\Models\StudentModel();
    $students = $studentModel->findAll();

    // Pass the grade and students data to the view
    return view('grades/edit', [
        'grade' => $grade,
        'students' => $students
    ]);
}



public function update($id)
{
    if ($redirect = $this->ensureLoggedIn()) return $redirect;
    if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;

    // Validate the form inputs
    $validation = \Config\Services::validation();
    if (!$this->validate([
        'student_id' => 'required|is_not_unique[students.students_id]',
        'grade_first_sem' => 'required|integer|greater_than[0]|less_than[101]',
        'grade_second_sem' => 'required|integer|greater_than[0]|less_than[101]',
        'year_start' => 'required|valid_date',
        'year_end' => 'required|valid_date'
    ])) {
        return redirect()->back()->withInput()->with('error', 'Please fill in all fields correctly.');
    }

    // Update the grade record
    $gradeModel = new \App\Models\GradesModel();
    $studentModel = new StudentModel();
$student = $studentModel->find($this->request->getPost('student_id'));

if (!$student) {
    return redirect()->back()->withInput()->with('error', 'Invalid student selected.');
}

$gradeModel->update($id, [
    'student_id' => $this->request->getPost('student_id'),
    'student_name' => $student['first_name'] . ' ' . $student['last_name'],
    'grade_first_sem' => $this->request->getPost('grade_first_sem'),
    'grade_second_sem' => $this->request->getPost('grade_second_sem'),
    'year_start' => $this->request->getPost('year_start'),
    'year_end' => $this->request->getPost('year_end')
]);


    // Set a success message and redirect
    session()->setFlashdata('success', 'Grade record updated successfully.');
    return redirect()->to('/grades');
}


    public function delete($id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin'])) return $redirect;
        $model = new GradesModel();
        $model->delete($id);
        return redirect()->to('/grades')->with('success', 'Grade deleted successfully.');
    }
}
