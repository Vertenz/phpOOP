<?php


namespace app\main;

use app\repositories\ProductRepository;
use app\repositories\UsersRepository;
use app\repositories\VerificationRepository;
use app\services\DB;
use app\services\Session;
use app\services\TwigRenderServices;


/**
 *Class Container
 * @property ProductRepository productRepository;
 * @property DB db;
 * @property TwigRenderServices renderer
 * @property Session session
 * @property UsersRepository usersRepository
 * @property VerificationRepository verificationRepository
 */
class Container
{


    protected $components = [];
    protected $componentsData = [];

    /**
     * Container constructor.
     * @param array $componentsData
     */public function __construct(array $componentsData)
{
    $this->componentsData = $componentsData;
}



    public function __get($name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (!array_key_exists($name, $this->componentsData)) {
           throw new \Exception('Отсутсвует класс в компанентах '.$name);
        }

        $className = $this->componentsData[$name]['class'];

        if (!empty($this->componentsData[$name]['config'])) {
            $config = $this->componentsData[$name]['config'];
            $component = new $className($config);
        }else {
            $component = new $className();
        }

        if (method_exists($component, 'setContainer')) {
            $component->setContainer($this);
        }

        $this->components[$name] = $component;

        return $component;
    }
}