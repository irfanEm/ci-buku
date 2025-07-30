<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Buku_model', 'Buku'); // kasih alias
		$this->load->library('form_validation');	
		$this->load->library('session');	
	}

	public function index()
	{
		$this->load->library('pagination');
		$keyword = $this->input->get('q');
		$limit = 5;
		$start = $this->input->get('per_page') ?? 0;

		if ($keyword) {
			$data['buku'] = $this->Buku->searchWithLimit($limit, $start, $keyword);
			$total_rows = $this->Buku->countSearch($keyword);
			$config['base_url'] = site_url('buku?q=' . urlencode($keyword));
		} else {
			$data['buku'] = $this->Buku->getAllWithLimit($limit, $start);
			$total_rows = $this->Buku->countAll();
			$config['base_url'] = site_url('buku');
		}

		// Konfigurasi pagination
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['page_query_string'] = true;

		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('buku/index', $data);
	}


	public function tambah()
	{
		$this->load->view('buku/tambah');
	}

	public function simpan()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required|min_length[3]');
		$this->form_validation->set_rules('penulis', 'Penulis', 'required|min_length[3]');
		$this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric');

		if($this->form_validation->run() == FALSE){
			$this->load->view('buku/tambah');
		}else{
			$data = [
				'judul' => $this->input->post('judul', true),
				'penulis' => $this->input->post('penulis', true),
				'tahun_terbit' => $this->input->post('tahun_terbit', true),
			];
		}

		$this->Buku->insert($data);

		$this->session->set_flashdata('success', 'Buku berhasil ditambahkan');
		redirect('buku');
	}

	public function edit($id)
	{
		$buku = $this->Buku->getById($id);
		if(!$buku){
			redirect('buku');
		}

		$this->load->view('buku/edit', ['buku' => $buku]);
	}

	public function update($id)
	{
		$buku = $this->Buku->getById($id);
		if(!$buku){
			redirect('buku');
		}

		$this->form_validation->set_rules('judul', 'Judul Buku', 'required|min_length[3]');
		$this->form_validation->set_rules('penulis', 'Penulis', 'required|min_length[3]');
		$this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric');

		if($this->form_validation->run() == FALSE){
			$this->load->view('buku/edit', ['buku' => $buku]);
		}else{
			$data = [
				'judul' => $this->input->post('judul', true),
				'penulis' => $this->input->post('penulis', true),
				'tahun_terbit' => $this->input->post('tahun_terbit', true)
			];
		}

		$this->Buku->update($id, $data);

		$this->session->set_flashdata('success', 'Buku berhasil diperbarui');
		redirect('buku');
	}
	
	public function hapus($id)
	{
		if(!$id){
			redirect('buku');
		}

		$this->Buku->delete($id);

		$this->session->set_flashdata('success', 'Buku berhasil dihapus');
		redirect('buku');
	}
}

