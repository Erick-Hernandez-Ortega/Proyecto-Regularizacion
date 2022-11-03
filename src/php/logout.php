<?php

session_start();
destroySession();

function destroySession() {

    $_SESSION = [];

    if (ini_get('session.use_cookies')) {

        $params = session_get_cookie_params();
        setcookie(session_name(),
                  '',
                  time() - 42000,
                  $params['path'],
                  $params['domain'],
                  $params['secure'],
                  $params['httponly']);
    }
    @session_destroy();
}

$host = $_SERVER['HTTP_HOST'];
header("location: http://$host/Proyecto-Regularizacion/login.php");
exit();
?>
