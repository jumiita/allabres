<?php

include_once "../Models/singlepropertyModel.php";

$model = new singlepropertyModel();

if (isset($_GET["id"])) {
    $property = $model->getProperty($_GET["id"]);
} else {
    die("NO ID SELECTED");
}

session_start();

require_once "../Views/singlepropertyView.phtml";

?>