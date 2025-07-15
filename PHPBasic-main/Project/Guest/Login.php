<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
    $email=$_POST['txt_email'];
    $pswd=$_POST['txt_pswd'];
    $selQuery="select * from tbl_user where user_email='".$email."' AND user_password='".$pswd."'";
    echo   $selQuery;
    $row=$con->query( $selQuery);
    if($data=$row->fetch_assoc())
    {
        $_SESSION['uid']=$data['user_id'];
        $_SESSION['uname']=$data['user_name'];
        header("location:../User/UserHome.php");
    }
    else{
        ?>
            <script>
                alert("Invalid");
                window.location="Login.php";
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
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <table border="2">
            <tr>
                <td><label for="txt_email">Email</label></td>
                <td><input type="text" name="txt_email"></td>
            </tr>
             <tr>
                <td><label for="txt_pswd">Password</label></td>
                <td><input type="text" name="txt_pswd"></td>
            </tr>
             <tr>
               <td colspan="2" align="center"><input type="submit" name="btn_submit"></td>
            </tr>
        </table>
    </form>
</body>
</html>