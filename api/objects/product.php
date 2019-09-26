<?php
class Inventaris{
 
    // mengkoneksikan database ke table
    private $conn;
    public $table_name = "administrator";
 
    public $id_admin;
    public $inventarisir;
    public $peminjaman;
    public $pengembalian;
    public $generate_laporan;
 
    // mengkonstruksi $db sebagai database koneksi
    public function __construct($db){
        $this->conn = $db;
    }

    
    // READ FUNCTION
    function read(){

    // pilih query
    $query = "SELECT * FROM ". $this->table_name ." 
              ORDER BY id_admin DESC"; 
   
      $stmt = $this->conn->prepare($query);
   
      $stmt->execute();
   
      return $stmt;
  }


    // CREATE FUNCTION
    function create(){
  
        $query = "INSERT INTO
                " . $this->table_name . "
                SET
                inventarisir=:inventarisir, 
                peminjaman=:peminjaman, 
                pengembalian=:pengembalian, 
                generate_laporan=:generate_laporan";

        $stmt = $this->conn->prepare($query);

        $this->inventarisir=htmlspecialchars(strip_tags($this->inventarisir));
        $this->peminjaman=htmlspecialchars(strip_tags($this->peminjaman));
        $this->pengembalian=htmlspecialchars(strip_tags($this->pengembalian));
        $this->generate_laporan=htmlspecialchars(strip_tags($this->generate_laporan));

        $stmt->bindParam(":inventarisir", $this->inventarisir);
        $stmt->bindParam(":peminjaman", $this->peminjaman);
        $stmt->bindParam(":pengembalian", $this->pengembalian);
        $stmt->bindParam(":generate_laporan", $this->generate_laporan);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    // READ ONE FUNCTION
    function readOne(){
        $query = "SELECT * FROM ". $this->table_name ."
                WHERE administrator.id_admin = ?
                LIMIT 1
                "; 

        $stmt = $this->conn->prepare( $query );
    
        $stmt->bindParam(1, $this->id_admin);  
    
        // MENGAMBIL DATA PADA DATABASE
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // MENGAMBIL NILAI YG ADA DI DATABASE UNTUK DITAMPILKAN
        $this->inventarisir      = $row['inventarisir'];
        $this->peminjaman        = $row['peminjaman'];
        $this->pengembalian      = $row['pengembalian'];
        $this->generate_laporan  = $row['generate_laporan'];
    }


    // UPDATE FUNCTION
    function update(){
        $query = "UPDATE " . $this->table_name . "
                SET
                  inventarisir = :inventarisir,
                  peminjaman = :peminjaman,
                  pengembalian = :pengembalian,
                  generate_laporan = :generate_laporan
                WHERE
                  id_admin = :id";
     
        $stmt = $this->conn->prepare($query);
     
        /* SCRIPT_TAGS(), HTMLSPECIALCHARS() : 
          UNTUK MENGUBAH CODE UNIK SEPERTI &COPY; TIDAK DIEKSEKUSI */
        $this->inventarisir = htmlspecialchars(strip_tags($this->inventarisir));
        $this->peminjaman = htmlspecialchars(strip_tags($this->peminjaman));
        $this->pengembalian = htmlspecialchars(strip_tags($this->pengembalian));  
        $this->generate_laporan = htmlspecialchars(strip_tags($this->generate_laporan));
        $this->id_admin = htmlspecialchars(strip_tags($this->id_admin));
     
        $stmt->bindParam(':inventarisir', $this->inventarisir);
        $stmt->bindParam(':peminjaman', $this->peminjaman);
        $stmt->bindParam(':pengembalian', $this->pengembalian);
        $stmt->bindParam(':generate_laporan', $this->generate_laporan);
        $stmt->bindParam(':id', $this->id_admin);
     
        if($stmt->execute()){
            return true;
        }
        return false;
      }


    // DELETE FUNCTION
    function delete(){
    
        $query = "DELETE FROM " . $this->table_name . " WHERE id_admin = ?";
    
        $stmt = $this->conn->prepare($query);
    
        $this->id_admin=htmlspecialchars(strip_tags($this->id_admin));
    
        $stmt->bindParam(1, $this->id_admin);
    
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // SEARCH FUNCTION
    function search($keywords){
    
        // memangiil query
        $query = "SELECT * FROM ". $this->table_name ."
                  WHERE
                    id_admin LIKE ? OR inventarisir LIKE ? OR peminjaman LIKE ? 
                    OR pengembalian LIKE ?
                  ORDER BY
                    id_admin 
                  DESC
                  ";
    
        $stmt = $this->conn->prepare($query);
    
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        /* keyword sebagai string dan angka 1, 2, 3 sebagai parameter
           sesuai dengan berapa jumlah data yang kita pakai untuk pencaharian*/
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}