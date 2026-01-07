<?php
session_start();


require_once "../controllers/AuthController.php";
require_once "../controllers/BookController.php";
require_once "../controllers/BorrowController.php";


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$u = $_SERVER['REQUEST_URI'];

$uri = str_replace('/BRIF_BIBLIO2/public', '', $uri);
  






switch ($uri) {


    case '/':
        (new AuthController())->landing();
       
        break;

    case '/login':
     
        $_SERVER['REQUEST_METHOD'] === 'POST'
            ? (new AuthController())->login()
            : (new AuthController())->loginForm();
        break;

    case '/register':
        $_SERVER['REQUEST_METHOD'] === 'POST'
            ? (new AuthController())->register()
            : (new AuthController())->registerForm();
        break;

    case '/logout':
        (new AuthController())->logout();
        break;


    case '/books':
        (new BookController())->index();
        break;

    case '/books/show':
        (new BookController())->show();
        break;

    case '/books/create':
        $_SERVER['REQUEST_METHOD'] === 'POST'
            ? (new BookController())->store()
            : (new BookController())->createForm();
        break;

    case '/books/delete':
        (new BookController())->delete();
        break;


    case '/books/edit':
        (new BookController())->edit();
        break;

    case '/books/update':
        (new BookController())->update();
        break;


    case '/dashboard':
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        require "../views/books/dashboard.php";
        break;


    case '/borrow':
        (new BorrowController())->borrow();
        break;
    case '/borrows/create':
    (new BorrowController())->store();
    break;
    

    case '/borrows/my':
        require_once '../controllers/BorrowController.php';
        (new BorrowController())->myBorrows();
        break;

        case '/borrows/return':
    (new BorrowController())->returnBook();
    break;

  case '/users/readers':
    require_once '../controllers/UserController.php';
    $controller = new UserController();
    $controller->readers();
    break;
case '/borrows/history':
    require_once '../controllers/BorrowController.php';
    (new BorrowController())->history();
    break;


    default:
        http_response_code(404);
        echo "404 - Page not found";
}
