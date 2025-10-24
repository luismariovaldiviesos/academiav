<div class="intro-y box xl:sticky xl:top-24">
    <div class="p-6 border-b">
        <h3 class="text-lg font-medium">Resumen del estudiante</h3>
    </div>

    <div class="p-6 space-y-8">
        {{-- SOLO VISTA DE FOTO (sin input) --}}
        <div class="w-full">
            <div class="mx-auto max-w-[300px]">
                <div class="bg-slate-100 rounded-md overflow-hidden">
                    {{-- DATA: reemplaza el placeholder por la imagen real si existe --}}
                    <div class="flex items-center justify-center aspect-[3/4] text-slate-400 text-lg">
                        Foto
                    </div>
                </div>
            </div>
        </div>

        {{-- RESUMEN (placeholders) --}}
        <div class="text-base space-y-3">
            <div class="flex justify-between">
                <span class="text-slate-500">Nombre:</span>
                <span class="font-medium text-right">-- {{-- DATA --}}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">CI:</span>
                <span class="font-medium text-right">--</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Nacimiento:</span>
                <span class="font-medium text-right">--</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Categoría:</span>
                <span class="font-medium text-right">--</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Estado matrícula:</span>
                <span class="font-medium text-right">--</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Costo mensual:</span>
                <span class="font-medium text-right">--</span>
            </div>
        </div>
    </div>
</div>
