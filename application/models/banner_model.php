<?php
class Banner_Model extends MY_Model
{
    protected $_table_name = 'banners';
    protected $_order_by = 'order';
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Название',
            'rules' => 'trim|required|max_length[64]|xss_clean'
        ),
        'link' => array(
            'field' => 'link',
            'label' => 'Ссылка',
            'rules' => 'trim|xss_clean'
        )
    );

    public function get_new ()
    {
        $banner = new stdClass();
        $banner->title = '';
        $banner->link  = '';

        return $banner;
    }

    public function save_order ($banners)
    {
        if (count($banners)) {
            foreach ($banners as $order => $banner) {
                if ($banner['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $banner['item_id'])->update($this->_table_name);
                }
            }
        }
    }


    public function save_file($id = NULL) {

        $banner_file_config['upload_path'] = './uploads/banners/';
        $banner_file_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $banner_file_config['file_name'] = sha1(time());


        $this->load->library('upload', $banner_file_config);

        if ( ! $this->upload->do_upload('filename')) {

            $result['flag'] = 'error';
            $result['data'] = $this->upload->display_errors();

        } else {
            $data = array('upload_data' => $this->upload->data());
            // echo "Создан новый файл " . $banner_file_config['upload_path'] . $data['upload_data']['file_name'] . "<br>";

            if ($id === NULL) { } else {
                $fileinfo = $this->get($id, TRUE);
                if (file_exists($banner_file_config['upload_path'] . $fileinfo->filename)) {
                    // echo "Удаляем старый файл " . $banner_file_config['upload_path'] . $fileinfo->filename . "<br>";
                    unlink($banner_file_config['upload_path'] . $fileinfo->filename);
                }
            }

            $result['flag'] = 'success';
            $result['data'] = $data['upload_data']['file_name'];
        }

        return $result;
    }




}