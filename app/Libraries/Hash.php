<?php 

namespace App\Libraries;

class Hash {
  public static function make($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }

  public static function check($inputPassword, $dbPassword) {
    if(password_verify($inputPassword, $dbPassword)) {
      return true;
    } else {
      return false;
    }
  }
}

?>