<?php
// belum tau kegunaanya
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// memasukkan database dan product file
include_once '../config/database.php';
include_once '../objects/product.php';
 
// menginisiasi database
$database = new Database();
$db = $database->getConnection();
 
// memanggil class product pada file product.php
$inventaris = new Inventaris($db);
 
// kode membaca data inventaris
$stmt = $inventaris->read();
$num = $stmt->rowCount();
 
if($num > 0){
 
    // array
    $products_arr=array();
    $products_arr["Data"]=array();
 
    // fetch() lebih cepet daripada fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $product_item=array(
            "id"=>$id_admin,
            "inventarisir"=>$inventarisir,
            "peminjaman"=>$peminjaman,
            "pengembalian"=>$pengembalian,
            "generate_laporan"=>$generate_laporan
        );
 
        array_push($products_arr["Data"], $product_item);
    }
 
    http_response_code(200);
    echo json_encode($products_arr);
}
else{ 
  http_response_code(404);
  echo json_encode(
      array("message" => "tidak ada catatan")
  );
}
 