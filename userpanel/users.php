<?php 
session_start();
require('connection.php');
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']=='yes'){
$admin_id=$_SESSION['ADMIN_ID'];
  $cat_res=mysqli_query($con,"select * from agency where id='$admin_id' and status='1' order by id desc");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                     $aname=strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $list['name'])));
                                                     $alw=$list['allowed_pages'];
                                                 }
?>

<?php require('html-header.php');?>
<?php require('top-header.php');?>
<?php require('left-sidebar.php');?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                
                <div class="row">
                            <div class="col-12">
                                <div class="card" style="height: 495px; overflow: hidden auto;" data-simplebar="init">
                                    <div class="card-header">
                                        <div class="card-icon text-muted"><i class="fas fa-sync-alt fs-14"></i></div>
                                        <h3 class="card-title">Pages</h3>
                                      
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-md">
                                            <table id="datatable-col-visiblility" class="table text-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Logo</th>
                                                        <th>Banner</th>
                                                        <th>Image</th>
                                                        <th>Key Feature 1</th>
                                                        <th>Key Feature 2</th>
                                                        <th>Key Feature 3</th>
                                                        <th>Key Feature 4</th>
                                                        <th>Page URL</th>
                                                        <th>Postback URL</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               <?php
                                                $cat_res=mysqli_query($con,"select * from pages where agency_id='$admin_id' order by id desc");
                                                $cat_arr=array();
                                                while($row=mysqli_fetch_assoc($cat_res)){
                                                  $cat_arr[]=$row;    
                                                }
                                                 foreach($cat_arr as $list){
                                                ?>
                                               
                                                    <tr>
                                                       <td class="align-middle"><?php echo $list['id'];?></td>
                                                        <td class="align-middle"><?php echo $list['name'];?></td>
                                                       
                                                        <td class="align-middle"><img src="uploads/<?php echo $list['logo'];?>" width="100%"></td>
                                                        <td class="align-middle"><img src="uploads/<?php echo $list['banner'];?>" width="100%"></td>
                                                        <td class="align-middle"><img src="uploads/<?php echo $list['image'];?>" width="100%"></td>
                                                        <td class="align-middle"><?php echo $list['kf1'];?></td>
                                                        <td class="align-middle"><?php echo $list['kf2'];?></td>
                                                        <td class="align-middle"><?php echo $list['kf3'];?></td>
                                                        <td class="align-middle"><?php echo $list['kf4'];?></td>
                                                        <td class="align-middle">https://drive360.in/landing-pages/<?php echo $aname;?>/<?php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $list['name'])));?></td>
                                                        <td class="align-middle"><?php echo $list['url'];?></td>
                                                        <td class="align-middle"><?php echo $list['status'];?></td>

                                                       
                                                        
                                                    </tr>
                                                   <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                    
                    </div>
                    </div>
                    </div>
                                                

<?php require('footer.php');?>
        <?php }else{
        header('auth-login');
        }
        ?>