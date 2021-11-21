<?php
include 'koneksi.php';
?>
<h3 align="center">Daftar Prodi</h3>
<form method="POST" action="tambah_jurusan.php">
    <input type="submit" name="add" value="Tambah Jurusan">
  </form>
<table border="1" width="50%" align="center">
<caption>
  <form method="POST">
    <input type="text" name="kata" size="35">
    <input type="submit" name="cari" value="Search!">
  </form>
</caption>  
<th width="8%">No</th>
<th width="5%">Id Prodi</th>
<th width="30%">Nama Jurusan</th>
<th width="35%">Nama Prodi</th>
<th width="15%">Aksi</th>
<?php
$no=1;
if(isset($_POST['cari']))
  {
  $kata=$_POST['kata']; 
  $sql="SELECT a.id_prodi,b.nama_jurusan,a.nama_prodi FROM prodi a,jurusan b WHERE a.id_jurusan=b.id_jurusan and (b.nama_jurusan like '%$kata%' or a.nama_prodi like '%$kata%')";
  }
else
  $sql="SELECT a.id_prodi,b.nama_jurusan,a.nama_prodi FROM prodi a,jurusan b WHERE a.id_jurusan=b.id_jurusan";
//    
$qry=mysqli_query($konek,$sql);
while($row=mysqli_fetch_array($qry))
{ 
     echo "<tr>";
     echo "<td align='center'>".$no++."</td>";
     echo "<td align='center'>".$row[0]."</td>";
     echo "<td>".$row[1]."</td>";
     echo "<td>".$row[2]."</td>";
     echo "<td align='center'> <a href='edit_jurusan.php?id=$row[0]'> Edit </a> |
                            <a href='del_jurusan.php?id=$row[0]'> Hapus </a>
     </td>";
     echo "</tr>";
}     
?>
</table>