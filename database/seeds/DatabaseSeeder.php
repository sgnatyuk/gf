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

        // 0 - вс
        // 1 - пн
        // 2 - вт
        // 3 - ср
        // 4 - чт
        // 5 - пт
        // 6 - сб

        Tariff::updateOrCreate(
            ['name' => 'Fit'],
            [
                'name'          => 'Fit',
                'description'   => 'Тариф для тех, кто хочет похудеть',
                'price'         => 300,
                'disabled_days' => [0, 6],
            ]);

        Tariff::updateOrCreate(
            ['name' => 'Daily'],
            [
                'name'          => 'Daily',
                'description'   => 'Тариф для номального ежедневного питания',
                'price'         => 600,
                'disabled_days' => [],
            ]);

        Tariff::updateOrCreate(
            ['name' => 'Balance'],
            [
                'name'          => 'Balance',
                'description'   => 'Тариф для тех, кто хочет быть в форме',
                'price'         => 900,
                'disabled_days' => [0, 1, 6],
            ]);

        Tariff::updateOrCreate(
            ['name' => 'Power'],
            [
                'name'          => 'Power',
                'description'   => 'Тариф для набора массы',
                'price'         => 1200,
                'disabled_days' => [0, 2, 4, 6],
            ]);
    }
}
