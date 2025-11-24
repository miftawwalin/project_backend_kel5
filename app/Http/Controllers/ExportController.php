<?php

namespace App\Http\Controllers;

use App\Exports\RequestExport;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportRequest()
    {
        return Excel::download(new RequestExport, 'request_report.xlsx');
    }

    public function exportProduct()
    {
        return Excel::download(new ProductExport, 'product_stock.xlsx');
    }
}
