<?php
class Model_news extends CI_Model
{
    function get_news($number = 3, $offset = null)
    {
        $this->db->select('*');
        $this->db->from('newsletter');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit($number, $offset);
        $query =  $this->db->get();

        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }
        return show_404();
    }

    function tot_news()
    {
        $query = $this->db->get('newsletter');
        $result = $query->num_rows();
        return $result;
    }


    function first_news($slug)
    {
        $this->db->select('*');
        $this->db->from('newsletter');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->where('slug', $slug);
        $query =  $this->db->get();

        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }
        return show_404();
    }

    function get_archive()
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $this->db->select('Year(newsletter.tanggal) as year, MONTHNAME(newsletter.tanggal) as month,newsletter.id_newsletter, newsletter.tanggal');
        $this->db->from('newsletter');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->group_by(array("year", "month"));
        $query =  $this->db->get();

        $archives = array();

        if ($results = $query->result()) {
            foreach ($results as $result) {

                $archives[$result->year][] = $result;
            }
            return $archives;
        }
        return show_404();
    }

    function get_news_by_date($year, $month)
    {
        $this->db->select('*');
        $this->db->from('newsletter');
        // $this->db->where('MONTH(tanggal)', $month);
        // $this->db->where('YEAR(tanggal)', $year);
        $this->db->where("DATE_FORMAT(tanggal,'%M')", $month);
        $this->db->where("DATE_FORMAT(tanggal,'%Y')", $year);

        $query =  $this->db->get();

        $result = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }
        return show_404();
    }
}
