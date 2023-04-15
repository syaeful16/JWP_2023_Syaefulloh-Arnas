<?php

namespace App\Models;

use CodeIgniter\Model;

class DiarysModel extends Model {
  protected $table = 'diary';
  protected $allowedFields = ['title', 'diary', 'date_created', 'user_id'];
}

?>