<?php

namespace app\services;


class Request
{
    protected $requestStr;
    protected $controllerName = '';
    protected $actionName = '';
    protected $id = 0;
    protected $params = [
        'get' => [],
        'post' => []
    ];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->requestStr = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
        $this->fillParams();
    }

    protected function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if (preg_match_all($pattern, $this->requestStr, $matches)) {
            if (!empty($matches['controller'][0])) {
                $this->controllerName = $matches['controller'][0];
            }

            if (!empty($matches['action'][0])) {
                $this->actionName = $matches['action'][0];
            }
        }
    }

    protected function fillParams()
    {
        $this->params = [
            'get' => $_GET,
            'post' => $_POST
        ];
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    public function getId()
    {
        if (empty($this->params['get']['id'])) {
            return 0;
        }

        return (int)$this->params['get']['id'];
    }

    public function post($name) {
        return $_POST["$name"];
    }
}

class errorClass extends \Exception
{

    /**
     * errorClass constructor.
     */
    public function __construct($message = "", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->logMSG();
    }

    protected function logMSG()
    {
        $msg = parent::getMessage();
        echo $msg;
    }
}