<?php
class Order_Model extends MY_Model
{
    protected $_table_name = 'orders';
    protected $_timestamps = TRUE;
    public $rules = array(
        'fio' => array(
            'field' => 'fio',
            'label' => 'Ф.И.О.',
            'rules' => 'trim|required|max_length[128]|xss_clean'
        ),
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
        'phone' => array(
            'field' => 'body',
            'label' => 'Телефон',
            'rules' => 'trim'
        ),
        'comment' => array(
            'field' => 'comment',
            'label' => 'Комментарий',
            'rules' => ''
        ),
        // 'item' => array(
        //     'field' => 'item',
        //     'label' => 'Товар',
        //     'rules' => 'required|integer'
        // ),
        'size' => array(
            'field' => 'size',
            'label' => 'Размер',
            'rules' => 'required|integer'
        ),
        'color' => array(
            'field' => 'color',
            'label' => 'Цвет',
            'rules' => 'required|integer'
        ),
    );






}