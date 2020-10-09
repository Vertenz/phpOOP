<?php


namespace app\controllers;


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

    public function __construct(RenderI $renderer, Request $request)
    {
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