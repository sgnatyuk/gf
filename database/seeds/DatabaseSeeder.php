<?php

use Illuminate\Database\Seeder;

use App\Models\Tariff;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Tariff::create([
            'name'        => 'Fit',
            'description' => 'Тариф для тех, кто хочет похудеть',
            'price'       => 300,
        ]);

        Tariff::create([
            'name'        => 'Daily',
            'description' => 'Тариф для номального ежедневного питания',
            'price'       => 600,
        ]);

        Tariff::create([
            'name'        => 'Balance',
            'description' => 'Тариф для тех, кто хочет быть в форме',
            'price'       => 900,
        ]);

        Tariff::create([
            'name'        => 'Power',
            'description' => 'Тариф для набора массы',
            'price'       => 1200,
        ]);
    }
}
