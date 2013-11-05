<?php
class Section extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('section_model');
    }

    public function index ()
    {
        // Fetch all sections
        $this->data['sections'] = $this->section_model->get();

        // Load view
        $this->data['subview'] = 'admin/section/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a section or set a new one
        if ($id) {
            $this->data['section'] = $this->section_model->get($id);
            count($this->data['section']) || $this->data['errors'][] = 'section could not be found';
        }


        // Set up the form
        $rules = $this->section_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->section_model->array_from_post(array(
                'title',
                'slug',
                'body',
                'meta_title',
                'meta_keywords',
                'meta_description'
            ));
            $this->section_model->save($data, $id);
            redirect('admin/section');
        }

        // Load the view
        $this->data['subview'] = 'admin/section/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/section/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->section_model->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['sections'] = $this->section_model->get();

        // // Load view
        $this->load->view('admin/section/order_ajax', $this->data);
    }


    public function delete ($id)
    {
        $this->section_model->delete($id);
        redirect('admin/section');
    }

}