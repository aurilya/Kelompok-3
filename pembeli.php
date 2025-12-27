<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['pembeli'])) header("Location: index.php");

if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

if(isset($_POST['tambah'])){
    $_SESSION['cart'][]=$_POST;
}

if(isset($_GET['hapus'])){
    unset($_SESSION['cart'][$_GET['hapus']]);
}

if(isset($_POST['checkout'])){
    foreach($_SESSION['cart'] as $c){
        $total=$c['harga']*$c['jumlah'];
        mysqli_query($conn,"INSERT INTO tblpembeli VALUES(NULL,'$_SESSION[pembeli]','$c[nama]','$c[harga]','$c[jumlah]','$total',CURRENT_TIMESTAMP)");
    }
    $_SESSION['cart']=[];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Pembeli</title>
    <style>
    body{
        background:#fde2e4;
        font-family:Poppins;
    }
    .box{
        width:95%;
        margin:30px auto;
        background:#fff0f3;
        padding:20px;
        border-radius:15px;
    }
    table{
        width:100%;
        border-collapse:collapse;
    }
    th,td{
        padding:8px;
        text-align:center;
    }
    th{
        background:#f497b6;
        color:white;
    }
    button{
        background:#f497b6;
        color:white;
        padding:6px;
        border:none;
        border-radius:8px;
    }
    .nav{
        display:flex;
        justify-content:space-between;
        margin-bottom:15px;
    }
    </style>
</head>
<body>

<div class="box">
<div class="nav">
<button onclick="history.back()">⬅ Kembali</button>
<button onclick="window.location.href='logout_pembeli.php'">Logout</button>


</div>

<h3>Daftar Barang</h3>
    <table>
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
<?php
$q=mysqli_query($conn,"SELECT * FROM tblbarang");
while($b=mysqli_fetch_assoc($q)){
?>
<tr>
<form method="post">
<td><?= $b['nama_barang'] ?></td>
<td><?= $b['harga'] ?></td>
<td><input type="number" name="jumlah" min="1" required></td>
<td>
<input type="hidden" name="nama" value="<?= $b['nama_barang'] ?>">
<input type="hidden" name="harga" value="<?= $b['harga'] ?>">
<button name="tambah">+ Keranjang</button>
</td>
</form>
</tr>
<?php } ?>
</table>

<hr>
<h3>Keranjang</h3>
    <table>
    <tr>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
<?php
$g=0;
foreach($_SESSION['cart'] as $i=>$c){
$t=$c['harga']*$c['jumlah'];
$g+=$t;
echo "<tr>
<td>$c[nama]</td>
<td>$c[jumlah]</td>
<td>$t</td>
<td><a href='?hapus=$i'>Hapus</a></td>
</tr>";
}
echo "<tr><th colspan='2'>Total</th><th colspan='2'>$g</th></tr>";
?>
</table>

<form method="post">
<button name="checkout">Checkout</button>
</form>

</div>
</body>
</html>
