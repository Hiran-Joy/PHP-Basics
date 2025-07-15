<?php
include("../Assets/Connection/Connection.php");
    session_start();
    
    $selProfile="select * from tbl_user u
    inner join tbl_place p on u.place_id = p.place_id
    inner join tbl_district d on p.district_id = d.district_id
     where user_id='".$_SESSION['uid']."'";
    $row=$con->query( $selProfile);
    $data=$row->fetch_assoc();


if(isset($_POST['btn_save']))
{   
    $name=$_POST['txt_name'];
    $contact=$_POST['txt_contact'];
     $address=$_POST['txt_addrs'];


     $photo=$_FILES['file_photo']['name'];
  $old_photo=$_POST['txt_photo'];

if(!empty($photo))
{
  $temp=$_FILES['file_photo']['tmp_name'];
    move_uploaded_file($temp,"../Assets/File/UserDocs".$photo);

}
else{
    $photo=$old_photo;
}




    $updateQry="update tbl_user set user_name='". $name."',user_contact='".$contact."',user_address='".$address."',user_photo='".$photo."' where user_id='".$_SESSION['uid']."'";
    
   if($con->query($updateQry))
  {
  ?>
    <script>
      alert("updated");
      window.location="Myprofile.php";
    </script>
  <?php
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyProfile</title>
</head>
<body><form action="" method="post" enctype="multipart/form-data" >
   <table border="2">
     <tr>
        <td><input type="hidden" name="txt_photo" value="<?php echo $data['user_photo']?>">
            <img src="../Assets/File/UserDocs<?php echo $data['user_photo']?>" alt="" width="100px" height="100px"></td>
<td>
    <input type="file" name="file_photo">
</td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" name="txt_name" value="<?php echo $data['user_name']?>"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="email" name="txt_email" value="<?php echo $data['user_email']?>" disabled></td>
    </tr>
    <tr>
        <td>Contact</td>
        <td><input type="text" name="txt_contact" value="<?php echo $data['user_contact']?>"></td>
    </tr>
     <tr>
        <td>Address</td>
        <td>
            <textarea name="txt_addrs" ><?php echo $data['user_address']?></textarea></td>
    </tr>

    <tr>
        <td>
            <a href="./MyProfile.php">Back</a></td>
          <td> <input type="Submit" name="btn_save" value="Save">
        </td>
    </tr>
   </table>
</form>
</body>
</html>