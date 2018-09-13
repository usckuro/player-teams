<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\Team', 30)->create()->each(function($model){
            factory('App\Models\Player', 15)->create(['team_id' => $model->id]);
        });
    }
}
