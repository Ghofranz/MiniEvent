<?php
require_once __DIR__ . '/../../config/database.php';

class Admin
{
  private $conn;
  private $table = 'admin';

  public $id;
  public $username;
  public $password_hash;

  public function __construct()
  {
    $this->conn = Database::getInstance();
  }

  public function verify($username, $password)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE username = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
      $admin = $stmt->fetch(PDO::FETCH_ASSOC);
      if (password_verify($password, $admin['password_hash'])) {
        return $admin;
      }
    }
    return false;
  }

  public function create($username, $password)
  {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO " . $this->table . " 
                  (username, password_hash) 
                  VALUES (?, ?)";

    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$username, $password_hash]);
  }
}
