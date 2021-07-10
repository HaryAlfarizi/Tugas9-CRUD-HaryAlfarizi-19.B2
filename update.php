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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_anggota
    if (isset($_GET['id_anggota'])) {
        $id_anggota=input($_GET["id_anggota"]);

        $sql="select * from pembeli where id_anggota=$id_anggota";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_anggota=htmlspecialchars($_POST["id_anggota"]);
        $nama_barang=input($_POST["nama_barang"]);
        $nama_pembeli=input($_POST["nama_pembeli"]);
        $alamat=input($_POST["alamat"]);
        $jumlah_beli=input($_POST["jumlah_beli"]);
        $no_hp=input($_POST["no_hp"]);

        //Query update data pada tabel anggota
        $sql="update pembeli set
			nama_barang='$nama_barang',
			nama_pembeli='$nama_pembeli',
			alamat='$alamat',
			jumlah_beli='$jumlah_beli',
			no_hp='$no_hp'
			where id_anggota=$id_anggota";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'>Data gagal diupdate!</div>";

        }

    }

    ?>
    <h2>Update Data Pembeli</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" class="form-control" value="<?php echo $data['nama_barang']; ?>" placeholder="Masukan Nama Barang" required />

        </div>
        <div class="form-group">
            <label>Nama Pembeli:</label>
            <input type="text" name="nama_pembeli" class="form-control" value="<?php echo $data['nama_pembeli']; ?>" placeholder="Masukan Nama Pembeli" required/>
        </div>

        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required><?php echo $data['alamat']; ?></textarea>

        </div>
        <div class="form-group">
            <label>Jumlah Beli:</label>
            <input type="jumlah_beli" name="jumlah_beli" class="form-control" value="<?php echo $data['jumlah_beli']; ?>" placeholder="Masukan Jumlah Beli" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" value="<?php echo $data['no_hp']; ?>" placeholder="Masukan No HP" required/>
        </div>

        <input type="hidden" name="id_anggota" value="<?php echo $data['id_anggota']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>