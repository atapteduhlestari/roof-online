<?php
class Model_project extends CI_Model
{
	function get_project($number = '', $offset = '', $keyword = '')
	{
		$this->db->select('project.*, produk.nama_produk, gambar_logo, nama_logo');
		$this->db->from('project');
		$this->db->join('produk', 'produk.id_produk = project.id_produk');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		if ($keyword) {
			$this->db->like('judul_project', $keyword);
			$this->db->or_like('produk.nama_produk', $keyword);
		}
		$this->db->order_by('rec_update', 'asc');
		$this->db->limit($number, $offset);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}

	function tot_project($keyword = '')
	{
		$this->db->select('project.*, produk.nama_produk, gambar_logo, nama_logo');
		$this->db->from('project');
		$this->db->join('produk', 'produk.id_produk = project.id_produk');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		if ($keyword) {
			$this->db->like('judul_project', $keyword);
			$this->db->or_like('produk.nama_produk', $keyword);
		}
		$query = $this->db->get();

		$result = $query->num_rows();
		return $result;
	}

	function discover_project($keyword = '')
	{
		$this->db->select('project.*, produk.nama_produk, produk.id_produk, gambar_logo, nama_logo');
		$this->db->from('project');
		$this->db->join('produk', 'produk.id_produk = project.id_produk');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.nama_produk', $keyword);
		$this->db->order_by('rec_update', 'asc');
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
		}
		return $result;
	}

	function get_product_category($kategori, $number, $offset)
	{
		$this->db->select('produk.*, gambar_logo');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('kategori.id_kategori', $kategori);
		// $this->db->limit($number, $offset);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		return show_404();
	}

	function tot_product_category($kategori)
	{
		$this->db->select('produk.*, gambar_logo');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('kategori.id_kategori', $kategori);
		$query = $this->db->get();

		$result = $query->num_rows();
		return $result;
	}

	function get_product_subcategory($subkategori, $number, $offset)
	{
		$this->db->select('produk.*, gambar_logo');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('subkategori.id_subkategori', $subkategori);
		// $this->db->limit($number, $offset);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		return show_404();
	}

	function tot_product_subcategory($subkategori)
	{
		$this->db->select('produk.*, gambar_logo');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('subkategori.id_subkategori', $subkategori);
		$query = $this->db->get();

		$result = $query->num_rows();
		return $result;
	}
}
