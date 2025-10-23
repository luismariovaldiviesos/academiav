{{-- FORM (sin datos) + métodos Livewire con dd() --}}
<div x-data="{ tab: 'perfil' }" class="content space-y-5">
    {{-- BARRA DE PESTAÑAS --}}
    <div class="intro-y box p-4">
        <div class="flex flex-wrap gap-2">
            <button class="btn" :class="{ 'btn-primary': tab==='perfil' }"  @click="tab='perfil'">Perfil</button>
            <button class="btn" :class="{ 'btn-primary': tab==='ficha' }"   @click="tab='ficha'">Ficha deportiva</button>
            <button class="btn" :class="{ 'btn-primary': tab==='lesiones' }"@click="tab='lesiones'">Lesiones</button>
            <button class="btn" :class="{ 'btn-primary': tab==='rep' }"     @click="tab='rep'">Representante</button>
            <button class="btn" :class="{ 'btn-primary': tab==='matri' }"   @click="tab='matri'">Matrícula</button>
            <button class="btn" :class="{ 'btn-primary': tab==='fin' }"     @click="tab='fin'">Finanzas</button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 items-start">
        {{-- IZQUIERDA: CONTENIDO TABS --}}
        <div class="col-span-12 xl:col-span-8 space-y-5">

            {{-- PERFIL --}}
            <div class="intro-y box" x-show="tab==='perfil'" x-cloak>
                <div class="p-5 grid grid-cols-12 gap-4">
                    {{-- Campos simulados --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">CI</label>
                        <input type="text" class="form-control" placeholder="CI del alumno">
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre del alumno">
                    </div>
                    {{-- ... más campos ... --}}
                    <div class="col-span-12">
                        <button class="btn btn-primary" wire:click="savePerfil">Guardar</button>
                    </div>
                </div>
            </div>

            {{-- FICHA DEPORTIVA --}}
            <div class="intro-y box" x-show="tab==='ficha'" x-cloak>
                <div class="p-5 grid grid-cols-12 gap-4">
                    {{-- Campos simulados --}}
                    <div class="col-span-12 md:col-span-4">
                        <label class="form-label">Talla camiseta</label>
                        <input type="text" class="form-control" placeholder="S / M / L / ...">
                    </div>
                    {{-- ... más campos ... --}}
                    <div class="col-span-12">
                        <button class="btn btn-primary" wire:click="saveFicha">Guardar</button>
                    </div>
                </div>
            </div>

            {{-- LESIONES --}}
            <div class="intro-y box" x-show="tab==='lesiones'" x-cloak>
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-medium">Lesiones</h3>
                        <button class="btn btn-primary" wire:click="addLesion">Agregar lesión</button>
                    </div>
                    {{-- Tabla simulada --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>Fecha</th><th>Lesión</th><th>Estado</th><th>Acciones</th></tr></thead>
                            <tbody>
                                <tr>
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
                                {{-- Aquí iterarás lesiones --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- REPRESENTANTE --}}
            <div class="intro-y box" x-show="tab==='rep'" x-cloak>
                <div class="p-5 grid grid-cols-12 gap-4">
                    {{-- Campos simulados --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">Nombre representante</label>
                        <input type="text" class="form-control" placeholder="Nombre completo">
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="correo@ejemplo.com">
                    </div>
                    {{-- ... más campos ... --}}
                    <div class="col-span-12">
                        <button class="btn btn-primary" wire:click="saveRepresentante">Guardar</button>
                    </div>
                </div>
            </div>

            {{-- MATRÍCULA --}}
            <div class="intro-y box" x-show="tab==='matri'" x-cloak>
                <div class="p-5 grid grid-cols-12 gap-4">
                    {{-- Campos simulados --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">Categoría</label>
                        <select class="form-select">
                            <option>Seleccione…</option>
                        </select>
                    </div>
                    {{-- ... más campos ... --}}
                    <div class="col-span-12">
                        <button class="btn btn-primary" wire:click="saveMatricula">Guardar matrícula</button>
                    </div>
                </div>
            </div>

            {{-- FINANZAS --}}
            <div class="intro-y box" x-show="tab==='fin'" x-cloak>
                <div class="p-5 space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-medium">Finanzas</h3>
                        <div class="flex gap-2">
                            <button class="btn btn-outline-primary" wire:click="registrarPago">Registrar pago</button>
                            <button class="btn btn-outline-secondary" wire:click="generarCuotaMes">Generar cuota</button>
                        </div>
                    </div>
                    {{-- tablas simuladas --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>Periodo</th><th>Debido</th><th>Aplicado</th><th>Saldo</th><th>Estado</th></tr></thead>
                            <tbody><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- DERECHA: FOTO + RESUMEN --}}
        <aside class="col-span-12 xl:col-span-4">
            <div class="intro-y box xl:sticky xl:top-20">
                <div class="p-5 border-b">
                    <h3 class="font-medium">Resumen del estudiante</h3>
                </div>
                <div class="p-5 space-y-5">
                    {{-- FOTO (placeholder) --}}
                    <div class="mx-auto max-w-[260px]">
                        <div class="bg-slate-100 rounded-md overflow-hidden">
                            <div class="flex items-center justify-center aspect-[3/4] text-slate-400">
                                Sin foto {{-- aquí va <img ...> --}}
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Actualizar foto</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>

                    {{-- RESUMEN (placeholder) --}}
                    <div class="text-sm space-y-2">
                        <div class="flex justify-between"><span class="text-slate-500">Nombre:</span><span class="font-medium text-right">--</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">CI:</span><span class="font-medium text-right">--</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Nacimiento:</span><span class="font-medium text-right">--</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Categoría:</span><span class="font-medium text-right">--</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Estado matrícula:</span><span class="font-medium text-right">--</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Costo mensual:</span><span class="font-medium text-right">--</span></div>
                    </div>

                    <div class="pt-3 border-t flex gap-2">
                        <button class="btn btn-outline-primary btn-sm" wire:click="generarCuotaMes">Generar cuota</button>
                        <button class="btn btn-outline-secondary btn-sm" @click="tab='fin'">Ir a finanzas</button>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
