<?php

include_once "../Models/singlepropertyModel.php";

$model = new singlepropertyModel();

if (isset($_GET["id"])) {
    $property = $model->getProperty($_GET["id"]);
} else {
    die("NO ID SELECTED");
}

require_once "../Views/singlepropertyView.phtml";

?>