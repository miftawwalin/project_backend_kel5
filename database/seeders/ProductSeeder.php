<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Department;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil department untuk mapping
        $departments = [
            'PPIC' => Department::where('name', 'PPIC')->first()?->id,
            'QC' => Department::where('name', 'QC')->first()?->id,
            'DIES SHOP' => Department::where('name', 'DIES SHOP')->first()?->id,
            'PRODUCTION' => Department::where('name', 'PRODUCTION')->first()?->id,
            'QA' => Department::where('name', 'QA')->first()?->id,
            'Maintenance' => Department::where('name', 'Maintenance')->first()?->id,
        ];

        // Data sesuai dengan Excel
        $products = [
            [
                'item_code' => 'SBM-007-001-0001105',
                'name' => 'ALMENT STRIP',
                'category' => 'Consumable / Material Packing',
                'qty' => 3,
                'stock' => 3,
                'min_stock' => 1,
                'loc' => 'D-1-4 (B.1)',
                'uom' => 'Lot',
                'department_id' => $departments['QC'],
            ],
            [
                'item_code' => 'SBM-007-001-0002239',
                'name' => 'CARBIDE TAPER BALLENDMILLR4X12X55X1X125L',
                'category' => 'Cutting Tool / Tooling',
                'qty' => 15,
                'stock' => 15,
                'min_stock' => 5,
                'loc' => '2-2-C',
                'uom' => 'Pcs',
                'department_id' => $departments['DIES SHOP'],
            ],
            [
                'item_code' => 'SBM-007-005-0000016',
                'name' => 'MITSUBISHI GOT GT2708-VTBA',
                'category' => 'Machine / Sparepart',
                'qty' => 1,
                'stock' => 1,
                'min_stock' => 0,
                'loc' => 'H-4-1 (E.1)',
                'uom' => 'Unit',
                'department_id' => $departments['Maintenance'],
            ],
            [
                'item_code' => 'SBM-008-002-0000004',
                'name' => 'LDEP BOX 98X85X88X0.06MM',
                'category' => 'Consumable / Material Packing',
                'qty' => 850,
                'stock' => 850,
                'min_stock' => 400,
                'loc' => 'WL-A1',
                'uom' => 'Pcs',
                'department_id' => $departments['PPIC'],
            ],
            [
                'item_code' => 'SBM-008-002-0000006',
                'name' => 'PE SHEET WITH SIZE 150X150X0.04MM',
                'category' => 'Consumable / Material Packing',
                'qty' => 0,
                'stock' => 0,
                'min_stock' => 500,
                'loc' => 'WL-A1',
                'uom' => 'Pcs',
                'department_id' => $departments['QC'],
            ],
            [
                'item_code' => 'SBM-008-007-0000001',
                'name' => 'TALI STRAPPING BAND 1 ROLL @ 8 KG',
                'category' => 'Consumable / Material Packing',
                'qty' => 6,
                'stock' => 6,
                'min_stock' => 3,
                'loc' => 'D-2-1 (A.1)',
                'uom' => 'ROLL',
                'department_id' => $departments['PPIC'],
            ],
            [
                'item_code' => 'SBM-008-034-0000001',
                'name' => 'KERANJANG SHOOT BLAST FORGING SUS 304',
                'category' => 'Maintenance / Cleaning Supplies',
                'qty' => 2,
                'stock' => 2,
                'min_stock' => 1,
                'loc' => 'E-3-1 (D.1)',
                'uom' => 'Unit',
                'department_id' => $departments['PRODUCTION'],
            ],
            [
                'item_code' => 'SBM-008-036-0000001',
                'name' => 'BOSELON 103 SHEET 0.08X2600X3300',
                'category' => 'Consumable / Material Packing',
                'qty' => 160,
                'stock' => 160,
                'min_stock' => 100,
                'loc' => 'WH-LAMA',
                'uom' => 'Pcs',
                'department_id' => $departments['PPIC'],
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['item_code' => $productData['item_code']],
                $productData
            );
        }
    }
}
