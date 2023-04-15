<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model {
  protected $table = 'users';
  protected $allowedFields = ['name', 'email', 'password', 'photo', 'token'];
}

?>