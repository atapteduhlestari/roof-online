<?php
class Model_product extends CI_Model
{

	function get_product($number = null, $offset = null)
	{
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo,kategori.nama_kategori, kategori.slug as kategori_slug,subkategori.nama_subkategori, subkategori.slug as sub_slug');
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

	function product_first($slug)
	{
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo, kategori.nama_kategori, kategori.id_kategori, kategori.slug as kategori_slug, subkategori.nama_subkategori, subkategori.slug as sub_slug');
		$this->db->from('produk');
		$this->db->join('project', 'produk.id_produk = project.id_produk', 'LEFT');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.slug', $slug);
		$this->db->where('produk.status', 1);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		}
		return show_404();
	}

	function image_product($id_produk)
	{
		$this->db->select('url_gambar');
		$this->db->from('produk_gambar');
		$this->db->where('id_produk', $id_produk);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {

				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	function image_project($id_produk)
	{
		$this->db->select('project.judul_project, project.gambar_project');
		$this->db->from('project');
		$this->db->where('project.id_produk', $id_produk);
		$this->db->limit(6);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	function tot_project($slug)
	{
		$this->db->select('project.id_produk');
		$this->db->from('project');
		$this->db->where('project.id_produk', $slug);
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

	function get_product_category($slug, $number, $offset)
	{
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo, kategori.nama_kategori, kategori.slug as kategori_slug,  subkategori.slug as sub_slug');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('kategori.slug', $slug);
		$this->db->limit($number, $offset);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		return show_404();
	}

	function tot_product_category($slug)
	{
		$this->db->select('produk.*');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('kategori.slug', $slug);
		$query = $this->db->get();

		$result = $query->num_rows();
		return $result;
	}

	function get_product_subcategory($slug_kategori, $slug_sub, $number, $offset)
	{
		$this->db->select('produk.*, logo.gambar_logo, logo.nama_logo, kategori.slug as kategori_slug, subkategori.nama_subkategori, subkategori.slug as sub_slug');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('kategori.slug', $slug_kategori);
		$this->db->where('subkategori.slug', $slug_sub);
		$this->db->limit($number, $offset);
		$query = $this->db->get();

		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
		return show_404();
	}

	function tot_product_subcategory($slug_kategori, $slug_sub)
	{
		$this->db->select('produk.*');
		$this->db->from('produk');
		$this->db->join('produk_subkategori', 'produk.id_produk = produk_subkategori.id_produk', 'LEFT');
		$this->db->join('kategori', 'produk_subkategori.id_kategori = kategori.id_kategori', 'LEFT');
		$this->db->join('subkategori', 'produk_subkategori.id_subkategori = subkategori.id_subkategori', 'LEFT');
		$this->db->join('logo', 'produk.id_logo = logo.id_logo', 'LEFT');
		$this->db->where('produk.status', 1);
		$this->db->where('kategori.status', 1);
		$this->db->where('kategori.slug', $slug_kategori);
		$this->db->where('subkategori.slug', $slug_sub);
		$query = $this->db->get();

		$result = $query->num_rows();
		return $result;
	}



	function set_slug($table)
	{
		if ($table === 'project') {

			$this->db->select('id_project, judul_project, slug');
			$this->db->from($table);
			$query = $this->db->get()->result();

			foreach ($query as $q) {
				$text = strtolower(trim($q->judul_project));
				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
				$this->db->set('slug', $slug);
				$this->db->where('id_project', $q->id_project);
				$this->db->update('project');
			}
		}

		if ($table === 'produk') {
			$this->db->select('id_produk, nama_produk, slug');
			$this->db->from($table);
			$query = $this->db->get()->result();

			foreach ($query as $q) {
				$text = strtolower(trim($q->nama_produk));
				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
				$this->db->set('slug', $slug);
				$this->db->where('id_produk', $q->id_produk);
				$this->db->update('produk');
			}
		}

		if ($table === 'kategori') {
			$this->db->select('id_kategori, nama_kategori, slug');
			$this->db->from($table);
			$query = $this->db->get()->result();

			foreach ($query as $q) {
				$text = strtolower(trim($q->nama_kategori));
				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
				$this->db->set('slug', $slug);
				$this->db->where('id_kategori', $q->id_kategori);
				$this->db->update('kategori');
			}
		}

		if ($table === 'subkategori') {
			$this->db->select('id_subkategori, nama_subkategori, slug');
			$this->db->from($table);
			$query = $this->db->get()->result();

			foreach ($query as $q) {
				$text = strtolower(trim($q->nama_subkategori));
				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
				$this->db->set('slug', $slug);
				$this->db->where('id_subkategori', $q->id_subkategori);
				$this->db->update('subkategori');
			}
		}

		if ($table === 'newsletter') {
			$this->db->select('id_newsletter, judul, slug');
			$this->db->from($table);
			$query = $this->db->get()->result();

			foreach ($query as $q) {
				$text = strtolower(trim($q->judul));
				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
				$this->db->set('slug', $slug);
				$this->db->where('id_newsletter', $q->id_newsletter);
				$this->db->update('newsletter');
			}
		}

		if (!$table || $table !== 'newsletter' && $table !== 'produk' && $table !== 'kategori' && $table !== 'subkategori') {
			$this->output->set_status_header('404');
			$data['title'] = 'ATAP TEDUH LESTARI';
			$data['banner_title'] = '404';
			$data['meta_desc'] = false;
			$this->load->view('layouts/header', $data);
			$this->load->view('layouts/components/navbar');
			$this->load->view('layouts/components/banner');
			$this->load->view('layouts/components/404_custom');
			$this->load->view('layouts/footer');
			echo $this->output->get_output();
			exit;
		}

		dd($query);
	}
}
