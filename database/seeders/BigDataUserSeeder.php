<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class BigDataUserSeeder extends Seeder
{
    public function run(): void
    {
        $totalUsers = 10000;
        $batchSize = 500;

        for ($createdUsers = 0; $createdUsers < $totalUsers; $createdUsers += $batchSize) {
            User::factory()
                ->count(min($batchSize, $totalUsers - $createdUsers))
                ->create();
        }
    }
}
