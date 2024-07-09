<?php

namespace Core;

class Request
{
    use RequestParamParser;

    public $vars;

    public function __construct()
    {
        $this->vars = [];
        $param = [];
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $param = $this->ParseGetParam();
            case "POST":
                $param = $this->ParsePostParam();
                if (count($param) == 0 && isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] == "application/json")
                    //possible json
                    $param =  $this->ParseJsonBody();
        };
        $this->vars = array_merge($this->vars, $param);
        var_dump($this->vars);
    }

    public function has(string $s): bool
    {
        return isset($this->vars[$s]);
    }

    public function all(): array
    {
        return $this->vars;
    }
}


trait RequestParamParser
{
    public function ParseGetParam(): array
    {
        return $_REQUEST;
    }

    public function ParsePostParam(): array
    {
        return $_REQUEST;
    }

    public function ParseJsonBody(): array
    {
        $requestBody = file_get_contents('php://input');
        // json_validate($requestBody) php 8.3 function
        $array = json_decode($requestBody, true);
        if (!json_last_error() == JSON_ERROR_NONE) {
            return [];
        }
        return $array;
    }
}
