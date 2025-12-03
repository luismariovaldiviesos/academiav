<div class="intro-y col-span-12">
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                {{ $componentName }} | <span class="font-normal">{{ $action }}</span>
            </h2>
        </div>

        <div class="p-5">
            <div class="preview">
                <!-- Primera fila de inputs -->
                <div class="mt-3">
                    <div class="sm:grid grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">NOMBRE</label>
                            <input wire:model='nombre' id="nombre" type="text" 
                                   class="w-full form-control form-control-lg border-start-0 kioskboard" 
                                   maxlength="250">
                            @error('nombre')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>                     

                        <div>
                            <label class="form-label">CEDULA</label>
                            <input wire:model='ci' id="ci" type="text" 
                                   data-kioskboard-type="numpad" 
                                   class="w-full form-control form-control-lg border-start-0 kioskboard" 
                                   maxlength="13">
                            @error('ci')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Segunda fila de inputs -->
                <div class="mt-5">
                    <div class="sm:grid grid-cols-3 gap-5">
                        <div>
                            <label class="form-label">TELÉFONO</label>
                            <input wire:model='telefono' id="telefono" type="text" 
                                   class="w-full form-control form-control-lg border-start-0 kioskboard" 
                                   maxlength="250">
                            @error('telefono')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">EMAIL</label>
                            <input wire:model='email' id="email" type="email" 
                                   class="w-full form-control form-control-lg border-start-0 kioskboard" 
                                   maxlength="250">
                            @error('email')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">NOTAS</label>
                            <input wire:model='notas' id="notas" type="text" 
                                   class="w-full form-control form-control-lg border-start-0 kioskboard" 
                                   maxlength="250">
                            @error('notas')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sección de Categorías al final -->
                <div class="mt-6">
                    <h5 class="form-label mb-4">CATEGORÍAS:</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($allCategorias as $categoria)
                            <div class="flex items-center p-3 border rounded-lg hover:bg-gray-50 dark:hover:bg-dark-1">
                                <input
                                    type="checkbox"
                                    wire:model="categoriasSeleccionadas"
                                    value="{{ $categoria->id }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    id="categoria-{{ $categoria->id }}"
                                >
                                <label for="categoria-{{ $categoria->id }}" 
                                       class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                                    {{ $categoria->nombre }} {{ $categoria->descripcion }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('categoriasSeleccionadas')
                        <x-alert msg="{{ $message }}" class="mt-2" />
                    @enderror
                </div>

                <!-- Botones -->
                <div class="mt-8 pt-4 border-t border-gray-200 dark:border-dark-5">
                    <div class="flex justify-between">
                        <x-back />
                        <x-save />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>