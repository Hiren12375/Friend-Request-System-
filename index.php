<?php
  include'database.php';
  $obj = new method();

  if (isset($_POST['submit'])) {
       //print_r($_POST);
      $obj->registration('user',$_POST);
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

    <title>Request Send And Receive</title>
    <style type="text/css">
            *{
                font-family: 'Philosopher', sans-serif;
            }
       </style>
  </head>
  <body>
    <br>
     <span class=" bg-secondary text-center"> 
          <h2 class="">Registration Now </h2>
     </span>

     <div class="container col-8 bg-white mb-5 ">
         <div class="col-lg-7 m-auto mt-5 d-block">
                <br><br>
            <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group mb-2">
                       <input type="text" class="form-control" name="username" id="user" placeholder="Enter User Name" required>
                  </div>
                  <span id="user_error"> </span>
                  <div class="form-group mb-2">
                       <input type="password" class="form-control" name="password" id="user" placeholder="Enter Password" required>
                  </div>
                  <span id="pass_error"> </span>

                  <div class="form-group mb-2">
                       <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email " required>
                  </div>
                  <span id="email_error"></span>
                   <div class="form-group mb-2">
                       <input type="text" class="form-control" name="mobile_no" id="mobile" placeholder="Enter Your Mobile No " required>
                    </div>
                  <span id="mobile_error"></span>                  
                    <div class="form-check-inline mt-3 mb-2">                        
                     <label class="form-check-label">
                             Gender : -
                              <input type="radio" class="form-check-input" name="r1"  value="Male">Male
                              <input type="radio" class="form-check-input" name="r1" value="Female">Female                              
                     </label>
                    </div>
                  <span id="gender_error"></span>
                         
                  <div class="form-group mb-2">
                      <textarea class="form-control" id="bio" name="bio"placeholder="Enter Bio" aria-label="With textarea"required></textarea>
                  </div>
                  <span id="bio_error"></span>       
                  
                  <div class="form-group mb-2 mt-1" >
                       <input type="file" class="form-control" name="image" required>
                  </div> 
                  <span id="file_error"></span>
                   <hr> 
                  <div class="form-group mt-3 mb-3">
                     <input type="submit" class=" btn btn-success" name="submit" id="submit" value="Register Now ">
                      <br><br>
                  </div>   
            </form>
         </div>
     </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>