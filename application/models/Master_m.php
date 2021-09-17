<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_m extends CI_Model {

	// private $table = 'petugas';
	private $primary_key = 'id_petugas';

	public function create($table, $data)
	{
		return $this->db->insert($table, $data);
	}	

	public function getLokasiKerja(){
		$this->db->select('*');
		$this->db->from('subunit');
		$this->db->join('unit', 'subunit.idunit = unit.idunit');
		$query = $this->db->get();

		return $query->result();
	}

	public function getUser(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('subunit', 'user.unit = subunit.idsub','left');
		$this->db->join('unit', 'subunit.idunit = unit.idunit','left');
		$query = $this->db->get();

		return $query->result();
	}

	public function getUnit(){
		$this->db->select('*');
		$this->db->from('unit');
		$query = $this->db->get();

		return $query->result();
	}



}

/* End of file Petugas_m.php */
/* Location: ./application/models/Petugas_m.php */