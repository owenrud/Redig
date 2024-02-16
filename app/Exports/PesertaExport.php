<?php

namespace App\Exports;

use App\Models\peserta_event;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PesertaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @param int $eventId
     */
    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Customize the query to filter by ID_event
        return peserta_event::where('ID_event', $this->eventId)->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the column headings based on your model attributes
        return [
            'ID_peserta',
            'ID_event',
            'nama',
            'email',
            'gender',
            'type',
            'instansi',
            'nama_ruang',
            'no_meja',
            'kode_doorprize',
            'payment_url',
            'payment_status',
            'status_absen',
            'absen_oleh',
        ];
    }
}