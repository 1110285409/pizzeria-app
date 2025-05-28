<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pizza;

class PizzaController extends Controller
{
    public function index()
    {
        return response()->json(Pizza::all(), 200);
    }
}
