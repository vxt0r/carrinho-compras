<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index()
    {
        $products = Produto::paginate(4);
        $user = User::find(Auth::id());
        return view('home',['products'=>$products,'user'=> $user]);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate(Produto::rules(),Produto::feedback());

        if($request->hasFile('imagem')){
    
            $imageName = uniqid().'.'.$request->imagem->extension();
            
            $request->imagem->move(public_path('images'),$imageName);
            
            Produto::create([
                'nome' => $request->nome,
                'preco' => $request->preco,
                'imagem' => $imageName
            ]);
        }

        else{
            Produto::create([
                'nome' => $request->nome,
                'preco' => $request->preco,
            ]);
        }

        return redirect()->route('admin.index');
    }

    public function edit(string $id)
    {
        $product = Produto::find($id);
        return view('admin.edit',['product'=>$product]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate(Produto::rules(),Produto::feedback());

        $product = Produto::find($id);

        if($request->hasFile('imagem')){
            if($product->imagem === 'produto.png'){
                $imageName = uniqid().'.'.$request->imagem->extension();
                $request->imagem->move(public_path('images'),$imageName);
                $product->update([
                    'nome' => $request->nome,
                    'preco' => $request->preco,
                    'imagem' => $imageName
                ]);
                return redirect()->route('admin.index');
            }
            else{
                $request->imagem->move(public_path('images'),$product->imagem);
            }
        }
        
        $product->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        return redirect()->route('admin.index');
    }

    public function destroy(string $id)
    {
        $product = Produto::find($id);
        if($product->imagem !== 'produto.png'){

            $file = "images/$product->imagem";
            if(file_exists($file)){
                unlink($file);
            }
        }
        $product->delete();
        return redirect()->route('admin.index');
    }
}
