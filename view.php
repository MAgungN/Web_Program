<?php
$con = new mysqli("localhost", "root", "", "db_surat_agung");

$tgl = date ('d F Y');

$query = mysqli_query($con, 'SELECT * FROM tbl_surat');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Surat</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    $pesan = $_GET['pesan'];
    $frm = $_GET['frm'];
    //echo $pesan;
    if($pesan == 'success' && $frm == 'del'){

    ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Berhasil!</strong> Selamat Anda telah menghapus.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    } else if($pesan == 'success' && $frm == 'add'){

    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> Selamat Anda telah menambahkan.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        }else if($pesan == 'success' && $frm == 'edit'){

            ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <strong>Berhasil!</strong> Selamat Anda telah mengubah.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
?>
    <h1 style="text-align:center"><b>LIST SURAT</b></h1>
<table class="table table-sm">
    <thead class="table-info">
      <td>NO SURAT</td>
      <td>JENIS SURAT</td>
      <td>TANGGAL SURAT</td>
      <td>TTD SURAT</td>
      <td>TTD MENGETAHUI</td>
      <td>TTD MENYETUJUI</td>
      <td colspan="2">ACTION</td>
    </thead>
    <tbody>

<?php
        foreach ($query as $isi) {
            if($isi["jenis_surat"] == '1') {
                $js = "Surat Keputusan";
            }
            else if($isi["jenis_surat"] == '2'){
                    $js = "Surat Pernyataan";
            }else if($isi["jenis_surat"] == '3'){
                    $js = "Surat Pinjaman";
            }else{
                $js = "Kode Permasalahan";
            }
            ?>
        <tr>
            <td><?php echo $isi['no_surat'];?></td>
            <td><?php echo $js;?></td>
            <td><?php echo $isi['tgl_surat'];?></td>
            <td><?php echo $isi['ttd_surat'];?></td>
            <td><?php echo $isi['ttd_mengetahui'];?></td>
            <td><?php echo $isi['ttd_menyetujui'];?></td>
            <td><a href="edit.php?id=<?php echo $isi['id'];?>">EDIT</a></td>
            <td><a href="#" data-bs-toggle="modal" data-bs-target="#deletesurat<?php echo $isi['id'];?>">DELET</a></td>
        </tr>

        <div class="example-modal">
            <div id="deletesurat<?php echo $isi['id'];?>" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog">
            <div class="modal-content">
            <form class="row g-3" action="delete.php" method="post">
            <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;
        </span></button>
        <h3 class="modal-title">Konfirmasi Delete Data Surat</h3>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $isi['id'];?>">
            <h4 class="text-center">Apakah Anda yakin ingin menghapus no surat <?php echo $isi['no_surat']; ?><strong><span class="grt"></span></strong></h4>
        </div>
        <div class="modal-footer">
            <button id="nodelete" type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancle</button>
			<button type="submit" class="btn btn-primary" name="delete" id="delete">Delete</button>
        </div>
        </from>
        </div>
        </div>
        </div>
        </div>
        <?php
        }
        ?>
        </tbody>
</table>
<?php
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
    
        $result = mysqli_query($con, "DELETE FROM `tbl_surat` WHERE `tbl_surat`.`id` = $id");
    }
        
?>
</body>
<script src="../assets/js/bootsrap.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" 
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" 
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>
