<?php
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Reservation.php';

class AdminController
{
  private $adminModel;
  private $eventModel;
  private $reservationModel;

  public function __construct()
  {
   // session_start();
    $this->adminModel = new Admin();
    $this->eventModel = new Event();
    $this->reservationModel = new Reservation();

    $this->checkAuth();
  }

  private function checkAuth()
  {
    $allowedPages = ['login'];
    $currentPage = basename($_SERVER['REQUEST_URI']);

    if (!in_array($currentPage, $allowedPages) && !isset($_SESSION['admin_logged_in'])) {
      header('Location: ' . BASE_URL . 'admin/login');
      exit();
    }
  }

  public function login()
  {
    if (isset($_SESSION['admin_logged_in'])) {
      header('Location: ' . BASE_URL . 'admin/dashboard');
      exit();
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';

      $admin = $this->adminModel->verify($username, $password);

      if ($admin) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: ' . BASE_URL . 'admin/dashboard');
        exit();
      } else {
        $error = 'Identifiants incorrects.';
      }
    }

    $data = [
      'title' => 'Connexion Admin - ' . SITE_NAME,
      'error' => $error
    ];

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/admin/login.php';
    require_once __DIR__ . '/../views/partials/footer.php';
  }

  public function dashboard()
  {
    $totalEvents = count($this->eventModel->getAll());
    $totalReservations = count($this->reservationModel->getAll());
    $events = $this->eventModel->getAll();

    $data = [
      'title' => 'Tableau de bord - ' . SITE_NAME,
      'totalEvents' => $totalEvents,
      'totalReservations' => $totalReservations,
      'events' => $events
    ];

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/admin/dashboard.php';
    require_once __DIR__ . '/../views/partials/footer.php';
  }

  public function createEvent()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
  'title' => $_POST['title'],
  'description' => $_POST['description'],
  'event_date' => $_POST['event_date'],
  'event_time' => $_POST['event_time'],
  'location' => $_POST['location'],
  'seats' => $_POST['seats'],
  'image' => $event['image']
];


      if ($this->eventModel->create($data)) {
        $_SESSION['success'] = 'Événement créé avec succès';
        header('Location: ' . BASE_URL . 'admin/dashboard');
        exit();
      } else {
        $_SESSION['error'] = 'Erreur lors de la création';
      }
    }

    $data = [
      'title' => 'Créer un événement - ' . SITE_NAME,
      'action' => 'create'
    ];

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/admin/form_event.php';
    require_once __DIR__ . '/../views/partials/footer.php';
  }

  public function editEvent()
  {
    $id = $_GET['id'] ?? 0;
    $event = $this->eventModel->getById($id);

    if (!$event) {
      header('Location: ' . BASE_URL . 'admin/dashboard');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
  'title' => $_POST['title'],
  'description' => $_POST['description'],
  'event_date' => $_POST['event_date'],
  'event_time' => $_POST['event_time'],
  'location' => $_POST['location'],
  'seats' => $_POST['seats'],
  'image' => $this->handleImageUpload()
];

      // Si nouvelle image
      if (!empty($_FILES['image']['name'])) {
        $data['image'] = $this->handleImageUpload();
      }

      if ($this->eventModel->update($id, $data)) {
        $_SESSION['success'] = 'Événement mis à jour';
        header('Location: ' . BASE_URL . 'admin/dashboard');
        exit();
      } else {
        $_SESSION['error'] = 'Erreur lors de la mise à jour';
      }
    }

    $data = [
      'title' => 'Modifier un événement - ' . SITE_NAME,
      'event' => $event,
      'action' => 'edit'
    ];

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/admin/form_event.php';
    require_once __DIR__ . '/../views/partials/footer.php';
  }

  private function handleImageUpload()
  {
    if (!empty($_FILES['image']['name'])) {
      $target_dir = dirname(__DIR__, 2) . '/public/uploads/';
      $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
      $new_filename = uniqid() . '.' . $imageFileType;
      $target_file = $target_dir . $new_filename;

      // Vérifier si c'est une image
      $check = getimagesize($_FILES['image']['tmp_name']);
      if ($check !== false && move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        return $new_filename;
      }
    }
    return 'default.jpg';
  }
public function deleteEvent()
{
    $id = $_GET['id'] ?? null;

    if ($id) {
        $this->eventModel->delete($id);
        $_SESSION['success'] = "Événement supprimé avec succès";
    }

    header('Location: ' . BASE_URL . 'admin/dashboard');
    exit();
}
/*public function deleteEvent()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: ' . BASE_URL . 'admin/dashboard');
        exit();
    }

    $reservationCount = $this->reservationModel->countByEvent($id);

    if ($reservationCount > 0) {
        $_SESSION['error'] = "Suppression impossible : des réservations existent pour cet événement.";
    } else {
        $this->eventModel->delete($id);
        $_SESSION['success'] = "Événement supprimé avec succès.";
    }

    header('Location: ' . BASE_URL . 'admin/dashboard');
    exit();
}*/

public function reservations()
{
    $event_id = $_GET['event_id'] ?? null;

    if (!$event_id) {
        header('Location: ' . BASE_URL . 'admin/dashboard');
        exit();
    }

    $event = $this->eventModel->getById($event_id);
    $reservations = $this->reservationModel->getByEvent($event_id);

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/admin/reservations.php';
    require_once __DIR__ . '/../views/partials/footer.php';
}


  public function logout()
  {
    session_destroy();
    header('Location: ' . BASE_URL . 'admin/login');
    exit();
  }
}