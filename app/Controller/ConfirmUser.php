<?php

//element for database 
  $servername = "localhost";
  $username = "user";
  $password = "";
  $db = "hmarket";
  $conn = mysqli_connect($servername, $username, $password,$db);
  $redirect_url="../";
//element for JWT
  $secret = 'lavoro';
  $expiration = time() + 3600;
  $issuer = 'localhost';
  $userId = "0";


  if (!empty($_POST['user']) && !empty($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT id_user FROM `user` WHERE username =? AND password =? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    if ($result->num_rows > 0) {
      // found user in this moment
        $row = $result->fetch_assoc();
        foreach ($row as $r) {
          if(is_numeric($r))
          {
            $userId = $r;

           
          header("Location: $redirect_url"); 
            exit(); 
          }
      }
            
    }
} else {
    echo "Errore: Nome utente o password mancanti.";
}


$conn->close();

