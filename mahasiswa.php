<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "crud_db";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nim        = "";
$nama       = "";
$tgl_lahir  = "";
$alamat     = "";
$agama      = "";
$kelamin    = "";
$no_hp      = "";
$email      = "";
$prodi      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['mhs'])) {
    $mhs = $_GET['mhs'];
} else {
    $mhs = "";
}
if($mhs == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM mahasiswa WHERE id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($mhs == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nim        = $r1['nim'];
    $nama       = $r1['nama'];
    $tgl_lahir  = $r1['tgl_lahir'];
    $alamat     = $r1['alamat'];
    $agama      = $r1['agama'];
    $kelamin    = $r1['kelamin'];
    $no_hp      = $r1['no_hp'];
    $email      = $r1['email'];
    $prodi      = $r1['id_prodi'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $alamat     = $_POST['alamat'];
    $agama      = $_POST['agama'];
    $kelamin    = $_POST['kelamin'];
    $no_hp      = $_POST['no_hp'];
    $email      = $_POST['email'];
    $prodi      = $_POST['prodi'];

    if ($nim && $nama && $tgl_lahir && $alamat && $agama && $kelamin && $no_hp && $email && $prodi) {
        if ($mhs == 'edit') { //untuk update
            $sql1       = "UPDATE mahasiswa SET nim = '$nim',nama='$nama',tgl_lahir = '$tgl_lahir',alamat = '$alamat', agama = '$agama', kelamin = '$kelamin', no_hp = '$no_hp', email = '$email', id_prodi = '$prodi' WHERE id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "INSERT INTO mahasiswa(nim,nama,tgl_lahir,alamat,agama,kelamin,no_hp,email,id_prodi ) VALUES ('$nim','$nama','$tgl_lahir','$alamat','$agama','$kelamin', '$no_hp', '$email', '$prodi')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
            <a class="text-decoration-none" href="mahasiswa.php"><h3 class="btn btn-dark btn-sm" style="float: right;">Prev</h3></a>
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=mahasiswa.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=mahasiswa.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agama" id="agama">
                                <option value="">- Pilih Agama -</option>
                                <option value="Katolik" <?php if ($agama == "Katolik") echo "selected" ?>>Katolik</option>
                                <option value="Protestan" <?php if ($agama == "Protestan") echo "selected" ?>>Protestan</option>
                                <option value="Islam" <?php if ($agama == "Islam") echo "selected" ?>>Islam</option>
                                <option value="Hindu" <?php if ($agama == "Hindu") echo "selected" ?>>Hindu</option>
                                <option value="Buddha" <?php if ($agama == "Buddha") echo "selected" ?>>Buddha</option>
                                <option value="KongHuCu" <?php if ($agama == "Kong Hu Cu") echo "selected" ?>>Kong Hu Cu</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="radio" name="kelamin" value="L" <?php if($kelamin =='L') echo 'checked'?>>Laki-laki
                            <input type="radio" name="kelamin" value="P" <?php if($kelamin =='P') echo 'checked'?>>Perempuan
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="no_hp" class="col-sm-2 col-form-label">Nomor Hp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $no_hp ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                        <div class="col-sm-10">
                        <select name="prodi" id="prodi">
                        <option value="">- Pilih Program Studi -</option>
                            <?php
                            $qry="SELECT * FROM prodi";
                            $hasil=mysqli_query($koneksi,$qry);
                            while ($row=mysqli_fetch_array($hasil)) {
                                echo "<option value='$row[0]'>".$row[0]." - ".$row[1]."</option>";
                            }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Kelamin</th>
                            <th scope="col">Nomor Hp</th>
                            <th scope="col">Email</th>
                            <th scope="col">Program Studi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "SELECT * FROM mahasiswa ORDER BY id ASC";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $no     = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nim        = $r2['nim'];
                            $nama       = $r2['nama'];
                            $tgl_lahir  = $r2['tgl_lahir'];
                            $alamat     = $r2['alamat'];
                            $agama      = $r2['agama'];
                            $kelamin    = $r2['kelamin'];
                            $no_hp      = $r2['no_hp'];
                            $email      = $r2['email'];
                            $prodi      = $r2['id_prodi'];

                        ?>
                            <tr class="text-center">
                                <th scope="row"><?php echo $no++ ?></th>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo date('d-m-Y', strtotime ($tgl_lahir))?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $agama ?></td>
                                <td scope="row"><?php echo $kelamin ?></td>
                                <td scope="row"><?php echo $no_hp ?></td>
                                <td scope="row"><?php echo $email ?></td>
                                <td scope="row"><?php echo $prodi ?></td>
                                <td scope="row">
                                    <a href="mahasiswa.php?mhs=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning btn-sm">Edit</button></a>
                                    <a href="mahasiswa.php?mhs=delete&id=<?php echo $id?>" onclick="return confirm('Apakah Anda Mau Menghapusnya?')"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>
