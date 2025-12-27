<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){
    $u=$_POST['username'];
    $p=$_POST['password'];
    $q=mysqli_query($conn,"SELECT * FROM pembeli WHERE username='$u' AND password='$p'");
    if(mysqli_num_rows($q)>0){
        $_SESSION['pembeli']=$u;
        header("Location: pembeli.php");
    } else {
        echo "<script>alert('Login gagal');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Pembeli</title>
    <style>
    body{
        background:#fde2e4;
        font-family:Poppins;
    }
    .box{
        width:300px;
        margin:120px auto;
        background:#fff0f3;
        padding:20px;
        border-radius:15px;
    }
    input,button{
        width:100%;
        margin:8px 0;
        padding:8px;
        border-radius:8px;
        border:1px solid #f497b6;
    }
    button{
        background:#f497b6;
        color:white;
    }
    </style>
</head>
<body>

<div class="box">
<button onclick="history.back()">⬅ Kembali</button>
<h3>Login Pembeli</h3>
<form method="post">
<input name="username" placeholder="Username" required>
<input name="password" type="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
</div>

</body>
</html>
