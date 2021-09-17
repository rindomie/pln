<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		is_logged_in();
	}

	// List all your items
	public function index()
	{
        $data['title'] = 'Profile';

        // $masyarakat = $this->db->get_where('masyarakat',['username' => $this->session->userdata('username')])->row_array();
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('subunit', 'user.unit = subunit.idsub','left');
		$this->db->join('unit', 'subunit.idunit = unit.idunit','left');
		$this->db->where('user.nik', $this->session->userdata('nik'));
		$user = $this->db->get()->row_array();

		// if ($masyarakat == TRUE) :
		// 	$data['user'] = $masyarakat;
		// elseif ($petugas == TRUE) :
		// 	$data['user'] = $petugas;
		// endif;

		$data['user'] = $user;

        $this->load->view('_part/backend_head', $data);
        $this->load->view('_part/backend_sidebar_v');
        $this->load->view('_part/backend_topbar_v');
        $this->load->view('user/profile');
        $this->load->view('_part/backend_footer_v');
        $this->load->view('_part/backend_foot');
	}

	public function UpdateFoto($id)
	{
		$iduser = htmlspecialchars($id); 

		$upload_image = $_FILES['foto']['name'];
		$config['allowed_types'] = 'jpeg|jpg|png';
		// $config['max_size']      = '10000';
		$config['upload_path'] = './assets/profile/';
		$config['file_name'] = $upload_image;

		// var_dump($upload_image);
		// die;

		$cek = $this->load->library('upload', $config);

		// var_dump($cek_data);
		// die;

		if ($this->upload->do_upload('foto')) :
			$image = $this->upload->data('file_name');

            $params = [
				'foto'			=> $image,
			];

			// $resp = $this->db->update('temuan',$params, ['idtemuan' => $idtemuan]);
			$this->db->where('iduser', $iduser);
			$resp = $this->db->update('user', $params);

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Foto berhasil diupdate!
					</div>');

				redirect('User/ProfileController');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Foto gagal diupdate!
					</div>');

				redirect('User/ProfileController');
			endif;

		else :
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Upload foto gagal!
				</div>');

			redirect('User/ProfileController');
		endif;
	}
}

/* End of file ProfileController.php */
/* Location: ./application/controllers/User/ProfileController.php */
