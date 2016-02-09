<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('AdminSeeder');

        // Seed the states
        $this->call('StatesSeeder');
        $this->command->info('Seeded the states!');

        //Seed the countries
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');

        //Seed the services
        $this->call('ServicesSeeder');
        $this->command->info('Seeded the services!');

        //Seed the visas
        $this->call('VisaSeeder');
        $this->command->info('Seeded the visas!');

        //Seed the service_visas
        $this->call('ServiceVisaSeeder');
        $this->command->info('Seeded the service_visas!');


        Model::reguard();
    }
}
