<?php
include('../Assets/Connection/Connection.php');

$place='';
$dis_id='';
$place_id='';
if(isset($_POST['btn_save']))
{	
	$dis=$_POST['sel_district'];
	$place=$_POST['txt_place'];
	$eid = $_POST['txt_hidden'];

	if($eid != "")
	{

			$UpdateQry="update tbl_place set district_id ='".$dis."',place_name='".$place."' where place_id='".$_GET['eid']."'";
		 
			if($con->query($UpdateQry))
			{
				?>
				<script>
				alert("updated");
			
				</script>
				<?php
			}
	}
	else
	{
			
			$insertQry="insert into tbl_place(district_id,place_name) values('".$dis."','".$place."')";
		
			if($con->query($insertQry))
			{
				?>
				<script>
				alert("inserted");
				window.location="Place.php";
				</script>
				<?php
			}
			
			
	}
}


if(isset($_GET['did']))
{
	$delQuery="delete from tbl_place where place_id='".$_GET['did']."'";
		if($con->query($delQuery))
	{
		?>
        <script>
		alert("deleted");
		window.location="Place.php";
		</script>
        <?php
	}

}




if(isset($_GET['eid']))
{
	$seQuery="select * from tbl_place where place_id='".$_GET['eid']."'";
		$row=$con->query($seQuery);
	$data=$row->fetch_assoc();
	$place=$data['place_name'];
	$dis_id=$data['district_id'];
	$place_id=$data['place_id'];

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td colspan="2"><div align="center">Place</div>        <div align="center"></div></td>
    </tr>
    <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district">
        <option>...Select...</option>
            <?php

				$selQuery="select * from tbl_district";
				$row=$con->query($selQuery);
	
					while($data=$row->fetch_assoc())
					{
	
						?>
						<option
								<?php
                                if($dis_id==$data['district_id'])
                                {
                                    echo "selected";
                                }
                                
                                ?>
         				value=" <?php echo $data['district_id'];?>">
       					 <?php echo $data['district_name'];?>
       				 </option>
        <?php
	}?>
        
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="txt_place"></label>
       <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $place_id;?>"/>
      <input type="text" name="txt_place" id="txt_place" value=" <?php echo $place?>" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_save" id="btn_save" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>

<table width="200" border="1">
  <tr>
    <td>Slno</td>
    <td>DistrictName</td>
    <td>Place</td>
    <td>Action</td>
  </tr>
  <?php
  $i=0;
  $seleQuery="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
  $row=$con->query($seleQuery) ;
  while($data=$row->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $data['district_name']?></td>
    <td><?php echo $data['place_name']?></td>
    <td><a href="Place.php?did=<?php echo $data['place_id']?>">Delete</a>
    <a href="Place.php?eid=<?php echo $data['place_id']?>">Edit</a>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>