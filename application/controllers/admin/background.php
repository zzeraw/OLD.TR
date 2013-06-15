<?php
/**
 * Класс-контроллер для работы с фоновыми изображениями - удаление, редактирование, создание.
 *
 * @package admin
 */

class Background extends Admin_Controller
{

    /**
     * Конструктор класса загружает нужную модель для работы с фонами.
     */
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('background_model');
    }


    public function index ()
    {
        // Находим все записи в базе
        $this->data['backgrounds'] = $this->background_model->get();

        // Загружаем вид
        $this->data['subview'] = 'admin/background/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Set up the form
        $rules = $this->background_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {

            $data = $this->background_model->array_from_post(array(
                'title'
            ));

            if ($_FILES['filename']['size'] != 0) {
                $fileinfo = $this->background_model->save_file($id);
                if ($fileinfo['flag'] === 'success') {
                    $data['filename'] = $fileinfo['data'];
                } else {
                    $this->data['errors'][] = $fileinfo['data'];
                }
            }

            // echo "Данные для вставки в БД:";
            // var_dump($data);

            $last_id = $this->background_model->save($data, $id);
            redirect('admin/background');

            if ($id === NULL) {
                redirect('admin/background/edit/' . $last_id);
            }
        }

        // Fetch a background or set a new one
        if ($id) {
            $this->data['background'] = $this->background_model->get($id);
            count($this->data['background']) || $this->data['errors'][] = 'background could not be found';
        }
        else {
            $this->data['background'] = $this->background_model->get_new();
        }

        // Load the view
        $this->data['subview'] = 'admin/background/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/background/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->background_model->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['backgrounds'] = $this->background_model->get();

        // // Load view
        $this->load->view('admin/background/order_ajax', $this->data);
    }


    public function delete ($id)
    {
        $this->background_model->delete($id);
        redirect('admin/background');
    }

}