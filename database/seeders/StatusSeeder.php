<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        Status::query()->updateOrCreate([
            'id' => Status::OPEN,
        ], ['name' => 'OPEN']);

        Status::query()->updateOrCreate([
            'id' => Status::IN_PROGRESS,
        ], ['name' => 'IN_PROGRESS']);

        Status::query()->updateOrCreate([
            'id' => Status::COMPLETED,
        ], ['name' => 'COMPLETED']);

        Status::query()->updateOrCreate([
            'id' => Status::REJECTED,
        ], ['name' => 'REJECTED']);
    }
}
