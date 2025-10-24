<div class="p-8 space-y-6">
    <div class="grid grid-cols-12 gap-6 items-end">
        {{-- fecha lesión (mes y año) --}}
        <div class="col-span-12 md:col-span-3">
            <label class="form-label text-base">Fecha de lesión</label>
            <input type="month" class="form-control h-12 text-lg">
        </div>

        {{-- lesión --}}
        <div class="col-span-12 md:col-span-3">
            <label class="form-label text-base">Lesión</label>
            <input type="text" class="form-control h-12 text-lg" placeholder="Esguince / Fractura / etc.">
        </div>

        {{-- parte afectada --}}
        <div class="col-span-12 md:col-span-3">
            <label class="form-label text-base">Parte afectada</label>
            <input type="text" class="form-control h-12 text-lg" placeholder="Rodilla / Tobillo / Hombro">
        </div>

        {{-- gravedad --}}
        <div class="col-span-12 md:col-span-3">
            <label class="form-label text-base">Gravedad</label>
            <select class="form-select h-12 text-lg">
                <option value="">Seleccione…</option>
                <option>Leve</option>
                <option>Moderada</option>
                <option>Grave</option>
            </select>
        </div>

        {{-- estado --}}
        <div class="col-span-12 md:col-span-3">
            <label class="form-label text-base">Estado</label>
            <select class="form-select h-12 text-lg">
                <option value="">Seleccione…</option>
                <option>Activa</option>
                <option>Alta</option>
                <option>En rehabilitación</option>
            </select>
        </div>

        {{-- notas --}}
        <div class="col-span-12 md:col-span-9">
            <label class="form-label text-base">Notas</label>
            <input type="text" class="form-control h-12 text-lg" placeholder="Observaciones / indicaciones médicas">
        </div>

        <div class="col-span-12 flex justify-end">
            <button class="btn btn-primary text-lg px-8 py-2.5" wire:click="addLesion">
                Agregar lesión
            </button>
        </div>
    </div>

    {{-- Listado de lesiones registradas (placeholder) --}}
    <div class="overflow-x-auto">
        <table class="table text-base">
            <thead>
                <tr><th>Fecha</th><th>Lesión</th><th>Parte afectada</th><th>Gravedad</th><th>Estado</th><th>Notas</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-slate-400">--</td>
                    <td class="text-slate-400">--</td>
                    <td class="text-slate-400">--</td>
                    <td class="text-slate-400">--</td>
                    <td class="text-slate-400">--</td>
                    <td class="text-slate-400">--</td>
                    <td>
                        <div class="flex gap-2">
                            <button class="btn btn-outline-primary btn-sm">Editar</button>
                            <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                        </div>
                    </td>
                </tr>
                {{-- DATA: @foreach lesiones ... @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
