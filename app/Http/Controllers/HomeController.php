<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class HomeController extends Controller
{
    // produto na página inicial
    public function index()
    {
        $registros = Produto::where([
            'ativo' => 'S'
            ])->get();

        return view('home.index', compact('registros'));
    }

    // detalhe do produto
    public function produto($id = null)
    {
        if( !empty($id) ) {
            $registro = Produto::where([
                'id'    => $id,
                'ativo' => 'S'
                ])->first();

            if( !empty($registro) ) {
                return view('home.produto', compact('registro'));
            }
        }
        return redirect()->route('index');
    }
}
