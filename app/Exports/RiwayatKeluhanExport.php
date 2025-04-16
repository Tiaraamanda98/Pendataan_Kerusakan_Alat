<?php

namespace App\Exports;

use App\Models\Klien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;

class RiwayatKeluhanExport implements FromCollection, WithHeadings, WithDrawings
{
    protected $start_date, $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        return Klien::whereBetween('tgl_keluhan', [$this->start_date, $this->end_date])
            ->select('id_tiket', 'klien', 'unit', 'keluhan', 'tgl_keluhan', 'deskripsi', 'jam', 'gambar', 'deskripsi_perbaikan', 'tgl_perbaikan', 'jam_perbaikan', 'gambar_perbaikan', 'status')
            ->get()
            ->map(function ($item) {
                // Menghitung durasi antara `tgl_keluhan jam` dan `tgl_perbaikan jam_perbaikan`
                if ($item->tgl_perbaikan && $item->jam_perbaikan) {
                    $start = Carbon::parse($item->tgl_keluhan . ' ' . $item->jam);
                    $end = Carbon::parse($item->tgl_perbaikan . ' ' . $item->jam_perbaikan);

                    $diff = $start->diff($end);
                    $item->durasi = "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                } else {
                    $item->durasi = '-';
                }

                // Menghapus 'post-images/' dari nama file gambar
                return [
                    'id_tiket'          => $item->id_tiket,
                    'klien'             => $item->klien,
                    'unit'              => $item->unit,
                    'keluhan'           => $item->keluhan,
                    'tgl_keluhan'       => $item->tgl_keluhan,
                    'deskripsi'         => $item->deskripsi,
                    'jam'               => $item->jam,
                    'gambar'            => str_replace('post-images/', '', $item->gambar),
                    'deskripsi_perbaikan' => $item->deskripsi_perbaikan,
                    'tgl_perbaikan'     => $item->tgl_perbaikan,
                    'jam_perbaikan'     => $item->jam_perbaikan,
                    'gambar_perbaikan'  => str_replace('post-images/', '', $item->gambar_perbaikan),
                    'durasi'            => $item->durasi,
                    'status'            => $item->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            "ID Tiket", "Klien", "Unit", "Keluhan", "Tanggal Keluhan", "Deskripsi", "Jam", 
            "Gambar Sebelum Perbaikan", "Deskripsi Perbaikan", "Tanggal Perbaikan", "Jam Perbaikan",
            "Gambar Setelah Perbaikan", "Durasi", "Status"
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $riwayat = Klien::whereBetween('tgl_keluhan', [$this->start_date, $this->end_date])
                        ->select('id_tiket', 'gambar', 'gambar_perbaikan')
                        ->get();

        foreach ($riwayat as $index => $item) {
            $row = $index + 2; // Baris Excel dimulai dari 2 (baris 1 adalah heading)

            // Path gambar di storage
            $gambarSebelum = storage_path('app/public/post-images/' . basename($item->gambar));
            $gambarSesudah = storage_path('app/public/post-images/' . basename($item->gambar_perbaikan));

            // Gambar Sebelum Perbaikan
            if ($item->gambar && file_exists($gambarSebelum)) {
                $drawing = new Drawing();
                $drawing->setName('Gambar Sebelum');
                $drawing->setDescription('Gambar Sebelum Perbaikan');
                $drawing->setPath($gambarSebelum);
                $drawing->setHeight(50);
                $drawing->setCoordinates('H' . $row);
                $drawings[] = $drawing;
            }

            // Gambar Setelah Perbaikan
            if ($item->gambar_perbaikan && file_exists($gambarSesudah)) {
                $drawing2 = new Drawing();
                $drawing2->setName('Gambar Sesudah');
                $drawing2->setDescription('Gambar Setelah Perbaikan');
                $drawing2->setPath($gambarSesudah);
                $drawing2->setHeight(50);
                $drawing2->setCoordinates('L' . $row);
                $drawings[] = $drawing2;
            }
        }

        return $drawings;
    }
}
