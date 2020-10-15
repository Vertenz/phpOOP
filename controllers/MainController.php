<?php


namespace app\controllers;


use app\main\Container;
use app\services\RenderI;
use app\services\Request;

class MainController
{
    protected $pathsToViews = [__DIR__ . '/../views/',
    __DIR__ . '/../views/layouts'
    ];

    protected $path = __DIR__ . '/../views/';
    protected $actionDefault = 'all';

    /**
     * @var RenderServices
     */
    protected $renderer;
    /**
     * @var Request
     */
    protected $request;
/** @var Container  */
    protected $container;

    public function __construct(RenderI $renderer, Request $request, Container $container)
    {
        $this->container = $container;
        $this->renderer = $renderer;
        $this->request = $request;
    }


    public function run($action)
    {
        if (empty($action)) {
            $action = $this->actionDefault;
        }

        $action .= "Action";
        if (!method_exists($this, $action)) {
            return '404';
        }
        return $this->$action();
    }



    protected function getId()
    {
        return $this->request->getId();
    }
}