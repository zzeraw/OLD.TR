<?php
class Banner extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('banner_model');
    }

    public function index ()
    {
        // Fetch all banners
        $this->data['banners'] = $this->banner_model->get();

        // Load view
        $this->data['subview'] = 'admin/banner/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Set up the form
        $rules = $this->banner_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            $data = $this->banner_model->array_from_post(array(
                'title',
                'link'
            ));

            if ($_FILES['filename']['size'] != 0) {
                $fileinfo = $this->banner_model->save_file($id);
                if ($fileinfo['flag'] === 'success') {
                    $data['filename'] = $fileinfo['data'];
                } else {
                    $this->data['errors'][] = $fileinfo['data'];
                }
            }

            // echo "Данные для вставки в БД:";

            $last_id = $this->banner_model->save($data, $id);
            redirect('admin/banner');

            if ($id === NULL) {
                redirect('admin/banner/edit/' . $last_id);
            }
        }

        // Fetch a banner or set a new one
        if ($id) {
            $this->data['banner'] = $this->banner_model->get($id);
            count($this->data['banner']) || $this->data['errors'][] = 'banner could not be found';
        }
        else {
            $this->data['banner'] = $this->banner_model->get_new();
        }

        // Load the view
        $this->data['subview'] = 'admin/banner/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/banner/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->banner_model->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['banners'] = $this->banner_model->get();

        // // Load view
        $this->load->view('admin/banner/order_ajax', $this->data);
    }


    public function delete ($id)
    {
        $this->banner_model->delete($id);
        redirect('admin/banner');
    }

}