<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Setting;
use App\Models\Alumno;
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
        $alumno = Alumno::create([
            'ci' => '0999999999',
            'nombre' => 'Consumidor Final',
            'fecha_nacimiento' => '2000-01-01',
            'colegio' => 'Ninguno',
            'genero' => 'X',
        ]);

        $customer = Customer::create([
            'alumno_id' => $alumno->id,
            'businame' => 'Carlos Perez',
            'typeidenti' => 'ci',
            'valueidenti' => '0999999999',
            'address' => 'dirección',
            'address' => 'dirección',
            'email' => 'final@mail',
            'phone' => '999999',
            'notes' => 'consumidor final por defecto'
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
