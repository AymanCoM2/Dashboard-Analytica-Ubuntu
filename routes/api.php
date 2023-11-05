<?php

use App\Models\QueryOfReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('/save-pivot', function (Request $request) {
  $jsonData = $request->json()->all();
  $fileContent = $jsonData['fileContent'];
  $lines = explode("\n", $fileContent);
  $skip_imports = false;
  $indent_level = 1;
  $output = '';
  foreach ($lines as $line) {
    $trimmed_line = trim($line);
    if (preg_match('/^(from|import)\s/i', $trimmed_line)) {
      $output .= $line . "\n";
      $skip_imports = true;
    } elseif ($skip_imports) {
      $output .= "def renderAlsoPivot(dataFrame):\n";
      $skip_imports = false;
    } else {
      $output .= str_repeat("\t", $indent_level) . $line . "\n";
    }
  }
  $output .= "renderAlsoPivot(dataFrame)\n";
  $queryId  = $jsonData['queryId'];
  $pivQuery = QueryOfReport::where('id', '=', $queryId)->first();
  if ($pivQuery) {
    $pivQuery->query_pivot  = $output;
    $pivQuery->save();
  }
  return response()->json(['msg' => "Ok"]);
});
