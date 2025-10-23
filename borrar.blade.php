    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="intro-y col-span-12 lg:col-span-9">
            <h2 class="text-lg font-medium text-center text-theme-1 py-4">
                FICHA DEL ALUMNO
            </h2>
            <div class="post intro-y overflow-hidden box">
                <div class="post__tabs nav nav-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600" role="tablist">

                    <a wire:click="setTabActive('tabPerfil')"
                    title="Peerfil del Alumno"
                    data-toggle="tab"
                    data-target="#tabPerfil"
                    href="javascript:;"
                    class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabPerfil ? 'active' : '' }}"
                    id="content-tab"
                    role="tab" >
                    <i class="fas fa-list mr-2"></i>PERFIL
                    </a>

                    <a wire:click="setTabActive('tabFichaDep')"
                        title="Ficha Deportiva"
                        data-toggle="tab" data-target="#tabFichaDep"
                        href="javascript:;"
                        class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabFichaDep ? 'active' : '' }}"
                        id="meta-title-tab" role="tab" aria-selected="false">
                        <i class="fas fa-th-large mr-2"></i> FICHA DEPORTIVA
                    </a>

                    <a wire:click="setTabActive('tabLesiones')"
                    title="Lesiones del Alumno"
                    data-toggle="tab" data-target="#tabLesiones"
                    href="javascript:;"
                    class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabLesiones ? 'active' : '' }}"
                    id="meta-title-tab" role="tab" aria-selected="false">
                    <i class="fas fa-th-large mr-2"></i> LESIONES
                    </a>

                    <a wire:click="setTabActive('tabRepresentante')"
                    title="Representante del Alumno"
                    data-toggle="tab" data-target="#tabRepresentante"
                    href="javascript:;"
                    class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabRepresentante ? 'active' : '' }}"
                    id="meta-title-tab" role="tab" aria-selected="false">
                    <i class="fas fa-th-large mr-2"></i> REPRESENTANTE
                    </a>

                    <a wire:click="setTabActive('tabMatricula')"
                    title="Matricula del Alumno"
                    data-toggle="tab" data-target="#tabMatricula"
                    href="javascript:;"
                    class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabMatricula ? 'active' : '' }}"
                    id="meta-title-tab" role="tab" aria-selected="false">
                    <i class="fas fa-th-large mr-2"></i> MATRICULA
                    </a>
                    <a wire:click="setTabActive('tabFinanzas')"
                    title="Finanzas del Alumno"
                    data-toggle="tab" data-target="#tabFinanzas"
                    href="javascript:;"
                    class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center {{$tabFinanzas ? 'active' : '' }}"
                    id="meta-title-tab" role="tab" aria-selected="false">
                    <i class="fas fa-th-large mr-2"></i> FINANZAS
                </div>

                <div class="post__content tab-content">

                    <div id="tabPerfil" class="tab-pane {{$tabPerfil ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">
                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                    <h1>PERFIL</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div id="tabFichaDep" class="tab-pane  {{$tabFichaDep ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">
                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                 <h1>FICHA </h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tabLesiones" class="tab-pane  {{$tabLesiones ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">

                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                   LESIONES
                                </div>
                            </div>
                        </div>
                    </div>
                     <div id="tabRepresentante" class="tab-pane  {{$tabRepresentante ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">

                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                   REPRESENTANTE
                                </div>
                            </div>
                        </div>
                    </div>

                     <div id="tabMatricula" class="tab-pane  {{$tabMatricula ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">
                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                   MATRICULA
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tabFinanzas" class="tab-pane  {{$tabFinanzas ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">
                        <div class="p-5" id="striped-rows-table">
                            <div class="preview">
                                <div class="overflow-x-auto">
                                   FINANZAS
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-span-12 lg:col-span-3">
            <div class="intro-y box p-5">
                <div>
                    <h2 class="text-2xl text-center mb-3">foto estudiante</h2>
                </div>

                <div class="mt-3">
                    <h1 class="text-2x1 font-bold">info del estudiante</h1>
                    <h4 class="text-2x1"> resumen</h4>
                </div>
                <div class="mt-3">
                    <h1 class="text-2x1 font-bold">info del estudiante </h1>
                    <h4 class="text-2x1"> resumen </h4>
                </div>


            </div>
        </div>





    </div>
</div>


{{-- CODIGO ANTERIOR DE PESTAÑAS DEL ALUMNO  --}}
