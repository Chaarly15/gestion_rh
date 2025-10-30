<?php

namespace App\Exports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employe::with(['direction', 'grade', 'profil'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Matricule',
            'Nom',
            'Prénom',
            'Email',
            'Téléphone',
            'Date de Naissance',
            'Sexe',
            'Poste',
            'Direction',
            'Grade',
            'Profil',
            'Date d\'Embauche',
            'Type de Contrat',
            'Statut',
            'Salaire',
        ];
    }

    /**
     * @param Employe $employe
     * @return array
     */
    public function map($employe): array
    {
        return [
            $employe->matricule,
            $employe->nom,
            $employe->prenom,
            $employe->email,
            $employe->telephone,
            $employe->date_naissance?->format('d/m/Y'),
            $employe->sexe,
            $employe->poste,
            $employe->direction?->nom_direction,
            $employe->grade?->nom_grade,
            $employe->profil?->nom_profil,
            $employe->date_embauche?->format('d/m/Y'),
            $employe->type_contrat,
            $employe->statut,
            $employe->salaire ? number_format($employe->salaire, 2, ',', ' ') . ' €' : '',
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style pour la première ligne (en-têtes)
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true],
            ],
        ];
    }
}
