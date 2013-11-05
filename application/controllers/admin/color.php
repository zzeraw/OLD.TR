<?php
class Color extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('color_model');
    }

    public function index ()
    {
        // Fetch all colors
        $this->data['colors'] = $this->color_model->get();

        // Load view
        $this->data['subview'] = 'admin/color/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Set up the form
        $rules = $this->color_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            $data = $this->color_model->array_from_post(array(
                'title'
            ));


            if ($_FILES['filename']['size'] != 0) {
                $fileinfo = $this->color_model->save_file($id);
                if ($fileinfo['flag'] === 'success') {
                    $data['filename'] = $fileinfo['data'];
                } else {
                    $this->data['errors'][] = $fileinfo['data'];
                }
            }

            // echo "Данные для вставки в БД:";
            // var_dump($data);

            $last_id = $this->color_model->save($data, $id);
            redirect('admin/color');

            if ($id === NULL) {
                redirect('admin/color/edit/' . $last_id);
            }
        }

        // Fetch a color or set a new one
        if ($id) {
            $this->data['color'] = $this->color_model->get($id);
            count($this->data['color']) || $this->data['errors'][] = 'color could not be found';
        }
        else {
            $this->data['color'] = $this->color_model->get_new();
        }

        // Load the view
        $this->data['subview'] = 'admin/color/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/color/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->color_model->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['colors'] = $this->color_model->get();

        // // Load view
        $this->load->view('admin/color/order_ajax', $this->data);
    }


    public function delete ($id)
    {
        $this->color_model->delete($id);
        redirect('admin/color');
    }

}