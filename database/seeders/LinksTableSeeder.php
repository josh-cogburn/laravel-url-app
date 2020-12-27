<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // get all users
        $users = User::all();      
        
        // loop through each user
        foreach ($users as $user) {
            // determine how many tasks to create for the user
            $limit = random_int(10, 20);
            
            for ($i = 0; $i < $limit; $i++) {
                $link = Link::factory()->make();       
                
                // associate the task to the user
                $link->user()->associate($user);      
                
                // save the task
                $link->save();                
            }
            

        }        
    }
}
