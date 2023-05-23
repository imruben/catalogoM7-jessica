
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Compras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="d-flex flex-wrap p-6 text-gray-900">
                    <p>Aquí podrás apreciar las últimas compras que has realizado. ¡Recuerda que es mejor comprar todos los bolsos de una para no contaminar y cuidar el planeta!😁</p>
                    
                    @if(count($record)==0)
                        <p>El historial esta vacío</p><br>
                        <a href="/bags" class="btn btn-outline-primary" type="submit">Ir al catalogo</a>
                    @else
                    <table  class="table table-striped">
                        <thead>
                            <th scope="col"><h1>TU HISTORIAL DE COMPRA</h1></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio(€)</th>
                            <th scope="col">Material</th>
                        </thead>                   
                        <tbody>
                        @foreach($record as $key => $item)
                            @foreach($item["cart"] as $key => $bag)
                            <tr>
                                <td>{{$item["time"]}}</td>                         
                                <td>{{$bag['bag_name']}}</td>
                                <td>{{$bag['bag_price']}}</td>
                                <td>{{$bag['bag_material']}}</td>   
                            </tr>
                            @endforeach
                        @endforeach  
                        </tbody>
                    </table> 
                    <form method="POST" action="/delete" >
                        @csrf   
                        <button type="submit" class="btn btn-outline-danger btn-lg btn-block" >
                            BORRAR HISTORIAL
                        </button>
                    </form>       
                    @endif
                </div>
                </div>
                @if (session('success'))
                    <script>
                    alert("{{ session('success') }}");
                    </script>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
