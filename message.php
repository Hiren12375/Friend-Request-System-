<?php
session_start();
     if(isset($_SESSION['uid'])){
  
  }else{        
         header("location:login.php");
     }

 include'database.php'; 
 $obj = new method();
 
 /* Notification  delete Method */
 if(isset($_GET['chat_from_del'])){
  $chat_from_del=$_GET['chat_from_del'];
  $obj->chat_from_del('chat',$chat_from_del);
 }
 
 /*   Accept Friend Method */
  if(isset($_POST['send-message'])){
     if (isset($_GET['chat_id'])) {
       $chat_id=$_GET['chat_id'];
                  
       $obj->insert_chat('chat',$chat_id,$_POST);
         //print_r($vv);
      }
  }
/**** update msg ***/
  
  if(isset($_POST['update-msg'])){
     $msg= $obj->update_msg('chat',$_POST);
      //print_r($msg);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
    integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
     
     <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

    <title>Notification</title>
    <style type="text/css">
      #cont{margin-top:10px;}
       #profile{
              border-radius: 50%;
              height: 50px;
              width: 50px;
              align-self: center;
            }
      
    </style>
  </head>
  <body>
    <?php     
        if (isset($_GET['chat_edit'])) {
            $chat_edit=$_GET['chat_edit'];
            $sst=$obj->display_update_chat($chat_edit);
            //print_r($sst);                  
    ?> 
      <form method="post">
        <input type="text" name="message" value="<?php echo $sst[0]['message'];?>">
        <br>
        <input type="hidden" name="id_c" value="<?php echo $sst[0]['id_c'];?>">
        <input type="submit" name="update-msg">
      </form> 
    <?php }
     ?>             
      <div class="container"id="cont">
      <div class="d-flex justify-content-center ">
          <img src="upload/<?php// echo $_SESSION['profile_pic']; ?>" id="profile">                
        </div>
      <span class="d-flex justify-content-center mb-2"> <?php// echo " welcome " .$_SESSION["name"]; ?></span>
      <span class="d-flex justify-content-center mb-2"> <?php //echo " welcome " .$_SESSION['email']; ?></span>

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
                <?php?>
                <!-- <span class="visually-hidden">unread messages</span> -->
              </span>
            </button></a>&nbsp &nbsp
             <a href="login.php"><button type="submit" name="logout" class="btn btn-dark">Logout</button></a>             
           </form>
           </div>
         </div>
         <hr>
      </div>
       <!--- chating code-->
      <div class="back-container">
      <div class="container front-container1 mb-5">
      <div class="row chat-top">
        <div class="col-sm-4 border-right border-secondary">         
          <img src="upload/<?php echo $_SESSION['profile_pic']; ?>" alt="" class="profile-image rounded-circle">
          <span class="mt-2 ml-2"> <?php echo " welcome " .$_SESSION["name"]; ?></span>
          <span class="float-right mt-2">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle" fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            </svg>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-fill mx-3" fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
            </svg>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical mr-2" fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            </svg>
          </span>
        </div>
        <div class="col-sm-8">           
            <?php
 
                  if (isset($_GET['chat_id'])) {
                    $chat_id=$_GET['chat_id'];
                    $cha_s=$obj->chat_display('user',$chat_id);
                    while ($chat=mysqli_fetch_assoc($cha_s)) {
            
            ?>           
          <img src="upload/<?php echo $chat['profile_pic'];?>" alt="" class="profile-image rounded-circle">
          <span class="ml-2"><?php echo $chat['name']; ?></span>
          <?php } }?>
          <span class="float-right mt-2">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
              <path fill-rule="evenodd"
                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
            </svg>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical mx-3" fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            </svg>
          </span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 contacts">
          <div class="contact-table-scroll">
            <table class="table table-hover">
              <tbody>
                <?php
                    
                $result= $obj->Accept_Friend('user','friends');
                       while ($res=mysqli_fetch_assoc($result)) {                           
                          $uid=$res['from_id']!=$_SESSION['uid'] ? $res['from_id'] : $res['to_id'];
                           // print_r($uid);
                           // die();  
                            $row=$obj->users_data('user',$uid);                   
                 ?>
                <tr>
                  <td><a href="?chat_id=<?php echo $row['id']; ?>"><img src="upload/<?php echo $row['profile_pic']; ?>" alt="" class="profile-image rounded-circle"></a></td>
                  <td><?php echo $row['name'];?><br> <small>su kare che </small></td>
                  <td><small> <?php ?>11:55 PM</small></td>
                </tr>
              <?php } ?>  
                <!--
                  <td><img src="images/p1.jpg" alt="" class="profile-image rounded-circle"></td>
                  <td>Kunal <br> <small>Nikl lo</small></td>
                  <td><small>Sunday</small></td>
                </tr> --> 
                <!-- end -->
              </tbody>
            </table>
          </div>
               <!-- Chating Code  -->
        </div>
        <div class="col-sm-8 message-area">
          <div class="message-table-scroll">
            <table class="table">
              <tbody>
                <?php
                        //header("message.php");
                    if (isset($_GET['chat_id'])) {
                        $chatuid1=$_GET['chat_id']; 
                    $user1=$obj->user_SendMe_chat('chat','user',$chatuid1);
                    $chating_msg=$user1->num_rows;
                    while ($cht1=$user1->fetch_assoc()) {          
                      //echo $cht1['id'];                    
                ?>
                <tr>
                  <td>
                    <p class="bg-primary p-2 mt-2 mr-5 shadow-sm text-white float-left rounded"><?php echo $cht1['message'];?></p>
                    <a href="?chat_from_del=<?php echo $cht1['id_c'];?>"><button>Delete</button></a>
                  </td>
                  <td>
                    <p class="p-1 mt-2 mr-3 shadow-sm"><small><?php echo $cht1['time'];?></small></p>
                  </td>
                </tr>
                 <?php } }?>
                  <?php
                          if (isset($_GET['chat_id'])) {
                              $chatuid=$_GET['chat_id']; 
                         // $user=$obj->user_chat('user',$chat_uid);  
                           // print_r($user);
                           //     die();                          
                          //while ($res1= mysqli_fetch_assoc($user)) {
                              // print_r($res1);
                              //  die();
                              $users=$obj->users_chat('chat','user',$chatuid);
                             while ($cht= $users->fetch_assoc()) {
                                // $user=$obj->user_chat('user',$chat_uid);
                                //print_r($cht);
                               // die();
                                //echo $cht['id_c'];                            
                  ?> 
                <tr>                 
                  <td>                      
                    <p class="bg-success p-2 mt-2 mr-5 shadow-sm text-white float-right rounded"><?php echo $cht['message'];?></p>
                      <a href="?chat_from_del=<?php echo $cht['id_c'];?>"><button>Delete</button></a>
                      <a href="?chat_edit=<?php echo $cht['id_c'];?>"><button>edit</button></a>                                          
                  </td>                    
                  <td>
                    <p class="p-1 mt-2 mr-3 shadow-sm"><small><?php echo $cht['time']; ?></small></p>
                  </td>                                     
                </tr>
                 <?php } } ?>               
              </tbody>
            </table>
          </div>
          <!-- TextBox code -->
          <div class="row message-box p-3">
            <div class="col-sm-2 mt-2">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-emoji-smile" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path fill-rule="evenodd"
                  d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683z" />
                <path
                  d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z" />
              </svg>
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-paperclip mx-2" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
              </svg>
            </div>
            <div class="col-sm-8">
              <form  method="post" >
                <div>
                  <input type="text" class="form-control" name="message_chat" placeholder="Write message...">
                </div>
                
                <div class=" justify-content-right mt-1">
                  <input type="submit" name="send-message" value="Send">
                </div>
                
              </form>

            </div>
            <div class="col-sm-2 mt-1">
               <!-- <form method="post">
                 <input type="submit" name="send-message" value="Send">
               </form> -->              
            </div>
          </div>
        </div>
      </div>
    </div>
   </div> 
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
 

