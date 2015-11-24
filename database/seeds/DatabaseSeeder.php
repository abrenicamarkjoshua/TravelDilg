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
        $this->call(usersTableSeeder::class);

        // $this->call(AccountTypeTableSeeder::class);
        // $this->call(RegionsTableSeeder::class);
        // $this->call(positionTableSeeder::class);
        // $this->call(statusCodeTableSeeder::class);
        // $this->call(attachedDocumentsTableSeeder::class);
        // $this->call(provincesTableSeeder::class);
        // $this->call(travelTypeTableSeeder::class);
        // $this->call(userAssignmentRegionalTableSeeder::class);
        // $this->call(userAssignmentProvincialTableSeeder::class);

        // $this->call(travelApplicationTableSeeder::class);
        Model::reguard();
    }
}
