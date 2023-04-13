<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class AccountRepository extends Repository
{

    function checkEmailExists($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT userID FROM Users WHERE email = ?");
            $stmt->execute([$email]);
            $users = $stmt->fetchAll();
            if (empty($users)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong on our side! Please try again later.");
        }
    }
    function register($user)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO `Users`(`email`, `userRole`, `fullName`, `phoneNumber`, `password`) VALUES (?,?,?,?,?)");
            $stmt->execute([
                $user->getEmail(), 
                $user->getUserRole(), 
                $user->getFullName(), 
                $user->getPhoneNumber(), 
                $user->getPassword()]);
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function getPasswordByEmail($email){
        try {
            $stmt = $this->connection->prepare("SELECT `password` FROM `Users` WHERE email = ?");
            $stmt->execute([$email]);
            $password = $stmt->fetch();
            return $password;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
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
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

    function getUser($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT userID, userRole, fullName FROM `Users` WHERE email = ?");
            $stmt->execute([$email]);
            $userData = $stmt->fetch();
            $user = new User($userData['fullName'], $userData['userRole'],'', '', '', $userData['userID'], );            
            return $user;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
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
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
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
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

    function updateUser($id, $firstname, $lastname, $email, $password, $postalcode, $housenumber)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `Users` SET `firstname`=?,`lastname`=?,`email`=?,`password`=?,`postalcode`=?,`housenumber`=? WHERE ID = ?");
            $stmt->execute([$firstname, $lastname, $email, $password, $postalcode, $housenumber, $id]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

    function deleteUser($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM `Users` WHERE ID = ?");
            $stmt->execute([$id]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
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
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
}
