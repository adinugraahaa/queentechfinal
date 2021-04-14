<?php 

class Dbh {
  private $host = "localhost";
  private $user = "root";
  private $pwd = "";
  private $dbName = "ecommerce";

  public function connect() {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
    $pdo = new PDO($dsn, $this->user, $this->pwd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //for limit
    return $pdo;
  }
}