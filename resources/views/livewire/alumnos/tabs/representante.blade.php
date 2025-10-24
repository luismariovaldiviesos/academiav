<div class="p-8 grid grid-cols-12 gap-6">
    {{-- nombre, tipo documento, ci-ruc, direccion, email, telefono, notas --}}
    <div class="col-span-12 md:col-span-6">
        <label class="form-label text-base">Nombre del representante</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="Nombre completo">
    </div>

    <div class="col-span-12 md:col-span-3">
        <label class="form-label text-base">Tipo documento</label>
        <select class="form-select h-12 text-lg">
            <option value="">Seleccione…</option>
            <option>CI</option>
            <option>RUC</option>
            <option>Pasaporte</option>
        </select>
    </div>

    <div class="col-span-12 md:col-span-3">
        <label class="form-label text-base">CI / RUC</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="Número de documento">
    </div>

    <div class="col-span-12">
        <label class="form-label text-base">Dirección</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="Calle, número, sector">
    </div>

    <div class="col-span-12 md:col-span-6">
        <label class="form-label text-base">Email</label>
        <input type="email" class="form-control h-12 text-lg" placeholder="correo@ejemplo.com">
    </div>

    <div class="col-span-12 md:col-span-6">
        <label class="form-label text-base">Teléfono</label>
        <input type="text" class="form-control h-12 text-lg" placeholder="09xxxxxxxx">
    </div>

    <div class="col-span-12">
        <label class="form-label text-base">Notas</label>
        <textarea class="form-control text-lg" rows="3" placeholder="Observaciones"></textarea>
    </div>

    <div class="col-span-12 flex justify-end">
        <button class="btn btn-primary text-lg px-8 py-2.5" wire:click="saveRepresentante">
            Guardar
        </button>
    </div>
</div>
