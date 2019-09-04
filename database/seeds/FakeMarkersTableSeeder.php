<?php

use App\Models\Marker;
use Illuminate\Database\Seeder;

class FakeMarkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Marker::class, 100)->create();
    }
}
