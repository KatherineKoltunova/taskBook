<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = array(
            'taskbook/([a-z]+)/([a-z]+)' => '$1/$2',
            'taskbook/([a-z]+)' => '$1/index',

            'taskbook' => 'task/index',
        );
    }

    private function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getUri();

        foreach ($this->routes as $uriPattern => $path)
        {
            if (preg_match("~$uriPattern~", $uri))
            {
                $internalRouter = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRouter);

                $controllerName = ucfirst(array_shift($segments).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segments));

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null) {
                    break;
                }
            }
        }
    }
}