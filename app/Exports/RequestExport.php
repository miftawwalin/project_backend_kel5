<?php

namespace App\Exports;

use App\Models\ProductRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ProductRequest::with('user')
            ->get()
            ->map(function ($req) {
                return [
                    'ID'        => $req->id,
                    'User'      => $req->user->name ?? '-',
                    'Status'    => $req->status,
                    'Tanggal'   => $req->created_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'User', 'Status', 'Tanggal'];
    }
}
