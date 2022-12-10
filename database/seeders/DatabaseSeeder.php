<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
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
//         \App\Models\User::factory(10)->create();
    $user = User::factory()->create([
        'name' => 'ali',
        'email' => 'ali@gmail.com'
    ]);
    Listing::factory(6)->create([
       'user_id' =>$user->id
    ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Listing::factory(12)->create();

     /*   Listing::create([
            'title' =>'My name is mohammed alhakmy i am programming website pages internet ',
            'tags' =>'programming website ',
            'company' => 'Any Name',
            'location' => 'Any location',
            'email' => 'Any@email.com',
            'website' => 'Any website',
            'description' => 'Any description',

        ]);

        Listing::create([
            'title' =>'My name is mohammed alhakmy i am programming website pages internet 00',
            'tags' =>'programming website 00',
            'company' => 'Any Name00',
            'location' => 'Any location00',
            'email' => 'Any@email.com00',
            'website' => 'Any website00',
            'description' => 'Any description00',
        ]);*/
    }
}
