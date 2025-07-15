<?php
include("../Assets/Connection/Connection.php");


if(isset($_POST['btn_save']))
{

  $Place=$_POST['sel_place'];
  $user_name=$_POST['txt_name'];
  $user_email=$_POST['txt_email'];
  $user_contact=$_POST['txt_contact'];
  $user_addr=$_POST['txt_address'];
  $user_pswd=$_POST['txt_pswd'];

      $user_photo=$_FILES['file_photo']['name'];
      $temp=$_FILES['file_photo']['tmp_name'];
      move_uploaded_file($temp,'../Assets/File/UserDocs'.$user_photo);


$selEmail="select * from tbl_user where user_email='".$user_email."'";
$row=$con->query($selEmail);
if($row->fetch_assoc())
{
  ?>
     <script>
      alert("Email Already Exist");
      window.location="Registration.php";
    </script>
  <?php
}
else{
 $insQry="insert into tbl_user(place_id,user_name,user_email,user_contact,user_address,user_photo,user_password) values
  ('".$Place."','".$user_name."','".$user_email."','".$user_contact."','".$user_addr."','".$user_photo."','".$user_pswd."')";

  if($con->query($insQry))
  {
  ?>
    <script>
      alert("inserted");
      window.location="Registration.php";
    </script>
  <?php
  }
}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Registration</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="1">
    <tr>
      <td colspan="2"><div align="center">Registration</div></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" required/></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onchange="getPlace(this.value)">
         <option>...Select...</option>
            <?php

				$selQuery="select * from tbl_district";
				$row=$con->query($selQuery);
	
					while($data=$row->fetch_assoc())
					{
	
						?>
						<option
								
         				value=" <?php echo $data['district_id'];?>">
       					 <?php echo $data['district_name'];?>
       				 </option>
                     <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="sel_place"></label>
        <select name="sel_place" id="sel_place">
      </select></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_pswd"></label>
      <input type="password" name="txt_pswd" id="txt_pswd" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_save" id="btn_save" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>

<script src="../Assets/JQuery/JQuery.js"></script>

<script>
        function getPlace(did)
        {
            $.ajax({
              url:"../Assets/AjaxPages/AjaxPlace.php",
              data:{Did:did},
              success:function(response){
                $('#sel_place').html(response);
              }
            })
        }
</script>
</body>
</html>