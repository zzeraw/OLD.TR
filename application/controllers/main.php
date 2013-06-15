<?php

class Main extends Frontend_Controller {

    public function __construct(){
        parent::__construct();

        $this->data['breadcrumbs'] = array();
        $this->data['recent_items'] = array();

        $this->get_last_modified();
    }

    public function index() {

        switch ($this->main_model->getControllerBySlug($this->uri->segment(1))) {
            case 'homepage' :
                $this->_homepage();
                break;
            case 'all':

                break;
            case 'group':
                $this->_item('group', $this->uri->segment(1), $this->uri->segment(2));
                break;
            case 'collections':
                $this->_item('collections', $this->uri->segment(1), $this->uri->segment(2));
                break;
            case 'collection':
                $this->_item('collection', $this->uri->segment(1), $this->uri->segment(2));
                break;
            case 'section':
                $this->_section($this->uri->segment(1));
                break;
            default:
                show_404(current_url());
                break;
        }

        $this->load->view('_main_layout', $this->data);
    }

    public function _item($type, $slug, $id = FALSE) {

        $this->load->model('item_model');
        $this->load->model('color_model');

        $this->data['breadcrumbs'][0] = array(site_url('catalog'), 'Каталог');

        // $this->session->unset_userdata('recent_items');

        $recent_items = $this->session->userdata('recent_items');
        if (!empty($recent_items)) {
            // $recent_items = array_reverse($recent_items);
            foreach ($recent_items as $item) {
                $this->data['recent_items'][]  = $this->item_model->get($item, TRUE);
                $this->data['recent_images'][] = $this->item_model->get_images_of_item($item);
            }

        }

        if ($id) {
            $this->data['meta'] = $this->get_meta($id);

            $category = $this->main_model->getTitleBySlug($slug);
            $item     = $this->main_model->getTitleBySlug($id);

            $this->data['breadcrumbs'][0] = array(site_url($slug), $category->title);
            $this->data['breadcrumbs'][1] = array(site_url($slug . '/' . $id), $item->title);

            $this->data['item']        = $this->item_model->get($id);
            $this->data['groups']      = $this->group_model->get_groups($id);
            $this->data['collections'] = $this->collection_model->get_collections($id);
            $this->data['colors']      = $this->item_model->get_colors_of_item($id);

            $this->data['sizes']       = $this->item_model->get_sizes_of_item($id);
            $this->data['images']      = $this->item_model->get_images_of_item($id);

            $this->data['colors_list'] = $this->color_model->get();

            $this->data['subview'] = 'item';

            $this->load->model('order_model');
            $rules = $this->order_model->rules;
            $this->form_validation->set_rules($rules);

            // Process the form
            if ($this->form_validation->run() == TRUE) {
                $data = $this->order_model->array_from_post(array(
                    'fio',
                    'email',
                    'phone',
                    'comment',
                    'size',
                    'color'
                ));
                $data['item'] = $id;
                $data['ip'] = $this->input->ip_address() . ' ' . $this->input->user_agent();

                if ($this->order_model->save($data)) {
                    $order['color'] = $this->item_model->get_color_title_by_c_color_id($this->input->post('color'));
                    $order['size'] = $this->input->post('size');

                    $message = "Поступил заказ: <br/>";
                    $message .= "<br/>";
                    $message .= "<b>Товар: </b><a href='" . site_url($slug . '/' . $id) . "'>" . $this->data['item']->title . "</a><br/>";
                    $message .= "<b>Артикул: </b>" . $this->data['item']->article . "<br/>";
                    $message .= "<b>Цена: </b>" . $this->data['item']->price . " руб.<br/>";
                    $message .= "<b>Цвет: </b>" . $order['color']->title . "<br/>";
                    $message .= "<b>Размер: </b>" . $order['size'] . "<br/>";
                    $message .= "<br/>";
                    $message .= "<b>ФИО: </b>" . $this->input->post('fio') . "<br/>";
                    $message .= "<b>Телефон: </b>" . $this->input->post('phone') . "<br/>";
                    $message .= "<b>Email: </b>" . $this->input->post('email') . "<br/>";
                    $message .= "<b>Комментарий</b>: " . nl2br($this->input->post('comment')) . "<br/>";
                    $message .= "<b>Дата и время: </b>" . date('d.m.Y H:i:s') . "<br/>";

                    if ($this->send($message)) {
                        $this->session->set_flashdata('success', 'Ваша заявка отправлена. Если информация введена правильно, то мы с вами свяжемся.');
                    } else {
                        $this->session->set_flashdata('error', 'Ваша заявка не отправлена. Попробуйте еще раз.');
                    }

                    // var_dump($data);
                    // var_dump($order);

                    // echo $this->email->print_debugger();

                    redirect($slug . '/' . $id);
                }
            }

            $old_recent_items =  $this->session->userdata('recent_items');
            if (!empty($old_recent_items)) {
                if (!in_array($id, $old_recent_items)) {
                    $old_recent_items[] = $id;
                }
            } else {
                $old_recent_items[] = $id;
            }
            $this->session->set_userdata('recent_items', $old_recent_items);

        } else {
            $this->data['meta'] = $this->get_meta($slug);

            $category = $this->main_model->getTitleBySlug($slug);
            $this->data['breadcrumbs'][0] = array(site_url($slug), $category->title);
            switch ($type) {
                case 'group':
                    $this->data['items'] = $this->item_model->get_items_by_group($slug);
                    break;
                case 'collection':
                    $this->data['items'] = $this->item_model->get_items_by_collection($slug);
                    break;
                case 'collections':
                    $this->data['items'] = $this->item_model->get_items_by_collection();
                    break;
                case 'all':
                    $this->data['items'] = $this->item_model->get();
                    break;
            }
            $this->data['images'] = $this->item_model->get_thumb_items_pairs();
            $this->data['subview'] = 'list';
        }
    }

    public function _section($slug) {
        $this->data['meta'] = $this->get_meta($slug);

        $this->data['section'] = $this->section_model->get_by(array('slug' => $slug), TRUE);
        $this->data['breadcrumbs'][0] = array(site_url($slug), $this->data['section']->title);
        $this->data['subview'] = 'page';
    }

    public function _homepage() {
        $this->load->model('banner_model');
        $this->load->model('background_model');

        $this->data['meta'] = $this->get_meta('homepage');

        $this->data['breadcrumbs'][0] = array(site_url(), 'Главная');

        $this->data['section'] = $this->section_model->get_by(array('slug' => 'homepage'), TRUE);
        $this->data['subview'] = 'homepage';

        $this->data['banners']     = $this->banner_model->get();
        $this->data['backgrounds'] = $this->background_model->get();
    }

    private function send($message)
    {
        $email_config['protocol']     = 'sendmail';
        $email_config['smtp_host']    = 'smtp.tatianarazumova.ru';
        $email_config['smtp_port']    = '25';
        $email_config['smtp_timeout'] = '7';
        $email_config['smtp_user']    = 'orders@tatianarazumova.ru';
        $email_config['smtp_pass']    = 'x56t87z';
        $email_config['charset']      = 'utf-8';
        $email_config['newline']      = "\r\n";
        $email_config['mailtype']     = 'html';
        $email_config['validation']   = FALSE; // bool whether to validate email or not

         //загружаем библиотеку email
        $this->load->library('email');

        $this->email->clear();
         //выполняем инициализацию и заполняем все необходимые поля
        $this->email->initialize($email_config);
        $this->email->from('orders@tatianarazumova.ru', 'Ателье Татьяны Разумовой');
        $this->email->to('zzeraw@bk.ru');
        $this->email->subject('Поступил новый заказ!');
        $this->email->message($message);

        $this->to      = 'zzeraw@bk.ru';
        $this->from    = 'orders@tatianarazumova.ru';
        $this->subject = 'Поступил новый заказ!';
        $this->body    = $message;

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // private function send($message) {
    //     $email_config['protocol']     = 'sendmail';
    //     $email_config['smtp_host']    = 'smtp.tatianarazumova.ru';
    //     $email_config['smtp_port']    = '25';
    //     $email_config['smtp_timeout'] = '7';
    //     $email_config['smtp_user']    = 'orders@tatianarazumova.ru';
    //     $email_config['smtp_pass']    = 'x56t87z';
    //     $email_config['charset']      = 'utf-8';
    //     $email_config['newline']      = "\r\n";
    //     $email_config['mailtype']     = 'html';
    //     $email_config['validation']   = FALSE; // bool whether to validate email or not

    //      //загружаем библиотеку email
    //     $this->load->library('email');

    //     $this->email->clear();
    //      //выполняем инициализацию и заполняем все необходимые поля
    //     $this->email->initialize($email_config);
    //     $this->email->from('orders@tatianarazumova.ru', 'Ателье Татьяны Разумовой');
    //     $this->email->to('tatiana_razumova@mail.ru');
    //     $this->email->subject('Поступил новый заказ!');
    //     $this->email->message($message);

    //     $this->to      = 'tatiana_razumova@mail.ru';
    //     $this->from    = 'orders@tatianarazumova.ru';
    //     $this->subject = 'Поступил новый заказ!';
    //     $this->body    = $message;

    //     if ($this->email->send()) {
    //         return TRUE;
    //     } else {
    //         return FALSE;
    //     }
    // }

    private function get_meta($page = FALSE) {
        $meta = $this->main_model->getMetaBySlug($page);

        $meta_homepage = $this->main_model->getMetaBySlug('homepage');

        !empty($meta->meta_title)       || $meta->meta_title       = $meta_homepage->meta_title;
        !empty($meta->meta_keywords)    || $meta->meta_keywords    = $meta_homepage->meta_keywords;
        !empty($meta->meta_description) || $meta->meta_description = $meta_homepage->meta_description;

        return $meta;
    }

    public function get_last_modified() {
        $delay = mt_rand(2000,10000); // случайная задержка
        // header('Last-Modified: '.gmdate('D, d M Y H:i:s \G\M\T', time()-$num));
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s\G\M\T', time() - $delay) . ' GMT');

        return TRUE;
    }


}
