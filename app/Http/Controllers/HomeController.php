<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoProdutos;
use App\Models\Produto;
use App\Models\User;
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
            $products = Produto::where('nome','LIKE','%'.$_GET['busca'].'%')->get();
        }
        else{
            $products = Produto::paginate(4);
        }

        $user = User::find(Auth::id());
        return view('home',['products'=>$products,'user'=> $user]);
    }

    public function cart()
    {
        $user_id = Auth::id();
        $cart = Carrinho::where('user_id',$user_id)->get();
        return view('user.cart',['cart'=>$cart[0]]);
    }

    public function addProduct()
    {
        
        $user_id = Auth::id();
        $cart = Carrinho::where('user_id',$user_id)->first();

        $product = CarrinhoProdutos::where('produto_id',$_POST['id'])->get();
    
        if(isset($product[0])){
            $new_quantity = (int)$product[0]->qtd + (int)$_POST['qtd'];
            $product[0]->update(['qtd'=> $new_quantity]);
        }
        else{
            CarrinhoProdutos::create([
                'produto_id' =>  $_POST['id'],
                'qtd' => $_POST['qtd'],
                'carrinho_id' => $cart->id
            ]);
        }
       
        return redirect()->route('carrinho');
    }

    public function removeProduct(string|int $id)
    {
        $product = CarrinhoProdutos::find($id);
        $product->delete();
        return redirect()->route('carrinho');
    }

    public function clearCart(string|int $id)
    {
        $products = CarrinhoProdutos::where('carrinho_id',$id);
        $products->delete(); 
        return redirect()->route('carrinho');
    }

    public function order()
    {
        session_start();
        if(isset($_SESSION['order']) && isset($_SESSION['cart'])){
            return view('user.order',[
               'order'=> $_SESSION['order'],
               'cart' => $_SESSION['cart'], 
            ]);
        }
       else {
            return redirect()->route('home');
       }
    }

    public function makeOrder(Request $request)
    {
        $user_id = Auth::id();
        session_start();
        $_SESSION['cart'] = Carrinho::where('user_id',$user_id)->get()[0];
        $_SESSION['order'] = $request->all();
        return redirect()->route('pedido');

    }

}
