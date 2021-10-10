<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;

class ListarController extends Controller
{
    public function index(){

        $carros = Carro::all();

        return view('listar',['carros' => $carros]);

    }
}
