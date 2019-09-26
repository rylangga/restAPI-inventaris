<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$inventaris = new Inventaris($db);
 
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->inventarisir) &&
    !empty($data->peminjaman) &&
    !empty($data->pengembalian) &&
    !empty($data->generate_laporan)
){
 
    $inventaris->inventarisir = $data->inventarisir;
    $inventaris->peminjaman = $data->peminjaman;
    $inventaris->pengembalian = $data->pengembalian;
    $inventaris->generate_laporan = $data->generate_laporan;
 
    if($inventaris->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Berhasil Menambahkan Catatan"));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message" => "Gagal Membuat Catatan"));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message" => "Data Kurang Lengkap"));
}
?>