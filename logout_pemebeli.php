<?php
session_start();

/* hapus session pembeli */
unset($_SESSION['pembeli']);

/* hancurkan session */
session_destroy();

/* kembali ke halaman login pembeli */
header("Location: login_pembeli.php");
exit;
?>
