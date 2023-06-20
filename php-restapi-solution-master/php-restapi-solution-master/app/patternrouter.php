<?php
class PatternRouter
{
    private function stripParameters($uri)
    {
        //maximum 2 just to controll for the case of multiple question marks
        $uriParts = explode('?', $uri, 2);
        return $uriParts[0];
    }

    public function route($uri, $queryString)
    {
        // check if we are requesting an api route
        $api = false;
        if (str_starts_with($uri, "api/")) {
            $uri = substr($uri, 4);
            $api = true;
        }

        // set default controller/method
        $defaultcontroller = 'home';
        $defaultMethod = 'index';

        // ignore query parameters
        $uri = strtolower($this->stripParameters($uri));

        // read controller/method names from URL
        $explodedUri = explode('/', $uri);

        if (!isset($explodedUri[0]) || empty($explodedUri[0])) {
            $explodedUri[0] = $defaultcontroller;
        }
        if (!isset($explodedUri[1]) || empty($explodedUri[1])) {
            $explodedUri[1] = $defaultMethod;
        }
        $methodName = $explodedUri[1];

        $loginRequiredRoutes = [
            'login',
            'payment',
            'recieve'
        ];
        if (in_array($explodedUri[1], $loginRequiredRoutes) && $explodedUri[0] == 'paymentpage') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['userID'])) {
                $explodedUri[0] = 'errormessage403';
                $methodName = $defaultMethod;
            }
        }
        if ($explodedUri[0] === 'test') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] != 1) {
                $explodedUri[0] = 'errormessage403';
                $methodName = $defaultMethod;
            }
        }
        if ($explodedUri[1] === 'userdetails') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['userID'])) {
                $explodedUri[0] = 'errormessage403';
                $methodName = $defaultMethod;
            }
        }

        $controllerName = str_replace('-', '', $explodedUri[0]) . "controller";

        // load the file with the controller class
        $filename = __DIR__ . '/controllers/' . $controllerName . '.php';
        if ($api) {
            $filename = __DIR__ . '/api/controllers/' . $controllerName . '.php';
        }
        if (file_exists($filename)) {
            require_once $filename;
        } else {
            http_response_code(404);
            die();
        }
        // dynamically call relevant controller method
        try {
            $controllerObj = new $controllerName;

            // add query string to the $_GET superglobal
            $_GET = [];
            if (!empty($queryString)) {
                parse_str($queryString, $_GET);
            }
            $controllerObj->{$methodName}();
        } catch (Exception $e) {
            http_response_code(404);
            die();
        }
    }
}
