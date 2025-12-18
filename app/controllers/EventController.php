<?php
require_once __DIR__ . '/../models/Event.php';

class EventController
{
  private $eventModel;

  public function __construct()
  {
    $this->eventModel = new Event();
  }

  public function index()
  {
    $events = $this->eventModel->getAll();

    $data = [
      'title' => 'Accueil - ' . SITE_NAME,
      'events' => $events
    ];

    $this->render('events/list', $data);
  }

  public function list()
  {
    $events = $this->eventModel->getAll();

    $data = [
      'title' => 'Événements - ' . SITE_NAME,
      'events' => $events
    ];

    $this->render('events/list', $data);
  }

  public function details()
  {
    $id = $_GET['id'] ?? 0;
    $event = $this->eventModel->getById($id);

    if (!$event) {
      header('Location: ' . BASE_URL);
      exit();
    }

    $availableSeats = $this->eventModel->getAvailableSeats($id);

    $data = [
      'title' => $event['title'] . ' - ' . SITE_NAME,
      'event' => $event,
      'availableSeats' => $availableSeats
    ];

    $this->render('events/details', $data);
  }

  private function render($view, $data = [])
  {
    extract($data);

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/' . $view . '.php';
    require_once __DIR__ . '/../views/partials/footer.php';
  }
}
