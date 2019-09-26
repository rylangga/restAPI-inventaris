<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Inventaris($db);
 
// BELUM TAU KEGUNAANYA
$data = json_decode(file_get_contents("php://input"));

$product->id_admin = $data->id;
$product->inventarisir = $data->inventarisir;
$product->peminjaman = $data->peminjaman;
$product->pengembalian = $data->pengembalian;
$product->generate_laporan = $data->generate_laporan;
//  var_dump($product);

 if($product->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Laporan berhasil di Update"));
}
 
else{
    http_response_code(503);
    echo json_encode(array("message" => "Laporan gagal di Update"));
}
?>