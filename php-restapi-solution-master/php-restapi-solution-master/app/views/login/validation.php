
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
    $stmt = $conn->prepare("SELECT * FROM admin");
    $stmt->execute();
    $admins = $stmt->fetchAll();
     
    foreach($admins as $admin) {
         
        if(($admin['username'] == $username) &&
            ($admin['password'] == $password)) {
                header("location: index.php"); // Needs To be to the admin page
                $_SESSION['username'] = $username; //HIER SLA JE DE USER GLOBAAL OP. 
                $_SESSION['password'] = $password;
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