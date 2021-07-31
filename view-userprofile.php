<?php
include'database.php'; 
 $obj = new method();
?>
<!doctype html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>View-User-Profile</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    
	  <style>
        *{
                font-family: 'Philosopher', sans-serif;
            }
		.container{margin-top:50px;}
        #profile{
              border-radius: 50%;
              align-self: center;
            }
        #style{
            align: center;
            font-size: 30px;
            color: white;
            background-color:#444444 ;
            border-radius:20px;
        }
        #color{
            background-color:#EDEDED ;
        }
	  </style>
   </head>
   <body>              
      <div class="container">
         <div class="card">
            <div class="card-header"><a href="display.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> All Friends</a></div>

            <div class="card-body" id="color">
                <?php
                    if(isset($_GET['uid'])){
                       $uid=$_GET['uid'];
                       $result= $obj->userprofile('user',$uid);
                       //print_r($result);
                 ?>
                 <h3 class="text-center">User Profile</h3>
               <div class="col-sm-12 d-flex justify-content-center">
                   <img src="upload/<?php echo $result[0]['profile_pic']; ?>" class="mb-3" id="profile" width="200px" height="200px">                  
               </div>
               <div class="d-flex justify-content-center">
                <table class="table-dark"  id="style">
                    <tr>
                        <td>Username &nbsp</td>
                        <td><?php echo isset($result[0]['name'])?$result[0]['name']: " " ?></td>
                    </tr>
                    <tr>
                        <td> Email </td>
                        <td><?php echo isset($result[0]['email'])?$result[0]['email']: " " ?></td>
                    </tr>
                    <tr>
                        <td>Mobile No &nbsp</td>
                        <td><?php echo isset($result[0]['mobile'])?$result[0]['mobile']: " " ?></td>
                    </tr>
                    <tr>
                        <td>Gender </td>
                        <td><?php echo isset($result[0]['gender'])?$result[0]['gender']: " " ?></td>
                    </tr>
                    <tr>
                        <td> Bio </td>
                        <td><?php echo isset($result[0]['bio'])?$result[0]['bio']: " " ?></td>
                    </tr>                                       
                </table>
               </div>
               <?php } ?> 
               </div>
            </div>
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
    
   </body>
</html>