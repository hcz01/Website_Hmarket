<?php
// it only able to select items
  $servername = "localhost";
  $username = "user";
  $password = "";
  $db = "hmarket";
  $conn = mysqli_connect($servername, $username, $password,$db);

  if (!empty($_POST['user']) && !empty($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Utilizza prepared statements per evitare problemi di sicurezza come SQL injection
    $sql = "SELECT id_user FROM `user` WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    if ($result->num_rows > 0) {
        // L'utente è stato trovato nel database
        $row = $result->fetch_assoc();
        setcookie('user',$user);
        header("Location: ../");
        exit();     
       // $myobj = new stdClass();
       // $myobj->user = $user;
       // $data[] = $myobj;
    }
  // $json_data = json_encode($data);
} else {
    echo "Errore: Nome utente o password mancanti.";
}

$conn->close();

?>