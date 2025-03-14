<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Upload;

class UploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Upload::factory()->count(3)->create();
    }
}
