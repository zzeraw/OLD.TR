<?php
class Group extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('group_model');
    }

    public function index ()
    {
        // Fetch all groups
        $this->data['groups'] = $this->group_model->get();

        // Load view
        $this->data['subview'] = 'admin/group/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a group or set a new one
        if ($id) {
            $this->data['group'] = $this->group_model->get($id);
            count($this->data['group']) || $this->data['errors'][] = 'group could not be found';
        }
        else {
            $this->data['group'] = $this->group_model->get_new();
        }

        // Set up the form
        $rules = $this->group_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->group_model->array_from_post(array(
                'title',
                'slug',
                'body',
                'meta_title',
                'meta_keywords',
                'meta_description'
            ));
            $this->group_model->save($data, $id);
            redirect('admin/group');
        }

        // Load the view
        $this->data['subview'] = 'admin/group/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/group/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->group_model->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['groups'] = $this->group_model->get();

        // // Load view
        $this->load->view('admin/group/order_ajax', $this->data);
    }


    public function delete ($id)
    {
        $this->group_model->delete($id);
        redirect('admin/group');
    }



}