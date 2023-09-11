<?php

namespace App\Http\Controllers;

use App\Models\QueryOfReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryOfReportController extends Controller
{
    public function index()
    {
        // TODO Pagination 
        $allQueries = QueryOfReport::all();
        return view('pages.manage-queries.index', compact('allQueries'));
    }

    public function create()
    {
        return view('pages.manage-queries.create');
    } // DONE 

    public function store(Request $request)
    {
        // TODO data Validation 
        $newQuery = new QueryOfReport;
        $newQuery->query_title = $request->f_query_title;
        $newQuery->report_category_id = $request->f_report_category_id;
        // $newQuery->sql_query_string = nl2br($request->f_sql_query_string);
        $newQuery->sql_query_string = $request->f_sql_query_string;
        $newQuery->save();

        DB::insert('insert into roles_queries (role_id, query_id) values (?, ?)', [1, $newQuery->id]);
        // ^ after adding the New Query , Use DB Facade to store it For the Admin Role 

        return view('pages.manage-queries.index');
    } // DONE 

    public function view($id)
    {
        $singleQuery = QueryOfReport::find($id);
        return view('pages.manage-queries.view', compact('singleQuery'));
    }
    public function edit($id)
    {
        $singleQuery = QueryOfReport::find($id);
        return view('pages.manage-queries.edit', compact('singleQuery'));
    }
    public function update(Request $request, $id)
    {
        $updatedQuery = QueryOfReport::find($id);
        $updatedQuery->query_title = $request->f_query_title;
        $updatedQuery->report_category_id = $request->f_report_category_id;
        $updatedQuery->sql_query_string = $request->f_sql_query_string;
        $updatedQuery->save();
        toastr()->info('Updated and Ok !!');
        return redirect()->route('queries.manage.index');
    }
    public function delete(Request $request, $id)
    {
        $deletedQuery = QueryOfReport::find($id);
        $deletedQuery->delete();
        Toastr()->info('Query is Deleted Successfully');
        return redirect()->route('queries.manage.index');
    }
}
