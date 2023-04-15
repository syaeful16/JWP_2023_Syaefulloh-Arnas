<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Profile extends BaseController
{

  protected $userModel, $userInfo;

  public function __construct()
  {
    $this->userModel = new UsersModel();
    $loggedUserId = session()->get('logged');
    $this->userInfo = $this->userModel->find($loggedUserId);
  }

  public function index()
  {
    $data = [
      'title' => 'My Profile',
      'userInfo' => $this->userInfo
    ];

    return view('profile/profile', $data);
  }

  public function changePhoto()
  {
    $filePhoto = $this->request->getFile('photo');
    $namePhoto = $filePhoto->getRandomName();
    
    $filePhoto->move('img', $namePhoto);

    $data = [
      'photo' => $namePhoto
    ];

    $this->userModel->update($this->userInfo['id'], $data);

    return redirect()->back();
  }

  public function update() {
    
    $data = [
      'name' => $this->request->getPost('name'),
      'email' => $this->request->getPost('email')
    ];

    $this->userModel->update($this->userInfo['id'], $data);

    return redirect()->back()->with('success', 'successfully changed the data');
  }
}