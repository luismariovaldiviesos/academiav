<div class="p-8 grid grid-cols-12 gap-6">


    {{-- CAMPOS: ci, nombres, fecha nacimiento, colegio, genero --}}
    <div class="col-span-12 md:col-span-8 grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-6">
            <label class="form-label text-base">CI</label>
            <input type="text" class="form-control h-12 text-lg" placeholder="CI del alumno">
        </div>

        <div class="col-span-12 md:col-span-6">
            <label class="form-label text-base">Nombres</label>
            <input type="text" class="form-control h-12 text-lg" placeholder="Nombres completos">
        </div>

        <div class="col-span-12 md:col-span-6">
            <label class="form-label text-base">Fecha de nacimiento</label>
            <input type="date" class="form-control h-12 text-lg">
        </div>

        <div class="col-span-12 md:col-span-6">
            <label class="form-label text-base">Colegio</label>
            <input type="text" class="form-control h-12 text-lg" placeholder="Colegio">
        </div>

        <div class="col-span-12 md:col-span-6">
            <label class="form-label text-base">Género</label>
            <select class="form-select h-12 text-lg">
                <option value="">Seleccione…</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                <option value="X">Otro / Prefiere no decir</option>
            </select>
        </div>
           <div class="col-span-12 md:col-span-6">
            <label class="form-label text-base">Foto del alumno</label>
            <input type="file" class="form-control h-12 text-base">
         </div>
        <div class="col-span-12 flex justify-end">
            <button class="btn btn-primary text-lg px-8 py-2.5" wire:click="savePerfil">
                Guardar
            </button>
        </div>
    </div>
</div>
