<div>
    @if (!$form)
        <div class="intro-y col-span-12">
            <div class="intro-y box">
                <h2 class="text-lg font-medium text-center text-them-1 py-4">
                    {{ $componentName }}
                </h2>

                {{-- AQUI LLAMAMOS AL COMPONENTE SEARCH --}}
                <x-search />
                {{-- AQUI LLAMAMOS AL COMPONENTE SEARCH --}}

                <div class="p-5">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr class="text-theme-1">
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">NOMBRE</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">CEDULA/RUC</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">TELEFONO</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">CATEGORÍAS</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">EDADES</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($entrenadores as $entrenador)
                                        <tr class="dark:bg-dark-1 {{ $loop->index % 2 > 0 ? 'bg-gray-200' : '' }}">
                                            <td class="dark:border-dark-5">
                                                <h6 class="mb-1 font-medium">{{ $entrenador->nombre }}</h6>
                                            </td>
                                            <td class="dark:border-dark-5">
                                                <h6 class="mb-1 font-medium">{{ $entrenador->ci }}</h6>
                                            </td>
                                            <td class="dark:border-dark-5">
                                                <h6 class="mb-1 font-medium">{{ $entrenador->telefono }}</h6>
                                            </td>
                                            <td class="dark:border-dark-5">
                                                <div class="flex flex-col gap-1">
                                                    @foreach($entrenador->categorias as $categoria)
                                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">
                                                            {{ $categoria->nombre }}
                                                        </span>
                                                    @endforeach
                                                    @if($entrenador->categorias->count() == 0)
                                                        <span class="text-xs text-gray-500">Sin categorías</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="dark:border-dark-5">
                                                <div class="flex flex-col gap-1">
                                                    @foreach($entrenador->categorias as $categoria)
                                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">
                                                            {{ $categoria->descripcion }}
                                                        </span>
                                                    @endforeach
                                                    @if($entrenador->categorias->count() == 0)
                                                        <span class="text-xs text-gray-500">-</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="dark:border-dark-5 text-center">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-danger text-white border-0"
                                                        onclick="destroy('entrenadores','Destroy', {{ $entrenador->id }})"
                                                        type="button">
                                                        <i class="fas fa-trash f-2x"></i>
                                                    </button>
                                                    <button class="btn btn-warning text-white border-0 ml-3"
                                                        wire:click.prevent="Edit({{ $entrenador->id }})"
                                                        type="button">
                                                        <i class="fas fa-edit f-2x"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="bg-gray-200 dark:bg-dark-1">
                                            <td colspan="6">
                                                <h6 class="text-center">NO HAY ENTRENADORES</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 p-5">
                    {{ $entrenadores->links() }}
                </div>
            </div>
        </div>
    @else
        @include('livewire.entrenadores.form')
    @endif

    <script>
        document.addEventListener('click', (e) => {
            if(e.target.id == 'search'){
                KioskBoard.run('#search', {})

                document.getElementById('search').blur()
                document.getElementById('search').focus()

                const inputSearch = document.getElementById('search')
                inputSearch.addEventListener('change', (e) => {
                    @this.search = e.target.value
                })
            }
        })
    </script>
</div>