
<?php
 
include_once("dbconfig.php");
  
function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();
     
    foreach($users as $user) {
         
        if(($user['username'] == $username) &&
            ($user['password'] == $password)) {
                header("location: index.php"); // Needs To be to the admin page
        }
        else {
            echo "<script language='javascript'>";
            echo "alert('The information you entered is incorrect.')";
            echo "</script>";
            die();
        }
    }
}
 
?>