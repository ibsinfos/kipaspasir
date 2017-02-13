<?php
include 'connect.php';



$result = mysql_query("SELECT name,ID FROM mainmenu");

?>

<html>
<head>

</head>
<body>
<table>
<tbody>
<tr>
<td style="width: 93px;">Parent</td>
<td>:</td>
<td><select name="parent_id">
<option value='0'>Please Select Parent</option>
<?php

while($row = mysql_fetch_array($result))
  {


 echo "<option value='".$row['ID']."'>".$row['name']."</option>";
 
  }
?>

</select></td>
</tr>
<tbody>
<table>
</body>
</html>
