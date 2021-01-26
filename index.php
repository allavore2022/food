<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Define a default root (home page)
$f3->route('GET /', function () {
//    echo "My Food Page";
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a default root (home page)
$f3->route('GET /@first/@last', function ($f3, $params) {
    echo "Hello, ".$params['first']." ".$params['last'];

});

//Define a "breakfast" route
$f3->route('GET /breakfast', function () {
//    echo "My Food Page";
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

//Define a "lunch" route
$f3->route('GET /lunch', function () {
//    echo "My Food Page";
    $view = new Template();
    echo $view->render('views/lunch.html');
});

//Define a "lunch/sandwich" route
$f3->route('GET /breakfast/@item', function ($f3, $params) {
    var_dump($params);
    $menu = array('eggs', 'waffles', 'pancakes');
    $item = $params['item'];
    if (in_array($item, $menu)){
        switch($item){
            case 'eggs':
                $view = new Template();
                echo $view->render('views/eggs.html');
                break;
            case 'pancakes':
                echo "Swedish or American?";
                break;
            case 'waffles':
                $f3->rereoute("http://thewafflehouse.com");
                break;
            default:
                $f3->error(404);
        }
    }
    else {
        echo "Sorry, we don't serve $item";
    }
//    echo "My Food Page";
//    $view = new Template();
//    echo $view->render('views/breakfast.html');
});

//Define a "lunch/sandwich" route
$f3->route('GET /lunch/sandwich', function () {
//    echo "My Food Page";
    $view = new Template();
    echo $view->render('views/sandwich.html');
});

//Rune fat free
$f3->run();