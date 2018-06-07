<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\Role;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $datosPersona = [[
            'nombres'=>'Juan pablo',
            'apellido'=>'jimenez',
            'telefono'=>'202323',
            'documento'=>'131465655',
            'tipo_documento'=>'DNI',
            'fecha_nac'=>'1998-05-06',
            'domicilio'=>'venstreet 849'
            ],
            [
            'nombres'=>'Roberto Armando',
            'apellido'=>'perez',
            'telefono'=>'2323443344',
            'documento'=>'11465655',
            'tipo_documento'=>'DNI',
            'fecha_nac'=>'1998-05-06',
            'domicilio'=>'calle falsa 123'
            ],
            [
            'nombres'=>'Claudia Analia',
            'apellido'=>'Barreda',
            'telefono'=>'2322455344',
            'documento'=>'21465655',
            'tipo_documento'=>'DNI',
            'fecha_nac'=>'1998-05-06',
            'domicilio'=>'chapultepec y cuatemoc'
            ]
        ];

        //
        $persona0 = Persona::create($datosPersona[0]);
        $persona1 = Persona::create($datosPersona[1]);
        $persona2 = Persona::create($datosPersona[2]);
        $datosUser = [
        	[
            'name'=>'juan',
            'email'=>'brno_007@hotmail.com',
            'password'=> bcrypt('contraseña123456'),
            'persona_id'=>$persona0->id,
        	],
        	[
            'name'=>'Tito',
            'email'=>'tito@unlu.com',
            'password'=> bcrypt('zaq12wsx'),
            'persona_id'=>$persona1->id,        		
        	],
        	[
            'name'=>'Claudia',
            'email'=>'claudia@unlu.com',
            'password'=> bcrypt('123456'),
            'persona_id'=>$persona2->id,
        	],
        ];

       // 
        $user0 = User::create($datosUser[0]);
        $user1 = User::create($datosUser[1]);
        $user2 = User::create($datosUser[2]);

/*
        */
        $rol0 = Role::create([
            'nombre'=>'administrador',
            'descripcion'=>'Rol administrador del sistema',
        ]);
        $rol1 = Role::create([
            'nombre'=>'produccion',
            'descripcion'=>'Rol produccion de la planta',
        ]);
        $rol2 = Role::create([
            'nombre'=>'jefeProduccion',
            'descripcion'=>'Rol Jefe de Produccion de la planta',
        ]);

        //
        $user0->roles()->attach($rol0->id);
        $user1->roles()->attach($rol1->id); 
        $user2->roles()->attach($rol2->id);     	

        //$this->call(PersonaTableSeeder::class);
    }
}
