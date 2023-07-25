<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index()
    {
        $users = Product::all();
        
        
        return ($users);
    }

  

    public function create(Request $request)
    {
       // $request->user()->token();
        $user = Product::create([
            'name' => $request->name,
        ]);
        
       

        return ($user);  
    }  
}
