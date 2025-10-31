<div class="p-8 grid grid-cols-12 gap-6">
    {{-- Campos: datos camiseta, número, talla, estatura, peso, posición principal, otra posición, lateralidad --}}
    <div class="col-span-12 md:col-span-6">
        <label class="form-label text-base">Datos camiseta</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="Nombre impreso / detalles">
    </div>

    <div class="col-span-12 md:col-span-3">
        <label class="form-label text-base">Número camiseta</label>
        <input type="number" class="form-control h-12 text-lg" placeholder="10">
    </div>

    <div class="col-span-12 md:col-span-3">
        <label class="form-label text-base">Talla camiseta</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="S / M / L / XL">
    </div>

    <div class="col-span-12 md:col-span-6">
        <label class="form-label text-base">Posición principal</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="Delantero / Defensa / Volante / Arquero">
    </div>

    <div class="col-span-12 md:col-span-6">
        <label class="form-label text-base">Otra posición</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="Posición secundaria">
    </div>

    <div class="col-span-12 md:col-span-4">
        <label class="form-label text-base">Lateralidad</label>
        <select class="form-select h-12 text-lg">
            <option value="">Seleccione…</option>
            <option>Diestro</option>
            <option>Zurdo</option>
            <option>Ambidiestro</option>
        </select>
    </div>
    <div class="col-span-12 md:col-span-4">
        <label class="form-label text-base">Instituto anterior</label>
        <input type="text" step="0.01" class="form-control h-12 text-lg" placeholder="academia prueba">
    </div>

    <div class="col-span-12 md:col-span-4">
        <label class="form-label text-base">Años Jugando</label>
        <input type="text" step="0.1" class="form-control h-12 text-lg" placeholder="2 años">
    </div>

    <div class="col-span-12 flex justify-end">
        <button class="btn btn-primary text-lg px-8 py-2.5" wire:click="saveFicha">
            Guardar
        </button>
    </div>
</div>
