<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_m extends CI_Model {

	private $table = 'pengaduan';
	private $primary_key = 'id_pengaduan';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data){
		$this->db->where('idtemuan', $id);
        return $this->db->update('temuan', $data);
	}

}

/* End of file Pengaduan_m.php */
/* Location: ./application/models/Pengaduan_m.php */