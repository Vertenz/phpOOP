<?php
class User {
    public $name;
    public $password;

    public function __construct(string $name, string $password) {
        $this->name = (string) $name;
        $this->password = (string) $password;
    }
    public function seyHi () {
        echo "Hi $this->name <br>";
    }
};

class Admin extends User {
    protected $adminLevel;

        public function __construct(string $name, string $password, int $adminLevel) {
            $this->adminLevel = (int) $adminLevel;
            parent::__construct($name, $password);
        }
        public function seyHi()
        {
            echo parent::seyHi().$this->showAdmin();
        }
        private function showAdmin() {
            echo "<button>Admin</button>";
        }
}


$userAdmin = new Admin('Admin', 'admin', '0');
$userUsual = new User('Usual', 'user');

$userAdmin->seyHi();
$userUsual->seyHi();


//Задание 5 пример 1
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

$a1 = new A(); //создаст объекс на основе А
$a2 = new A(); //создаст объект на основе А
$a1->foo(); //вызывает Ф. Так как префикс инкримет, то увеличивает на 1 и отдает через echo 1
$a2->foo(); //отдает через echo 2, так как создана ссылка на х
$a1->foo(); //отдает через echo 3, так как создана ссылка на х
$a2->foo(); //отдает через echo 4, так как создана ссылка на х


//Задание 5 пример 2
class B
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class C extends B
{
}

$a1 = new B();
$b1 = new C();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

//выводит 1122, так же как и в первом примере, только теперь ссылки на переменные внутри объектов, то есть у каждого свой Х;

class D
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class F extends D
{
}

$a1 = new D;
$b1 = new F;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
//вроде тоже самые, но может что-то не понял