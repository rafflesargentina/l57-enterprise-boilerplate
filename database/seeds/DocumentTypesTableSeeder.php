<?php

use Raffles\Models\DocumentType;

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'DNI', 'description' => 'Documento Nacional de Identidad', 'slug' => 'dni',
            ],
            [
                'id' => '99', 'name' => 'Otro', 'description' => 'Otro no listado', 'slug' => 'otro',
            ]
        ];

        foreach ($types as $type) {
            DocumentType::create($type);
        }
    }
}
