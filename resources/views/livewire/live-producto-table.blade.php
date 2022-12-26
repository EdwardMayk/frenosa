<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-nx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <!-- Buscador -->
                <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex text-gray-500">
                        <select wire:model="perPage" class="mr-2 rounded-md">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <input type="text" 
                            id="default-search" 
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="search"
                            placeholder="Buscar Nombre o Email">                    
                    </div>
                </div>
            <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            <!-- Boton agregar -->
            <a type="button" href="{{ route('productos.create') }}" class="bg-indigo-500 px-12 py-2 rounded text-gray-200 font-semibold hover:bg-indigo-800 transition duration-200 each-in-out">Agregar +</a>
            <!-- Tabla -->
            
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
                    @if(count($productos)<=0)
                        <tr>
                            <td colspan="7">No hay resultados</td>
                        </tr>
                    @endif
                    @foreach ($productos as $producto)
                    <tr>
                        <tds style="display: none;">{{$producto->id}}</td>
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
                                @can('usuario update')
                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" class="formEliminar">
                                    @csrf 
                                    @method('DELETE')   
                                    <button type="submit" class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Borrar</button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>                  
            </table>
            {{$productos->links()}}
            </div>
            </div>
        </div>
    </div>    
</div>
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
