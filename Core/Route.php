<?php

namespace Core;

use App\Controller\BaseController;

use Core\Request;
use Exception;

class Route
{
    use RouteValidation;
    //mappingArray contain [TargetClass,handler]
    public static function Get(string $url, array $mappingArray)
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] != "GET") {
                http_response_code(405);
                throw new Exception("Method not allowed");
            }
            if (!self::isValidMapppingArray($mappingArray)) {
                //todo: handle err throw exception or do some thing later
            }
            $targetClass = $mappingArray[0];
            $handlerFunc = $mappingArray[1]; //function
            $targetClassIntance = new $targetClass;

            if (!method_exists($targetClassIntance, $handlerFunc)) {
                //todo:  throw method not found exception
            }

            $request = new Request();
            $html = $targetClassIntance->$handlerFunc($request);
            //Render html
            Render::Html($html);
        } catch (\Exception $e) {
            //todo: handle exceptions
        }
    }
}

trait RouteValidation
{
    protected static function isValidMapppingArray(array $array): bool
    {
        if (count($array) < 2) {
            return false;
        }

        //ensure the passed class is extending the base class
        // $class = $array[0];
        // if(($class,BaseController)){
        // }

        return true;
    }
}
