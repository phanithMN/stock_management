<?php

namespace App\Http\Controllers;

use App\Exports\ExportStock;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\ReportStock;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Stock;

class ReportStockController extends Controller
{
    public function ReportStock(Request $request) {
        $currentDate = Carbon::now()->toDateString(); 
        $rowLength = $request->query('row_length', 10);
        $search_value = $request->query("search");
        $date = $request->query('date', $currentDate);
        $categories = Category::all();
        $status = Status::all();
        $report_stocks = ReportStock::all();

        $stocks = Stock::join('categories', 'stocks.category_id', '=', 'categories.id') 
        ->join('status', 'stocks.status_id', '=', 'status.id') 
        ->select('stocks.*', 'categories.name as category_name', 'status.name as status_name')
        ->where('stocks.name', 'like', '%'.$request->input('search').'%')
        ->where('status.name', 'like', '%'.$request->query("status_name").'%')
        ->where('categories.name', 'like', '%'.$request->query("category").'%')
        ->whereDate('stocks.created_at', $date)
        ->paginate($rowLength);
        return view('page.report-stock.index', [
            'report_stocks'=>$report_stocks,
            'stocks'=>$stocks,
            'categories'=>$categories,
            'status'=>$status,
            'search_value'=>$search_value,
            'date'=>$date
        ]);
    }


    public function ExportCSV()
    {
        $filename = 'stock.csv';
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
    
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
    
            // Add CSV headers
            fputcsv($handle, [
                'ID',
                'Name',
                'Category',
                'Status',
                'Created At',
            ]);
    
            Stock::with(['category', 'status'])->chunk(25, function ($stocks) use ($handle) {
                foreach ($stocks as $stock) {
                    // Extract data from each stock along with the joined category and status.
                    $data = [
                        isset($stock->id) ? $stock->id : '',
                        isset($stock->name) ? $stock->name : '',
                        isset($stock->category->name) ? $stock->category->name : '', // Access category name
                        isset($stock->status->name) ? $stock->status->name : '',     // Access status name
                        isset($stock->created_at) ? $stock->created_at->format('Y-m-d') : '',
                    ];
            
                    // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });
    
            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }
}
