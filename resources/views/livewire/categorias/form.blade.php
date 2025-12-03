<div class="intro-y col-span-12">
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                {{ $componentName  }} | <span class="font-normal">{{ $action }}</span>
            </h2>
        </div>

        <div class="p-5 ">
            <div class="preview">

                <div class="mt-3">
                    <div class="sm:grid grid-cols-2 gap-5">
                        <div>
                            <label  class="form-label">NOMBRE</label>
                            <input wire:model='nombre' id="nombre" type="text" class="form-control form-control-lg border-start-0 kioskboard" maxlength="250">
                            @error('nombre')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>                     

                        <div>
                            <label  class="form-label">DESCRIPCION</label>
                            <input wire:model='descripcion' id="descripcion" type="text" data-kioskboard-type="numpad" class="form-control form-control-lg border-start-0 kioskboard" >
                            @error('descripcion')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div> 

                    </div>

                </div>

                <div class="mt-3">
                    <div class="sm:grid grid-cols-3 gap-5">
                        <div>
                            <label  class="form-label">EDAD MÍNIMA</label>
                            <input wire:model='edad_minima' id="edad_minima" type="number" class="form-control form-control-lg border-start-0 kioskboard" maxlength="250">
                            @error('edad_minima')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>

                        <div>
                            <label  class="form-label">EDAD MÁXIMA</label>
                            <input wire:model='edad_maxima' id="edad_maxima" type="number" data-kioskboard-type="numpad" class="form-control form-control-lg border-start-0 kioskboard" maxlength="250">
                            @error('edad_maxima')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>

                        <div>
                            <label  class="form-label">COSTO MENSUAL </label>
                            <input wire:model='costo_mensual' id="costo_mensual" type="number" class="form-control form-control-lg border-start-0 kioskboard" maxlength="250">
                            @error('costo_mensual')
                                <x-alert msg="{{ $message }}" />
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="mt-5">
                    <x-back />

                    <x-save />
                </div>

            </div>
        </div>

    </div>


    <script>

       KioskBoard.run('.kioskboard', {})

       document.querySelectorAll(".kioskboard").forEach(i => i.addEventListener("change", e =>{

            switch(e.currentTarget.id)
            {
                case 'businame':
                    @this.businame = e.target.value
                    break
                case 'valueidenti':
                    @this.valueidenti = e.target.value
                    break
                case 'address':
                    @this.address = e.target.value
                    break
                case 'email':
                    @this.email = e.target.value
                    break
                case 'phone':
                    @this.phone = e.target.value
                    brea
                case 'notes':
                    @this.notes = e.target.value
                    break
            }

       }))

    </script>

</div>




