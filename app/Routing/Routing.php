<?php

declare(strict_types=1);

namespace App\Routing;

require __DIR__ . "/IRouting.php";

class Routing implements IRouting
{
    public static function get(string $route, string $call): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            Routing::route($route, $call);
        }
    }

    public static function route(string $route, string $call): void
    {
        $route_dict = [];
        $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $route_dict[$route] = $call;
        foreach ($route_dict as $key => $value) {
            if ($request_url == $key) {
                $call_value = $route_dict[$key];
                $call_parts = explode("@", $call_value);
                $class = $call_parts[0];
                $function = $call_parts[1];
                require_once __DIR__ . "/../Controllers/" . $class . ".php";
                $Class = "App\Controllers\\" . $class;
                $Class = new $Class;
                $Class->$function();
                exit;
            }
        }
    }

    public static function group($middleware, $function): void
    {
        $_SESSION["X-RateLimit-Limit"] = "100";
        $_SESSION["X-RateLimit-Remaining"] = "10";

        $middleware = array(
            $middleware
        );

        $function();
    }
}
