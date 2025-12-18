<?php
require_once __DIR__ . '/../../config/database.php';

class Reservation
{
  private $conn;
  private $table = 'reservations';

  public $id;
  public $event_id;
  public $name;
  public $email;
  public $phone;
  public $created_at;

  public function __construct()
  {
    $this->conn = Database::getInstance();
  }

  public function create($data)
  {
    $query = "INSERT INTO " . $this->table . " 
                  (event_id, name, email, phone, created_at) 
                  VALUES (:event_id, :name, :email, :phone, NOW())";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':event_id', $data['event_id']);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':phone', $data['phone']);

    return $stmt->execute();
  }

  public function getByEvent($event_id)
  {
    $query = "SELECT * FROM " . $this->table . " 
                  WHERE event_id = ? 
                  ORDER BY created_at DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute([$event_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAll()
  {
    $query = "SELECT r.*, e.title as event_title 
                  FROM " . $this->table . " r
                  JOIN events e ON r.event_id = e.id
                  ORDER BY r.created_at DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function checkDuplicate($event_id, $email)
  {
    $query = "SELECT COUNT(*) as count 
                  FROM " . $this->table . " 
                  WHERE event_id = ? AND email = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->execute([$event_id, $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
  }
  public function countByEvent($event_id)
{
    $query = "SELECT COUNT(*) FROM reservations WHERE event_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$event_id]);
    return (int) $stmt->fetchColumn();
}

}