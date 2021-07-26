<?php

class M_Dosen extends CI_Model{

	public $limit;
	public $offset;
	public $sort;
	public $order;

	function __construct(){

		parent::__construct();

	}
    
    
    function get(){
      /*
      
      "SELECT kode," +
                "       nidn as NIDN," +
                "       nama as Nama," +
                "       alamat as Alamat," +
                "       telp as Telp " +
                "FROM dosen " +
                "ORDER BY kode");
      */
      $rs = $this->db->query("SELECT kode, ".
							 "		 nama,".
							 "		 telp, ".
							 "		 posisi ".
                             "FROM dosen ".
							 "ORDER BY $this->sort $this->order ".
							 "LIMIT $this->offset,$this->limit");
							 
      return $rs;		
    }
	
	function get_all(){
     
    //   $rs = $this->db->query("SELECT kode, ".
	// 						 "		 nama,".
	// 						 "		 telp, ".
	// 						 "		 posisi ".
    //                          "FROM dosen ".
	// 						 "ORDER BY nama");

	  $rs = $this->db->query("SELECT a.kode as kode, ".
							 "		 a.nama as nama,".
							 "		 a.telp as telp, ".
							 "		 b.nama as nama_mk ".
                             "FROM pekerja a ".
							 "LEFT JOIN posisi b ".
							 "ON a.posisi = b.kode ".
							 "ORDER BY a.nama asc;");

		// $this->db->select('*');
		// $this->db->from('dosen a');
		// $this->db->join('matakuliah b', 'b.kode = a.posisi', 'left');
		// $this->db->order_by('a.kode', 'asc');
		// $rs = $this->db->get();
		// if($rs->num_rows() != 0)
    	// {
        // return $rs->result_array();
   		// }
    	// else
    	// {
        // return false;
    	// }
							 
      return $rs;		
    }
	
	function get_by_kode($kode){
		$rs = $this->db->query(	"SELECT kode, ".
								"		 nama,".
								"		 telp, ".
								"		 posisi ".
								"FROM pekerja ".
								"WHERE kode = $kode");
		return $rs;		
	}
	
	function get_search($search){
		$rs = $this->db->query(	"SELECT kode, ".
								"		 nama,".
								"		 telp, ".
								"		 posisi ".
								"FROM dosen ".
								"WHERE nama LIKE '%$search%'");
		return $rs;		
	}
    
    function num_page(){
    	
    	$result = $this->db->from('pekerja')
                           ->count_all_results();
        return $result;
    }
    
    function insert($data){
        $this->db->insert('pekerja',$data);		
    }
    
    function update($kode,$data){
        $this->db->where('kode',$kode);
        $this->db->update('pekerja',$data);
    }
    
    function delete($kode){
        $this->db->query("DELETE FROM pekerja WHERE kode='$kode'");
    }
	
	function cek_for_insert($nama){
		/*
		
		var check = string.Format("SELECT CAST(COUNT(*) AS CHAR(1)) " +
                                          "FROM dosen " +
                                          "WHERE kode={0} OR nidn='{1}'",
                                          int.Parse(txtKode.Text), txtNIDN.Text);
                var i = int.Parse(_dbConnect.ExecuteScalar(check));
		*/
		$rs = $this->db->query("SELECT CAST(COUNT(*) AS CHAR(1)) as cnt ".
							   "FROM pekerja ".
							   "WHERE nama='$nama'");
		return $rs->row()->cnt;
	}
	
	function cek_for_update($kode_baru,$nidn,$kode_lama){
		$rs = $this->db->query("SELECT CAST(COUNT(*) AS CHAR(1)) as cnt ".
							   "FROM pekerja ".
							   "WHERE (kode=$kode_baru) AND kode <> $kode_lama");
		return $rs->row()->cnt;
	}
}