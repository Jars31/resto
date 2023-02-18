<?php 

include 'config/koneksi.php';

if (isset($_POST['simpan'])) {
  $tmp = $_FILES['foto']['tmp_name'];
  $folder = "image/";
  $nama_file = $_FILES['foto']['name'];

  move_uploaded_file($tmp,"$folder/$nama_file");
  $a = mysqli_query($conn, "INSERT INTO tb_menu VALUES(null,'$_POST[menu]','$_POST[jenis]','$_POST[harga]','$_POST[status]','$nama_file','$_POST[kategori]')");
  echo "<script>alert('Berhasil Tersimpan');document.location.href='?menu=menu'</script>";
}

if (isset($_GET['hapus'])) {
  $b = mysqli_query($conn,"DELETE FROM tb_menu WHERE kd_menu = '$_GET[id]'");
  echo "<script>alert('Berhasil Dihapus');document.location.href='?menu=menu''</script>";
}

if (isset($_GET['edit'])) {
  $edit = "SELECT * FROM tb_menu WHERE kd_menu = '$_GET[id]'";
  $take = mysqli_query($conn,$edit);
    $ambil = mysqli_fetch_array($take);
}

if(isset($_POST['update'])){
  $tmp = $_FILES['foto']['tmp_name'];
  $folder = "image/";
  $nama_file = $_FILES['foto']['name'];

  move_uploaded_file($tmp,"$folder/$nama_file");
  $c = mysqli_query($conn,"UPDATE tb_menu SET menu = '$_POST[menu]', jenis = '$_POST[jenis]',harga = '$_POST[harga]', status = '$_POST[status]', foto = '$nama_file', kategori = '$_POST[kategori]' WHERE menu = '$_POST[menu]'");
  echo "<script>alert('Berhasil Diubah');document.location.href='?menu=menu''</script>";
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Entri Meja</title>
  <style> 
        body {
        background-color:lightblue;
        background-repeat: no-repeat;
        background-size: cover;

    }
  </style>
</head>
<style type="text/css">
* {margin:0; padding:0;}
nav{
  position: fixed;
  background-color: rgb(10,101,146);
   width: 100%;
   height: 50px;
   font-family: sans-serif;  
}
nav ul ul {
 display: none;
}

nav ul li:hover > ul{
display: block;
width: 150px;
}

nav ul {
 background: rgb(10,101,146);
 list-style: none;
 position: relative;
 display: inline-table;
 width: 100%;
}
        

nav ul li{
 float:left;
}

nav ul li:hover{
 background:#666;

}

nav ul li:hover a{
 color:#fff;

}

nav ul li a{
 display: block;
 padding: 20px;
 color: #fff;
 text-decoration: none;

}
  .button{
    background-color:rgb(10,101,146);
     border:none;
     color: white;
     width: 90px;
     height: 30px;
     border-radius: 10px;
  }
  .button:hover{
    background-color:rgb(10,101,146);
    color: white;
  }
   table tr {
      text-align: center;
      padding-left: 20px;
    }
        td,th{
            color:black;
        }
        table th {
      padding: 10px 40px;
      border-left:0,5px solid black;
      border-bottom: 0,5px solid #000;
      background: #bdbdbd ;
    }
</style>
<body>
  <nav>
    <ul>
      <li><a href="dashboard.php" style="font-family: Century Gothic">Welcome</a></li>
      <li><a href="menu.php" style="font-family: Century Gothic">Menu</a></li>
      <li><a href="kategori.php" style="font-family: Century Gothic">Kategori</a></li>
      <li><a href="entri_meja.php" style="font-family: Century Gothic">Entri Meja</a></li>
      <li><a href="user.php" style="font-family: Century Gothic">Kelola User</a></li>
      <li><a href="logout.php" onclick="return confirm('Apa anda yakin ?')">Log Out</a></li>
    </ul>
  </nav>
  <br>
  <br><br><br><br>
  <center><h1 style="font-family:Century Gothic; color:rgba(10,101,146);">Entri Meja</h1>
    <br><br>
    <center><form method="post" enctype="multipart/form-data">
      <table align="center">
        <tr>
          <td>Nomer Meja</td>
          <td><input type="text" name="menu" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" value="<?php echo @$ambil[1];?>"></td>
        </tr>
        <tr>
          <td>Pesan</td>
          <td><select name="jenis" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;">
              <option>Makanan</option>
              <option>Minuman</option>
          </select></td>
        </tr>
        <tr>
          <td>Nama Menu</td>
          <td><input type="text" name="harga" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" value="<?php echo @$ambil[3];?>"></td>
        <tr>
          <td>Catatan Tambahan</td>
          <td><input type="text" name="harga" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" value="<?php echo @$ambil[3];?>"></td>


        </tr>
        <tr>
          
        </tr>
        <tr>
        </tr>
        <tr>
          
          </td>
        </tr>
        <tr>
          <td></td>
          <td><br><input type="submit" name="simpan" value="Simpan" class="button" style="margin-right: 10px"></td>
        </tr>
      </table><br>
    </div>
    </form>
    <form method="post">
      <table cellpadding="10" border="1" style="margin-top: 30px;border-collapse: collapse;" align="center">
        <tr>
          <th>No.Meja</th>
          <th>Jenis Pesanan</th>
          <th>Nama Menu</th>
          <th>Catatan</th>
          <th>Aksi</th>
        </tr>
        <?php
          $sql = "SELECT * FROM tb_menu";
          if (isset($_POST['cari'])) {
              $sql="SELECT * FROM tb_menu WHERE kd_menu LIKE '$_POST[tcari]%' OR menu LIKE '$_POST[tcari]%' OR jenis LIKE '$_POST[tcari]%' OR harga LIKE '$_POST[tcari]%' OR status LIKE '$_POST[tcari]%'";
            }else{
              $sql="SELECT * FROM tb_menu";
            }
          $qry = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_array($qry)){
          ?>
        <tr>
          <td><?php echo $row[0]; ?></td>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><a href="?menu=menu&edit&id=<?php echo $row[0];?>">Edit</a> | <a href="?menu=menu&hapus&id=<?php echo $row[0];?>">Hapus</a></td>
        </tr>
      <?php } ?>
      </table>
    </form></center>
</body>
</html>