<?php
class Color_Model extends MY_Model
{
    protected $_table_name = 'colors';
    protected $_order_by = 'order';
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Название',
            'rules' => 'trim|required|max_length[64]|xss_clean'
        )
    );

    public function get_new ()
    {
        $color = new stdClass();
        $color->title = '';

        return $color;
    }

    public function save_order ($colors)
    {
        if (count($colors)) {
            foreach ($colors as $order => $color) {
                if ($color['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $color['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function get_pairs() {
        // Fetch colors
        $this->db->select('id, title');
        $colors = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'No colors'
        );
        if (count($colors)) {
            foreach ($colors as $color) {
                $array[$color->id] = $color->title;
            }
        }

        return $array;
    }


    public function save_file($id = NULL) {

        $color_file_config['upload_path'] = './uploads/colors/';
        $color_file_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $color_file_config['file_name'] = sha1(time());
        $color_file_config['max_size'] = '0';
        $color_file_config['max_width']  = '0';
        $color_file_config['max_height']  = '0';

        $this->load->library('upload', $color_file_config);

        if ( ! $this->upload->do_upload('filename')) {

            $result['flag'] = 'error';
            $result['data'] = $this->upload->display_errors();

        } else {
            $data = array('upload_data' => $this->upload->data());
            // echo "Создан новый файл " . $color_file_config['upload_path'] . $data['upload_data']['file_name'] . "<br>";

            if ($id === NULL) { } else {
                $fileinfo = $this->get($id, TRUE);
                if (file_exists($color_file_config['upload_path'] . $fileinfo->filename)) {
                    // echo "Удаляем старый файл " . $color_file_config['upload_path'] . $fileinfo->filename . "<br>";
                    unlink($color_file_config['upload_path'] . $fileinfo->filename);
                }
            }

            $result['flag'] = 'success';
            $result['data'] = $data['upload_data']['file_name'];
        }

        return $result;
    }




}