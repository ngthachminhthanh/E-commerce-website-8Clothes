<?php
include_once('ketnoi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $format = isset($_GET['format']) ? $_GET['format'] : '';
    $table = isset($_GET['table']) ? $_GET['table'] : '';

    switch ($format) {
        case 'csv':
            exportToCSV($table, $conn);
            break;
        case 'json':
            exportToJSON($table, $conn);
            break;
        case 'excel':
            // exportToExcel($table, $conn);
            break;
        default:
            echo 'Invalid format';
            break;
    }
} else {
    // Chức năng xuất khác nếu cần
}

function exportToCSV($table, $conn)
{
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=\"$table.csv\"");

    $output = fopen('php://output', 'w');

    $result = mysqli_query($conn, "SELECT * FROM $table LIMIT 1");
    $fields = mysqli_fetch_fields($result);

    $header = array();
    foreach ($fields as $field) {
        $header[] = $field->name;
    }

    fputcsv($output, $header);

    $result = mysqli_query($conn, "SELECT * FROM $table");

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }

    fclose($output);
}

function exportToJSON($table, $conn)
{
    header('Content-Type: application/json');
    header("Content-Disposition: attachment; filename=\"$table.json\"");

    // Lấy dữ liệu từ cơ sở dữ liệu và chuyển đổi thành mảng JSON
    $result = mysqli_query($conn, "SELECT * FROM $table");
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
}

function exportToExcel($table, $conn)
{
}
