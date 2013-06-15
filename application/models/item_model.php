<?php
class Item_Model extends MY_Model
{
    protected $_table_name = 'c_items';
    protected $_order_by   = 'order';
    protected $_timestamps = FALSE;
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Название',
            'rules' => 'trim|required|max_length[256]|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Содержимое',
            'rules' => 'trim'
        ),
        'article' => array(
            'field' => 'article',
            'label' => 'Артикул',
            'rules' => 'trim|max_length[32]'
        ),
        'composition' => array(
            'field' => 'composition',
            'label' => 'Состав',
            'rules' => 'trim|max_length[128]'
        ),
        'price' => array(
            'field' => 'price',
            'label' => 'Цена',
            'rules' => 'trim|required|max_length[32]'
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
        ),

// ----------------+-+-+-+-+-

        'exist_color' => array(
            'field' => 'exist_color[]',
            'label' => 'Цвет',
            'rules' => ''
        ),

        'new_color' => array(
            'field' => 'new_color[]',
            'label' => 'Цвет',
            'rules' => 'trim|integer|max_length[11]'
        ),

        'size' => array(
            'field' => 'size[]',
            'label' => 'Размер',
            'rules' => 'trim'
        ),

        'new_size' => array(
            'field' => 'new_size[]',
            'label' => 'Размер',
            'rules' => 'trim'
        ),

        'group' => array(
            'field' => 'group[]',
            'label' => 'Группы',
            'rules' => 'trim|integer|max_length[11]'
        ),

        'collection' => array(
            'field' => 'collection[]',
            'label' => 'Коллекции',
            'rules' => 'trim|integer|max_length[11]'
        ),

        'new_group' => array(
            'field' => 'new_group[]',
            'label' => 'Группы',
            'rules' => 'trim|integer|max_length[11]'
        ),

        'new_collection' => array(
            'field' => 'new_collection[]',
            'label' => 'Коллекции',
            'rules' => 'trim|integer|max_length[11]'
        ),

// ----------------+-+-+-+-+-

        'remove_exist_color' => array(
            'field' => 'remove_exist_color[]',
            'label' => '',
            'rules' => 'trim|integer|max_length[11]'
        ),

        'remove_exist_image' => array(
            'field' => 'remove_exist_image[]',
            'label' => '',
            'rules' => 'trim|integer|max_length[11]'
        ),

        'remove_exist_group' => array(
            'field' => 'remove_exist_group[]',
            'label' => '',
            'rules' => 'trim|integer|max_length[11]'
        ),

        'remove_exist_collection' => array(
            'field' => 'remove_exist_collection[]',
            'label' => '',
            'rules' => 'trim|integer|max_length[11]'
        )
    );

    public $color_file_upload_config = array(
                    'upload_path'   => './uploads/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'overwrite'     => TRUE
            );

    public $color_file_resize_config = array(
                    'image_library'  => 'gd2',
                    'maintain_ratio' => TRUE,
                    'master_dim'     => 'width',
                    'width'          => 642,
                    'height'         => 980
            );

    public $color_thumb_resize_config = array(
                    'image_library'  => 'gd2',
                    'maintain_ratio' => TRUE,
                    'master_dim'     => 'width',
                    'width'          => 336,
                    'height'         => 512
            );

    public function get_new ()
    {
        $item                   = new stdClass();
        $item->title            = '';
        // $item->slug          = '';
        $item->body             = '';
        $item->article          = '';
        $item->composition      = '';
        $item->price            = '';
        $item->meta_title       = '';
        $item->meta_keywords    = '';
        $item->meta_description = '';

        return $item;
    }

    public function save_file($item_id, $color_id, $image_id, $fieldname) {

        $this->color_file_upload_config['file_name'] = 'catalog_' . $item_id . '_' . $color_id . '_' . $image_id;
        $this->upload->initialize($this->color_file_upload_config);

        // записываем картинку

        if ( ! $this->upload->do_upload($fieldname)) {
            $result['flag'] = 'error';
            $result['data'][] = $this->upload->display_errors();
        } else {
            $result = array('upload_data' => $this->upload->data());

            // меняем ее размеры
            $this->color_file_resize_config['create_thumb'] = FALSE;
            $this->color_file_resize_config['new_image']    = FALSE;
            $this->color_file_resize_config['source_image'] = './uploads/' . $result['upload_data']['file_name'];
            $this->image_lib->initialize($this->color_file_resize_config);
            if ( ! $this->image_lib->resize()) {
                $result['flag'] = 'error';
                $result['data'][] = $this->image_lib->display_errors();
            } else {
                $result['flag'] = 'success';
                $result['filename'] = $result['upload_data']['file_name'];
            }

            // создаем уменьшенную копию картинки
            $this->color_thumb_resize_config['create_thumb'] = FALSE;
            $this->color_thumb_resize_config['source_image'] = './uploads/' . $result['upload_data']['file_name'];
            $this->color_thumb_resize_config['new_image']    = './uploads/' . $result['upload_data']['raw_name'] . '_thumb' . $result['upload_data']['file_ext'];
            $this->image_lib->initialize($this->color_thumb_resize_config);
            if ( ! $this->image_lib->resize()) {
                $result['flag'] = 'error';
                $result['data'][] = $this->image_lib->display_errors();
            } else {
                $result['flag'] = 'success';
                $result['filename'] = $result['upload_data']['file_name'];
                $result['thumb'] = $result['upload_data']['raw_name'] . '_thumb' . $result['upload_data']['file_ext'];
            }
        }
        return $result;
    }

    public function save($data, $id = NULL) {

        // var_dump($data);
        // var_dump($_FILES);

        if (count($_FILES)) {
            $this->load->library('upload', $this->color_file_upload_config);
            $this->load->library('image_lib', $this->color_file_resize_config);
        }

        if ($id === NULL) {

        // ++СОЗДАНИЕ ТОВАРА++
            // создание основных элементов
            $this->_table_name = 'c_items';
            $item_last_id = parent::save($data['common']);

            if (!isset($item_last_id)) {
                return FALSE;
            }

            // СОЗДАНИЕ ДОБАВЛЕННЫХ ЭЛЕМЕНТОВ
            // создание групп
            $fields = array('group', 'new_group');
            $this->_table_name = 'c_groups_links';
            foreach ($fields as $field) {
                if ($data['groups'][$field]!=FALSE) {
                    foreach ($data['groups'][$field] as $group) {
                        parent::save(array('id_item' => $item_last_id, 'id_group' => $group));
                    }
                }
            }

            // создание коллекций
            $fields = array('collection', 'new_collection');
            $this->_table_name = 'c_collections_links';
            foreach ($fields as $field) {
                if ($data['collections'][$field]!=FALSE) {
                    foreach ($data['collections'][$field] as $collection) {
                        parent::save(array('id_item' => $item_last_id, 'id_collection' => $collection));
                    }
                }
            }

            if (count($data['colors']['new_color'])) {
                foreach ($data['colors']['new_color'] as $color_key => $color_value) {
                    $this->_table_name = 'c_colors';
                    $color_last_id = parent::save(array('id_c_item' => $item_last_id, 'id_color' => $color_value));

                    // создание размеров
                    $sizes = $this->explodeSizes($data['sizes']['new_size'][$color_key]);

                    foreach ($sizes as $size) {
                        $this->_primary_key = 'id';
                        $this->_table_name = 'c_sizes';

                        parent::save(array('id_c_item' => $item_last_id, 'id_c_color' => $color_last_id, 'size' => $size));
                    }
                    // добавление изображений
                    foreach ($_FILES as $fieldname => $fieldvalue) {
                        $fieldname_parts = explode('_', $fieldname);
                        if (($fieldname_parts[0] . '_' . $fieldname_parts[1] =='new_image') && ($color_key == $fieldname_parts[2])) {
                            $color_id = $fieldname_parts[2];
                            $image_id = $fieldname_parts[3];
                            $result = $this->save_file($item_last_id, $color_last_id, $image_id, $fieldname);
                            // var_dump($result);
                            if ($result['flag']=='success') {
                                // заносим данные о картинке в базу
                                $this->_table_name = 'c_images';
                                // var_dump(array('id_c_color' => $color_last_id, 'id_c_item' => $item_last_id, 'filename' => $result['filename'], 'thumb' => $result['thumb']));
                                parent::save(array('id_c_color' => $color_last_id, 'id_c_item' => $item_last_id, 'filename' => $result['filename'], 'thumb' => $result['thumb']));
                            } elseif ($result['flag']=='error') {
                                $this->session->set_flashdata('error', $result['data']);
                            }
                        }
                    }
                }
            }

            return $item_last_id;

        } else {

        // ++РЕДАКТИРОВАНИЕ ТОВАРА++
            // УДАЛЕНИЕ ЭЛЕМЕНТОВ
            // удаляем товар определенного цвета, следовательно - размеры и изображения этого товара
            if (!empty($data['remove']['remove_exist_color'])) {
                foreach ($data['remove']['remove_exist_color'] as $id_color) {
                    if (isset($id_color)) {
                        $this->_primary_key = 'id';
                        $this->_table_name = self::DB_C_COLORS;
                        parent::delete($id_color);

                        $this->delete_sizes_of_color($id_color);
                        $this->delete_images_of_color($id_color);
                    }
                }
            }
            // удаляем изображения
            if (!empty($data['remove']['remove_exist_image'])) {
                foreach ($data['remove']['remove_exist_image'] as $id_image) {
                    if (isset($id_image)) {
                        $this->_primary_key = 'id';
                        $this->_table_name = 'c_images';

                        $image = $this->get($id_image, TRUE);

                        if (!count($image)) {
                            continue;
                        }

                        !file_exists('./uploads/' . $image->filename) || unlink('./uploads/' . $image->filename);
                        !file_exists('./uploads/' . $image->thumb) || unlink('./uploads/' . $image->thumb);

                        parent::delete($id_image);
                    }
                }
            }
            // удаляем группы
            if (!empty($data['remove']['remove_exist_group'])) {
                foreach ($data['remove']['remove_exist_group'] as $id_group) {
                    if (isset($id_group)) {
                        $this->_table_name = 'c_groups_links';
                        parent::delete($id_group);
                    }
                }
            }
            // удаляем коллекции
            if (!empty($data['remove']['remove_exist_collection'])) {
                foreach ($data['remove']['remove_exist_collection'] as $id_collection) {
                    if (isset($id_collection)) {
                        $this->_table_name = 'c_collections_links';
                        parent::delete($id_collection);
                    }
                }
            }

            // ИЗМЕНЕНИЕ СУЩЕСТВУЮЩИХ ЭЛЕМЕНТОВ
            // изменяем основную информацию
            $this->_table_name = 'c_items';
            $this->_primary_key = 'id';
            parent::save($data['common'], $id);

            // изменяем существующие группы
            foreach ($data['groups']['group'] as $group_id => $group_value) {
                $this->_table_name = 'c_groups_links';
                $this->_primary_key = 'id';
                parent::save(array('id_group' => $group_value), $group_id);
            }

            // изменяем существующие коллекции
            foreach ($data['collections']['collection'] as $collection_id => $collection_value) {
                $this->_table_name = 'c_collections_links';
                $this->_primary_key = 'id';
                parent::save(array('id_collection' => $collection_value), $collection_id);
            }

            // изменяем цвет
            foreach ($data['colors']['exist_color'] as $color_id => $color_value) {
                $this->_table_name = 'c_colors';
                $this->_primary_key = 'id';
                parent::save(array('id_color' => $color_value), $color_id);
            }

            // изменяем размеры
            foreach ($data['sizes']['size'] as $color_id => $size_values) {
                $sizes = $this->explodeSizes($size_values);

                $this->_table_name = 'c_sizes';
                $this->_primary_key = 'id_c_color';
                parent::delete($color_id, TRUE);

                foreach ($sizes as $size) {
                    $this->_primary_key = 'id';
                    $this->_table_name = 'c_sizes';

                    if (empty($size)) {
                        continue;
                    }

                    parent::save(array('id_c_item' => $id, 'id_c_color' => $color_id, 'size' => $size));
                }
            }

            // добавление изображений в существующий цвет
            foreach ($_FILES as $fieldname => $fieldvalue) {
                $fieldname_parts = explode('_', $fieldname);
                if ($fieldname_parts[0]=='image') {
                    $color_id = $fieldname_parts[1];
                    $image_id = $fieldname_parts[2];
                    $result = $this->save_file($id, $color_id, $image_id, $fieldname);
                    if ($result['flag']=='success') {
                        // заносим данные о картинке в базу
                        $this->_table_name = 'c_images';
                        parent::save(array('id_c_color' => $color_id, 'id_c_item' => $id, 'filename' => $result['filename'], 'thumb' => $result['thumb']));
                    } elseif ($result['flag']=='error') {
                        $this->session->set_flashdata('error', $result['data']);
                    }
                }
            }


            // ДОБАВЛЕНИЕ НОВЫХ ЭЛЕМЕНТОВ
            // добавление цвета
            if (!empty($data['colors']['new_color'])) {
                foreach ($data['colors']['new_color'] as $new_color_key => $color_value) {
                    $this->_primary_key = 'id';
                    $this->_table_name = 'c_colors';
                    $last_color_id = parent::save(array('id_c_item' => $id, 'id_color' => $color_value));

                    // добавление размеров цвета
                    $sizes = $this->explodeSizes($data['sizes']['new_size'][$new_color_key]);

                    foreach ($sizes as $size) {
                        $this->_primary_key = 'id';
                        $this->_table_name = 'c_sizes';

                        parent::save(array('id_c_item' => $id, 'id_c_color' => $last_color_id, 'size' => $size));
                    }

                    foreach ($_FILES as $fieldname => $fieldvalue) {
                        $fieldname_parts = explode('_', $fieldname);
                        if (($fieldname_parts[0] . '_' . $fieldname_parts[1] =='new_image') && ($new_color_key == $fieldname_parts[2])) {
                            $color_id = $fieldname_parts[2];
                            $image_id = $fieldname_parts[3];
                            $result = $this->save_file($id, $last_color_id, $image_id, $fieldname);
                            if ($result['flag']=='success') {
                                // заносим данные о картинке в базу
                                $this->_table_name = 'c_images';
                                parent::save(array('id_c_color' => $last_color_id, 'id_c_item' => $id, 'filename' => $result['filename'], 'thumb' => $result['thumb']));
                            } elseif ($result['flag']=='error') {
                                $this->session->set_flashdata('error', $result['data']);
                            }
                        }
                    }
                }
            }
            // добавление групп
            if (!empty($data['groups']['new_group'])) {
                foreach ($data['groups']['new_group'] as $group_id => $group_value) {
                    $this->_table_name = 'c_groups_links';
                    $this->_primary_key = 'id';
                    parent::save(array('id_item' => $id, 'id_group' => $group_value));
                }
            }
            // добавление коллекций
            if (!empty($data['collections']['new_collection'])) {
                foreach ($data['collections']['new_collection'] as $collection_id => $collection_value) {
                    $this->_table_name = 'c_collections_links';
                    $this->_primary_key = 'id';
                    parent::save(array('id_item' => $id, 'id_collection' => $collection_value));
                }
            }
            return $id;
        }
    }


    public function explodeSizes($size_values) {
        // заменяем запятые на пробелы
        $size_values = str_replace(',', ' ', $size_values);
        // избавляемся от двойных пробелов
        while (strpos($size_values, '  ') !== FALSE) {
            $size_values = str_replace('  ',' ',$size_values);
        }
        // избавляемся от ведущих и последних пробелов
        $size_values = trim($size_values);
        $sizes = explode(' ', $size_values);

        return $sizes;
    }

    public function delete($id) {

        $this->_order_by = 'id';

        $this->delete_color_of_item($id);
        $this->delete_size_of_item($id);
        $this->delete_image_of_item($id);
        $this->delete_group_of_item($id);
        $this->delete_collection_of_item($id);


        $this->_table_name = 'c_items';
        $this->_primary_key = 'id';
        parent::delete($id);
    }

    public function delete_color_of_item($id_item) {
        $this->_table_name = 'c_colors';
        $this->_primary_key = 'id_c_item';

        parent::delete($id_item, TRUE);
    }

    public function delete_size_of_item($id_item) {
        $this->_table_name = 'c_sizes';
        $this->_primary_key = 'id_c_item';

        parent::delete($id_item, TRUE);
    }

    public function delete_image_of_item($id_item) {
        $this->_table_name = 'c_images';
        $this->_primary_key = 'id';

        $images = $this->get_by(array('id_c_item' => $id_item));
        // echo $this->db->last_query();
        // var_dump($images);
        foreach ($images as $image) {
            // var_dump($image);
            !file_exists('./uploads/' . $image->filename) || unlink('./uploads/' . $image->filename);
            !file_exists('./uploads/' . $image->thumb) || unlink('./uploads/' . $image->thumb);
        }

        $this->_primary_key = 'id_c_item';
        parent::delete($id_item, TRUE);
    }

    public function delete_group_of_item($id_item) {
        $this->_table_name = 'c_groups_links';
        $this->_primary_key = 'id_item';

        parent::delete($id_item, TRUE);
    }

    public function delete_collection_of_item($id_item) {
        $this->_table_name = 'c_collections_links';
        $this->_primary_key = 'id_item';

        parent::delete($id_item, TRUE);
    }



    public function delete_sizes_of_color($id_color) {
        $this->_table_name = self::DB_C_SIZES;
        $this->_primary_key = 'id_c_color';

        parent::delete($id_color, TRUE);
    }
    public function delete_images_of_color($id_color) {
        $this->_table_name = self::DB_C_IMAGES;
        $this->_primary_key = 'id_c_color';

        $images = $this->get_by(array('id_c_color' => $id_color));
        // echo $this->db->last_query();
        // var_dump($images);
        foreach ($images as $image) {
            // var_dump($image);
            !file_exists('./uploads/' . $image->filename) || unlink('./uploads/' . $image->filename);
            !file_exists('./uploads/' . $image->thumb) || unlink('./uploads/' . $image->thumb);
        }
        parent::delete($id_color, TRUE);
    }





    public function save_order ($items)
    {
        if (count($items)) {
            foreach ($items as $order => $item) {
                if ($item['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $item['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function get_colors() {
        $colors[0] = new stdClass();
        $colors[0]->id = NULL;
        $colors[0]->id_color = NULL;

        return $colors;
    }

    public function get_sizes() {
        $sizes[0] = new stdClass();
        $sizes[0]->id = NULL;

        return $sizes;
    }

    public function get_images() {
        $images[0] = new stdClass();
        $images[0]->id = 0;

        return $images;
    }

    public function get_thumb_items_pairs() {
        $this->_table_name = 'c_images';
        $this->_order_by = 'id';

        // Fetch images
        $this->db->select('id_c_item, thumb');
        $this->db->group_by('id_c_item');

        $images = $this->get();

        // Return key => value pair array
        $array = array();
        if (count($images)) {
            foreach ($images as $image) {
                $array[$image->id_c_item] = $image->thumb;
            }
        }

        return $array;
    }

    public function get_colors_of_item($item) {
        // $this->db->from('c_colors');

        $this->_table_name = 'c_colors';
        $this->_order_by = 'id';

        return $this->get_by(array('id_c_item' => $item));
    }

    public function get_sizes_of_item($item) {
        // $this->db->from('c_colors');

        $this->_table_name = 'c_sizes';
        $this->_order_by = 'size';

        $sizes = $this->get_by(array('id_c_item' => $item));

        $array = array();

        if (count($sizes)) {
            foreach ($sizes as $size) {
                $array[$size->id_c_color][] = array('id' => $size->id, 'size' => $size->size);
            }
        }

        return $array;
    }

    public function get_images_of_item($item) {

        $this->db->where('id_c_item', $item);
        $this->db->order_by('filename');

        $images = $this->db->get('c_images')->result();

        $array = array();

        if (count($images)) {
            foreach ($images as $image) {
                $array[$image->id_c_color][] = array('id' => $image->id, 'filename' => $image->filename, 'thumb' => $image->thumb);
            }
        }

        return $array;
    }

    public function get_items_by_collection($slug = FALSE) {

        $this->db->select('i.*');
        $this->db->from('c_items i');
        $this->db->join('c_collections_links cl', 'cl.id_item = i.id', 'left');
        $this->db->join('c_collections c', 'c.id = cl.id_collection', 'left');

        if ($slug == FALSE) {
            $this->db->where('c.id IS NOT NULL');
        } else {
            $this->db->where('c.slug', $slug);
        }

        $this->db->order_by('i.order');
        return $this->db->get()->result();
    }

    public function get_items_by_group($slug) {

        $this->db->select('i.*');
        $this->db->from('c_items i');
        $this->db->join('c_groups_links gl', 'gl.id_item = i.id', 'left');
        $this->db->join('c_groups g', 'g.id = gl.id_group', 'left');

        $this->db->where('g.slug', $slug);

        $this->db->order_by('i.order');

        return $this->db->get()->result();

    }

    public function get_color_title_by_c_color_id($id) {
        // select c.title FROM colors c LEFT JOIN c_colors cc ON (c.id = cc.id_color) WHERE (cc.id = 67)

        $this->db->select('c.title');
        $this->db->from('colors c');
        $this->db->join('c_colors cc', 'c.id = cc.id_color', 'left');

        $this->db->where('cc.id', $id);

        return $this->db->get()->row();
    }

}
