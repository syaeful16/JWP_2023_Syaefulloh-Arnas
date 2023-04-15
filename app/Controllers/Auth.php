<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\UsersModel;
use CodeIgniter\Email\Email;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth/register', $data);
    }

    public function forgotPassword() {
        $data = [
            'title' => 'Forgot Password'
        ];

        return view('auth/forgotPassword', $data);
    }

    public function resetPassword($token) {
        $data = [
            'title' => 'change Password',
            'token' => $token
        ];

        return view('auth/changePassword', $data);
    }

    public function save()
    {
        $validation = $this->validate(
            [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} cannot be empty'
                    ],
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'The {field} cannot be empty',
                        'valid_email' => 'The {field} does not match',
                        'is_unique' => 'The {field} already exists'
                    ],
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'The {field} cannot be empty',
                        'min_length' => 'minimum {param} letter {field}'
                    ]
                ]

            ]
        );

        if(!$validation) {
            $data = [
                'title' => 'Registration Error',
                'validation' => $this->validator
            ];
            
            return view('auth/register', $data);
        } else {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $values = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ];

            $usersModel = new UsersModel();
            $query = $usersModel->insert($values);

            if(!$query) {
                return redirect()->back()->with('failed', 'Seomething went wrong');
            } else {
                // return redirect()->to('auth/register')->with('success', 'You are now registered successfully');
                $lastId = $usersModel->insertID();
                session()->set('logged', $lastId);
                return redirect()->to('/dashboard');
            }

        }
    }

    public function login()
    {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'valid_email' => 'The {field} does not match',
                    'is_not_unique' => 'Your {field} not registered'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'The {field} cannot be empty',
                    'min_length' => 'minimum {param} letter {field}'
                ]
            ]
        ]);

        if(!$validation) {
            $data = [
                'title' => 'Login Error',
                'validation' => $this->validator
            ];
            return view('auth/login', $data);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $usersModel = new UsersModel();
            $checkUser = $usersModel->where('email', $email)->first();
            $checkPassword = Hash::check($password, $checkUser['password']);

            if(!$checkPassword) {
                session()->setFlashdata('fail', 'Incorrect password');
                return redirect()->to('/auth')->withInput();
            } else {
                $user_id = $checkUser['id'];
                session()->set('logged', $user_id);
                return redirect()->to('/dashboard');
            }
        }
    }

    public function logout() {
        if(session()->has('logged')) {
            session()->remove('logged');
            return redirect()->to('/auth?access=out')->with('fail', 'You are logged out!');
        }
    }

    public function sendReset() {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'valid_email' => 'The {field} does not match',
                    'is_not_unique' => 'Your {field} not registered'
                ]
            ],
        ]);

        if(!$validation) {
            $data = [
                'title' => 'Reset Password Failed',
                'validation' => $this->validator
            ];
            
            return view('auth/forgotPassword', $data);
        } else {
            try {
                $usersModel = new UsersModel();
                $userInfo = $usersModel->where('email', $this->request->getPost('email'))->first();

                $token = mt_rand(100000, 999999);

                $data = [
                    'token' => $token
                ];
    
                $usersModel->update($userInfo['id'], $data);
    
                $to = $userInfo['email'];
                $subject = 'Reset Password Link';
                $token_no = $token;
                $message = "Hi, ".$userInfo['name']."<br><br>"
                    ."Your reset password request has been received. Please click the below link to reset your password.<br><br>"
                    ."<a href='". base_url() ."/auth/change_password/".$token_no."'>Click here to Reset Password</a>";
                $email = \Config\Services::email();
                $email->setTo($to);
                $email->setFrom('syaefulloharnas16@gmail.com', 'Admin');
                $email->setSubject($subject);
                $email->setMessage($message);
    
                if($email->send()) {
                    return redirect()->to('auth/forgotPassword')->with('success', 'Reset password link sent to your registered email');
                } else {
                    return $email->printDebugger(['headers']);
                }

            } catch(\Exception $e) {
                dd($e);
            }
        }       
    }

    public function updatePassword() {
        $validation = $this->validate([
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'The {field} cannot be empty',
                    'min_length' => 'minimum {param} letter {field}'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'The {field} cannot be empty',
                    'matches' => 'Confirm password is not the same'
                ]
            ],
        ]);

        if(!$validation) {
            $data = [
                'title' => 'Change Password failed',
                'validation' => $this->validator,
                'token' => $this->request->getPost('token')
            ];

            return view('auth/changePassword', $data);
        } else {
            $usersModel = new UsersModel();

            $userInfo = $usersModel->where('token', $this->request->getPost('token'))->first();

            $data = [
                'password' => Hash::make($this->request->getPost('password'))
            ];
            
            // dd($data);
            $updatePass = $usersModel->update($userInfo['id'], $data);
            if(!$updatePass) {
                return redirect()->to('auth/updatePassword')->with('fail', 'Failed to change your password');
            } else {
                return redirect()->to('auth');
            }
        }
    }
}