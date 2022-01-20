<?php

include_once "../Models/signupModel.php";

if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["password2"])) {
    if($_POST["password"] == $_POST["password2"]){
        $signupModel = new signupModel();
        if($signupModel->checkUserExists($_POST["mail"])){
            die("User already exists");
        }else{
            try {
                $password = crypt($_POST["password"], bin2hex(random_bytes(10)));
            } catch (Exception $e) {
                $password = crypt($_POST["password"], "salt");
            }
            if($signupModel->saveUser($_POST["mail"], $password)){
                header("Location: loginController.php");
            } else{
                die("sign up gone wrong");
            }
        }
    }
} else {
    include_once "../Views/signUpView.phtml";
}