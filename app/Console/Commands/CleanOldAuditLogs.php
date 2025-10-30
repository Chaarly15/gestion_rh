<?php

namespace App\Console\Commands;

use App\Models\AuditLog;
use Illuminate\Console\Command;

class CleanOldAuditLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-old-audit-logs {--days=90}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nettoyer les anciens logs d\'audit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        
        $deleted = AuditLog::where('created_at', '<', now()->subDays($days))->delete();

        $this->info("$deleted logs supprimés (plus de $days jours)");
    }
}
