<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create([
            'name'=>'Politics',
            'slug'=>Str::slug('Politics')
        ]);
        Topic::create([
            'name'=>'Religion',
            'slug'=>Str::slug('Religion')
        ]);
        Topic::create([
            'name'=>'Technology',
            'slug'=>Str::slug('Technology')
        ]);
        Topic::create([
            'name'=>'EducTation',
            'slug'=>Str::slug('Education')
        ]);
        Topic::create([
            'name'=>'Business',
            'slug'=>Str::slug('Business')
        ]);
    }
}
