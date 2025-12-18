<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;
use App\Models\Product;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Http\Response;

class ExportController extends Controller
{
    public function exportRequest()
    {
        $requests = ProductRequest::with('user', 'items.product')->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $headers = ['No', 'User', 'NPK/Nama', 'Barang', 'Jumlah', 'Note', 'Status', 'Tanggal Request'];
        $sheet->fromArray([$headers], null, 'A1');
        
        // Style header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
        ];
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);
        
        // Fill data
        $row = 2;
        foreach ($requests as $index => $req) {
            if ($req->items->count() > 0) {
                foreach ($req->items as $item) {
                    $sheet->setCellValue('A' . $row, $index + 1);
                    $sheet->setCellValue('B' . $row, $req->user->name ?? '-');
                    $sheet->setCellValue('C' . $row, $req->npk_nama ?? '-');
                    $sheet->setCellValue('D' . $row, $item->product->name ?? '-');
                    $sheet->setCellValue('E' . $row, $item->qty);
                    $sheet->setCellValue('F' . $row, $item->note ?? '-');
                    $sheet->setCellValue('G' . $row, ucfirst($req->status));
                    $sheet->setCellValue('H' . $row, $req->request_date ? \Carbon\Carbon::parse($req->request_date)->format('d-m-Y') : ($req->created_at->format('d-m-Y')));
                    $row++;
                }
            } else {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $req->user->name ?? '-');
                $sheet->setCellValue('C' . $row, $req->npk_nama ?? '-');
                $sheet->setCellValue('D' . $row, '-');
                $sheet->setCellValue('E' . $row, '-');
                $sheet->setCellValue('F' . $row, '-');
                $sheet->setCellValue('G' . $row, ucfirst($req->status));
                $sheet->setCellValue('H' . $row, $req->request_date ? \Carbon\Carbon::parse($req->request_date)->format('d-m-Y') : ($req->created_at->format('d-m-Y')));
                $row++;
            }
        }
        
        // Auto size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'request_report_' . date('Y-m-d_His') . '.xlsx';
        
        $response = new Response();
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        
        ob_start();
        $writer->save('php://output');
        $response->setContent(ob_get_clean());
        
        return $response;
    }

    public function exportProduct()
    {
        $products = Product::with('department')->get();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $headers = ['No', 'Item Code', 'Nama Barang', 'Category', 'Qty', 'UOM', 'Lokasi', 'Min Stock', 'Department', 'Tanggal'];
        $sheet->fromArray([$headers], null, 'A1');
        
        // Style header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
        ];
        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);
        
        // Fill data
        $row = 2;
        foreach ($products as $index => $product) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $product->item_code);
            $sheet->setCellValue('C' . $row, $product->name);
            $sheet->setCellValue('D' . $row, $product->category);
            $sheet->setCellValue('E' . $row, $product->qty);
            $sheet->setCellValue('F' . $row, $product->uom);
            $sheet->setCellValue('G' . $row, $product->loc);
            $sheet->setCellValue('H' . $row, $product->min_stock);
            $sheet->setCellValue('I' . $row, $product->department->name ?? '-');
            $sheet->setCellValue('J' . $row, $product->created_at->format('d-m-Y'));
            $row++;
        }
        
        // Auto size columns
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'product_stock_' . date('Y-m-d_His') . '.xlsx';
        
        $response = new Response();
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        
        ob_start();
        $writer->save('php://output');
        $response->setContent(ob_get_clean());
        
        return $response;
    }
}
