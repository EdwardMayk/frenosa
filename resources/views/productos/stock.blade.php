<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos con pico Stock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">                              
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th style="display: none;">Id</th>
                        <th class="border px-4 py-2">CÓDIGO</th>
                        <th class="border px-4 py-2">NOMBRE</th>
                        <th class="border px-4 py-2">SECCIÓN</th>
                        <th class="border px-4 py-2">MARCA</th>
                        <th class="border px-4 py-2">STOCK</th>
                        <th class="border px-4 py-2">IMAGEN</th>
                        <th class="border px-4 py-2">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    @if ($producto->stock < 11)
                    <tr>
                        <td style="display: none;">{{$producto->id}}</td>
                        <td>{{$producto->codigo}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->seccion}}</td>
                        <td>{{$producto->marca}}</td>
                        <td>{{$producto->stock}}</td>
                        <td>
                            <img src="/imagen/{{$producto->imagen}}" width="60%">
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center rounded-lg text-lg" role="group">
                                <!-- Editar -->
                                <a href="{{ route('productos.edit',$producto->id) }}" class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Editar</a>
                                <!-- Borrar -->
                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" class="formEliminar">
                                    @csrf 
                                    @method('DELETE')   
                                    <button type="submit" class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Borrar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>                  
            </table>

            </div>
                <div>
                    {!! $productos->links() !!}
                </div>            
        </div>
    </div>
</x-app-layout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        (function () {
    'use strict'
    //debemos crear la clase formEliminar dentro del form del boton borrar
    //recordar que cada registro a eliminar esta contenido en un form  
    var forms = document.querySelectorAll('.formEliminar')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {        
            event.preventDefault()
            event.stopPropagation()        
            Swal.fire({
                    title: '¿Confirma la eliminación del registro?',        
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#20c997',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                        Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.','success');
                    }
                })                      
        }, false)
        })
    })()
</script>