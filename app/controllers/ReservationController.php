<?php
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Event.php';

class ReservationController
{
  private $reservationModel;
  private $eventModel;

  public function __construct()
  {
    session_start();
    $this->reservationModel = new Reservation();
    $this->eventModel = new Event();
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $event_id = $_POST['event_id'] ?? '';
      $name = trim($_POST['name'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $phone = trim($_POST['phone'] ?? '');

      // Validation
      if (empty($name) || empty($email) || empty($event_id)) {
        $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires.';
      } else {
        // disponibilité
        $availableSeats = $this->eventModel->getAvailableSeats($event_id);

        if ($availableSeats['available_seats'] <= 0) {
          $_SESSION['error'] = 'Désolé, plus de places disponibles.';
        } elseif ($this->reservationModel->checkDuplicate($event_id, $email)) {
          $_SESSION['error'] = 'Vous avez déjà réservé pour cet événement.';
        } else {
          $data = [
            'event_id' => $event_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone
          ];

          if ($this->reservationModel->create($data)) {
            $_SESSION['success'] = 'Réservation enregistrée avec succès!';
          } else {
            $_SESSION['error'] = 'Erreur lors de la réservation.';
          }
        }
      }

      
      header('Location: ' . BASE_URL . 'events/details?id=' . $event_id);
      exit();
    }
  }
}