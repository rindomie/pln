<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function index()
	{
		$data['title'] = 'Login';

		$this->form_validation->set_rules('nik','NIK','trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('password','Password','trim|required|alpha_numeric_spaces');

		if ($this->form_validation->run() == FALSE) :
			$this->load->view('_part/login_head', $data);
			$this->load->view('login_v');
			$this->load->view('_part/login_footer');
		else :
			$nik = htmlspecialchars($this->input->post('nik',TRUE));
			$password = htmlspecialchars($this->input->post('password',TRUE));

			$this->cek_login($nik, $password);
		endif;
	}

	private function cek_login($nik, $password)
	{
		// cek akun di table masyarakat dan petugas berdasarkan username
		// $masyarakat = $this->db->get_where('masyarakat',['username' => $username])->row_array();
		$user = $this->db->get_where('user',['nik' => $nik])->row_array();
		// var_dump($user);
		// die;

		if ($user == TRUE) {
			// cek password
			if (password_verify($password, $user['password'])) {
				// jika password benar
				// maka buat session userdata

				if($user['level'] == '1'){
					$session = [
					'id' 		=> $user['iduser'],
					'nik' 		=> $user['nik'],
					'nama' 		=> $user['nama'],
					'level' 	=> $user['level'],
					'unit' 	=> $user['unit'],
				];
					$this->session->set_userdata($session);
					$this->session->set_flashdata('msg','<div class="alert alert-primary" role="alert">
						Login berhasil!
						</div>');
					return redirect('Admin/DashboardController');
				}
				else if($user['level'] == '2') {
					$session = [
					'id' 		=> $user['iduser'],
					'nik' 		=> $user['nik'],
					'nama' 		=> $user['nama'],
					'level' 	=> $user['level'],
					'unit' 	=> $user['unit'],
				];
					$this->session->set_userdata($session);
					$this->session->set_flashdata('msg','<div class="alert alert-primary" role="alert">
						Login berhasil!
						</div>');
					return redirect('Admin/DashboardController');
				}
				else if($user['level'] == '3') {
					$session = [
					'id' 		=> $user['iduser'],
					'nik' 		=> $user['nik'],
					'nama' 		=> $user['nama'],
					'level' 	=> $user['level'],
					'unit' 	=> $user['unit'],
				];
					$this->session->set_userdata($session);
					$this->session->set_flashdata('msg','<div class="alert alert-primary" role="alert">
						Login berhasil!
						</div>');
					return redirect('User/ProfileController');
				}
				else {
					$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
					User tidak ditemukan!
					</div>');

					return redirect('Auth/LoginController');
				}
			}
			else {
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
				Password salah!
				</div>');

				return redirect('Auth/LoginController');
			}
		}
				
		else {
			// password salah
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">
				Username atau Password salah!
				</div>');

			return redirect('Auth/LoginController');
		}
	}
}

/* End of file LoginController.php */
/* Location: ./application/controllers/Auth/LoginController.php */
