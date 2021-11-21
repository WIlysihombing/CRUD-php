<!DOCTYPE html>
<?php
include 'koneksi.php';
?>
<html>
<head>
	<title>Tambah Prodi</title>
</head>
<body>
	<form method="POST">
	<table border="0" width="50%" align="center">
		<tr>
			<td width="25%">Nama Jurusan</td>
			<td width="75%"><input type="text" name="nama" size="40" placeholder="Nama Jurusan" required=""></td>
		</tr>
		<tr>
			<td width="25%">Nama Prodi</td>
			<td width="75%"><input type="text" name="nama1" size="40" placeholder="Nama Prodi" required=""></td>
		</tr>
		<tr>
			<td width="25%"></td>
			<td width="75%"><input type="submit" name="save" value="simpan"></td>
		</tr>
	</table> 
	</form>
<?php
if(isset($_POST['save']))
{
	$nama=$_POST['nama'];
	$sql="INSERT into Prodi (nama_Prodi),Jurusan (nama_jurusan) values ('$nama1','nama')";
	$hasil=mysqli_query($konek,$sql);
	if($hasil)
		echo"<script language='javascript'>
		(window.alert('Data Tersimpan'))
		location.href='tambah_prodi.php,tambah_jurusan.php'
		</script>";
	else
		echo"<script language='javascript'>
		(window.alert('Data Tidak Dapat Tersimpan'))
		location.href='tambah_prodi.php,tambah_jurusan.php'
		</script>";
}
?>
</body>
</html>