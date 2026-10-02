<?php
session_start();
if(isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("location: index.php");
  exit();
}

if(isset($_POST['catat'])) {
  header("location: catatan.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Design/dashboard.css?v=1">
</head>
<body>
  <?php include "Layout/header.php"; ?>
  <h1>Halo <?= $_SESSION['username'] ?></h1>
  <form action="dashboard.php" method="POST">
    <div class="logout">
    <button type="submit" name="logout">Logout</button>
      <br>
      <a href="https://whatsapp.com/channel/0029VbD4ItF2ZjCtnMFgZL19">Link</a>
      <br>
      <button type="submit" name = "catat">Catatan</button>
    </div>
  </form>
</body>
</html>