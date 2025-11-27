<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Setting;
use App\Models\Alumno;
use App\Models\Categoria;
use App\Models\FichaDeportiva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InicialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

           $customer = Customer::create([
           'businame' => 'Carlos Perez',
            'typeidenti' => 'ci',
            'valueidenti' => '0999999999',
            'address' => 'dirección',
            'address' => 'dirección',
            'email' => 'final@mail',
            'phone' => '999999',
            'notes' => 'consumidor final por defecto'
        ]);

        $alumno = Alumno::create([
            'representante_id' => $customer->id,
            'ci' => '0999999999',
            'nombres' => 'Juan Perez',
            'fecha_nacimiento' => '2000-01-01',
            'colegio' => 'Colegio Nacional',
            'genero' => 'X',
        ]);

     

        $fichaDeportiva = FichaDeportiva::create([
            'alumno_id' => $alumno->id,
            'datos_camiseta' => 'Camiseta Oficial',
            'numero_camiseta' => 10,
            'talla_camiseta' => 'M',
            'posicion_principal' => 'Delantero',
            'otra_posicion' => 'Mediocampista',
            'lateralidad' => 'Diestro',
            'academia_anterior' => 'Escuela de Fútbol Local',
            'años_practica' => 5,
        ]);


        $categoria =  Categoria::create([
            'nombre' => 'Categoria Inicial',
            'descripcion' => 'Para niños de 4 a 6 años',
            'edad_minima' => 4,
            'edad_maxima' => 6,
            'costo_mensual' => 50.00,
            ]);

             $categoria =  Categoria::create([
            'nombre' => 'Categoria segunda',
            'descripcion' => 'Para niños de 6 a 8 años',
            'edad_minima' => 6,
            'edad_maxima' => 8,
            'costo_mensual' => 50.00,
            ]);





        Setting::create([
            'razonSocial' => 'ACADEMIA ANTONIO VALENCIA',
            'nombreComercial' => 'ACADEMIA ANTONIO VALENCIA',
            'ruc' => '0103844494001',
            'estab' => '001',
            'ptoEmi' => '001',
            'dirMatriz' => 'BAGUANCHI',
            'dirEstablecimiento' => 'BAGUANCHI',
            'telefono' => '0987308688',
            'email'=> 'khipusistemas@gmail.com',
            'ambiente' => '001',
            'tipoEmision' => '001',
            'contribuyenteEspecial' => 'revisar',
            'obligadoContabilidad' => 'NO',
            'logo' => 'noImage.jpg',
            'leyend' => 'Gracias por su compra',
            'printer' => 'epson',
        ]);
    }
}
