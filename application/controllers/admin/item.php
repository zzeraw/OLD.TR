<?php
class Item extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('item_model');
        $this->load->model('collection_model');
        $this->load->model('group_model');
        $this->load->model('image_model');
        $this->load->model('color_model');
    }

    public function index ()
    {
        // Fetch all items
        $this->data['items'] = $this->item_model->get();
        $this->data['images'] = $this->item_model->get_thumb_items_pairs();

        // var_dump($this->data['items']);

        // Load view
        $this->data['subview'] = 'admin/item/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a item or set a new one
        // $this->data['groups'] = array();
        if ($id) {
            $this->data['item'] = $this->item_model->get($id);
            $this->data['groups'] = $this->group_model->get_groups($id);
            $this->data['collections'] = $this->collection_model->get_collections($id);
            $this->data['colors'] = $this->item_model->get_colors_of_item($id);

            $this->data['sizes'] = $this->item_model->get_sizes_of_item($id);
            $this->data['images'] = $this->item_model->get_images_of_item($id);

            count($this->data['item']) || $this->data['errors'][] = 'item could not be found';
        }
        else {
            $this->data['item'] = $this->item_model->get_new();
            $this->data['groups'] = $this->group_model->get_groups();
            $this->data['collections'] = $this->collection_model->get_collections();
            $this->data['colors'] = $this->item_model->get_colors();

            $this->data['sizes'] = $this->item_model->get_sizes();
            $this->data['images'] = $this->item_model->get_images();
        }

        // Groups & Collections for dropdown
        $this->data['groups_list'] = $this->group_model->get_pairs();
        $this->data['collections_list'] = $this->collection_model->get_pairs();
        $this->data['colors_list'] = $this->color_model->get();

        // Set up the form
        $rules = $this->item_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            $data['groups'] = $this->item_model->array_from_post(array(
                'group',
                'new_group'
            ));

            $data['collections'] = $this->item_model->array_from_post(array(
                'collection',
                'new_collection'
            ));

            $data['colors'] = $this->item_model->array_from_post(array(
                'exist_color',
                'new_color'
            ));

            $data['sizes'] = $this->item_model->array_from_post(array(
                'size',
                'new_size'
            ));

            $data['common'] = $this->item_model->array_from_post(array(
                'title',
                'body',
                'article',
                'composition',
                'price',
                'meta_title',
                'meta_keywords',
                'meta_description'
            ));

            $data['remove'] = $this->item_model->array_from_post(array(
                'remove_exist_color',
                'remove_exist_image',
                'remove_exist_group',
                'remove_exist_collection'
            ));

            // var_dump($data);
            $this->item_model->save($data, $id);
            redirect('admin/item');
        }

        // Load the view
        $this->data['subview'] = 'admin/item/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/item/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->item_model->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['items'] = $this->item_model->get();
        $this->data['images'] = $this->item_model->get_thumb_items_pairs();

        // // Load view
        $this->load->view('admin/item/order_ajax', $this->data);
    }


    public function delete ($id)
    {
        // $images = $this->image_model->get_by(array('id_c_item' => $id));
        $this->item_model->delete($id);

        // if () {
        //     foreach ($images as $image) {
        //         !file_exists($image->filename) || unlink('./uploads/' . $image->filename);
        //         !file_exists($image->thumb) || unlink('./uploads/' . $image->thumb);
        //     }
        // }
        redirect('admin/item');
    }

}
