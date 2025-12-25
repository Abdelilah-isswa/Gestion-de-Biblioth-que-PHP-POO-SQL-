<?php
session_start();

/* Load controllers */
require_once "../controllers/AuthController.php";
require_once "../controllers/BookController.php";
require_once "../controllers/BorrowController.php";

/* Get URL */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/* Remove project folder name (CHANGE if needed) */
$uri = str_replace('/BRIF_BIBLIO2/public', '', $uri);

/* ROUTING */
switch ($uri) {

    /* HOME */
    case '/':
        (new AuthController())->landing();
        break;

    /* AUTH */
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

    /* BOOKS */
    case '/books':
        (new BookController())->index();
        break;

    case '/books/show':
        (new BookController())->show();
        break;

    case '/dashboard':
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }
    require "../views/books/dashboard.php";
    break;

    /* BORROWS */
    case '/borrow':
        (new BorrowController())->borrow();
        break;

    case '/my-borrows':
        (new BorrowController())->myBorrows();
        break;

    /* 404 */
    default:
        http_response_code(404);
        echo "404 - Page not found";
}
