<?php 
 
 include 'koneksi.php';

 // Membuat Perintah jika tombol ditekan
 if (isset($_POST['bsimpan'])) {

    // UPDATE DATA
    // Pengujian Apakah data akan di edit atau di sinmpan 
    if ($_GET['hal'] == "edit") {
      
      // Data akan di edit 
      $edit = mysqli_query($koneksi , "UPDATE tmhs set
                                      NIM = '$_POST[tnim]',
                                       NAMA = '$_POST[tnama]',
                                        ALAMAT = '$_POST[talamat]',
                                         JURUSAN = '$_POST[tjurusan]'
                                         WHERE id_mhs = '$_GET[id]'

                                      ");
      // Jika data di edit sukses
      if ($edit) { // Akan menampilkan SUKSES
        echo "<script>
                alert('Edit Data Sukses');
                document.location='admin.php'; 
              </script>";
      }
      // Jika data di edit gagal
      else { // Akan menampilkan Gagal 
        echo "<script>
                alert('Edit Data gagal');
                document.location='admin.php';
              </script>";
      }

    }
     else {
      // Data akan disimpan 
      $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (NIM , NAMA , ALAMAT , JURUSAN)
                                          VALUES ('$_POST[tnim]',
                                                  '$_POST[tnama]',
                                                  '$_POST[talamat]',
                                                  '$_POST[tjurusan]')
                                          ");
     
        // Jika data di simpan sukses
      if ($simpan) { // Akan menampilkan SUKSES
        echo "<script>
                alert('Simpan Data Sukses');
                document.location='admin.php'; 
              </script>";
      }
      // Jika data di simpan gagal
      else { // Akan menampilkan Gagal 
        echo "<script>
                alert('Simpan Data gagal');
                document.location='admin.php';
              </script>";
      }

       }
     
    }
    // Menampilkan Data yang mau di edit atau dihapus    
     // Pengujian jika tombol edit / hapus di klik 
     if (isset($_GET['hal'])) {
       // Pengujian jika edit data 
       if ($_GET['hal'] == "edit") {
          
          //Tampilkan Data yang akan di edit 
          $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
          $data = mysqli_fetch_array($tampil);
          if ($data) {
            
             // Jika data ditemukan , maka ditampung ke dalam variabel
             $vnim = $data['NIM'];
             $vnama = $data['NAMA'];
             $valamat = $data['ALAMAT'];
             $vjurusan = $data['JURUSAN'];
          }
       }
       // DELETE DATA 
       elseif ($_GET['hal'] == "hapus") {
         $hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
         if ($hapus) {
           echo "<script>
                alert('Hapus Data Sukses');
                document.location='admin.php'; 
              </script>";
         }
       }
     }


 ?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>DATA MAHASISWA 19</title>
  </head>
  <body>
    <h1 style="text-align: center; margin-top: 10px;">PROGRAM SEDERHANA CRUD DATA MAHASISWA FT BILLFATH</h1>
    <div class="container">

      <!-- Awal  card  form-->
      <div class="card bg-dark">
        <div class="card-header" style="text-align: center;" >
          CRUD DATA MAHASISWA FT UNIVERSITAS BILLFATH LAMONGAN
        </div>
        <div class="card-body bg-success">
          <!-- ini adalah awal form -->
          <form method="post" action="">
            <div class="form-grup">
              <label>NIM</label>
              <input type="text" name="tnim" value="<?=@$vnim ?>"  class="form-control" placeholder="MASUKAN NIM ANDA" required>
            </div>
             <div class="form-grup">
              <label>NAMA</label>
              <input type="text" name="tnama" value="<?=@$vnama ?>"  class="form-control" placeholder="MASUKAN NAMA ANDA" required>
            </div>
             <div class="form-grup">
              <label>ALAMAT</label>
              <textarea class="form-control" name="talamat" placeholder="MASUKAN ALAMAT ANDA"><?=@$valamat ?></textarea>
            </div>
            <div class="form-grup">
              <label>JURUSAN</label>
             <select class="form-control" name="tjurusan">
               <option value="<?=@$vjurusan ?>"><?=@$vjurusan ?></option>
               <option value="S1-TEKNIK INFORMATIKA">S1-TEKNIK INFORMATIKA</option>
               <option value="S1-TEKNIK MESIN">S1-TEKNIK MESIN</option>
               <option value="S1-TEKNIK ELEKTRO">S1-TEKNIK ELEKTRO</option>
             </select>
            </div>
            
            <button type="submit" class="btn btn-primary"  name="bsimpan" style="margin-top: 5px;">Simpan</button>
            <button type="reset" class="btn btn-warning"  name="breset" style="margin-top: 5px;">Kosongkan</button>
           
          </form>
          <!-- ini adalah  akhir form -->
        </div>
      </div>
       <!-- akhir dari card -->

  <!-- Awal  card tabel-->
      <div class="card mt-5">
            <div class="card-header bg-success" style="text-align: center;" >
              DAFTAR DATA MAHASISWA FT UNIVERSITAS BILLFATH LAMONGAN
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">NIM</th>
                  <th style="text-align: center;">NAMA</th>
                  <th style="text-align: center;">ALAMAT</th>
                  <th style="text-align: center;">JURUSAN</th>
                  <th style="text-align: center;">AKHIR</th>
                </tr>
                <?php 
                    // Menampilkan Data 
                    $No = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs ORDER BY id_mhs DESC");
                    while ($data = mysqli_fetch_array($tampil))  :

                 ?>
                 <tr>
                   
                    <td><?=$No++;?></td>
                    <td><?=$data['NIM']?></td>
                    <td><?=$data['NAMA']?></td>
                    <td><?=$data['ALAMAT']?></td>
                    <td><?=$data['JURUSAN']?></td>
                    <td>
                      <a href="admin.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning"> EDIT </a>
                       <a href="admin.php?hal=hapus&id=<?=$data['id_mhs']?>" onclick="return confirm('Apakah Anda yakin menghapus data ini)" class="btn btn-danger"> HAPUS </a>
                    </td>

                 </tr>

             <?php endwhile ; ?>
              </table>
              
            </div>
          </div>
           <!-- akhir dari card -->


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>