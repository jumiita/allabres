<?php

include_once "../Models/loginModel.php";

if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $loginModel = new loginModel();
    $user = $loginModel->getUser($_POST["mail"], $_POST["password"]);
    if($user->getId() > 0){
        session_start();
        $_SESSION["userId"] = $user->getId();
        $_SESSION["userMail"] = $user->getMail();
        header("Location: list.php");
    } else {
        die("Login gone wrong");
    }
} else {
    include_once "../Views/loginView.phtml";
}

