<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CrudController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function products()
    {
    	$data['data'] = Product::paginate(10);
    	dd($data);
    }
}
