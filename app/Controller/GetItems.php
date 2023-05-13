<?php
// it only able to select items
  $servername = "localhost";
  $username = "user";
  $password = "";
  $db = "hmarket";
  $conn = mysqli_connect($servername, $username, $password,$db);
  $sql = "SELECT * FROM `goods` WHERE id_user=? ";

$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $myobj = new stdClass();
    $myobj->id= $row["id"];
    $myobj->name=$row["name"];
    $myobj->image=$row["image"];
    $data[] = $myobj;
  }
} else {
  $myobj->result= "0 results";
  $data[] = $myobj;
}

$json_data = json_encode($data);
echo $json_data;
//echo $json_data;

$conn->close();

?>