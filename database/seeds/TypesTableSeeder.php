<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('types');

        foreach ($types as $type) {
            $newType = new Type();

            $newType->name = $type;
            $newType->save();
        }
    }
}
