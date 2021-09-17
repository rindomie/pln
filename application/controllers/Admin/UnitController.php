<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		is_logged_in();
		if ($this->session->userdata('level') != '1') :
			redirect('Auth/BlockedController');
		endif;
		$this->load->model('Master_m');
	}

	// List all your items
	public function index()
	{
		$data['title'] = 'Unit Kerja';

		$this->form_validation->set_rules('namaunit','Nama Unit','trim|required|alpha_numeric_spaces|callback_username_check');
		$this->form_validation->set_rules('alamat','Alamat','trim|required');

		if ($this->form_validation->run() == FALSE) :
            $data['lokasi'] = $this->Master_m->getLokasiKerja();
            $data['unit'] = $this->Master_m->getUnit();
            

			$this->load->view('_part/backend_head', $data);
			$this->load->view('_part/backend_sidebar_v');
			$this->load->view('_part/backend_topbar_v');
			$this->load->view('admin/master_unit', $data);
			$this->load->view('_part/backend_footer_v');
			$this->load->view('_part/backend_foot');
		else :
			$params = [
				'namaunit'			=> htmlspecialchars($this->input->post('namaunit',TRUE)),
				'alamat'				=> htmlspecialchars($this->input->post('alamat',TRUE)),
			];

			$resp = $this->Master_m->create('unit',$params);

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Unit kerja berhasil ditambahkan!
					</div>');

				redirect('Admin/UnitController');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Unit kerja gagal ditambahkan!
					</div>');

				redirect('Admin/UnitController');
			endif;
		endif;
	}

    public function addsub()
    {
        $params = [
				'namasub'			=> htmlspecialchars($this->input->post('namasub',TRUE)),
				'idunit'				=> htmlspecialchars($this->input->post('idunit',TRUE)),
			];

			$resp = $this->Master_m->create('subunit',$params);

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Sub Unit kerja berhasil ditambahkan!
					</div>');

				redirect('Admin/UnitController');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					SUb Unit kerja gagal ditambahkan!
					</div>');

				redirect('Admin/UnitController');
			endif;
    }

	public function delete($id)
	{

	$idunit = htmlspecialchars($id); // id petugas

	$cek_data = $this->db->get_where('unit',['idunit' => $idunit])->row_array();
	
	if ( ! empty($cek_data)) :
		$resp = $this->db->delete('unit',['idunitt' => $idunit]);

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
