<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DropAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lumina:drop-all-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Confirm the action
        if (! $this->confirm('Are you sure you want to drop all tables?')) {
            return;
        }

        
        
        // Get all tables
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);
        $tables = implode('`, `', $tables);

        // Drop all tables
        DB::statement("DROP TABLE IF EXISTS `$tables`");

        

        $this->info('✅All tables dropped successfully.');
    }

    // private function dropDatabase($connectionName)
    // {
    //     $connection = DB::connection($connectionName);
    //     $databaseName = $connection->getDatabaseName();

    //     $connection->statement("DROP DATABASE IF EXISTS `$databaseName`");

    //     $this->info("Dropped database: $databaseName");
    // }
}
