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

    function logout()
    {
        try {
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            if (isset($_COOKIE['user'])) {
                unset($_COOKIE['user']);
            }
            return true;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    function getUser()
    {
        try {
            if (isset($_SESSION['user'])) {
                return $_SESSION['user'];
            }
            if (isset($_COOKIE['user'])) {
                return $_COOKIE['user'];
            }
            return false;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    function getUserById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM `Users` WHERE ID = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch();
            return $user;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    function getAllUsers()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM `Users`");
            $stmt->execute();
            $users = $stmt->fetchAll();
            return $users;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    function updateUser($id, $firstname, $lastname, $email, $password, $postalcode, $housenumber)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `Users` SET `firstname`=?,`lastname`=?,`email`=?,`password`=?,`postalcode`=?,`housenumber`=? WHERE ID = ?");
            $stmt->execute([$firstname, $lastname, $email, $password, $postalcode, $housenumber, $id]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    function deleteUser($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM `Users` WHERE ID = ?");
            $stmt->execute([$id]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    function getOrdersByUserId($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM `Orders` WHERE user_id = ?");
            $stmt->execute([$id]);
            $orders = $stmt->fetchAll();
            return $orders;
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
?>
