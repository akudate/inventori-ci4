<?php

namespace App\Controllers;

class AppController extends BaseController{
    private $supplierModel;
    private $barangModel;
    private $barangmasukModel;
    private $barangkeluarModel;
    private $userModel;
    private $session;
    public function __construct(){
        $this->supplierModel = new \App\Models\Supplier();
        $this->barangModel = new \App\Models\Barang();
        $this->barangmasukModel = new \App\Models\Barang_Masuk();
        $this->barangkeluarModel = new \App\Models\Barang_Keluar();
        $this->userModel = new \App\Models\User();
        $this->session = \Config\Services::session();
        
        if($this->session->admin_id == null){
            $this->session->setFlashdata('pesan', 'Anda belum Login');
            header("location:".base_url('login'));
            exit();
        }
    }
    public function template(){
        return view("template");
    }
    public function dashboard(){
        if((session()->admin_role) == "admin"){
            $rows1 = $this->supplierModel
                ->countAllResults();
            $rows2 = $this->barangModel
                ->countAllResults();
            $rows3 = $this->barangmasukModel
                ->countAllResults();
            $rows4 = $this->barangkeluarModel
                ->countAllResults();
            $data = ([
                "rows1" => $rows1,
                "rows2" => $rows2,
                "rows3" => $rows3,
                "rows4" => $rows4,
            ]);
            return view("dashboard", $data);
        }else{
            $this->session->setFlashdata('supplier', 'Anda tidak memiliki akses');
            $rows = $this->supplierModel
                ->orderBy("supplierID","asc")
                ->findAll();
        
            $data = ([
                "rows" => $rows,
            ]);

            return view("data_supplier",$data);
        }
    }
    public function tambah_supplier(){
        if((session()->admin_role) == "admin"){
            return view("tambah_supplier");
        }else{
            $this->session->setFlashdata('supplier', 'Anda tidak memiliki akses');
            $rows = $this->supplierModel
                ->orderBy("supplierID","asc")
                ->findAll();
        
            $data = ([
                "rows" => $rows,
            ]);

            return view("data_supplier",$data);
        }
    }
    public function proses_tambah_supplier(){
        // Ambil Data dari Form
        $supplierID     = $this->request->getPost("supplierID");
        $supplierName   = $this->request->getPost("supplierName");
        $alamat         = $this->request->getPost("alamat");
        $telepon        = $this->request->getPost("telepon");

        $this->supplierModel->insert([
            "supplierID"     => $supplierID,
            "supplierName"   => $supplierName,
            "alamat"         => $alamat,
            "telepon"        => $telepon,
        ]);

        return redirect()->to(base_url("data_supplier"));
    }
    public function data_supplier(){
        $rows = $this->supplierModel
                ->orderBy("supplierID","asc")
                ->findAll();
        
        $data = ([
            "rows" => $rows,
        ]);

        return view("data_supplier",$data);
    }
    public function hapus_supplier($supplierID){
        $this->supplierModel->where("supplierID", $supplierID)->delete();
        return redirect()->to(base_url("data_supplier"));
    }
    public function edit_supplier($supplierID){
        $supplier = $this->supplierModel
                    ->where("supplierID", $supplierID)
                    ->first();

        $data = ([
            "supplier" => $supplier,
        ]);

        return view("edit_supplier",$data);
    }
    public function proses_edit_supplier(){
        // Ambil Data dari Form
        $supplierID        = $this->request->getPost("supplierID");
        $supplierName      = $this->request->getPost("supplierName");
        $alamat         = $this->request->getPost("alamat");
        $telepon  = $this->request->getPost("telepon");

            $this->supplierModel
            ->where("supplierID", $supplierID)
            ->set([
                "supplierID"    => $supplierID,
                "supplierName"  => $supplierName,
                "alamat"        => $alamat,
                "telepon"       => $telepon,
            ])->update();
        
        return redirect()->to(base_url('data_supplier'));
    }
    public function tambah_barang(){
        if((session()->admin_role) == "admin"){
            $rows = $this->supplierModel
                ->orderBy("supplierID", "asc")
                ->findAll();

            $data = ([
                "rows" => $rows,
            ]);

            return view("tambah_barang", $data);
        }else{
            $this->session->setFlashdata('barang', 'Anda tidak memiliki akses');
            $rows = $this->barangModel
                ->orderBy("productID","asc")
                ->findAll();
        
            $data = ([
                "rows" => $rows,
            ]);

            return view("data_barang",$data);
        }
    }
    public function proses_tambah_barang(){
        // Ambil Data dari Form
        $productID    = $this->request->getPost("productID");
        $productName  = $this->request->getPost("productName");
        $gambar       = $this->request->getFile("gambar");
        $supplierID   = $this->request->getPost("supplierID");
        $harga        = $this->request->getPost("harga");
        $stok         = $this->request->getPost("stok");

        $namaGambar   = $productID."_".$gambar->getRandomName();

        $gambar->move("assets/gambar/",$namaGambar);

        $this->barangModel->insert([
            "productID"    => $productID,
            "productName"  => $productName,
            "gambar"       => $namaGambar,
            "supplierID"   => $supplierID,
            "harga"        => $harga,
            "stok"         => $stok,
        ]);

        return redirect()->to(base_url("data_barang"));
    }
    public function data_barang(){
        $rows = $this->barangModel
                ->orderBy("productID","asc")
                ->findAll();
        
        $data = ([
            "rows" => $rows,
        ]);

        return view("data_barang",$data);
    }
    public function hapus_barang($productID){
        $this->barangModel->where("productID", $productID)->delete();
        return redirect()->to(base_url("data_barang"));
    }
    public function edit_barang($productID){
        $barang = $this->barangModel
                    ->where("productID", $productID)
                    ->first();

        $rows = $this->supplierModel
                ->orderBy("supplierID","asc")
                ->findAll();
    
        $data = ([
            "barang" => $barang,
            "rows" => $rows,
        ]);

        return view("edit_barang",$data);
    }
    public function proses_edit_barang(){
        // Ambil Data dari Form
        $productID     = $this->request->getPost("productID");
        $productName   = $this->request->getPost("productName");
        $supplierID    = $this->request->getPost("supplierID");
        $harga         = $this->request->getPost("harga");
        $stok          = $this->request->getPost("stok");

        if($this->request->getFile("gambar")->getName() != NULL ){
            $gambar     = $this->request->getFile("gambar");
            $namaGambar = $productID."_".$gambar->getRandomName();

            $gambar->move("assets/gambar/",$namaGambar);

            $this->barangModel
            ->where("productID", $productID)
            ->set([
                "productID"     => $productID,
                "productName"   => $productName,
                "gambar"        => $namaGambar,
                "supplierID"    => $supplierID,
                "harga"         => $harga,
                "stok"          => $stok,
            ])->update();
        }else{
            $this->barangModel
            ->where("productID", $productID)
            ->set([
                "productID"     => $productID,
                "productName"   => $productName,
                "supplierID"    => $supplierID,
                "harga"         => $harga,
                "stok"          => $stok,
            ])->update();
        }

        return redirect()->to(base_url('barang/'.$productID.'/edit'));
    }
    public function tambah_barangmasuk(){
        if((session()->admin_role) == "admin"){
            $rows = $this->barangModel
                ->orderBy("productID", "asc")
                ->findAll();

            $data = ([
                "rows" => $rows,
            ]);

            return view("tambah_barangmasuk", $data);
        }else{
            $this->session->setFlashdata('barangmasuk', 'Anda tidak memiliki akses');
            $rows = $this->barangmasukModel
                ->orderBy("transactionID","asc")
                ->findAll();
        
            $data = ([
                "rows" => $rows,
            ]);

            return view("data_barangmasuk",$data);
        }
    }
    public function proses_tambah_barangmasuk(){
        // Ambil Data dari Form
        $transactionID  = $this->request->getPost("transactionID");
        $tanggal        = $this->request->getPost("tanggal");
        $productID      = $this->request->getPost("productID");
        $jumlah_masuk   = $this->request->getPost("jumlah_masuk");

        $barang = $this->barangModel
        ->where("productID", $productID)
        ->first();

        if($jumlah_masuk <= 0){
            $this->session->setFlashdata('pesan', 'Masukkan jumlah masuk minimal 1');
            return redirect()->to(base_url("tambah_barangmasuk"));
        }else{
            $this->barangmasukModel->insert([
                "transactionID" => $transactionID,
                "tanggal" => $tanggal,
                "productID" => $productID,
                "jumlah_masuk" => $jumlah_masuk,
            ]);

            $this->barangModel
                ->where("productID", $productID)
                ->set([
                    "stok" => $barang->stok + $jumlah_masuk,
                ])->update();

            return redirect()->to(base_url("data_barangmasuk"));
        }
    }
    public function data_barangmasuk(){
        $rows = $this->barangmasukModel
                ->orderBy("transactionID","asc")
                ->findAll();
        
        $data = ([
            "rows" => $rows,
        ]);

        return view("data_barangmasuk",$data);
    }
    public function hapus_barangmasuk($transactionID,$productID,$jumlah_masuk){
        $barang = $this->barangModel
        ->where("productID", $productID)
        ->first();

        if($barang->stok - $jumlah_masuk < 0){
            $this->session->setFlashdata('pesan', 'Stok barang tidak mencukupi');
            return redirect()->to(base_url("data_barangmasuk"));            
        }else{
            $this->barangModel
                ->where("productID", $productID)
                ->set([
                    "stok"   => $barang->stok - $jumlah_masuk,
                ])->update();

            $this->barangmasukModel->where("transactionID", $transactionID)->delete();
            return redirect()->to(base_url("data_barangmasuk"));
        }
    }
    public function edit_barangmasuk($transactionID){
        $barang_masuk = $this->barangmasukModel
                    ->where("transactionID", $transactionID)
                    ->first();

        $rows = $this->barangModel
                ->orderBy("productID","asc")
                ->findAll();

        $data = ([
            "barang_masuk" => $barang_masuk,
            "rows"         => $rows,
        ]);

        return view("edit_barangmasuk",$data);
    }
    
    public function proses_edit_barangmasuk(){
        // Ambil Data dari Form
        $transactionID   = $this->request->getPost("transactionID");
        $tanggal         = $this->request->getPost("tanggal");
        $productID       = $this->request->getPost("productID");
        $jumlah_masuk    = $this->request->getPost("jumlah_masuk");

        $barang_masuk = $this->barangmasukModel
                    ->where("transactionID", $transactionID)
                    ->first();

        $barang = $this->barangModel
        ->where("productID", $productID)
        ->first();

        $barang2 = $this->barangModel
        ->where("productID", $barang_masuk->productID)
        ->first();

        if($barang->stok - $barang_masuk->jumlah_masuk + $jumlah_masuk < 0){
            $this->session->setFlashdata('pesan', 'Stok barang tidak mencukupi');
            return redirect()->to(base_url("data_barangmasuk"));
        }elseif($barang_masuk->productID == $productID){
            $this->barangmasukModel
                ->where("transactionID", $transactionID)
                ->set([
                    "transactionID" => $transactionID,
                    "tanggal" => $tanggal,
                    "productID" => $productID,
                    "jumlah_masuk" => $jumlah_masuk,
                ])->update();

            $this->barangModel
                ->where("productID", $productID)
                ->set([
                    "stok" => $barang->stok - $barang_masuk->jumlah_masuk + $jumlah_masuk,
                ])->update();

            return redirect()->to(base_url('data_barangmasuk'));
        }else{
            $this->barangmasukModel
                ->where("transactionID", $transactionID)
                ->set([
                    "transactionID" => $transactionID,
                    "tanggal" => $tanggal,
                    "productID" => $productID,
                    "jumlah_masuk" => $jumlah_masuk,
                ])->update();

            $this->barangModel
                ->where("productID", $productID)
                ->set([
                    "stok" => $barang->stok + $jumlah_masuk,
                ])->update();

            $this->barangModel
                ->where("productID", $barang_masuk->productID)
                ->set([
                    "stok" => $barang2->stok - $barang_masuk->jumlah_masuk,
                ])->update();

            return redirect()->to(base_url('data_barangmasuk'));
        }
    }
    public function tambah_barangkeluar(){
        if((session()->admin_role) == "admin"){
            $rows = $this->barangModel
                ->orderBy("productID", "asc")
                ->findAll();

            $data = ([
                "rows" => $rows,
            ]);

            return view("tambah_barangkeluar", $data);
        }else{
            $this->session->setFlashdata('barangkeluar', 'Anda tidak memiliki akses');
            $rows = $this->barangkeluarModel
                ->orderBy("transactionID","asc")
                ->findAll();
        
            $data = ([
                "rows" => $rows,
            ]);

            return view("data_barangkeluar",$data);
        }
    }
    public function proses_tambah_barangkeluar(){
        // Ambil Data dari Form
        $transactionID  = $this->request->getPost("transactionID");
        $tanggal        = $this->request->getPost("tanggal");
        $productID      = $this->request->getPost("productID");
        $jumlah_keluar  = $this->request->getPost("jumlah_keluar");
        $tujuan         = $this->request->getPost("tujuan");

        $barang = $this->barangModel
        ->where("productID", $productID)
        ->first();
        
        if($barang->stok - $jumlah_keluar < 0) {
            $this->session->setFlashdata('pesan', 'Stok barang tidak mencukupi');
            return redirect()->to(base_url("data_barangkeluar"));
        }elseif($jumlah_keluar <= 0){
            $this->session->setFlashdata('pesan', 'Masukkan jumlah keluar minimal 1');
            return redirect()->to(base_url("tambah_barangkeluar"));
        }else{
            $this->barangkeluarModel->insert([
                "transactionID" => $transactionID,
                "tanggal" => $tanggal,
                "productID" => $productID,
                "jumlah_keluar" => $jumlah_keluar,
                "tujuan" => $tujuan,
            ]);

            $this->barangModel
                ->where("productID", $productID)
                ->set([
                    "stok" => $barang->stok - $jumlah_keluar,
                ])->update();

            return redirect()->to(base_url("data_barangkeluar"));
        }
    }
    public function data_barangkeluar(){
        $rows = $this->barangkeluarModel
                ->orderBy("transactionID","asc")
                ->findAll();
        
        $data = ([
            "rows" => $rows,
        ]);

        return view("data_barangkeluar",$data);
    }
    public function hapus_barangkeluar($transactionID,$productID,$jumlah_keluar){
        $barang = $this->barangModel
        ->where("productID", $productID)
        ->first();

        $this->barangModel
            ->where("productID", $productID)
            ->set([
                "stok"   => $barang->stok + $jumlah_keluar,
            ])->update();

        $this->barangkeluarModel->where("transactionID", $transactionID)->delete();
        return redirect()->to(base_url("data_barangkeluar"));
    }
    public function edit_barangkeluar($transactionID){
        $barang_keluar = $this->barangkeluarModel
                    ->where("transactionID", $transactionID)
                    ->first();

        $rows = $this->barangModel
                ->orderBy("productID","asc")
                ->findAll();

        $data = ([
            "barang_keluar" => $barang_keluar,
            "rows"         => $rows,
        ]);

        return view("edit_barangkeluar",$data);
    }
    
    public function proses_edit_barangkeluar(){
        // Ambil Data dari Form
        $transactionID   = $this->request->getPost("transactionID");
        $tanggal         = $this->request->getPost("tanggal");
        $productID       = $this->request->getPost("productID");
        $jumlah_keluar   = $this->request->getPost("jumlah_keluar");
        $tujuan          = $this->request->getPost("tujuan");

        $barang_keluar = $this->barangkeluarModel
                    ->where("transactionID", $transactionID)
                    ->first();

        $barang = $this->barangModel
        ->where("productID", $productID)
        ->first();

        $barang2 = $this->barangModel
        ->where("productID", $barang_keluar->productID)
        ->first();

        if($barang->stok + $barang_keluar->jumlah_keluar - $jumlah_keluar < 0) {
            $this->session->setFlashdata('pesan', 'Stok barang tidak mencukupi');
            return redirect()->to(base_url("data_barangkeluar"));
        }elseif($barang_keluar->productID == $productID){
            $this->barangkeluarModel
                ->where("transactionID", $transactionID)
                ->set([
                    "transactionID" => $transactionID,
                    "tanggal" => $tanggal,
                    "productID" => $productID,
                    "jumlah_keluar" => $jumlah_keluar,
                    "tujuan" => $tujuan,
                ])->update();

            $this->barangModel
                ->where("productID", $productID)
                ->set([
                    "stok" => $barang->stok + $barang_keluar->jumlah_keluar - $jumlah_keluar,
                ])->update();

            return redirect()->to(base_url('data_barangkeluar'));
        }else{
            $this->barangkeluarModel
                ->where("transactionID", $transactionID)
                ->set([
                    "transactionID" => $transactionID,
                    "tanggal" => $tanggal,
                    "productID" => $productID,
                    "jumlah_keluar" => $jumlah_keluar,
                    "tujuan" => $tujuan,
                ])->update();

            $this->barangModel
                ->where("productID", $productID)
                ->set([
                    "stok" => $barang->stok - $jumlah_keluar,
                ])->update();

            $this->barangModel
                ->where("productID", $barang_keluar->productID)
                ->set([
                    "stok" => $barang2->stok + $barang_keluar->jumlah_keluar,
                ])->update();
                
            return redirect()->to(base_url('data_barangkeluar'));
        }
    }
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}