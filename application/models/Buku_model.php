<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model
{
	public function getAll(){
		return $this->db->get('books')->result();
	}
	public function getById($id){
		return $this->db->get_where('books', ['id' => $id])->row();
	}
	public function insert($data){
		return $this->db->insert('books', $data);
	}
	public function update($id, $data){
		return $this->db->where('id', $id)->update('books', $data);
	}
	public function delete($id){
		return $this->db->delete('books', ['id' => $id]);
	}
	public function search($keyword){
		return $this->db->like('judul',$keyword)
						->or_like('penulis', $keyword)
						->or_like('tahun_terbit', $keyword)
						->get('books')
						->result();
	}

	public function getAllWithLimit($limit, $start)
	{
		return $this->db->limit($limit, $start)->get('books')->result();
	}

	public function countAll()
	{
		return $this->db->count_all('books');
	}

	public function searchWithLimit($limit, $start, $keyword)
	{
		return $this->db->like('judul', $keyword)
						->or_like('penulis', $keyword)
						->or_like('tahun_terbit', $keyword)
						->limit($limit, $start)
						->get('books')
						->result();
	}

	public function countSearch($keyword)
	{
		return $this->db->like('judul', $keyword)
						->or_like('penulis', $keyword)
						->or_like('tahun_terbit', $keyword)
						->count_all_result('books');
	}
}
