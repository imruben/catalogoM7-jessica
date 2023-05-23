<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Session::get('cart',[]);
        //dd($cart);
        return view('cart')->with('cart',$cart);
    }

    /**
     * All items added to cart proceed to be buyed and save at the record (historial).
     * Deletes Session Cart
     * Creates Sesson Record
     */
    public function buyAllBags(Request $request)
    {
        $cart = Session::get('cart', []);
        $time = now()->format('Y-m-d H:i:s');

        $record = $request->session()->get('record', []); //new
        // dd($record);
        $record[] = [
            'cart' => $cart,
            'time' => $time,
        ];
        $request->session()->put('record', $record);

        $request->session()->forget('cart');

        return back()->with('success', 'Compra realizada con exito. Yupiii!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $bag = Session::get('cart',[]);
        if(!$bag){
            return "bag no encontrada";
        }
     
        for($i= 0;$i <= count($bag);$i++){
            $bagId = $bag[$i]['bag_id'];
            if($bagId == $id){
                unset($bag[$i]);
                $bag = array_values($bag);
                Session::put('cart', $bag);
                break;
            }   
        }   
        return back()->with('success', 'Bag del cart borrada... snif🥺');
    }
}
