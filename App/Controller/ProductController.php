<?php

namespace App\Controller;

use Core\Request;

class ProductController extends BaseController
{
    //use request param later
    public function index(Request $request)
    {
        // Return html
        $input =  $request->all();
        $resp = 'Hello from ProductController index ';
        if ($request->has("id")) {
            $resp .= "id=".$input['id'];
        }
        return $resp;
    }
}
