<?php
class Main_Model extends MY_Model
{



    function __construct() {
        parent::__construct();

        $this->load->model('collection_model');
        $this->load->model('group_model');
        $this->load->model('section_model');

        $this->tablenames = array('collection' => 'c_collections', 'group' => 'c_groups', 'section' => 'sections');
    }

    public function getControllerBySlug($slug) {

        // var_dump($slug);

        // return $slug;

        if ((!$slug) || ($slug == 'homepage')) {
            return 'homepage';
        }

        if ($slug == 'collections') {
            return 'collections';
        }

        if ($slug == 'catalog') {
            return 'all';
        }


        foreach ($this->tablenames as $page => $tablename) {
            $this->db->where('slug', $slug);
            $this->db->from($tablename);

            if ($this->db->count_all_results() > 0) {
                return $page;
            }
        }

        return FALSE;

        // collections

        // groups

        // sections

        return $slug;
    }



    public function checkUniqueSlug($slug) {
        foreach ($this->tablenames as $tablename) {
            $count = 0;

            $this->db->where('slug', $slug);
            $this->db->from($tablename);

            $count = $this->db->count_all_results();

            if ($count > 0) {
                return FALSE;
            }
        }

        return TRUE;
    }

    public function getTitleBySlug($slug) {
        if (is_numeric($slug)) {
            $this->db->select('title');
            $this->db->where('id', $slug);
            $this->db->from('c_items');

            // var_dump($this->db->last_query());

            return $this->db->get()->row();
        } else {
            foreach ($this->tablenames as $page => $tablename) {
                $this->db->where('slug', $slug);
                $this->db->from($tablename);

                if ($this->db->count_all_results() > 0) {
                    $this->db->select('title');
                    $this->db->where('slug', $slug);
                    $this->db->from($tablename);

                    return $this->db->get()->row();
                }
                // var_dump($this->db->last_query());
            }
        }
        return FALSE;

    }

    public function getMetaBySlug($slug) {
        if (is_numeric($slug)) {
            $this->db->select('meta_title, meta_keywords, meta_description');
            $this->db->where('id', $slug);
            $this->db->from('c_items');

            return $this->db->get()->row();
        } else {
            foreach ($this->tablenames as $page => $tablename) {
                $this->db->where('slug', $slug);
                $this->db->from($tablename);

                if ($this->db->count_all_results() > 0) {
                    $this->db->select('meta_title, meta_keywords, meta_description');
                    $this->db->where('slug', $slug);
                    $this->db->from($tablename);

                    return $this->db->get()->row();
                }
                // var_dump($this->db->last_query());
            }
        }
        return FALSE;
    }
}
