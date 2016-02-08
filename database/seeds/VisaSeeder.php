<?php

use Illuminate\Database\Seeder;

class VisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visas')->truncate();
		
		DB::table('visas')->insert(array(
                'id' => 1,
                'name' => 'Business Multiple / 3 Months to 5 Years',
                'description' => '',
                'max_stay' => '30 days'
            ));

		DB::table('visas')->insert(array(
                'id' => 2,
                'name' => 'Business Multiple / 3 Months',
                'description' => '',
                'max_stay' => '30 days'
            ));		

		$this->command->info('Visas Added');
    }
}
