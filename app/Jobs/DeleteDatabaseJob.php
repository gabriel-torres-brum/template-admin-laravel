<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Stancl\Tenancy\Jobs\DeleteDatabase;

class DeleteDatabaseJob extends DeleteDatabase
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->databaseExists()) {
            parent::handle();
        }
    }

    private function databaseExists(): bool
    {
        $database = $this->tenant->database()->getName();

        return $this->tenant->database()->manager()
            ->databaseExists($database);
    }
}
