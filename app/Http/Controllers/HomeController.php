<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoProdutos;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(isset($_GET['busca'])){
            $produtos = $produtos = Produto::where('nome','LIKE','%'.$_GET['busca'].'%')->get();
        }
        else{
            $produtos = Produto::all();
        }

        return view('home',['produtos'=>$produtos]);
    }

    public function carrinho()
    {
        $user_id = Auth::id();
        $carrinho = Carrinho::where('user_id',$user_id)->get();
        return view('carrinho',['carrinho'=>$carrinho]);
    }

    public function adicionarProduto()
    {
        
        $user_id = Auth::id();
        $carrinho = Carrinho::where('user_id',$user_id)->first();

        $produto = CarrinhoProdutos::where('produto_id',$_POST['id'])->get();
    
        if(isset($produto[0])){
            $nova_quantidade = (int)$produto[0]->qtd + (int)$_POST['qtd'];
            $produto[0]->update(['qtd'=> $nova_quantidade]);
        }
        else{
            CarrinhoProdutos::create([
                'produto_id' =>  $_POST['id'],
                'qtd' => $_POST['qtd'],
                'carrinho_id' => $carrinho->id
            ]);
        }
       
        return redirect()->route('carrinho');
    }

    public function removerProduto(string|int $id)
    {

        $produto = CarrinhoProdutos::find($id);
        $produto->delete();
        return redirect()->route('carrinho');
    }

    public function limparCarrinho(string|int $id)
    {

        $produtos = CarrinhoProdutos::where('carrinho_id',$id);
        $produtos->delete(); 
        return redirect()->route('carrinho');
    }

    public function pedido(Request $request)
    {
        $user_id = Auth::id();
        $carrinho = Carrinho::where('user_id',$user_id)->get();
        return view('pedido',[
            'dados'=>$request->all(),
            'carrinho' => $carrinho
        ]);
    }

}
