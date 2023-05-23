<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class DashboardController extends Controller
{
    /**
     * Muestra todos los bolsos del catalogo des de la API
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
        return view('dashboard') ->with('bags',$bags);
    }

    /**
     * Recoge datos del formulario y crea un nuevo producto (bag) para el catalogo
     */
    public function create(Request $request)
    {
        $userID = Auth::id();
        
        $data = [
            'name' => $request->input('pname'),
            'price' => $request->input('pprice'),
            'material' => $request->input('pmaterial'),
            'user_id' => $userID 
        ];

        $response = Http::withToken('Bearer 3|Oo3J3nknCnGsjvP8vpwmdyN4WXtNjA1DF5BrZOi0')
        ->post('https://magical-lamarr.82-223-123-69.plesk.page/api/bags', $data);
        
        if ($response->successful()) {
            return back()->with('success', '¡Nueva Bag añadida al catálogo!');
        } else {
            return back()->with('error', 'Hubo un problema al enviar los datos.');
        }
    }

    public function update(Request $request, $id)
    {
        $id = $request->input('id');
        $userID = Auth::id();
        dd($request->all());
        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'material' => $request->input('material'),
            'user_id' => $userID 
        ];
        //dd($data);

        $response = Http::withToken('Bearer 3|Oo3J3nknCnGsjvP8vpwmdyN4WXtNjA1DF5BrZOi0')
        ->post('https://magical-lamarr.82-223-123-69.plesk.page/api/bags/'.$id,$data);

        
        if ($response->successful()) {
            return back()->with('success', '¡Bag actualizada en el catalogo!');
        } else {
            return back()->with('error', 'Hubo un problema al enviar los datos.');
        }
    }

    /**
     * Elimina por id el producto bag del catalogo haciendolo por API
     */
    public function destroy($id)
    {
        $client = new Client();
        $response = $client->delete('https://magical-lamarr.82-223-123-69.plesk.page/api/bags/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer 4|UWCOwItyfa7uVgfnNG7EIHC9L5oituLfHjEYAt3M',
                'Accept' => 'application/json',
            ],
        ]);

        return back()->with('success', 'Bag del catalogo BORRADO');
    }
}
