<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/f1a60a6392.js" crossorigin="anonymous"></script>
</head>
<body>
  <?= $this->renderSection('content') ?>
  <script>
    $('#btn-show').click(function() {
      var inputpass = $('#pass');
      if(inputpass.attr('type') === 'password') {
        inputpass.attr('type', 'text');
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        inputpass.attr('type', 'password');
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });
    $('#btn-show2').click(function() {
      var inputpass = $('#pass2');
      if(inputpass.attr('type') === 'password') {
        inputpass.attr('type', 'text');
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        inputpass.attr('type', 'password');
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });
  </script>
</body>
</html>