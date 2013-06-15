<?php
class Collection_Model extends MY_Model
{
    protected $_table_name = 'c_collections';
    protected $_table_name_links = 'c_collections_links';
    protected $_order_by = 'order';
    protected $_timestamps = TRUE;
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Название',
            'rules' => 'trim|required|max_length[64]|xss_clean'
        ),
        'slug' => array(
            'field' => 'slug',
            'label' => 'Латинское название',
            'rules' => 'trim|required|max_length[128]|url_title|xss_clean|callback__unique_slug'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Содержимое',
            'rules' => 'trim'
        ),
        'meta_title' => array(
            'field' => 'meta_title',
            'label' => 'Meta-title',
            'rules' => 'trim'
        ),
        'meta_keywords' => array(
            'field' => 'meta_keywords',
            'label' => 'Meta-keywords',
            'rules' => 'trim'
        ),
        'meta_description' => array(
            'field' => 'meta_description',
            'label' => 'Meta-description',
            'rules' => 'trim'
        )
    );

    public function get_new ()
    {
        $collection = new stdClass();
        $collection->title = '';
        $collection->slug = '';
        $collection->body = '';
        $collection->meta_title = '';
        $collection->meta_keywords = '';
        $collection->meta_description = '';

        return $collection;
    }

    public function save_order ($collections)
    {
        if (count($collections)) {
            foreach ($collections as $order => $collection) {
                if ($collection['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $collection['item_id'])->update($this->_table_name);
                }
            }
        }
    }


    public function get_pairs() {
        // Fetch collections
        $this->db->select('id, title');
        $collections = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'No collections'
        );
        if (count($collections)) {
            foreach ($collections as $collection) {
                $array[$collection->id] = $collection->title;
            }
        }

        return $array;
    }

    public function get_collections($item = FALSE) {

        if ($item === FALSE) {
            $collections[0] = new stdClass();
            $collections[0]->id = NULL;
            $collections[0]->collection_id = NULL;
            $collections[0]->collection_value = NULL;

            return $collections;
        }

        $this->db->select('c.id as collection_value, cl.id as collection_id');
        $this->db->from($this->_table_name_links . ' as cl');
        $this->db->join($this->_table_name . ' as c', 'c.id = cl.id_collection', 'left');
        $this->db->where('cl.id_item', $item);

        return $this->db->get()->result();
    }






}