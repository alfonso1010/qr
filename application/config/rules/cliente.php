<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//adding config items.
$config['post'] = [
        'nombre' => [
                'field' => 'nombre',
                'rules' => 'required',
                'errors' => [
                    'required' => 'nombre es requerido',
                ],
        ],
        'token' => [
                'field' => 'token',
                'rules' => 'required',
                'errors' => [
                    'required' => 'token es requerido',
                ],
        ],
    ];


$config['update'] = [
	'nombre' => [
            'field' => 'nombre',
            'rules' => 'min_length[0]',
            'errors' => [
                'min_length' => 'Mínimo 2 caracteres',
            ],
    ],
    'token' => [
            'field' => 'token',
            'rules' => 'min_length[0]',
            'errors' => [
                'min_length' => 'Mínimo 2 caracteres',
            ],
    ],
   
];