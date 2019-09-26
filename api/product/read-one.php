<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Inventaris($db);
 
$product->id_admin = isset($_GET['id_admin']) ? $_GET['id_admin'] : false;
 
$product->readOne();
 
if($product->id_admin != null){
    $product_arr = array(
        "id"               => $product->id_admin,
        "inventarisir"     => $product->inventarisir,
        "peminjaman"       => $product->peminjaman,
        "pengembalian"     => $product->pengembalian,
        "generate_laporan" => $product->generate_laporan 
    );
 
    http_response_code(200);
    echo json_encode($product_arr);
}
 
else{
    http_response_code(404);
    echo json_encode(array("message" => "Laporan tidak ditemukan"));
}
?>