<?php
include("../Connection/Connection.php");

?>
<option >...select...</option>
<?php 
	$selQuery ="select * from tbl_place where district_id='".$_GET['Did']."'";
	$row=$con->query($selQuery);
	while($data=$row->fetch_assoc())
	{
		?>
		<option value="<?php echo  $data['place_id']?>"><?php echo  $data['place_name']?></option>
		<?php
	}
	?>