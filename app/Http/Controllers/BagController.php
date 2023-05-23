<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class BagController extends Controller
{
     /**
     * Muestra todos los bolsos del catalogo
     */
    public function index()
    {
        $client = new Client();
        $response = $client->get("https://magical-lamarr.82-223-123-69.plesk.page/api/bags",[
            'headers' => [
                'Authorization' => 'Bearer 4|UWCOwItyfa7uVgfnNG7EIHC9L5oituLfHjEYAt3M',
                'Accept' => 'application/json',        
            ]
        ]);
        $bags = json_decode($response->getBody(),true);
        return view('catalog') ->with('bags',$bags);

    }

    /**
     * Añade el producto en un carrito (session)
     */
    public function addProduct(Request $request)
    {
        $request->all();
        $bagId = $request->input('bag_id');
        $bagName = $request->input('bag_name');
        $bagPrice = $request->input('bag_price');
        $bagMaterial = $request->input('bag_material');

        $cart = Session::get('cart', []);
        $product = [
            'bag_id' => $bagId,
            'bag_name' => $bagName,
            'bag_price' => $bagPrice,
            'bag_material' => $bagMaterial,
        ];
        $cart[] = $product;
    
        Session::put('cart', $cart);
        $message = 'Bolso añadido al carrito';
        session()->flash('success', $message); //alert de carro añadido

        return back();
    }
        
        

    /**
     * Store a newly created resource in storage.
     */
    public function buy(Request $request)
    {
        $cart = Session::get('cart', []);
        // dd($carrito);
        $hora = now()->format('Y-m-d H:i:s');

        $history = $request->session()->get('history', []);
        // dd($historial);
        $history[] = [
            'carrito' => $cart,
            'hora' => $hora,
        ];
        $request->session()->put('history', $history);


        $request->session()->forget('cart');

        // return redirect()->route('historial')->with('success', 'Compra realizada con éxito');
        return back()->with('success', 'Todos los bolsos comprados');
    }

    /**
     * Muestra el historial de la compra que realizó el cliente
     */
    public function record(){
        $record = Session::get('record',[]);

        return view('record')->with('record',$record);
    }

    /**
     * BORRA el historial de la compra 
     */
    public function deleteRecord(Request $request)
    {
        $request->session()->forget('record');
        return back()->with('success', 'Se ha borrado todo tu historial de compra');
    }
}