<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		is_logged_in();
		if ($this->session->userdata('level') != '2') :
			redirect('Auth/BlockedController');
		endif;
		$this->load->model('Temuan_m');
		$this->load->model('Master_m');
	}

	// List all your items
	public function index()
	{
		$data['title'] = 'Input Temuan';
		

		$this->form_validation->set_rules('title','Title Temuan','trim|required');
		$this->form_validation->set_rules('lokasi','Lokasi Temuan','trim|required');
		$this->form_validation->set_rules('kategori','Kategori Temuan','trim|required');


		if ($this->form_validation->run() == FALSE) :
			// $data['lokasi'] = $this->Master_m->getLokasiKerja();
			// $data['user'] = $this->Master_m->getUser();
		
			$this->load->view('_part/backend_head', $data);
			$this->load->view('_part/backend_sidebar_v');
			$this->load->view('_part/backend_topbar_v');
			$this->load->view('temuan/input_temuan', $data);
			$this->load->view('_part/backend_footer_v');
			$this->load->view('_part/backend_foot');
		else :
			$upload_image = $_FILES['foto']['name'];
			$config['allowed_types'] = 'jpeg|jpg|png';
			// $config['max_size']      = '10000';
			$config['upload_path'] = './assets/uploads/laporan/';
			$config['file_name'] = $upload_image;

			// var_dump($upload_image);
			// die;

			$cek = $this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

					$image = $this->upload->data('file_name');
					$params = [
						'idpenemu'			=> htmlspecialchars($this->input->post('id',TRUE)),
						'tgltemuan'				=> htmlspecialchars($this->input->post('tgltemu',TRUE)),
						'title'			=> htmlspecialchars($this->input->post('title',TRUE)),
						'keterangan'				=> htmlspecialchars($this->input->post('keterangan',TRUE)),
						'lokasi'				=> htmlspecialchars($this->input->post('lokasi',TRUE)),
						'ststemuan'				=> htmlspecialchars('diproses',TRUE),
						'tipetemuan'				=> htmlspecialchars($this->input->post('kategori',TRUE)),
						'foto'			=> $image,
					];

					$resp = $this->Master_m->create('temuan',$params);

					if ($resp) :
						$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Temuan berhasil dikirm!
							</div>');

						redirect('Temuan/TemuanController');
					else :
						$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Temuan gagal dikirim db!
							</div>');

						redirect('Temuan/TemuanController');
					endif;
							
			} else {
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Temuan gagal dikirim foto!
						</div>');

					redirect('Temuan/TemuanController');
			}

		endif;
	}

	public function MonitoringTemuan(){
		$data['title'] = 'Monitoring Temuan';

		$this->load->view('_part/backend_head', $data);
		$this->load->view('_part/backend_sidebar_v');
		$this->load->view('_part/backend_topbar_v');
		$this->load->view('temuan/monitoring_temuan', $data);
		$this->load->view('_part/backend_footer_v');
		$this->load->view('_part/backend_foot');
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
		$idtemuan = htmlspecialchars($id); 

		$cek_data = $this->db->get_where('temuan',['idtemuan' => $idtemuan])->row_array();

		// var_dump($cek_data);
		// die;

		if ( ! empty($cek_data)) :

			$params = [
				'title'			=> htmlspecialchars($this->input->post('title',TRUE)),
				'keterangan'					=> htmlspecialchars($this->input->post('ket',TRUE)),
				'tipetemuan'					=> htmlspecialchars($this->input->post('kategori',TRUE)),
				'lokasi'					=> htmlspecialchars($this->input->post('lokasi',TRUE)),
			];

			// $resp = $this->db->update('temuan',$params, ['idtemuan' => $idtemuan]);
			$resp = $this->Temuan_m->update($idtemuan, $params);;

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data temuan berhasil di edit!
					</div>');

				redirect('Temuan/TemuanController/DaftarTemuan');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data temuan gagal di edit!
					</div>');

				redirect('Temuan/TemuanController/DaftarTemuan');
			endif;

		else :
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data tidak ada
				</div>');

			redirect('Temuan/TemuanController/DaftarTemuan');
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
