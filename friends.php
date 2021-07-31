<?php
session_start();
include'database.php'; 
 $obj = new method();

if (isset($_GET['unfr_id'])) {
  $unfr_id=$_GET['unfr_id'];
  $res=$obj->un_friend('friends',$unfr_id);
    //print_r($res);
}

?>
<!doctype html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo " welcome " .$_SESSION["name"];?></title>
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
              <h3 class="text-center"> My All Friends</h3>
            <div class="card-body" id="color">
                <?php  
                       // if(isset($_GET['fr_id'])){
                       //    $fr_id=$_GET['fr_id'];
                       //    $obj->update_friend('friends',$fr_id);
     
                       $result= $obj->Accept_Friend('user','friends');
                       $friend_count=mysqli_num_rows($result);
                       //print_r($friend_count);
                       //die();
                       while ($res=mysqli_fetch_assoc($result)) {
                            $uid=$res['from_id']!=$_SESSION['uid'] ? $res['from_id'] :  $res['to_id'];  
                            $row=$obj->users_data('user',$uid);                      
                            //echo  strtoupper($row['name']);
                 ?>
                 <!-- <h3 class="">User Profile</h3> -->
               <div class="row">
                    <div class="col">
                     <img src="upload/<?php echo $row['profile_pic']; ?>" class="mb-3" id="profile" width="200px" height="200px">   
                     <p class=""> <?php echo strtoupper($row['name']) ?> </p>
                        <a href="?unfr_id=<?php echo $row['id']; ?>"><button class="btn btn-dark mb-3" name="unfriend">UN_FRIEND</button></a>
                    </div>                       
               </div>
               <?php } //}?> 
               </div>
            </div>
         </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>    
   </body>
</html>