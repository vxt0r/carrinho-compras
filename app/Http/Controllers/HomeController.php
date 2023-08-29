<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoProdutos;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function addProduct(Request $request)
    {
        
        $request->validate(['id' => 'numeric','qtd' => 'numeric|max:15']);
        $user_id = Auth::id();
        $cart = Carrinho::where('user_id',$user_id)->first();

        $product = CarrinhoProdutos::where('produto_id',$_POST['id'])->get();
        
    
        if(isset($product[0])){
            DB::table('carrinho_produtos')
                ->increment('qtd', $_POST['qtd'], ['id' => $product[0]->id]);
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
        if(Session::has('cart')){
            return view('user.order',[
                'order'=> Session::get('order'),
                'cart' => Session::get('cart'), 
            ]);
        }
       else {
            return redirect()->route('home');
       }
    }

    public function makeOrder(Request $request)
    {
        $user_id = Auth::id();
        $cart = Carrinho::where('user_id',$user_id)->get()[0];
        Session::put('cart',$cart);
        Session::put('order',$request->all());
        return redirect()->route('pedido');
    }

}
