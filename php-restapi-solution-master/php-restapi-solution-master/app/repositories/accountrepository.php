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
                $user->getPassword()
            ]);
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later." . $e->getMessage());
        }
    }
    function getPasswordByEmail($email)
    {
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
            $user = new User($userData['fullName'], $userData['userRole'], '', '', '', $userData['userID'],);
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
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $data = $stmt->fetchAll();

            $users = [];
            foreach ($data as $row) {
                $user = new User(
                    $row['fullName'],
                    $row['userRole'],
                    $row['email'],
                    $row['phoneNumber'],
                    $row['password'],
                    $row['userID']
                );
                array_push($users, $user);
            }

            return $users;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

    function createUser($user) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO `Users`(`email`, `userRole`, `fullName`, `phoneNumber`, `password`) VALUES (?,?,?,?,?)");
            $stmt->execute([
                $user->getEmail(),
                $user->getUserRole(),
                $user->getFullName(),
                $user->getPhoneNumber(),
                $user->getPassword()
            ]);
            $rowCount = $stmt->rowCount();
            if ($rowCount === 0) {
                throw new ErrorException("No rows were inserted. User ID could be invalid.");
            }
            return true;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

    function updateUser($updatedUser)
    {
        try {
            if ($updatedUser->getPassword() == "" || $updatedUser->getPassword() == null || $updatedUser->getPassword() == " " || $updatedUser->getPassword() == '') {
                $stmt = $this->connection->prepare("UPDATE `Users` SET `email`= :email,`fullName`= :fullName,`phoneNumber`= :phoneNumber WHERE userID = :userId;");
                $stmt->bindValue(':email', $updatedUser->getEmail());
                $stmt->bindValue(':fullName', $updatedUser->getFullName());
                $stmt->bindValue(':phoneNumber', $updatedUser->getPhoneNumber());
                $stmt->bindValue(':userId', $updatedUser->getUserID());
                $stmt->execute();
                $rowCount = $stmt->rowCount();
                if (!$stmt->execute()) {
                    error_log(print_r($stmt->errorInfo(), true));
                }
                if ($rowCount === 0) {
                    throw new ErrorException("No rows were updated. User ID could be invalid.");
                }
                return true;
            } else {
                $updatedUser->setPassword(password_hash($updatedUser->getPassword(), PASSWORD_DEFAULT));
                $stmt = $this->connection->prepare("UPDATE `Users` SET `email`=?,`userRole`=?,`fullName`=?,`phoneNumber`=?,`password`=? WHERE userID = ?");
                $email = $updatedUser->getEmail();
                $userRole = $updatedUser->getUserRole();
                $fullName = $updatedUser->getFullName();
                $phoneNumber = $updatedUser->getPhoneNumber();
                $password = $updatedUser->getPassword();

                $userID = (int)$updatedUser->getUserID();

                $stmt->bindValue(1, $email);
                $stmt->bindValue(2, $userRole);
                $stmt->bindValue(3, $fullName);
                $stmt->bindValue(4, $phoneNumber);
                $stmt->bindValue(5, $password);
                $stmt->bindValue(6, $userID);

                $stmt->execute();
                $rowCount = $stmt->rowCount();
                if ($rowCount === 0) {
                    throw new ErrorException("No rows were updated 2. User ID could be invalid.");
                }
                return true;
            }
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

    function checkEmail($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT `email` FROM `Users` WHERE email = ?");
            $stmt->execute([$email]);
            $email = $stmt->fetch();
            if ($email) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
            return false;
        }
    }

    function resetPassword($email, $password)
    {
        try {
            var_dump($email, $password);
            $stmt = $this->connection->prepare("UPDATE `Users` SET `password` = ? WHERE `email` = ?");
            $stmt->execute([$password, $email]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
            return false;
        }
    }

    function deleteUser($id)
    {
        try {
            error_log("User ID: " . $id);
            $stmt = $this->connection->prepare("DELETE FROM `Users` WHERE userID = ?");
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
