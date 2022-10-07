<?php 
    session_start();
?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HTVC Admin</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../bootstrap/css/admin.css">
        <link rel="stylesheet" href="../bootstrap/css/admin2.css">
        <!--<link rel="stylesheet" href="/font-awesome/css/all.css">-->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    </head>

    <body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
        <?php require '../giaodien/admin_menu.php';?>
        <div class="main">
            
            <div class="aa">
                <h3 class="a0">Quản lý tài khoản </h3>
                
               <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Thêm tài khoản</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
           <h4 class="modal-title">Thêm tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
        
        <div class="them">
    <form method="POST" enctype="multipart/form-data" action="../xuly/xulythem.php">
        <div class="themsp">
       
            <input  style="display: none;" type="text" name="user_id"  class="form-controll" ><br>
         <label >email</label><br>
        <input type="text" name="email"  required="true">  <br>
        <label >password</label><br>
        <input type="password" name="pass"  required="true"> <br><br>
        <label >Nhập lại password</label><br>
        <input type="password" name="pass2" required="true" > <br><br>
         <label >SDT</label><br>
         <input type="text" name="sdt" required="true" > <br>
         <label >Role</label><br>
         <select name='role' >
       <option>admin</option> 
       <option>kho</option>
         </select><br>   <br>  
         <button type="submit" class="sub" name="sub2">Thêm</button>
         </div>
       
    </form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                
                
                <p class="aa0"><a href="../giaodien/themuser.php">Thêm tài khoản</a></p>
                <div class="header_search">
                    <form action="qlkh.php" method="post" id="header-search-form">
                        <input type="text" name="keyword" class="form-control searchbar" id="searchbox" placeholder="Search..">
                          <button type="submit" name="submit">
                             <i class="fa fa-search" aria-hidden="true"></i>
                          </button>
                    </form>
                </div>
                <table class="table"  >
                    <thead class="thead-dark">
                        <tr>
                        <th>STT</th>
                        <th>user_id</th>
                        <th>Email</th>  
                        <th>SDT</th>
                        <th>Role</th>
                         <th>Sửa</th>
                        <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        include '../connectdb/connect.php';
                        include '../model/encrypt.php';
                        $con = ketnoi();
                        $model = new encrypt();
                        if(isset($_POST['keyword'])){
                            $search=$_POST['keyword'];
                            $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
                            if (!preg_match($regex_email, $search)) {
                                echo "<p style='display:block;color:red;font-size:15px;'>Email không hợp lệ, hãy nhập lại</p><br>";
                                $sql = "SELECT * FROM user";
                                $query = mysqli_query($con, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr id="a1">     

                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['user_id']; ?></td>

                                        <td>
                                            <?php 
                                                $tiento = explode("@", $row['email']);
                                                $decryptemail = $model->apphin_giaima($tiento[0])."@".$tiento[1];
                                                echo $decryptemail; 
                                            ?>
                                        </td>  
                                        <td><?php 
                                                $decryptsdt = $model->apphin_giaima($row['sdt']);
                                                echo $decryptsdt; 
                                                ?>
                                        </td>  
                                         <td><?php echo $row['role']; ?></td>
                                        <td><a href="../giaodien/sua_user.php?user_id=<?php echo $row['user_id']; ?>">Sửa</a></td>
                                        <td><a onclick="return Del('<?php echo $decryptemail; ?>')" href="../giaodien/xoa_user.php?user_id=<?php echo $row['user_id']; ?>">Xóa</a></td>
                                    </tr>
                                <?php 
                                }
                            }
                            else{
                                $tientosearch = explode("@", $search);
                                $mahoasearch = $model->apphin_mahoa($tientosearch[0]);
                                $mahoasearchemail = $mahoasearch."@".$tientosearch[1];
                                $sql1 = "SELECT * FROM  user WHERE email LIKE '$mahoasearchemail'";
                                $query = mysqli_query($con, $sql1);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr id="a1">     

                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['user_id']; ?></td>

                                        <td>
                                            <?php 
                                                $tiento = explode("@", $row['email']);
                                                $decryptemail = $model->apphin_giaima($tiento[0])."@".$tiento[1];
                                                echo $decryptemail; 
                                            ?>
                                        </td> 
                                        <td><?php
                                                $decryptsdt = $model->apphin_giaima($row['sdt']);
                                                echo $decryptsdt;
                                        ?></td>  
                                           <td><?php echo $row['role']; ?></td>
                                        <td><a href="../giaodien/sua_user.php?user_id=<?php echo $row['user_id']; ?>">Sửa</a></td>
                                        <td><a onclick="return Del('<?php echo $decryptemail; ?>')" href="../giaodien/xoa_user.php?user_id=<?php echo $row['user_id']; ?>">Xóa</a></td>
                                    </tr>
                            <?php }
                        
                            }
                        } else {
                            $sql = "SELECT * FROM user ";
                            $query = mysqli_query($con, $sql);
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr id="a1">     

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['user_id']; ?></td>

                                    <td>
                                        <?php 
                                            $tiento = explode("@", $row['email']);
                                            $decryptemail = $model->apphin_giaima($tiento[0])."@".$tiento[1];
                                            echo $decryptemail; 
                                        ?>
                                    </td>  
                                    <td><?php 
                                            $decryptsdt = $model->apphin_giaima($row['sdt']);
                                            echo $decryptsdt; 
                                            ?>
                                    </td>  
                                       <td><?php echo $row['role']; ?></td>
                                    <td><a href="../giaodien/sua_user.php?user_id=<?php echo $row['user_id']; ?>">Sửa</a></td>
                                    <td><a onclick="return Del('<?php echo $decryptemail; ?>')" href="../giaodien/xoa_user.php?user_id=<?php echo $row['user_id']; ?>">Xóa</a></td>
                                </tr>
                        <?php 
                            }
                         }
                        ?>

                    </tbody>  
                </table>
            </div>


        </div>
        <div>
            <footer class="footer">
               <div class="container">
                <center>
                   <p style="padding-top: 20px;">Copyright &copy Store. All Rights Reserved.</p>
                   <br><br><br>
                   <!--<p>This website is developed by Yugesh Verma</p>-->
               </center>
               </div>
           </footer>
        </div>
        <script type="text/javascript">
                function Del(name) {
                    return confirm("Bạn có chắc chắn muốn xóa user có email là: " + name + " ?");
                }
        </script>
    </body>

</html>