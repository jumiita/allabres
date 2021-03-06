<?php

include_once "country.php";
include_once "state.php";
include_once "city.php";
include_once "neighborhood.php";
include_once "image.php";
include_once "property.php";
include_once "dbo.php";

$dbo = new dbo();

if (isset($_GET["id"])) {
    $property = $dbo->getproperty($_GET["id"]);
} else {
    die("NO ID SELECTED");
}

?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://dawsonferrer.com/allabres/ddbb/mallorcasa/styles/main.css" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Mallorcasa</title>
</head>
<body>
<div class="container">
    <h2 class="text-center"><span><a href="list.php">Mallorcasa</a></span></h2>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="0" class='active' aria-current='true' aria-label="Slide 1"></button>
                    <?php for ($i = 1; $i < count($property->getImages()); $i++) { ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="<?php echo $i ?>" aria-label="Slide <?php echo $i + 1 ?>"></button>
                    <?php } ?>

                </div>
                <div class="carousel-inner">
                    <?php foreach ($property->getImages() as $image) { ?>
                        <div class="carousel-item <?php echo($property->getImages()[0]->getId() == $image->getId() ? "active" : "") ?>">
                            <img src="<?php echo $image->getUrl() ?>"
                                 class="d-block w-100"
                                 alt="13850">
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Property description</h5>
                    <?php echo $property->getDescription() ?>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Property location</h5>
                    <iframe width="100%" height="800" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?q=<?php echo $property->getLatitude() ?>,<?php echo $property->getLongitude() ?>&hl=es&z=15&output=embed"></iframe>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h5 class="card-title">Property details</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-info"></i>
                            Property Id
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getId() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-globe"></i>
                            Country
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getCountry()->getName() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-flag"></i>
                            State
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getState()->getName() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-building-o"></i>
                            City
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getCity()->getName() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-building"></i>
                            Neighborhood
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getNeighborhood()->getName() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-envelope"></i>
                            Zip code
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getZipcode() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-calendar"></i>
                            Published
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getDate()->format("d/m/Y") ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-bath"></i>
                            Bathrooms
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getBathrooms() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-arrow-circle-up"></i>
                            Floor
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getFloor() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-bed"></i>
                            Rooms
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getRooms() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-arrows-alt"></i>
                            Surface
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getSurface() ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fa fa-eur"></i>
                            Price
                            </span>
                            <span class="badge bg-primary rounded-pill"><?php echo $property->getPrice() ?>???</span>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        $('.carousel').carousel();
    });
</script>
</html>
