<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->command->warn('Running Fake Data seeders!');

        $this->call(TypesTableSeeder::class);
        $this->call(FakeMarkersTableSeeder::class);
        $this->call(FakeMarkerHasTypesTableSeeder::class);

        $this->command->info('Fake content seeded!');

        Model::reguard();
    }
}
