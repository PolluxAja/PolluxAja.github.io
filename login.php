<?php
session_start();
include "Database/proses_register.php";

$PesanError = "";

//kalau tombol diklik
if(isset($_POST['Login'])) {
  $usernameLogin = trim($_POST['username']);
  $passwordLogin = trim($_POST['password']);
  if(empty($usernameLogin) || empty($passwordLogin)) {
    $PesanError = "Form wajib di isi semua!";
  } else {
  $stmt = $db->prepare("SELECT * FROM DataUser WHERE username = ?");
    $stmt -> bind_param("s",  $usernameLogin);
    $stmt -> execute();
    $result = $stmt -> get_result();
  $user = $result->fetch_assoc();

  if($user && password_verify($passwordLogin, $user['password'])) {
    $_SESSION['status'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['id_user'] = $user['id'];
    header("location: dashboard.php");
    exit();
  } else {
    echo "akun tidak ditemukan";
  }
  }
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Design/login.css?v=2">

</head>
<body>
    <div class="login-container">
  <?php
    include "Layout/header.php"
      ?>
  <h3>Halaman Login</h3>
      <?= $PesanError?>
  <form action="" method="POST">
    <input type="text" placeholder="username" name="username">
    <input type="password" placeholder="password" name="password">
    <br>
    <button type="submit" name="Login">Login</button>
  </form>
    </div>
</body>
</html>