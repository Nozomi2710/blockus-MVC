<?php

class App
{
    public function __construct()
    {
        $url = $this->parseUrl();
        if ($url[0] == "Payment") {
            $controllerName = "PaymentController";
        }

        if (!file_exists("controllers/$controllerName.php")) {
            return;
        }

        require_once "controllers/$controllerName.php";

        $controller = new $controllerName;
        if (isset($url[1])) {
            $methodName = $url[1];
        } else {
            $methodName = "index";
        }

        if (!method_exists($controller, $methodName)) {
            return;
        }

        unset($url[0]);
        unset($url[1]);
        $params = array();
        if ($url) {
            $params = array_values($url);
        }

        call_user_func_array(Array($controller, $methodName), $params);
    }

    public function parseUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = explode("/", $url);

            return $url;
        }
    }
}
