<?php

use App\Models\QueryPrivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
  $userId  = $jsonData['userId'];
  $pivQuery = QueryPrivot::where('query_id', '=', $queryId)->where('user_id', $userId)->first();
  if ($pivQuery) {
    $pivQuery->query_pivot  = $output;
    $pivQuery->save();
  } else {
    $qpvt = new QueryPrivot();
    $qpvt->query_pivot = $output;
    $qpvt->user_id = $userId;
    $qpvt->query_id = $queryId;
    $qpvt->save();
  }
  return response()->json(['msg' => "Ok"]);
});

