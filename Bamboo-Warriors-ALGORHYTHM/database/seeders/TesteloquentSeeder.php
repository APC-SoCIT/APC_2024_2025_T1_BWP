<?php

namespace Database\Seeders;

use App\Models\TestEloquent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesteloquentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestEloquent::create([
            'name' => 'Juan Pedro',
            'age' => 18,
            'school' => 'APC',
        ]);

        TestEloquent::create([
            'name' => 'Jay Santos',
            'age' => 19,
            'school' => 'UST',
        ]);

        TestEloquent::create([
            'name' => 'Cardo Lim',
            'age' => 20,
            'school' => 'UE',
        ]);
    }
}
