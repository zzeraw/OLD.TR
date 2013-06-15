<?php
class Image_Model extends MY_Model
{
    protected $_table_name = 'c_images';
    protected $_order_by = 'id';

    public function get_thumb_items_pairs() {
        // Fetch images
        $this->db->select('id_c_item, thumb');
        $this->db->group_by('id_c_item');

        $images = parent::get();

        // Return key => value pair array
        $array = array();
        if (count($images)) {
            foreach ($images as $image) {
                $array[$image->id_c_item] = $image->thumb;
            }
        }

        return $array;
    }



}