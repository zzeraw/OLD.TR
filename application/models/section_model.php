<?php
class Section_Model extends MY_Model
{
    protected $_table_name = 'sections';
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
            'rules' => 'trim|required|max_length[128]|xss_clean'
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

    public function save_order ($sections)
    {
        if (count($sections)) {
            foreach ($sections as $order => $section) {
                if ($section['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $section['item_id'])->update($this->_table_name);
                }
            }
        }
    }






}