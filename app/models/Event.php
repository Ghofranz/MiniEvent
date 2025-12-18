<?php
require_once __DIR__ . '/../../config/database.php';

class Event
{
    private $conn;
    private $table = 'events';

    public $id;
    public $title;
    public $description;
    public $event_date;
    public $event_time;
    public $location;
    public $seats;
    public $image;

    public function __construct()
    {
        $this->conn = Database::getInstance();
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " 
                  ORDER BY event_date DESC, event_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (title, description, event_date, event_time, location, seats, image) 
                  VALUES (:title, :description, :event_date, :event_time, :location, :seats, :image)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':event_date', $data['event_date']);
        $stmt->bindParam(':event_time', $data['event_time']);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':seats', $data['seats']);
        $stmt->bindParam(':image', $data['image']);

        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " 
                  SET title = :title,
                      description = :description,
                      event_date = :event_date,
                      event_time = :event_time,
                      location = :location,
                      seats = :seats,
                      image = :image
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':event_date', $data['event_date']);
        $stmt->bindParam(':event_time', $data['event_time']);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':seats', $data['seats']);
        $stmt->bindParam(':image', $data['image']);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function getAvailableSeats($id)
    {
        $query = "SELECT 
                    e.seats AS total_seats,
                    COUNT(r.id) AS reserved_seats,
                    (e.seats - COUNT(r.id)) AS available_seats
                  FROM events e
                  LEFT JOIN reservations r ON e.id = r.event_id
                  WHERE e.id = ?
                  GROUP BY e.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}