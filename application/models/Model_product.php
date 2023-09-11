<?php
class Model_product extends CI_Model
{
	function get_product($number, $offset)
	{
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->limit($number, $offset);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		return show_404();
	}

	function product_first($id)
	{
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo, kategori.nama_kategori, kategori.id_kategori');
		$this->db->from('produk');
		$this->db->join('project', 'produk.id_produk = project.id_produk', 'LEFT');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.id_produk', $id);
		$this->db->where('produk.status', 1);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		}
		return show_404();
	}

	function image_product($id)
	{
		$this->db->select('url_gambar');
		$this->db->from('produk_gambar');
		$this->db->where('id_produk', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {

				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	function image_project($id)
	{
		$this->db->select('project.judul_project, project.gambar_project');
		$this->db->from('project');
		$this->db->where('project.id_produk', $id);
		$this->db->limit(6);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	function tot_project($id)
	{
		$this->db->select('project.id_produk');
		$this->db->from('project');
		$this->db->where('project.id_produk', $id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function tot_product()
	{
		$this->db->select('produk.*');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$query = $this->db->get();

		$result = $query->num_rows();
		return $result;
	}

	function get_product_category($kategori, $number, $offset)
	{
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo, kategori.nama_kategori');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('kategori.id_kategori', $kategori);
		$this->db->limit($number, $offset);
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
		$this->db->select('produk.*');
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
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo, subkategori.nama_subkategori');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('subkategori.id_subkategori', $subkategori);
		$this->db->limit($number, $offset);
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
		$this->db->select('produk.*');
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
