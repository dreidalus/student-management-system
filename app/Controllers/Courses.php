<?php

namespace App\Controllers;

use App\Models\CourseModel;

class Courses extends BaseController
{
    protected $courseModel;

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

    public function __construct()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        $this->courseModel = new CourseModel();
    }

    public function index()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher', 'student'])) return $redirect;
        $data['courses'] = $this->courseModel->findAll();
        return view('courses/index', $data);
    }

    public function add()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;
        return view('courses/add');
    }

    public function store()
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;
        $model = new CourseModel();


        $courseCode = $this->request->getPost('course_code');
        $courseName = $this->request->getPost('course_name');

    
        $existingCode = $model->where('course_code', $courseCode)->first();
        if ($existingCode) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Course code already exists.');
        }

     
        $existingName = $model->where('course_name', $courseName)->first();
        if ($existingName) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Course name already exists.');
        }

       
        $model->save($this->request->getPost());

        return redirect()->to('/courses')->with('success', 'Course added successfully.');
    }

    public function update($id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;
        $model = new CourseModel();

      
        $courseCode = $this->request->getPost('course_code');
        $courseName = $this->request->getPost('course_name');

     
        $existingCode = $model->where('course_code', $courseCode)->where('course_id !=', $id)->first();
        if ($existingCode) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Course code already exists.');
        }

       
        $existingName = $model->where('course_name', $courseName)->where('course_id !=', $id)->first();
        if ($existingName) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Course name already exists.');
        }

       
        $model->update($id, $this->request->getPost());

        return redirect()->to('/courses')->with('success', 'Course updated successfully.');
    }

    public function delete($id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin'])) return $redirect;
        $model = new CourseModel();
        $model->delete($id);

        return redirect()->to(site_url('courses'))->with('message', 'Course deleted successfully!');
    }

    public function edit($id)
    {
        if ($redirect = $this->ensureLoggedIn()) return $redirect;
        if ($redirect = $this->ensureRole(['admin', 'teacher'])) return $redirect;
        $model = new CourseModel();
        $data['course'] = $model->find($id);

        if (!$data['course']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Course not found');
        }

        return view('courses/edit', $data);
    }
}
