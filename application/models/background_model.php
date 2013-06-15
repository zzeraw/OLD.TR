<?php
class Background_Model extends MY_Model
{
    protected $_table_name = 'backgrounds';
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
        $background = new stdClass();
        $background->title = '';

        return $background;
    }

    public function save_order ($backgrounds)
    {
        if (count($backgrounds)) {
            foreach ($backgrounds as $order => $background) {
                if ($background['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $background['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function save_file($id = NULL) {

        $background_file_config['upload_path'] = './uploads/backgrounds/';
        $background_file_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $background_file_config['file_name'] = sha1(time());

        $this->load->library('upload', $background_file_config);

        if ( ! $this->upload->do_upload('filename')) {

            $result['flag'] = 'error';
            $result['data'] = $this->upload->display_errors();

        } else {
            $data = array('upload_data' => $this->upload->data());
            // echo "Создан новый файл " . $background_file_config['upload_path'] . $data['upload_data']['file_name'] . "<br>";

            if ($id === NULL) { } else {
                $fileinfo = $this->get($id, TRUE);
                if (file_exists($background_file_config['upload_path'] . $fileinfo->filename)) {
                    // echo "Удаляем старый файл " . $background_file_config['upload_path'] . $fileinfo->filename . "<br>";
                    unlink($background_file_config['upload_path'] . $fileinfo->filename);
                }
            }

            $result['flag'] = 'success';
            $result['data'] = $data['upload_data']['file_name'];
        }

        return $result;
    }




}