<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Authorize extends Controller
{
 
    public function login()
    {
        return view('authorize/login');
    }


    public function loginPost()
    {
        $model = new UserModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);
            
            return redirect()->to('/dashboard/index');
        } else {
            session()->setFlashdata('error', 'Invalid username or password.');
            return redirect()->to('/authorize/login');
        }
    }


    public function register()
    {
        return view('authorize/register');
    }


    public function registerPost()
    {
        $model = new UserModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        $role = $this->request->getPost('role');
        $validRoles = ['admin', 'teacher', 'student'];

        if (!in_array($role, $validRoles)) {
        session()->setFlashdata('error', 'Invalid role selected.');
        return redirect()->to('/authorize/register');
        }
        
        if ($password !== $confirmPassword) {
            session()->setFlashdata('error', 'Passwords do not match.');
            return redirect()->to('/authorize/register');
        }

   
        if ($model->where('username', $username)->first()) {
            session()->setFlashdata('error', 'Username already exists.');
            return redirect()->to('/authorize/register');
        }

      
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $model->save([
            'username' => $username,
            'password' => $hashedPassword,
            'role' => $role
        ]);

        session()->setFlashdata('success', 'Account created successfully! You can now log in.');
        return redirect()->to('/authorize/login');
    }

    // Logout button
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/authorize/login');
    }
}
