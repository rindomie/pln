<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeratorController extends CI_Controller {

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

	public function ModeratorTemuan(){
		$data['title'] = 'Temuan Masuk';

		$this->load->view('_part/backend_head', $data);
		$this->load->view('_part/backend_sidebar_v');
		$this->load->view('_part/backend_topbar_v');
		$this->load->view('moderator/moderator_temuan', $data);
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

	public function acc($id)
	{
		$idtemuan = htmlspecialchars($id); 

		$cek_data = $this->db->get_where('temuan',['idtemuan' => $idtemuan])->row_array();

		// var_dump($cek_data);
		// die;

		if ( ! empty($cek_data)) :

			$params = [
				'ststemuan' => "disetujui",
				'tanggapan'			=> htmlspecialchars($this->input->post('tanggapan',TRUE)),
				'pjdept'					=> htmlspecialchars($this->input->post('dept',TRUE)),
				'deadline'					=> htmlspecialchars($this->input->post('deadline',TRUE)),
				'idmoderator'					=> htmlspecialchars($this->input->post('moderator',TRUE)),
			];

			// $resp = $this->db->update('temuan',$params, ['idtemuan' => $idtemuan]);
			$resp = $this->Temuan_m->update($idtemuan, $params);;

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Temuan masuk berhasil di setujui!
					</div>');

				redirect('Moderator/ModeratorController/ModeratorTemuan');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Temuan masuk gagal di setujui!
					</div>');

				redirect('Moderator/ModeratorController/ModeratorTemuan');
			endif;

		else :
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data tidak ada
				</div>');

			redirect('Moderator/ModeratorController/ModeratorTemuan');
		endif;
	}	

	public function tolak($id)
	{
		$idtemuan = htmlspecialchars($id); 

		$cek_data = $this->db->get_where('temuan',['idtemuan' => $idtemuan])->row_array();

		// var_dump($cek_data);
		// die;

		if ( ! empty($cek_data)) :

			$params = [
				'ststemuan' => "ditolak",
				'tanggapan'			=> htmlspecialchars($this->input->post('tanggapan',TRUE)),
				'idmoderator'					=> htmlspecialchars($this->input->post('moderator',TRUE)),
			];

			// $resp = $this->db->update('temuan',$params, ['idtemuan' => $idtemuan]);
			$resp = $this->Temuan_m->update($idtemuan, $params);;

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Temuan masuk berhasil di tolak!
					</div>');

				redirect('Moderator/ModeratorController/ModeratorTemuan');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Temuan masuk gagal di tolak!
					</div>');

				redirect('Moderator/ModeratorController/ModeratorTemuan');
			endif;

		else :
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data tidak ada
				</div>');

			redirect('Moderator/ModeratorController/ModeratorTemuan');
		endif;
	}	

	// temuan acc

	public function ModeratorAcc(){
		$data['title'] = 'Temuan Disetujui';

		$this->load->view('_part/backend_head', $data);
		$this->load->view('_part/backend_sidebar_v');
		$this->load->view('_part/backend_topbar_v');
		$this->load->view('moderator/moderator_acc', $data);
		$this->load->view('_part/backend_footer_v');
		$this->load->view('_part/backend_foot');
	}

	public function done($id)
	{
		$idtemuan = htmlspecialchars($id); 

		$cek_data = $this->db->get_where('temuan',['idtemuan' => $idtemuan])->row_array();

		// var_dump($cek_data);
		// die;

		if ( ! empty($cek_data)) :

			$params = [
				'ststemuan' => "selesai",
			];

			// $resp = $this->db->update('temuan',$params, ['idtemuan' => $idtemuan]);
			$resp = $this->Temuan_m->update($idtemuan, $params);;

			if ($resp) :
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Temuan berhasil di close!
					</div>');

				redirect('Moderator/ModeratorController/ModeratorAcc');
			else :
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Temuan gagal di close!
					</div>');

				redirect('Moderator/ModeratorController/ModeratorAcc');
			endif;

		else :
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data tidak ada
				</div>');

			redirect('Moderator/ModeratorController/ModeratorAcc');
		endif;
	}

	public function ModeratorTolak(){
		$data['title'] = 'Temuan Ditolak';

		$this->load->view('_part/backend_head', $data);
		$this->load->view('_part/backend_sidebar_v');
		$this->load->view('_part/backend_topbar_v');
		$this->load->view('moderator/moderator_tolak', $data);
		$this->load->view('_part/backend_footer_v');
		$this->load->view('_part/backend_foot');
	}

	public function ModeratorDone(){
		$data['title'] = 'Temuan Close';

		$this->load->view('_part/backend_head', $data);
		$this->load->view('_part/backend_sidebar_v');
		$this->load->view('_part/backend_topbar_v');
		$this->load->view('moderator/moderator_selesai', $data);
		$this->load->view('_part/backend_footer_v');
		$this->load->view('_part/backend_foot');
	}




}

/* End of file PetugasController.php */
/* Location: ./application/controllers/Admin/PetugasController.php */
