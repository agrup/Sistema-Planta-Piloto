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

         $datosPersona = [
            'nombres'=>'Juan pablo',
            'apellido'=>'jimenez',
            'telefono'=>'202323',
            'documento'=>'131465655',
            'tipo_documento'=>'DNI',
            'fecha_nac'=>'1998-05-06',
            'domicilio'=>'venstreet 849'
        ];
        $persona = Persona::create($datosPersona);

        $datosUser = [
            'name'=>'juan',
            'email'=>'brno_007@hotmail.com',
            'password'=> bcrypt('contraseña123456'),
            'persona_id'=>$persona->id,
        ];

        $user1 = User::create($datosUser);


        $rol = Role::create([
            'nombre'=>'administrador',
            'descripcion'=>'Rol administrador del sistema',
        ]);

        $user1->roles()->attach($rol->id);   	
       // $this->call(PersonaTableSeeder::class);
    }
}
