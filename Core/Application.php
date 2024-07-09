<?php

namespace Core;

class Application
{
    public string $appPath;

    public function __construct($appPath)
    {
        $this->appPath = $appPath;
        $this->autoClassesRegister();
    }

    public function autoClassesRegister()
    {
        spl_autoload_register(function ($class) {
            $file = $class.".php";
            require $this->appPath ."\\". $file;
        });

        require $this->appPath . "/routes/web.php";
    }
}
