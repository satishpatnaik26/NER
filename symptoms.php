<?php
$username = $_POST['username'];
$Gender = $_POST['Gender'];
$email = $_POST['email'];
$Age = $_POST['Age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$pulse_rate = $_POST['pulse_rate'];
$Temperature = $_POST['Temperature'];
if (!empty($username) || !empty($Gender) || !empty($email) || !empty($Age) || !empty($weight) || !empty($height) || !empty($pulse_rate) || !empty($Temperature)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "symptoms";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (username, gender, email, Age, weight, height, pulse_rate, Temperature) values(?, ?, ?, ?, ?, ?,?,?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $username, $gender, $email, $Age, $weight, $height, $pulse_rate, $Temperature);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>