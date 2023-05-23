
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="d-flex flex-wrap p-6 text-gray-900">
                @foreach($bags as $bag)
                    <div class="card mr-1" style="width: 18rem;">
                        <img class="card-img-top" src="https://m.media-amazon.com/images/I/61zzJzljcKL._CR0,204,1224,1224_UX256.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$bag['name']}}</h5>
                            <h5 class="card-subtitle mb-2 text-muted">{{$bag['price']}} €</h5>
                            <p class="card-text">{{$bag['material']}}</p>
                            <form action="/bags" method="POST">
                                    @csrf
                                    <input type="hidden" name="bag_id" value="{{$bag['id']}}">
                                    <input type="hidden" name="bag_name" value="{{$bag['name']}}">
                                    <input type="hidden" name="bag_price" value="{{$bag['price']}}">
                                    <input type="hidden" name="bag_material" value="{{$bag['material']}}">
                                    <td><button class="btn btn-outline-primary" type="submit">Añadir carrito</button></td>
                                </form>
                        </div>
                    </div>
                    @endforeach           
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
