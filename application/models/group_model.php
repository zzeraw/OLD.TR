<?php
class Group_Model extends MY_Model
{
    protected $_table_name = 'c_groups';
    protected $_table_name_links = 'c_groups_links';
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
        $group = new stdClass();
        $group->title = '';
        $group->slug = '';
        $group->body = '';
        $group->meta_title = '';
        $group->meta_keywords = '';
        $group->meta_description = '';

        return $group;
    }

    public function save_order ($groups)
    {
        if (count($groups)) {
            foreach ($groups as $order => $group) {
                if ($group['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $group['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function get_pairs() {
        // Fetch groups
        $this->db->select('id, title');
        $groups = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'No groups'
        );
        if (count($groups)) {
            foreach ($groups as $group) {
                $array[$group->id] = $group->title;
            }
        }

        return $array;
    }

    public function get_groups($item = FALSE) {

        if ($item === FALSE) {
            $groups[0] = new stdClass();
            $groups[0]->id = NULL;
            $groups[0]->group_id = NULL;
            $groups[0]->group_value = NULL;

            return $groups;
        }

        $this->db->select('g.id as group_value, gl.id as group_id');
        $this->db->from($this->_table_name_links . ' as gl');
        $this->db->join($this->_table_name . ' as g', 'g.id = gl.id_group', 'left');
        $this->db->where('gl.id_item', $item);

        return $this->db->get()->result();
    }





}