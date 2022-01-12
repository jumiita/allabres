<?php
include_once "../Models/listModel.php";

$model = new listModel();
$properties = $model->getproperties();

$selectedPropertyId = "";
$selectedLatitude = 39.650112;
$selectedLongitude = 2.932662;
$zoom = 10;

if (isset($_GET["propertyId"])) {
    $selectedPropertyId = $_GET["propertyId"];
    $selectedProperty = $model->getproperty($selectedPropertyId);
    $selectedLatitude = $selectedProperty->getLatitude();
    $selectedLongitude = $selectedProperty->getLongitude();
    $zoom = 15;
}

require_once "../Views/listView.phtml"

?>

