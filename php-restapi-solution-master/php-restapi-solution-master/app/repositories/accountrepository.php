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
            $stmt = $this->connection->prepare("INSERT INTO `Users`(`email`, `userRole`, `fullName`, `phoneNumber`, `password`) VALUES (?,0,?,?,?)");
            $stmt->execute([
                $user->getEmail(), 
                $user->getFullName(), 
                $user->getPhoneNumber(), 
                $user->getPassword()]);
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later." . $e->getMessage());
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
            $stmt = $this->connection->prepare("SELECT `email`, `userRole`, `fullName`, `phoneNumber`, `password` FROM `Users` WHERE userID = ?");
            $stmt->execute([$id]);
            $userData = $stmt->fetch();
            $user = new User(
                $userData['fullName'],
                0,
                $userData['email'],
                $userData['phoneNumber'],
                $userData['password'],
                $id
            );
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

    function updateUser($updatedUser)
    {
        try {
            
            $stmt = $this->connection->prepare("UPDATE `Users` SET `email`=?,`userRole`=?,`fullName`=?,`phoneNumber`=?,`password`=? WHERE userID = ?");
            $stmt->bindParam(1, $updatedUser->getEmail());
            $stmt->bindParam(2, $updatedUser->getUserRole());
            $stmt->bindParam(3, $updatedUser->getFullName());
            $stmt->bindParam(4, $updatedUser->getPhoneNumber());
            $stmt->bindParam(5, $updatedUser->getPassword());
            $stmt->bindParam(6, $updatedUser->getUserID());
    
            $stmt->execute();
            $rowCount = $stmt->rowCount();
    
            if($rowCount === 0) {
                throw new ErrorException("No rows were updated. User ID could be invalid.");
            }
            return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage()); // Log error message
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
            return false;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage()); // Log error message
            throw new ErrorException("Something went wrong! Please try again later.");
            return false;
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
