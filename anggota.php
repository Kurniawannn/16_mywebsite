<?php
if(isset($_POST['update'])){
    include('koneksi.php');
       $id              = $_POST['id'];
       $nis             = $_POST['nis'];
       $nama            = $_POST['nama'];
       $kelas           = $_POST['id_kelas'];
       $jurusan         = $_POST['id_jurusan'];
       $jenis_kelamin   = $_POST['jk'];
       $tempat_lahir    = $_POST['tempat_lahir'];
       $tanggal_lahir   = $_POST['tgl_lahir'];
       $no_telpon       = $_POST['no_telepon'];
       $alamat          = $_POST['alamat'];

    $query_update = mysqli_query($koneksi,"UPDATE anggota
    SET nis ='$nis', nama ='$nama', id_kelas ='$kelas', id_jurusan ='$jurusan', jk ='$jenis_kelamin', tempat_lahir ='$tempat_lahir' tgl_lahir ='$tanggal_lahir', no_telepon ='$no_telpon', alamat ='$alamat', 
    WHERE id_anggota='$id'
    ");
    if ($query_update) {
        ?>
        <script>
            alert('data berhasil di ubah');
        </script>
        <?php
        header('refresh:0  URL=http://localhost/16_mywebsite_12RPL2/admin.php?page=anggota');
    }
}
?>
        
    
<h3 align=center>DATA ANGGOTA</h3>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputmodal">
  Tambah Data
</button>
<br>
<br>
<table class="table table-striped">
    
    <tr class="text-center">
        <th>NO</th>
        <th>NIS</th>
        <th>NAMA</th>
        <th>KELAS</th>
        <th>JURUSAN</th>
        <th>JK</th>
        <th>TEMPAT LAHIR</th>
        <th>TANGGAL LAHIR</th>
        <th>NO TELEPON</th>
        <th>ALAMAT</th>
        <th>ACTION</th>
    </tr>
    <?PHP
    $no =1;
    $query = mysqli_query($koneksi,"SELECT * FROM anggota");
    foreach ($query as $row ) {
  
    ?>
    <tr >
        <td class="text-center" valign=middle><?php echo $no?></td>
        <td class="text-center" valign=middle><?php echo $row['nis']?></td>
        <td valign=middle><?php echo $row['nama']?></td>
        <td class="text-center" valign=middle><?php echo $row['id_kelas']?></td>
        <td valign=middle>
        <?php
        if ($row['id_jurusan']=='1') {
            echo "Rekayasa Perangkat Lunak";
        }elseif ($row['id_jurusan']=='2') {
            echo "Teknik Kendaraan Ringan ";
        }elseif ($row['id_jurusan']=='3') {
            echo "Teknik Instalasi Tenaga Listrik";
        }elseif ($row['id_jurusan']=='4') {
            echo "Teknik Audio Video";
        }
        ?>
        <?php echo $row['id_jurusan']?>
        </td>
        <td class="text-center" valign=middle><?php echo $row['jk']?></td>
        <td class="text-center" valign=middle><?php echo $row['tempat_lahir']?></td>
        <td class="text-center" valign=middle><?php echo $row['tgl_lahir']?></td>
        <td class="text-center" valign=middle><?php echo $row['no_telepon']?></td>
        <td valign=middle><?php echo $row['alamat']?></td>        
        <td class="text-center" valign=middle>
        <a href="?page=anggota-delete&hapus&id=<?php echo $row['id_anggota']; ?>">
        <button class="btn btn-danger" ><i class="far fa-trash-alt"></i></button></a>
        <a href="?page=anggota&edit&id=<?php echo $row['id_anggota']; ?>">
        <button  class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="edit-Modal"><i class="fas fa-edit"></i></button></a>
        </td>
    </tr>
    <?php
    $no++;
    }
    ?>

</table>


<!-- Modal input -->
<div class="modal fade" id="inputmodal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inputModalLabel">Form Input Data Anggota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form  action="?page=anggota-insert" method="post"> 
        <div class="formm-group mb-2">
            <input class="form-control" type="text" name="nis" placeholder="Masukkan NIS" required>
        </div>
        <div class="form-group mb-2">
            <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama" required>
        </div>

        <div class="form-group mb-2">
           <select class="form-control" name="id_kelas" placeholder="Masukkan Kelas" required>
           <option value="">-Pilih Kelas-</option>
            <?php
            $query_kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
            foreach ($query_kelas as $kelas){
                ?>
                    <option value="<?php echo $kelas['id_kelas']?>"><?php echo $kelas['nama_kelas'] ?></option>
                <?php
            }
            ?>
            </select>
        </div>
        <div class="form-group mb-2">
           <select class="form-control" name="id_jurusan" placeholder="JURUSAN" required >
           <option value="">-Pilih Jurusan-</option>
           <?php
            $query_jurusan = mysqli_query($koneksi,"SELECT * FROM jurusan");
            foreach ($query_jurusan as $jurusan){
                ?>
                    <option value="<?php echo $jurusan['id_jurusan']?>"><?php echo $jurusan['nama_jurusan'] ?></option>
                <?php
            }
            ?>
            </select>
        </div>
        <div class="from-group ">
            <select class="form-control" name="jk" required >
            <option value="">-Pilih Jenis Kelamin-</option>
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="input-group mb-2">
        <span class="input-group-text">Tempat Lahir</span>
            <input class="form-control" type="text" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
        </div>
        <div class="input-group mb-2">
        <span class="input-group-text">Tanggal Lahir</span>
            <input class="form-control" type="date" name="tgl_lahir" placeholder="Masukkan Tgl Lahir" required>
        </div>
        <div class="from-group mb-2">
            <input class="form-control" type="text" name="no_telepon" placeholder="Masukkan No Telp" required>
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="alamat" required></textarea>
            <label for="floatingTextarea2">Alamat</label>
        </div>

            

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal input-->

<!-- modal edit-->
    <?php
        if (isset($_POST['edit'])) {
        $id =$_POST['id'];
        $query = mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota ='$id'");
        foreach ($query as $row){
    ?>
    <script>
        $(document).ready(function(){
            $("#edit-modal").modal('show');
        });
    </script>
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form edit Data Anggota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form  action="anggota.php" method="post"> 
        <input type="hidden" name="id" value="<?php echo $row['id_anggota']; ?>">
        <div class="formm-group mb-2">
            <input value="<?php echo $row['nis']; ?>" class="form-control" type="text" name="nis" placeholder="NIS" required>
        </div>
        <div class="form-group mb-2">
            <input value="<?php echo $row['nama']; ?>" class="form-control" type="text" name="nama" placeholder="NAMA" required>
        </div>

        <div class="form-group mb-2">
           <select value="<?php echo $row['kelas']; ?>" class="form-control" name="kelas" placeholder="KELAS" required>
           <option value="<?php echo $row['kelas']; ?>">
           <?php
                if ($row['kelas']=='x') {
                    echo "X";
                }elseif ($row['kelas']=='xi') {
                    echo "XI";
                }else{
                    echo "XII";
                }
           ?>
           </option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
            </select>
        </div>
        <div class="form-group mb-2">
           <select  class="form-control" name="jurusan" placeholder="JURUSAN" required >
           <option value="<?php echo $row['jurusan']; ?>">
           <?php
                    if ($row['jurusan']=='RPL') {
                        echo "Rekayasa Perangkat Lunak";
                    }elseif ($row['jurusan']=='TAV') {
                        echo "Teknik Audio Video";
                    }elseif ($row['jurusan']=='TKR') {
                        echo "Teknik Kendaraan Ringan";
                    }else {
                        echo "Teknik Instalasi Tenaga Listrik";
                    }
            ?>
           </option>
            <option value="RPL">REKAYASA PERANGKAT LUNAK</option>
            <option value="TKR">TEKNIK KENDARAAN RINGAN </option>
            <option value="TITL">TEKNIK INSTALASAI TENAGA LISTRIK</option>
            <option value="TAV">TEKNIK AUDIO VIDEO </option>
            </select>
        </div>
        <div class="input-group mb-2">
        <span class="input-group-text">Tanggal Lahir</span>
            <input value="<?php echo $row['tanggal_lahir']; ?>" class="form-control" type="date" name="tanggal_lahir" placeholder="TANGGAL LAHIR" required>
        </div>
        <div class="from-group mb-2">
            <input value="<?php echo $row['no_telpon']; ?>" class="form-control" type="text" name="no_telpon" placeholder="NO TELEPON" required>
        </div>
        <div class="form-floating">
            <textarea  class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="alamat" required><?php echo $row['alamat']; ?></textarea>
            <label for="floatingTextarea2">Alamat</label>
        </div>
        <div class="from-group ">
            <select value="<?php echo $row['jk']; ?>" class="form-control" name="jk" required >
            <option value="<?php echo $row['jk']; ?>">
                <?php
                        if ($row['jk'] =='L') {
                            echo "Laki-Laki";
                        }else {
                            echo "Perempuan";
                        }
                ?>
            </option>
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
}
}
?>