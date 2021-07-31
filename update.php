<?php
include'database.php'; 
 $obj = new method();
  
  /**  Update Data**/
  if (isset($_POST['update'])) {
         $obj->update('user',$_POST);
         //print_r($_POST);
  }
?>
<!doctype html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Manage User - PHP Object Oriented Programming CRUD</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    
	  <style>
		.container{margin-top:100px;}
	  </style>
   </head>
   <body>              
      <div class="container">
         <div class="card">
            <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add User</strong> <a href="display.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse Users</a></div>
            <div class="card-body">
               <div class="col-sm-6">
                  <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
                    <?php if(isset($_GET['id'])){
                       $id=$_GET['id'];
                       $result= $obj->displayupdate($id);
                        
                        //print_r($result);
                     
                    ?>     
                  <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group mb-2">
                       <input type="text" class="form-control" name="username" id="user" value="<?php echo $result[0]['name']; ?>" placeholder="Enter User Name" >
                  </div>
                  <span id="user_error"> </span>
                  
                  <div class="form-group mb-2">
                       <input type="email" class="form-control" name="email" id="email"value="<?php echo $result[0]['email']; ?>" placeholder="Enter Your Email " >
                  </div>
                  <span id="email_error"></span>
                   <div class="form-group mb-2">
                       <input type="text" class="form-control" name="mobile_no" id="mobile" value="<?php echo $result[0]['mobile']; ?>" placeholder="Enter Your Mobile No " >
                    </div>
                  <span id="mobile_error"></span>                  
                    <div class="form-check-inline mt-3 mb-2">                        
                     <label class="form-check-label">
                             Gender : -
                              <input type="radio" class="form-check-input" name="r1"  value="Male"
                              <?php
                                     if ($result[0]['gender'] == "Male") {
                                            echo "checked";
                                        }
                                ?>
                              >Male
                              <input type="radio" class="form-check-input" name="r1" value="Female"
                              <?php
                                     if ($result[0]['gender'] == "Female") {
                                            echo "checked";
                                        }
                                ?>
                              >Female                              
                     </label>
                    </div>
                  <span id="gender_error"></span>
                         
                  <div class="form-group mb-2">
                      <textarea class="form-control" id="bio" name="bio"placeholder="Enter Bio" aria-label="With textarea"><?php echo $result[0]['bio']; ?></textarea>
                  </div>
                  <span id="address_error"></span>       
                  
                  <div class="form-group mb-2 mt-1" >
                       <input type="hidden" name="hide" value="<?php echo $result[0]['id']; ?>">
                       <input type="file" class="form-control" name="image" required>
                       <input type="hidden" name="old_image" value="<?php echo $res['profile_pic']; ?>">
                      <img src="<?php echo "upload/".$result[0]['profile_pic']?>" height="200px">
                  </div> 
                  <span id="file_error"></span>
                  
                  <div class="form-group mt-3 mb-3">
                     <input type="submit" class=" btn btn-dark" name="update" id="submit" value="update Now ">
                      <br><br>
                  </div>   
            </form>
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