<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{

    function checkEmailExists()
    {
        try {
            $email = $_POST['email'] ?? '';
            $stmt = $this->connection->prepare("SELECT ID FROM Users WHERE email = ?");
            $stmt->execute([$email]);

            $users = $stmt->fetchAll();
            if (empty($users)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            throw new ErrorException("Iets is fout gegaan, probeer het op een later punt nogmaals.");
        }
    }
    function registerAccount()
    {
        try {
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $postalcode = $_POST['postalcode'] ?? '';
            $housenumber = $_POST['housenumber'] ?? '';
            $stmt = $this->connection->prepare("INSERT INTO `Users`(`firstname`, `lastname`, `email`, `password`, `postalcode`, `housenumber`) 
            VALUES (?,?,?,?,?,?)");
            $stmt->execute([$firstname, $lastname, $email, $password, $postalcode, $housenumber]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    function login()
    {
        try {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $stmt = $this->connection->prepare("SELECT * FROM `Users` WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if (!$user) {
                throw new ErrorException("foutieve email of wachtwoord");
            }
            if (!password_verify($password, $user['password'])) {
                throw new ErrorException("foutieve email of wachtwoord");
            }
            
            if (isset($_POST['remember_me'])) {
                if (array_values($_POST)[2] === "true") {

                    setcookie("user", $user, time() + 86400);
                } else if (array_values($_POST)[2] === "false"){
                    $_SESSION['user'] = $user;
                }
                else{
                    throw new ErrorException("Iets lijkt fout te zijn gegaan. probeer het later nogmaals.");
                }
            }

            return true;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>
