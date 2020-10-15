<?php


namespace app\main;


use app\traits\SingletonTrait;

class App
{
    /**
     * @var  array
     */
    protected $config;

    /** *
     *@var Container
     */
    protected $container;

    use SingletonTrait;
    /**
     *@return self
     */
    public static function call() {
        return static::getInstance();
    }

    public function run($config) {
        $this->container = new Container($config['components']);
        $this->config = $config;
        $this->runController();
    }

    private function runController() {
        //sessinon block
        $session = new \app\services\Session();
        $session->session();
//session block end
        echo "session";
        var_dump($_SESSION);
        echo "end session";
        echo '<hr>';
        echo '<hr>';


        $request = new \app\services\Request();
        $controllerName = $request->getControllerName() ?: $this->config['defaultController'];

        $controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";
//end url


        if(class_exists($controllerClass)) {
            $renderer = new \app\services\TwigRenderServices();
            /** @var \app\controllers\MainController $controller */
            $controller = new $controllerClass($renderer, $request, $this->container);
            echo $controller->run($request->getActionName());
        }else {
            echo "<h1>Else. controllerClass:</h1>";
            var_dump($controllerClass);

        }
    }
}