 <?php  // Membuat koneksi database 
 $server = "localhost";
 $username = "root";
 $password = "";
 $database = "dbmhs";

 // Menghubungkan koneksi ke server database 
 $koneksi = mysqli_connect($server , $username , $password , $database) or die (mysqli_error($koneksi));
 ?>