<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
      return
      "<!DOCTYPE html>
        <html>
        <head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/Car'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                    </div>
                    <div class='form-group'>
                        <label for='miles'>Enter Maximum mileage:</label>
                        <input id='miles' name='miles' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
             </div>
         </body>
        </html>";
    });

 // adfdasfds

    $app->get("/Car", function() {
          $porsche = new Car("2014 Porsche 911", 114991, 7864);
          $ford = new Car("2011 Ford F450", 55995, 14241);
          $lexus = new Car("2013 Lexus RX 350", 44700, 20000);
          $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979);
          $mazda = new Car("2016 Mazda 6", 25000, 50000);

          $cars = array($ford, $lexus, $mercedes, $mazda, $porsche);
          $output = "<h1>Your Car Dealership</h1>";
          $cars_matching_search = array();
          foreach ($cars as $car) {
              if ($car->getPrice() < $_GET["price"] && $car->getMiles() < $_GET["miles"]) {
                  array_push($cars_matching_search, $car);
            }
        }
            if ($cars_matching_search == null){
                return "Sorry no cars match your search.";
            }   else{
                    foreach ($cars_matching_search as $car) {
                    $our_price = $car->getPrice();
                    $our_model = $car->getModel();
                    $our_miles = $car->getMiles();
                    $output = $output .
                     "<li> $our_model </li>
                     <ul>
                     <li> $$our_price </li>
                     <li> Miles: $our_miles </li>
                     </ul>";
                }
            }
        return $output;
    });

    return $app;
?>
