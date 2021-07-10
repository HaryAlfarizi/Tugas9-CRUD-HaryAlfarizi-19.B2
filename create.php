<!DOCTYPE html>
<html>
<head>
    <title>FORM TAMBAH DATA PEMBELI</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama_barang=input($_POST["nama_barang"]);
        $nama_pembeli=input($_POST["nama_pembeli"]);
        $alamat=input($_POST["alamat"]);
        $jumlah_beli=input($_POST["jumlah_beli"]);
        $no_hp=input($_POST["no_hp"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into pembeli (nama_barang,nama_pembeli,alamat,jumlah_beli,no_hp) values
		('$nama_barang','$nama_pembeli','$alamat','$jumlah_beli','$no_hp')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'>Data gagal disimpan!</div>";

        }

    }
    ?>
    <h2>TAMBAHKAN DATA PEMBELI</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang" required />

        </div>
        <div class="form-group">
            <label>Nama Pembeli:</label>
            <input type="text" name="nama_pembeli" class="form-control" placeholder="Masukan Nama Pembeli" required/>
     </div>

        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>

        </div>
        <div class="form-group">
            <label>Jumlah Beli:</label>
            <input type="jumlah_beli" name="jumlah_beli" class="form-control" placeholder="Masukan Jumlah Beli" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
    </form>
</div>
</body>
</html>