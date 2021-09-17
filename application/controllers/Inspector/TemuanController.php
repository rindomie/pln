<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemuanController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		is_logged_in();
		if ($this->session->userdata('level') != '3') :
			redirect('Auth/BlockedController');
		endif;
		$this->load->model('Temuan_m');
		$this->load->model('Master_m');
	}

	// List all your items
	public function index()
	{
		$data['title'] = 'Input Temuan';
		

		$this->form_validation->set_rules('nik','NIK','trim|required|alpha_numeric_spaces|callback_username_check');
		$this->form_validation->set_rules('password','Password','trim|required|alpha_numeric_spaces|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('level','Level','trim|required');

		if ($this->form_validation->run() == FALSE) :
            // $data['lokasi'] = $this->Master_m->getLokasiKerja();
            // $data['user'] = $this->Master_m->getUser();
            

			$this->load->view('_part/backend_head', $data);
			$this->load->view('_part/backend_sidebar_v');
			$this->load->view('_part/backend_topbar_v');
			$this->load->view('inspector/input_temuan', $data);
			$this->load->view('_part/backend_footer_v');
			$this->load->view('_part/backend_foot');
		else :
			$params = [
				'nama'			=> htmlspecialchars($this->input->post('nama',TRUE)),
				'nik'				=> htmlspecialchars($this->input->post('nik',TRUE)),
				'password'				=> password_hash(htmlspecialchars($this->input->post('password',TRUE)), PASSWORD_DEFAULT),
				'unit'					=> htmlspecialchars($this->input->post('unit',TRUE)),
				'level'					=> htmlspecialchars($this->input->post('level',TRUE)),
				'foto'			=> 'user.png',
			];

			$resp = $this->Master_m->create('user',$params);

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Buat akun user berhasil!
					</div>');

				redirect('Admin/UserController');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Buat akun user gagal!
					</div>');

				redirect('Admin/UserController');
			endif;
		endif;
	}

	public function delete($id)
	{

	$iduser = htmlspecialchars($id); // id petugas

	$cek_data = $this->db->get_where('user',['iduser' => $iduser])->row_array();
	
	if ( ! empty($cek_data)) :
		$resp = $this->db->delete('user',['iduser' => $iduser]);

		if ($resp) :
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Akun berhasil dihapus
				</div>');

			redirect('Admin/UserController');
		else :
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Akun gagal dihapus!
				</div>');

			redirect('Admin/UserController');
		endif;
	else :
		$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Data tidak ada
			</div>');

		redirect('Admin/UserController');
	endif;

}

public function edit($id)
{
		$iduser = htmlspecialchars($id); // id petugas

		$cek_data = $this->db->get_where('user',['iduser' => $iduser])->row_array();

		if ( ! empty($cek_data)) :

			$data['title'] = 'Edit User';
			$data['user'] = $cek_data;
            $data['lokasi'] = $this->Master_m->getLokasiKerja();

			$this->form_validation->set_rules('nama','Nama','trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('level','Level','trim|required');

			if ($this->form_validation->run() == FALSE) :
				$this->load->view('_part/backend_head', $data);
				$this->load->view('_part/backend_sidebar_v');
				$this->load->view('_part/backend_topbar_v');
				$this->load->view('admin/edit_user', $data);
				$this->load->view('_part/backend_footer_v');
				$this->load->view('_part/backend_foot');
			else :

            $params = [
				'nama'			=> htmlspecialchars($this->input->post('nama',TRUE)),
				'unit'					=> htmlspecialchars($this->input->post('unit',TRUE)),
				'level'					=> htmlspecialchars($this->input->post('level',TRUE)),
			];

			$resp = $this->db->update('user',$params, ['iduser' => $iduser]);

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Akun user berhasil di edit
					</div>');

				redirect('Admin/UserController');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Akun user gagal di edit!
					</div>');

				redirect('Admin/UserController');
			endif;

			endif;

		else :
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data tidak ada
				</div>');

			redirect('Admin/UserController');
		endif;
	}	

	public function username_check($str = NULL)
	{
		if (!empty($str)) :
			$user = $this->db->get_where('user',['nik' => $str])->row_array();

			if ($user== true) :

				$this->form_validation->set_message('username_check', 'NIK ini sudah terdaftar ada.');

				return false;
			else :
				return true;
			endif;
		else :
			$this->form_validation->set_message('username_check', 'Inputan Kosong');

			return false;
		endif;
	}
}

/* End of file PetugasController.php */
/* Location: ./application/controllers/Admin/PetugasController.php */
