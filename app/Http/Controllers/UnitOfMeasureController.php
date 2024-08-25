<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UnitOfMeasure;

class UnitOfMeasureController extends Controller
{
    public function UnitOfMeasure(Request $request) {
        $unit_of_measures = UnitOfMeasure::all();

        return view('page.unit-of-measure.index', ['unit_of_measures'=>$unit_of_measures]);
    }

    public function Insert() {
        return view('page.unit-of-measure.insert');
    }

    public function InsertData(Request $request) {


        $unit_of_measures = new UnitOfMeasure();
        $unit_of_measures->unit = $request->input("unit");
        $unit_of_measures->price = $request->input("price");
       
        $unit_of_measures->save();

        return redirect()->route('unit-of-measure')->with('message', 'Unit of Measure Inserted Successfully');
    }

    // update 
    public function Update($id) {

        $unit_of_measure = UnitOfMeasure::find($id);

        return view('page.unit-of-measure.edit', ['unit_of_measures' => $unit_of_measure]);
    }

    public function DataUpdate(Request $request, $id) {

        $user = User::find($id);
        $user->name = $request->input("name");
        $user->username = $request->input("username");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        if($request->hasFile('image'))
        {
            $destination = 'uploads/users'. $user->image;
            if(User::exists($destination))
            {
                User::destroy($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.'.$extension;
            $file->move('uploads/users', $filename);
            $user->image = $filename;
            
        }
        $user->update();
        
        return redirect()->route('user')->with('message','User Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {   
            User::destroy($request->id);
            return redirect()->route('user');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
