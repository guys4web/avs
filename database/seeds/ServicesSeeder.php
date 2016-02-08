<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		DB::table('services')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
		DB::table('visas')->truncate();
		DB::table('service_visas')->truncate();
		// DB::table('carts')->truncate();
		// DB::table('cart_items')->truncate();

		DB::table('services')->insert(array(
                'id' => 1,
                'name' => 'Standard Service',
                'country_id' => 682,
                'min_process' => 10,
                'max_process' => 15
            ));

		DB::table('services')->insert(array(
                'id' => 2,
                'name' => 'Rush Service',
                'country_id' => 682,
                'min_process' => 5,
                'max_process' => 10
            ));

		DB::table('services')->insert(array(
                'id' => 3,
                'name' => 'Emergency Service',
                'country_id' => 682,
                'min_process' => 3,
                'max_process' => 5
            ));

		$this->command->info('Services Added');
	}
}
