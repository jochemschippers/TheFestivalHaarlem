<?php

class Repository
{

  protected $connection;

  function __construct()
  {

    require __DIR__ . '/../dbconfig.php';

    try {
      $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      throw new ErrorException("Wow! something went wrong on our side! please try again later");
    }
  }
  public function beginTransaction()
  {
    $this->connection->beginTransaction();
  }

  public function commit()
  {
    $this->connection->commit();
  }
  public function rollback()
  {
    $this->connection->rollBack();
  }
}
