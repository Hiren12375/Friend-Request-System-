<?php
session_start();
  if(isset($_SESSION['uid'])){
  
  }else{        
         header("location:login.php");
     }

 include'database.php'; 
 $obj = new method();
 
 /* delete Method */
 // if(isset($_GET['id'])){
 //  $id=$_GET['id'];
 //  $obj->delete('user',$id);
 // }

   /*** Send Request***/

 if (isset($_GET['to_id'])) {
    $to_id=$_GET['to_id'];
    //if ( $obj->send_request('friends',$to_id) < 1) {
       // code...
   
    $obj->send_request('friends',$to_id);
    // }else{

    //     echo "Error";
    // }    //print_r($to_id);
  }


 /** Logout**/
if(isset($_POST['logout'])){
      $obj->logout();
     
   } 

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font and  icon .-->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />   
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Display Record</title>
    <style type="text/css">
      .container{margin-top:30px;}
       #profile{
              border-radius: 50%;
              align-self: center;
            }
        .container{
            
            border-radius: 20px;
        }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="d-flex justify-content-center ">
          <img src="upload/<?php echo $_SESSION['profile_pic']; ?>" id="profile" width="200px" height="200px">                
        </div>
    <span class="d-flex justify-content-center mb-2"> <?php echo " welcome " .$_SESSION["name"]; ?></span>
     <span class="d-flex justify-content-center mb-2"> <?php echo " welcome " .$_SESSION['email']; ?></span>

      <div class="card">
            <div class="card-header d-flex justify-content-center"><form method="post"><a href="display.php" class=" ml-3 btn btn-dark btn-sm"><button type="button" class="btn btn-dark btn-sm">Home</button></a>&nbsp &nbsp <a href="notification.php" class=" btn btn-dark btn-sm"><button type="button" class="btn btn-dark position-relative">Request<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php $result=$obj->recive_request('user','friends');
                     $notification_count=mysqli_num_rows($result);
                     // if ($notification_count>0) {
                            echo $notification_count;
                        // while ($rrr=mysqli_fetch_assoc($result)) {?>             
                      <?php
                     //  }}
                       ?>
              </span>
            </button>
            </a> &nbsp &nbsp <a href="friends.php" class="btn btn-dark btn-sm"><button type="button" class="btn btn-dark position-relative">
              Friends
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
               <?php
                $result= $obj->Accept_Friend('user','friends');
                       $friend_count=mysqli_num_rows($result);
                       echo $friend_count;
                   ?>    
                <!-- <span class="visually-hidden">unread messages</span> -->
              </span>
            </button>
            </a> &nbsp &nbsp
            <button type="button" class="btn btn-dark position-relative">
              Message
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
                <!-- <span class="visually-hidden">unread messages</span> -->
              </span>
            </button>&nbsp &nbsp 
            <a href=""><button type="submit" name="logout" class="btn btn-dark">Logout</button></a> 
           </form>
           </div>
         </div>
         <hr>
         <div class="table-responsive">      
            <table class="table table-striped table-bordered">
               <thead>
                  <tr class="bg-primary text-white">
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Bio</th>
                     <th class="text-center">Profile_Pic</th>                     
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
                <?php
          
                     $result=$obj->All_User_Display('user');
                     //print_r($result);
                     // die();
                     // if(isset($result['0'])){
                       $i=1;                      
                     while ($row=mysqli_fetch_assoc($result)) {
                    //     print_r($row);
                    //     die();
                ?>
                  <tr>
                     <td><?php echo  $i;//$row['id'];?></td>
                     <td><?php echo $row['name']; ?></td>
                     <td><?php echo $row['email']; ?></td>
                     <td><?php echo $row['mobile']; ?></td>
                     <td align="center"><?php echo $row['gender']; ?></td>
                     <td align="center"><?php echo $row['bio']; ?> </td>
                     <td align="center"><img src="upload/<?php echo $row['profile_pic']; ?>" width="100px" height="100px"></td>
                     <td align="center">
                        <a href="view-userprofile.php?uid=<?php echo $row['id']; ?>" class="text-primary"><button type="button mb-2" class="btn btn-dark position-relative">view-profile
                       </button></a>
                        <a href="?to_id=<?php echo $row['id']; ?>"><button type="submit" name="send-request" class="btn btn-dark position-relative">Send Request
                       </button></a> 
                        
                     </td>
                  </tr>
                <?php 
                  $i++;

                } //}else{?>
                 <!-- <tr>
                     <td colspan="6" align="center">No Records Found!</td>
                  </tr> -->
                <?php //}?>
               </tbody>
            </table>
         </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
 <?php
   
 ?>
