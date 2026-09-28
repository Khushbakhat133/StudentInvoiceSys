<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Service;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create 10 Service records
        Service::factory(10)->create();

        // 2. Create 10 Students, each with an Invoice, and each Invoice with a Payment
        Student::factory(10)
            ->has(
                Invoice::factory()
                    ->has(Payment::factory())
            )
            ->create();
    }
}
