<?php include '../connection.php';

      session_start();
    if  (@$_SESSION['akses_level'] == "admin"){
      echo "<script> alert('Anda harus login sebagai petugas terlebih dahulu untuk mengakses module');
            window.location = '../login.php';</script>";
      exit;
    }
      include '../layout/header.php';
      include '../layout/nav_petugas.php';

$query   = mysqli_query($connect, "SELECT * FROM user ORDER BY id_user DESC");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Data User
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">user</a></li>
        <li class="active">Data user</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">


      
      <div class="box box-primary box-solid">
      
        
        <!-- /.box-header -->
        <div class="box-body">

          

            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama lengkap</th>
                  <th>Username</th>
                  <th>Akses level</th>
                  <th>Email</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
          <?php $no=0; foreach ($results as $key => $results): $no++ ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $results['nama_lengkap'];?></td>
                  <td><?php echo $results['username'];?></td>           
                  <td><?php echo $results['akses_level'];?></td>
                  <td><?php echo $results['email'];?></td>
                  <td><img src="../foto/<?php echo $results['photo'];?>" width="60px" height="60px"></td>
                  <td>
                   <a type="button" name="detail" value="detail" id="<?php echo $results['id_user']; ?>" class="btn btn-primary btn-sm detail_data"><i class="fa fa-eye"></i> detail</a>

                    <?php  if ($_SESSION['username'] == $results['username']){

                      $show_edit = '  
                                       <a href="user_edit.php?id_user='.$results["id_user"].'" 
                                          class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> edit</a>
                                     ';
                    echo $show_edit;
                  } ?>                 
                  </td>

                </tr>
              <?php endforeach ?> 

                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<?php include '../layout/footer.php' ?>

<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">User Details</h4>  
                </div>  
                <div class="modal-body" id="user_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>

 <script>
 $(document).ready(function(){
 $(document).on('click', '.detail_data', function(){  
           var user_id = $(this).attr("id");  
           if(user_id != '')  
           {  
                $.ajax({  
                     url:"user_ajax.php",  
                     method:"POST",  
                     data:{user_id:user_id},  
                     success:function(data){  
                          $('#user_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  

 </script>