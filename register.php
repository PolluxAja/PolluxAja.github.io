<?php
session_start();
include "Database/proses_register.php";
$error1 = "";
$error2 = "";

//kalo tombol diklik
if (isset($_POST["Register"])) {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $Hash = password_hash($password, PASSWORD_DEFAULT);

  //yang jni kalo input user kosong
  if (empty($username) || empty($password)) {
    $error1 = "Form wajib di-isi!";
    //yang ini kalau input user dua duanya ada isj
  } else {
    $stmt = $db->prepare(
      "INSERT INTO DataUser (username, password) VALUES (?, ?)"
    );
    $stmt->bind_param("ss", $username, $Hash);

    if ($stmt->execute()) {
      $IdUser = $db->insert_id;

      $_SESSION['status'] = True;
      $_SESSION['username'] = $username;
      $_SESSION['id_user'] = $IdUser;
      
      header("location: dashboard.php");
      exit();
    } else {
      $error2 = "Registrasi gagal!";
    }
  }
}
if (isset($_SESSION["status"])) {
  header("location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Design/register.css">
  <?php include "Layout/header.php"; ?>
</head>
<body>
  
  <form action="register.php" method="POST">
    <div class="register-container">
  <h3>Halaman Register</h3>
      <?= $error1 ?>
      <?= $error2 ?>
  <input type="text" placeholder="username" name="username">
  <input type="password" placeholder="password" name="password">
  <br>
  <button type="submit" name="Register">Register</button>
      <h3>Sudah punya akun?</h3>
      <a href="login.php">Login</a>
    </div>
  </form>
</body>
</html>