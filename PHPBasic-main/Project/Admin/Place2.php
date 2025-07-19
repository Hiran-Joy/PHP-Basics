
<?php
$place_namee='';
$district_idd='';
$district_id='';
$place='';
$place_idd='';
$hid="";
$eid="";
include('../Assets/Connection/Connection.php');

if(isset($_POST['btn_save']))
{
    $place= $_POST['txt_place'];
    $district_id= $_POST['sel_district'];
    $hid=$_POST['txt_hidden'];



   if(trim($hid==""))
   {
    $insQuery="insert into tbl_place(place_name, district_id) values('".$place."', '".$district_id."')";
   if ($con->query($insQuery))
   {
    ?>
    <script>
    alert("Inserted");
    window.location="Place2.php";
    </script>
    <?php
   }
}
else
{
  $upQuery="update tbl_place set district_id='".$district_id."', place_name='".$place."' where place_id='".$hid."'";
  if($con->query($upQuery))
  {
     ?>
    <script>
    alert("Updated");
    window.location="Place2.php";
    </script>
    <?php
   }
  }
} 

?>

<?php
    if(isset($_GET['did']))
    {
        $delQuery="delete from tbl_place where place_id='".$_GET['did']."'";
        $con->query($delQuery);

    }
    
?>

<?php
if(isset($_GET['eid'])){
$selQuery="select * from tbl_place where place_id='".$_GET['eid']."'";
$row=$con->query($selQuery);
$data=$row->fetch_assoc();
$place_namee=$data['place_name'];
$place_idd=$data['place_id'];
$district_idd=$data['district_id'];
}

?>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <th width="105" scope="row">District Name</th>
      <td width="79"><label for="sel_district"></label>
        <select name="sel_district" id="sel_district">
        <option>....select....</option>
       <?php
        $selQuery= "select * from tbl_district";
        $row=$con->query($selQuery);
        while($data=$row->fetch_assoc())
        {
            $dis_name=$data['district_name'];
            $dis_id=$data['district_id'];

            ?>
            
            
            <option <?php // whats the need of putting the code inside 'option tag'.
             if($district_idd==$dis_id)
            {
                echo "selected"; // why are we using this(the sel is only working if we use this).
            }
            ?>
            value="<?php echo $dis_id  ?>">
                <?php echo $dis_name ?>
            </option>
        <?php
        }
        ?>
        
      </select></td>
    </tr>
    <tr>
      <th scope="row">Place Name</th>
      <td><label for="txt_place"></label>
      <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $place_idd ?>" />
     <input type="text" name="txt_place" id="txt_place" value="<?php echo $place_namee ?>" /></td>
    </tr>
    <tr>
      <th colspan="2" scope="row"><input type="submit" name="btn_save" id="btn_save" value="Submit" /></th>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>

<form id="form2" name="form2" method="post" action="">
</form>
<table width="358" border="1">
  <tr>
    <th scope="row">SI NO:</th>
    <td><strong>District Name</strong></td>
    <td><strong>Place Name</strong></td>
    <td><strong>Action</strong></td>
  </tr>
    <?php
  $i=0;
  $selQuery="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
  $row=$con->query($selQuery) ;
  while($data=$row->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $data['district_name']?></td>
    <td><?php echo $data['place_name']?></td>
    <td><a href="Place2.php?did=<?php echo $data['place_id']?>">Delete</a>
        <a href="Place2.php?eid=<?php echo $data['place_id']?>">Edit</a></td>

    
  </tr>
  <?php
  }
  ?>
</table>
<p>&nbsp;</p>
