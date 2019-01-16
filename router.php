<?php
function CompareRoute($method, $request)
{
    if (!(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == $method))
        return false;

    if (!(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == $request))
        return false;

    return true;
}

function Router($method, $request, $action)
{
    if (CompareRoute($method, $request)) {
        $action = explode('@', $action);

        $controller = $action[0];
        $function = $action[1];

        require_once "controllers/{$controller}.php";

        $function();
    }
}

//Routing
Router('GET', '/index', 'Car@Index');
Router('POST', '/car', 'Car@AddCar');
Router('GET', '/cars', 'Car@ShowCars');
Router('GET', '/car/ID', 'Car@ShowCar');
Router('DELETE', '/car/ID', 'Car@RemoveCar');