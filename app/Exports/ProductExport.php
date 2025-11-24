<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::all()->map(function ($p) {
            return [
                $p->id,
                $p->item_code,
                $p->name,
                $p->category,
                $p->qty,
                $p->uom,
                $p->loc,
                $p->min_stock,
                $p->created_at->format('d-m-Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID','Item Code','Nama','Category','Qty',
            'UOM','Lokasi','Min Stock','Tanggal'
        ];
    }
}
