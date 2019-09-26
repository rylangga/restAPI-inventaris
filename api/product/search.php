<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Inventaris($db);
 
$keywords=isset($_GET["cari"]) ? $_GET["cari"] : "";
 
$stmt = $product->search($keywords);
$num = $stmt->rowCount();
 
if($num>0){
 
    $products_arr=array();
    $products_arr["records"]=array();
 
    // fetch() lebih cepet daripada fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row untuk membuat $row['name']
        extract($row);
 
        $product_item=array(
            "id" => $id_admin,
            "inventarisir" => $inventarisir,
            "peminjaman" => $peminjaman,
            "pengembalian" => $pengembalian,
            "generate_laporan" => $generate_laporan
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    http_response_code(200);
    // menampilkan produk data
    echo json_encode($products_arr);
}
 
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "Laporan tidak ditemukan")
    );
}
?>