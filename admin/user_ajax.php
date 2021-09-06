<?php include '../connection.php';

 if(isset($_POST["user_id"]))  
 {  
      $output = '';  
      //$connect = mysqli_connect("localhost", "root", "", "spk_apotek");  
      $query = "SELECT * FROM user WHERE id_user = '".$_POST["user_id"]."'";
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered table-striped">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '

                <tr>  
                     <td width="40%"><label>Photo</label></td>  
                     <td width="70%"><img src="./../foto/'.$row["photo"].'" width="60px" height="60px"></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Nama lengkap</label></td>  
                     <td width="70%">'.$row["nama_lengkap"].'</td>  
                </tr>

                <tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%">'.$row["email"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Phone</label></td>  
                     <td width="70%">'.$row["phone"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Username</label></td>  
                     <td width="70%">'.$row["username"].'</td>  
                </tr>
               
                <tr>  
                     <td width="30%"><label>Akses level</label></td>  
                     <td width="70%">'.$row["akses_level"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Last update</label></td>  
                     <td width="70%">'.$row["tanggal_update"].'</td>  
                </tr>
                
                
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>