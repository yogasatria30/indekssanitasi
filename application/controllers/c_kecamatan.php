<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kecamatan extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function getindeks()
    {
		$query  = "SELECT * FROM indekssanitasi";
		$data1 = $this ->db->query($query)->result();
		foreach ($data1 as $row ) {
            $respon1[$row->kabkecno] = (double)$row->indeks;
            
        }
        echo json_encode($respon1);
    }

	public function index()
	{
		$this->load->view('v_kecamatan',$kode);
	}
	public function getmandi($kode)
    {
        $respon -> cols[] = array(
            "label" => "mandi",
            "type" => "string"
        );
        $respon -> cols[] = array(
            "label" => "jumlah",
            "type" => "number"
        );
        $query  = "SELECT mandi, COUNT(mandi) as jumlah
		FROM desa
        WHERE nokab = $kode
		group by mandi";

		$data1 = $this ->db->query($query)->result();
        foreach ($data1 as $row ) {
            $respon -> rows[]['c'] = array(
                array(
                    "v"=>$row->mandi
                ),
                array(
                    "v"=>(int)$row->jumlah
                )
            );
            
        }
        echo json_encode($respon);
    }
	public function getminum($kode)
    {
        
        $respon -> cols[] = array(
            "label" => "minum",
            "type" => "string"
        );
        $respon -> cols[] = array(
            "label" => "jumlah",
            "type" => "number"
        );
        $query  = "SELECT minum, COUNT(minum) as jumlah
		FROM desa  WHERE nokab = $kode
		group by minum";

		$data1 = $this ->db->query($query)->result();
        foreach ($data1 as $row ) {
            $respon -> rows[]['c'] = array(
                array(
                    "v"=>$row->minum
                ),
				array(
                    "v"=>$row->jumlah
                )
            );
            
        }
        echo json_encode($respon);
    }

	public function getpenerangan($kode)
    {
       
        $respon -> cols[] = array(
            "label" => "penerangan",
            "type" => "string"
        );
        $respon -> cols[] = array(
            "label" => "jumlah",
            "type" => "number"
        );
        $query  = "SELECT penerangan, COUNT(penerangan) as jumlah
		FROM desa  WHERE nokab = $kode
		group by penerangan";

		$data1 = $this ->db->query($query)->result();
        foreach ($data1 as $row ) {
            $respon -> rows[]['c'] = array(
                array(
                    "v"=>$row->penerangan
                ),
                array(
                    "v"=>(int)$row->jumlah
                )
            );
            
        }
        echo json_encode($respon);
	}
	public function getsampah($kode)
    {        

        $respon -> cols[] = array(
            "label" => "sampah",
            "type" => "string"
        );
        $respon -> cols[] = array(
            "label" => "jumlah",
            "type" => "number"
        );
        $query  = "SELECT sampah, COUNT(sampah) as jumlah
		FROM desa  WHERE nokab = $kode
		group by sampah";

		$data1 = $this ->db->query($query)->result();
        foreach ($data1 as $row ) {
            $respon -> rows[]['c'] = array(
                array(
                    "v"=>$row->sampah
                ),
                array(
                    "v"=>(int)$row->jumlah
                )
            );
            
        }
        echo json_encode($respon);
    }



} 
