<?php

use App\Models\Marker;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FakeMarkerHasTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = Type::all()->pluck('id')->toArray();

        Marker::all()->each(function($marker, $key) use ($types){
            $marker->types()->attach(Arr::random($types, rand(1, count($types))));
        });
    }
}
