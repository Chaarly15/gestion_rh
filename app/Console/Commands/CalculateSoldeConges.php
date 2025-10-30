<?php

namespace App\Console\Commands;

use App\Models\Employe;
use App\Models\SoldeConge;
use Illuminate\Console\Command;

class CalculateSoldeConges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-solde-conges {--year=} {--employe=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculer le solde de congés pour tous les employés';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = $this->option('year') ?? now()->year;
        $employeId = $this->option('employe');

        $employes = $employeId 
            ? Employe::where('id_employe', $employeId)->get()
            : Employe::where('statut', 'Actif')->get();

        $bar = $this->output->createProgressBar($employes->count());
        $bar->start();

        foreach ($employes as $employe) {
            SoldeConge::calculerPourEmploye($employe, $year);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Soldes calculés avec succès pour ' . $employes->count() . ' employés');
    }
}
