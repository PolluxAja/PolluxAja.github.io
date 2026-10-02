<?php
session_start();
$pemberitahuan = "";
include "Database/proses_register.php";
if(isset($_POST['save'])) {
  $catatan = trim($_POST['catatan']);
  $IdUser = $_SESSION['id_user'];

  if(empty($catatan)) {
    echo "Catatan disarankan tidak boleh kosong!";
  } else {
    $IdUser = $_SESSION['id_user'];
    $stmt = $db->prepare("INSERT INTO Catatan (isi_catatan, id_catatan) VALUES (?, ?)");
    $stmt->bind_param("si", $catatan, $IdUser);
    $stmt->execute();
    $result = $stmt->get_result();
    $pemberitahuan = "berhasil disimpan";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="catatan.php" method="POST">
  <div>
  <h1>test</h1>
  <?php while ($catatan = $result->fetc_assoc()): ?>
    <p><?php echo $catatan['isi_catatan']; ?></p>
    <?php endwhile; ?>
    <?= $pemberitahuan ?>
    <textarea name="catatan"></textarea>
    <button type="submit" name="save">Save/Simpan</button>
  </div>
  </form>
</body>
</html>