<?php

 class database{
  	private $host;
  	private $dbusername;
  	private $dbpass;
  	private $dbname;

       function __construct(){
  		$this->host='localhost';
  		$this->dbusername='root';
  		$this->dbpass='';
  		$this->dbname='request_system';
  		$this->con = new mysqli($this->host,$this->dbusername,$this->dbpass,$this->dbname);
        if( $this->con) {
        	//echo " Connection Success";
        }else{

        	echo "Error".$this->con->connect;
        }
  	}   
}

class method extends database{      
	public function login($table,$post){
		$username=mysqli_real_escape_string($this->con,$_POST['username']);
		$password=md5($_POST['password']);
		$sql="select * from $table where name ='".$username."' and password ='".$password."' ";
		  $result=$this->con->query($sql);
		  return $result;
	}
	public function All_User_Display($table){
		$sql = "select * from $table where id != '".$_SESSION['uid']."'";
		$res=$this->con->query($sql);
		if ($res) {	    	
		}else{
			echo "error".$this->con->error;
		}
		return $res;		
	}
	
	public function delete( $table, $del_request_id){ 
	    $sql="DELETE FROM `friends` WHERE   id = '".$del_request_id."'";
		$res=$this->con->query($sql);
		
		if ($res) {
			echo" Delete SuccessFully";
		}else{
			echo "error".$this->con->error;
		}
		return $res;
	}

	public function registration($table,$post){
  	  	$username=mysqli_real_escape_string($this->con,$post['username']);
  		$password=mysqli_real_escape_string($this->con,md5($post['password']));
        $email=mysqli_real_escape_string($this->con,$post['email']);
        $mobile_no=mysqli_real_escape_string($this->con,$post['mobile_no']);
        $gender=mysqli_real_escape_string($this->con,$post['r1']);
        $bio=mysqli_real_escape_string($this->con,$post['bio']);
      	
      	if(isset($_FILES['image'])){
            $errors=array();

          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $temp_name = $_FILES['image']['tmp_name'];
          $file_type = $_FILES['image']['type'];
          $results = explode('.', $file_name);
           $file_ext=strtolower(end($results));
           //$file_ext=strtolower($txt);
          $extenction = array("jpeg","png","jpg");

	    if(in_array($file_ext,$extenction)===false){
	        $errors[]="This File Type is not Allowed Please Enter jpg,png File";
	          }
	           if ($file_size>2097152) {
	                $errors[]="File Size Must be less then 2 MB";
	           }
	            if (empty($errors)==true) {
	                   move_uploaded_file($temp_name,"upload/".$file_name);
	               }else{

	                print_r($errors);
	                die();
	               }
	        }

      	$sql="insert into $table (name,password,email,mobile,gender,bio,profile_pic) values('".$username."','".$password."','".$email."','".$mobile_no."','".$gender."','".$bio."','".$file_name."')";
      	$result=$this->con->query($sql);
      	if ($result) {
      		echo"Registration SuccessFully";
      	}else{
            echo " Registration Error".$this->con->error;
      	}      	    
      	    return $result;   	
	}
	public function displayupdate($id){
        $sql="select * from user where id='".$id."'";
        $result=$this->con->query($sql);
        if ($result->num_rows > 0) {
            while ($row=$result->fetch_assoc()) {
                $data[]=$row;
            }
            return $data;
        }
    }

    public function update($table,$post){      	
  		$username=mysqli_real_escape_string($this->con,$post['username']);
        $email=mysqli_real_escape_string($this->con,$post['email']);
        $mobile_no=mysqli_real_escape_string($this->con,$post['mobile_no']);
        $gender=mysqli_real_escape_string($this->con,$post['r1']);
        $bio=mysqli_real_escape_string($this->con,$post['bio']);
        $id=mysqli_real_escape_string($this->con,$post['hide']);
      	
      	if(isset($_FILES['image'])){
            $errors=array();

          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $temp_name = $_FILES['image']['tmp_name'];
          $file_type = $_FILES['image']['type'];
          $results = explode('.', $file_name);
           $file_ext=strtolower(end($results));
           //$file_ext=strtolower($txt);
          $extenction = array("jpeg","png","jpg");

	    if(in_array($file_ext,$extenction)===false){
	        $errors[]="This File Type is not Allowed Please Enter jpg,png File";
	          }
	           if ($file_size>2097152) {
	                $errors[]="File Size Must be less then 2 MB";
	           }
	            if (empty($errors)==true) {
	                   move_uploaded_file($temp_name,"upload/".$file_name);
	               }else{
	                print_r($errors);
	                die();
	               }
	        }
	        $sql="UPDATE `$table` SET `name`='".$username."',`email`='".$email."',`mobile`='".$mobile_no."',`gender`='".$gender."',`bio`='".$bio."',`profile_pic`='".$file_name."' WHERE id='".$id."'";

	        $result=$this->con->query($sql);
	        if ($result) {
	        	echo"Update SuccessFully";
	        }else{
	        	echo " Error".$this->con->error;
	        }
	        return $result;
	}
    
    public function userprofile($table,$uid){
    	$sql="select * from $table where id='".$uid."'";
    	$result=$this->con->query($sql);
    	if ($result->num_rows > 0) {
	        	while($row=$result->fetch_assoc()){
                       $data[]=$row;
	        	}
	        	return $data;
	        }
    }

    public function send_request($table,$to_id){
        $from_id=$_SESSION['uid'];
         $result=1;
        if ($result == 1) {
        	// code..
	        $sql="insert into $table (from_id,to_id,status) values('".$from_id."','".$to_id."',0)";
	        $result=$this->con->query($sql);
	        if ($result) {
	           echo" Send Request success";
	        }else{
	        	echo "send Request Error ".$this->con->error;
	        }
	          
	          return $result;
        }
        
    }
    
    public function recive_request($table_user,$table_friend){
    	$sql="select $table_friend.id, us.name,us.email,us.mobile,us.gender,us.bio,us.profile_pic from $table_friend JOIN $table_user us ON $table_friend.from_id = us.id where status=0 AND $table_friend.to_id ='".$_SESSION['uid']."'";
    	$result=$this->con->query($sql);
    	if ($result) {    		    		
    	}else{
    		echo "Recive Request Error ".$this->con->error;
    	}
    	return $result;
    }
    public function update_friend($table_friend,$fr_id){    	
    	    $update_sql= "UPDATE $table_friend  SET `status`= 1 WHERE id='".$fr_id."'";    	
    		$result=$this->con->query($update_sql);
    		if ($result) {
    			//header("location:friends.php");
    		}else{
    			echo " Error".$this->con->error;
    		}
    		return $result;   	 
    }
    public function Accept_Friend($table_user,$table_friend){
    		//$table_friend.from_id='".$_SESSION['uid']."' and
    	  	// $sql="select us.id, us.name,us.email,us.mobile,us.gender,us.bio,us.profile_pic from $table_user us JOIN $table_friend ON us.id = $table_friend.from_id JOIN $table_user ON $table_user.id = $table_friend.to_id AND $table_friend.status=1 where $table_friend.from_id='".$_SESSION['uid']."' and $table_friend.to_id ='".$_SESSION['uid']."'";
		    $sql="select * from $table_friend  where status=1 AND ($table_friend.from_id ='".$_SESSION['uid']."' OR $table_friend.to_id='".$_SESSION['uid']."')";

		    $result=$this->con->query($sql);
    		if ($result) {
    				
	        	}else{
	        		echo " My All Friend display Error".$this->con->error;
	        	}
	        	return $result;
	 }

	 public function users_data($table_user,$uid){
	 		$sql="select us.id, us.name,us.email,us.mobile,us.gender,us.bio,us.profile_pic from $table_user us where id='".$uid."'";
               
             $result=$this->con->query($sql);
    		if ($result) {
    				$result=mysqli_fetch_assoc($result);
    				//print_r($result);
	        	}else{
	        		echo " My All Friend display Error".$this->con->error;
	        	}
	        	return $result;   
	 }  
	 public function un_friend($table_friend,$unfr_id){
	 	$sql="DELETE FROM `$table_friend` WHERE   to_id='".$unfr_id."'";
             
        $result=$this->con->query($sql);
        if ($result) {
        	echo "Delete Success";
        }else{
        	echo " Unfriend Error".$this->con->error;
        }

        return $result;
	 }
            /*** Display Chat id ***/
    public function chat_display($table,$chat_id){

    	$sql=" select * from $table where id='".$chat_id."'";
    	$result=$this->con->query($sql);
    	if ($result) {
    		
    	}else{
    		echo " Unfriend Error".$this->con->error;
    	}
    	return $result;
    }
	
	public function insert_chat($table,$chat_to_id,$post){
		$from_id=$_SESSION['uid'];
		$message= mysqli_real_escape_string($this->con,$_POST['message_chat']);
		$sql="INSERT INTO $table ( `chat_from_id`, `chat_to_id`, `message`, `status`) VALUES ('".$from_id."','".$chat_to_id."','".$message."',0)";
        $result=$this->con->query($sql);
        if ($result) {
        	//echo " Insert Success";
        }else{
        	echo " Insert Chat Error".$this->con->error;
        }

        return $result;
	} 
      /***** From to  Chat  ****/
	public function users_chat($chat_table,$table,$chatuid){
		 // $sql="select $table.id, $chat_table.message,$chat_table.time from  $chat_table join $table on $chat_table.chat_from_id = $table.id or $chat_table.chat_to_id = $table.id  WHERE ($chat_table.chat_from_id='".$_SESSION['uid']."' OR $chat_table.chat_to_id='".$_SESSION['uid']."' and $table.id='".$uid."' )";	
		 $sql="select * from $chat_table JOIN $table on $chat_table.chat_from_id= $table.id OR $chat_table.chat_to_id = $table.id WHERE $chat_table.chat_from_id ='".$_SESSION['uid']."' and $table.id = '".$chatuid."'";    		   
		$result=$this->con->query($sql);
		if ($result) {
			//echo " Display Success";
		}else{
			echo "Display Me Error".$this->con->error; 
		}
		return $result;
	}
	  /***** Send to Me Chat  ****/
	public function user_SendMe_chat($chat_table,$table,$chat_uid1){
		  $sql="select * from $chat_table JOIN $table on $chat_table.chat_from_id= $table.id OR $chat_table.chat_to_id = $table.id WHERE $chat_table.chat_to_id ='".$_SESSION['uid']."' and $table.id = '".$chat_uid1."'";
		 		   
		$result=$this->con->query($sql);
		if ($result) {
			//echo " Display Success";			
		}else{
			echo "Display Me Error".$this->con->error; 
		}
		return $result;
	}
     /**** chat Delete ****/
	public function chat_from_del( $table, $chat_from_del){ 
	   $sql="DELETE FROM `$table` WHERE  id_c='".$chat_from_del."' ";
		$result=$this->con->query($sql);
		
		if ($result) {
			//echo" Delete SuccessFully";
		}else{
			echo "chat Delte Error ".$this->con->error;
		}
		return $result;
	}

	/**** chat update ****/
	public function display_update_chat($chat_edit){
        $sql="select * from chat where id_c='".$chat_edit."'";
        $result=$this->con->query($sql);
        if ($result->num_rows > 0) {
            while ($row=$result->fetch_assoc()) {
                $data[]=$row;
            }
            return $data;
        }
    }
	public function update_msg($table,$post){
		$chat_edit=mysqli_real_escape_string($this->con,$_POST['id_c']);
      	$message=mysqli_real_escape_string($this->con,$_POST['message']);
		
		$sql="UPDATE `$table` SET `message`='".$message."' WHERE id_c='".$chat_edit."'";
		$result=$this->con->query($sql);
		if ($result) {
			echo " update Success ";
		}else{
			echo "chat update Error ".$this->con->error;
		}
		return $result;
	}

     /**  Logout **/
    public function logout(){
        unset($_SESSION['uid']);
        header("location:login.php");
        exit();
    }

	function __distruct(){
		mysqli_close($this->con);
		exit();
	}
}

?>