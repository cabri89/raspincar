<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:cabri89.database.windows.net,1433; Database = raspincar", "cabri89", "cabri.du89");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "cabri89@cabri89", "pwd" => "cabri.du89", "Database" => "raspincar", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:cabri89.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
