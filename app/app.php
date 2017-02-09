<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();

    if (empty($_SESSION['car_list']))
    {
        $car_data = [["2014 Porsche 911", 114991, 7864], ["2011 Ford F450", 55995, 14241], ["2013 Lexus RX 350", 44700, 20000], ["Mercedes Benz CLS550", 39900, 37979], ["2016 Mazda 6", 25000, 50000]];
        foreach ($car_data as $car) {
          $newCar = new Car($car[0], $car[1], $car[2]);
          $newCar->save();
        }
    }

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app) {

        return $app['twig']->render('root.html.twig');
    });

    $app->get("/find_cars", function() use ($app) {

      return $app['twig']->render('find_cars.html.twig');

    });

    $app->get("/display_cars", function() use ($app) {

        $cars_matching_search = array();
        $cars = Car::getAll();
        foreach ($cars as $car) {
            if ($car->getPrice() < $_GET["price"] && $car->getMiles() < $_GET["miles"]) {
                array_push($cars_matching_search, $car);
            }
        }

        return $app['twig']->render('display_cars.html.twig', array('carMatches' => $cars_matching_search));

    });

    $app->get("/post_car", function() use ($app) {

        return $app['twig']->render('post_car.html.twig');

    });
    $app->post("/see_post", function() use ($app) {

        $newCar= new Car($_POST['make'],$_POST['price'],$_POST['mileage']);
        $newCar->save();
        return $app['twig']->render('see_post.html.twig', array('new_car' => $newCar ));

    });


    return $app;
?>
