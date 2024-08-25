<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function Stock(Request $request) {
        $search_value = $request->query("search");
        $status = Status::all();
        $categories = Category::all();
        $rowLength = $request->query('row_length', 10);
        $stocks = DB::table('stocks')
        ->join('categories', 'stocks.category_id', '=', 'categories.id') 
        ->join('status', 'stocks.status_id', '=', 'status.id') 
        ->select('stocks.*', 'categories.name as category_name', 'status.name as status_name')
        ->where('stocks.name', 'like', '%'.$request->input('search').'%')
        ->where('status.name', 'like', '%'.$request->query("status_name").'%')
        ->where('categories.name', 'like', '%'.$request->query("category").'%')
        ->paginate($rowLength);
        return view('page.stocks.index', [
            'stocks'=>$stocks, 
            'search_value'=>$search_value,
            'status' => $status,
            'categories' => $categories
        ]);
    }

    public function Insert() {
        $categories = Category::all();
        $status = Status::all();
        return view('page.stocks.insert', 
        [
            'categories'=>$categories,
            'status'=>$status
        ]);
    }

    public function InsertData(Request $request) {
        $stocks = new Stock();
        $stocks->name = $request->input('name');
        $stocks->category_id = $request->input('category_id');
        $stocks->status_id = $request->input('status_id');

        $stocks->save();
        return redirect()->route('stock')->with('message', 'Role Inserted Successfully');
    }

    // update 
    public function Update($id) {
        $categories = Category::all();
        $status = Status::all();
        $stock = Stock::find($id);
        return view('page.stocks.edit', [
            'stock' => $stock, 
            'categories'=>$categories,
            'status'=>$status
        ]);
    }

    public function DataUpdate(Request $request, $id) {
        $stock = Stock::find($id);
        $stock->name = $request->input('name');
        $stock->category_id = $request->input('category_id');
        $stock->status_id = $request->input('status_id');
       
        $stock->update();
        
        return redirect()->route('stock')->with('message','Role Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {
            Stock::destroy($request->id);
            return redirect()->route('stock')->with('message','Delete Successfully');
        } catch(\Exception $e) {
            report($e);
        }
    }

    
}
