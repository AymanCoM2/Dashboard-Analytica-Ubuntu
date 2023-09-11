<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportCategory;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportCategoryController extends Controller
{
    public function index()
    {
        // TODO Pagination 
        $allCategories = ReportCategory::all();
        return view('pages.manage-categories.index', compact('allCategories'));
    } // TODO

    public function create()
    {
        return view('pages.manage-categories.create');
    } // DONE 

    public function store(Request $request)
    {
        // TODO data Validation 
        // dd($request->f_category_name);
        $newReport = new ReportCategory;
        $newReport->category_name = $request->f_category_name;
        $newReport->save();
        return view('pages.manage-categories.index');
    } // DONE 

    public function view()
    {
    }
    public function edit()
    {
    }
    public function update(Request $request, $id)
    {
        // toastr()->info('Welcome back');
        // Toasster is Meaning Less Here , It needs A New View To Be  Returned 
        // A new View For Showing the Toaster 
        // Toastr()->info('ROROROR');
        // TODO 
        $updatedCategory  = ReportCategory::find($request->pk);
        $updatedCategory->category_name  = $request->value;
        $updatedCategory->save();
        return response()->json($request->value, 200);
    }
    public function delete(Request $request, $id)
    {
        $deletedCategory = ReportCategory::find($id);
        $deletedCategory->delete();
        Toastr()->info('Category is Deleted Successfull');
        return redirect()->route('categories.manage.index');
        // TODO with STatus For Toaster 
    }
}
