<?php
session_start();
 include'database.php'; 
 $obj = new method(); 
 if (isset($_POST['submit'])){ 
    $result=$obj->login('user',$_POST);             
    $count=mysqli_num_rows($result);
       if($count>0){
        $row=mysqli_fetch_assoc($result);        
         $_SESSION['uid']=$row['id'];
         $_SESSION['name']=$row['name'];
         $_SESSION['email']=$row['email'];
         $_SESSION['profile_pic']=$row['profile_pic'];
         header("location:display.php");
         exit();
    }
    else{
        echo "<script>alert('username or password incorrect!')</script>";
        echo "<script>location.href='login.php'</script>";             
    }
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

    <title>login</title>
    <style type="text/css">
      *{
                font-family: 'Philosopher', sans-serif;
                color: white;                
       }
       a{
                text-decoration:none;
                color: white;
       }
       a:hover{color:black;}
      .container{margin-top:100px;border-radius:20px;}
    </style>
  </head>
  <body style="background-color:powderblue;">
     <div class="container col-4 bg-dark justify-content-center" id="login">
       <h3 class="text-center">Login Now </h3>
       <span><?php  ?></span>
       <form action="" method="post" class="col-md-12 ">
         <div class=" row  ">
           <div class="input-group mt-4 mb-2">
             <input type="text" name="username" class="form-control" placeholder="Enter Your Username">
           </div>
           <div class="input-group mt-3 mb-2">
             <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
           </div>
           <div class="d-grid gap-2 d-md-flex justify-content-md-center">
              <input type="submit" name="submit" value="Login Hear.."class="btn btn-secondary">
           </div>
         </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-success mt-3 mb-2" ><a href="index.php">Registration Hear</a></button>
          </div>
       </form>
     </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>