<?php
include('../Assets/Connection/Connection.php');
$disid="";
$disname="";
if(isset($_POST['btn_save']))
{
	$district=$_POST['txt_districtname'];
	$hid=$_POST['txt_hidden'];
		
		if($hid=="")
		{
				$insQuery="insert into tbl_district(district_name) values('".$district."')";
				if($con->query($insQuery))
				{
					?>
					<script>
					alert("Inserted");
					window.location="District.php";
					</script>
					<?php
				}
				else
				{
					?>
					<script>
					alert("failed");
					window.location="District.php";
					</script>
					<?php
				}
		}
		else
		{
			$updateQuery="update tbl_district set district_name='".$district."' where district_id='".$_GET['eid']."'";
			if($con->query($updateQuery))
			{
				?>
				<script>
				
				alert("Updated");
				window.location="District.php";
				</script>
				<?php
			}
		}
}



if(isset($_GET['did']))
{
	$delQuery="delete from tbl_district where district_id='".$_GET['did']."'";
	if($con->query($delQuery))
	{
		?>
        <script>
		alert("Deleted");
		window.location="District.php";
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert("deletion failed");
		window.location="District.php";
		</script>
        <?php
	}
}




if(isset($_GET['eid']))
{
$selectQuery="select * from tbl_district where district_id='".$_GET['eid']."'";
$row=$con->query($selectQuery);
$data=$row->fetch_assoc();
$disid=$data['district_id'];
$disname=$data['district_name'];
}






?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td colspan="2"><div align="center">DISTRICT</div>        <div align="center"></div></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><label for="txt_districtname"></label>
       <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $disid?>" />
      <input type="text" name="txt_districtname" id="txt_districtname" value="<?php echo $disname?>" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_save" id="btn_save" value="Save" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>

<table width="200" border="1">
  <tr>
    <td>SlNo</td>
    <td>DistrictName</td>
    <td>Action</td>
  </tr>
  <?php
	$i=0;
	$selQuery="select * from tbl_district";
	$row=$con->query($selQuery);
	
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
  <tr>
    <td><?php echo $i?>;</td>
    <td><?php echo $data['district_name']?></td>
    <td><a href="District.php?did=<?php echo $data['district_id']?>">Delete</a> <a href="District.php?eid=<?php echo $data['district_id']?>">Edit</a></td>
  </tr>
  <?php
	}
	?>
</table>

<p>&nbsp;</p>
</body>
</html>