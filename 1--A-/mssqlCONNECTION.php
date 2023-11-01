<?php
    $serverName = "10.10.10.100";
    $databaseName = "LB"; // ! This is the One To Change 
    $uid = "ayman";
    $pwd = "admin@1234";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
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
