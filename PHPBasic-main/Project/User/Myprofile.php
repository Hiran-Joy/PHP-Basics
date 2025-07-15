<?php
include("../Assets/Connection/Connection.php");
    session_start();
    
    $selProfile="select * from tbl_user u
    inner join tbl_place p on u.place_id = p.place_id
    inner join tbl_district d on p.district_id = d.district_id
     where user_id='".$_SESSION['uid']."'";
    $row=$con->query( $selProfile);
    $data=$row->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyProfile</title>
</head>
<body>
   <table border="2">
     <tr>
        <td><img src="../Assets/File/UserDocs<?php echo $data['user_photo']?>" alt="" width="100px" height="100px"></td>

    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $data['user_name']?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $data['user_email']?></td>
    </tr>
    <tr>
        <td>Contact</td>
        <td><?php echo $data['user_contact']?></td>
    </tr>
 <tr>
        <td>District</td>
        <td><?php echo $data['district_name']?></td>
    </tr>
 <tr>
        <td>Place</td>
        <td><?php echo $data['place_name']?></td>
    </tr>

    <tr>
        <td>Address</td>
        <td><?php echo $data['user_address']?></td>
    </tr>

    <tr>
        <td>
            <a href="./EditProfile.php">Edit Profile</a></td>
          <td>  <a href="./ChangePassword.php">Change Password</a>
        </td>
    </tr>
   </table>
</body>
</html>