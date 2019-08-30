<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'ресторан',
            'магазин',
            'кинотеатр',
            'кафе',
        ];

        $i = 0;

        foreach ($types as $type) {
            $type = new Type(['name' => $type]);
            $type->save();
            $i++;
        }
    }
}
