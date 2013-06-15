<?php
class Collection extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('collection_model');
    }

    public function index ()
    {
        // Fetch all collections
        $this->data['collections'] = $this->collection_model->get();

        // Load view
        $this->data['subview'] = 'admin/collection/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a collection or set a new one
        if ($id) {
            $this->data['collection'] = $this->collection_model->get($id);
            count($this->data['collection']) || $this->data['errors'][] = 'collection could not be found';
        }
        else {
            $this->data['collection'] = $this->collection_model->get_new();
        }

        // Set up the form
        $rules = $this->collection_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->collection_model->array_from_post(array(
                'title',
                'slug',
                'body',
                'meta_title',
                'meta_keywords',
                'meta_description'
            ));
            $this->collection_model->save($data, $id);
            redirect('admin/collection');
        }

        // Load the view
        $this->data['subview'] = 'admin/collection/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/collection/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->collection_model->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['collections'] = $this->collection_model->get();

        // // Load view
        $this->load->view('admin/collection/order_ajax', $this->data);
    }


    public function delete ($id)
    {
        $this->collection_model->delete($id);
        redirect('admin/collection');
    }

}