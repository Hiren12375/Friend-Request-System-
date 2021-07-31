<?php
session_start();
     if(isset($_SESSION['uid'])){
  
  }else{        
         header("location:login.php");
     }

 include'database.php'; 
 $obj = new method();
 
 /* Notification  delete Method */
 if(isset($_GET['del_request_id'])){
  $del_request_id=$_GET['del_request_id'];
  $obj->delete('friends',$del_request_id);
 }
 
 /*   Accept Friend Method */
 if(isset($_GET['fr_id'])){
  $fr_id=$_GET['fr_id'];
  $obj->update_friend('friends',$fr_id);

 }
 /** Logout**/
   if(isset($_POST['logout'])){
      $obj->logout();
          //print_r($_POST);
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
    <title>Notification</title>
    <style type="text/css">
      .container{margin-top:100px;}
       #profile{
              border-radius: 50%;
              align-self: center;
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
            <div class="card-header d-flex justify-content-center"><form method="post "> <a href="display.php" class=" ml-3 btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i><button type="button" class="btn btn-dark btn-sm">Home</button></a>&nbsp &nbsp <a href="notification.php" class=" btn btn-dark btn-sm"><button type="button" class="btn btn-dark position-relative">Request<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0
              <!--  <span class="visually-hidden">unread messages</span>
 -->              </span>
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
             <a href="message.php"><button type="button" class="btn btn-dark position-relative">
              Message
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
                <!-- <span class="visually-hidden">unread messages</span> -->
              </span>
            </button></a>&nbsp &nbsp
             <a href="login.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>             
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
                     $result=$obj->recive_request('user','friends');
                     $notification_count=mysqli_num_rows($result);
                     //print_r($notification_count);
                     // if(isset($result['0'])){
                       $i=1;      
                    while($row=$result->fetch_assoc()){                      
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
                        <a href="notification.php?del_request_id=<?php echo $row['id']; ?>" class="text-danger"><button type="button" class="btn btn-dark position-relative">IGNORE
                       </button> </a>
                        <a href="?fr_id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-dark position-relative">Accept
                       </button></a>
                     </td>
                  </tr>
                <?php 
                  $i++;
                } //}else{?>
                <!--  <tr>
                     <td colspan="6" align="center">No Records Found!</td>
                  </tr> -->
                <?php// }?>
               </tbody>
            </table>
         </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
 

