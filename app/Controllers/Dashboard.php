<?php

namespace App\Controllers;

use App\Models\DiarysModel;
use App\Models\UsersModel;


class Dashboard extends BaseController
{

  protected $userModel, $userInfo, $diaryModel;

  public function __construct()
  {
    helper(['url', 'form']);
    $this->userModel = new UsersModel();
    $loggedUserId = session()->get('logged');
    $this->userInfo = $this->userModel->find($loggedUserId);
    $this->diaryModel = new DiarysModel();
  }

  public function index() {
    $diaryUser = $this->diaryModel->where('user_id', $this->userInfo['id'])->orderBy('id', 'DESC')->findAll();
    $data = [
      'title' => 'Dashboard',
      'userInfo' => $this->userInfo,
      'dataDiary' => $diaryUser
    ];
    return view('dashboard/index', $data);
  }

  public function insert() {
    // dd($this->request->getPost('diary'));
    $validation = $this->validate([
      'title' => [
        'rules' => 'required|max_length[100]',
        'errors' => [
          'required' => 'Title cannot be empty',
          'max_length' => 'Cannot exceed {param} characters '
        ]
      ],
    ]);

    if(!$validation) {
      $data = [
        'title' => 'Dashboard',
        'userInfo' => $this->userInfo,
        'validation' => $this->validator
      ];

      return view('dashboard/index', $data);
    } else {
      try {
        $title = $this->request->getPost('title');
        $diary = $this->request->getPost('diary');

        $data = [
          'title' => $title,
          'diary' => $diary,
          'date_created' => date('Y-m-d'),
          'user_id' => $this->userInfo['id']
        ];

        $query = $this->diaryModel->insert($data);
        if(!$query) {
          return redirect()->to('dashboard')->with('failed', 'Seomething went wrong');
        } else {
          return redirect()->to('dashboard')->with('success', 'Success added diary');
        }
      } catch(\Exception $e) {
        dd($e);
      }
    }
  }

  public function delete($id) {
    $delete = $this->diaryModel->delete($id);

    if(!$delete) {
      return redirect()->to('/dashboard')->with('faildel', 'Failed delete diary');
    } else {
      return redirect()->to('/dashboard')->with('successdel', 'Successfully delete diary');
    }
  }
  
}

?>