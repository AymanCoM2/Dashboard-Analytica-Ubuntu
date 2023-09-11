<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class DummyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $received_query = $request->que;
            $osInfo = php_uname();
            $firstWord = strtok($osInfo, ' ');
            if (strcasecmp($firstWord, 'Windows') === 0) {
                $data = DB::connection('sqlsrv')->select($received_query);
                $firstElement = $data[0];
                $allKeys = [];
                $tdContent = "";
                foreach ($firstElement as $key => $value) {
                    array_push($allKeys, $key);
                    $tdContent .= "<td>$key</td>";
                }
                return response()->json(['data' => $data, 'first' => $firstElement, 'keys' => $allKeys, 'row' => $tdContent]);
                // ! : This Will Take DB Credits From the ENV 
            } else {
                $serverName = "10.10.10.100";
                $databaseName = "LB";
                $uid = "ayman";
                $pwd = "admin@1234";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE => true,
                    "TrustServerCertificate" => true,
                ];
                $conn = new PDO("sqlsrv:server = $serverName; Database = $databaseName;", $uid, $pwd, $options);
                $stmt = $conn->query($received_query);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row; // Append each row to the $data array
                }
                $firstElement = $data[0];
                $allKeys = [];
                $tdContent = "";
                foreach ($firstElement as $key => $value) {
                    array_push($allKeys, $key);
                    $tdContent .= "<td>$key</td>";
                }
                return response()->json(['data' => $data, 'first' => $firstElement, 'keys' => $allKeys, 'row' => $tdContent]);
            }
        }
    }

    public function approveFirst()
    {
        return view('pages.approval');
    }
}
