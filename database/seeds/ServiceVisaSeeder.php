<?php

use Illuminate\Database\Seeder;

class ServiceVisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_visas')->truncate(); // Using truncate function so all info will be cleared when re-seeding.


		DB::table('service_visas')->insert(array(
                'service_id' => 1,
                'visa_id' => 1,
                'price' => 200
            ));

		DB::table('service_visas')->insert(array(
                'service_id' => 1,
                'visa_id' => 2,
                'price' => 200
            ));

		DB::table('service_visas')->insert(array(
                'service_id' => 2,
                'visa_id' => 1,
                'price' => 400
            ));

		DB::table('service_visas')->insert(array(
                'service_id' => 2,
                'visa_id' => 2,
                'price' => 400
            ));

		$this->command->info('Services Added');
    }
}
