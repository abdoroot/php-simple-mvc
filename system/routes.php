<?php

namespace System;

use App\Controller\BaseController;

class Route
{
    use RouteValidation;
    //mappingArray contain [TargetClass,handler]
    public static function Get(string $url,array $mappingArray)
    {
        try {
            if (!self::isValidMapppingArray($mappingArray)) {
                //todo: handle err throw exception or do some thing later
            }
            $targetClass = $mappingArray[0];
            $handlerFunc = $mappingArray[1]; //function
            $targetClassIntance = new $targetClass;
            //Render html
            $html = $targetClassIntance->$handlerFunc();
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
        // if(!instanceof($class,BaseController)){
        // }

        return true;
    }
}
