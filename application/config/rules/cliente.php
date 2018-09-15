<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//adding config items.
$config['post'] = [
        'username' => [
                'field' => 'username',
                'rules' => 'required',
                'errors' => [
                    'required' => 'username es requerido',
                ],
        ],
        'nombre' => [
                'field' => 'nombre',
                'rules' => 'required',
                'errors' => [
                    'required' => 'nombre es requerido',
                ],
        ],
        'password' => [
                'field' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'password es requerido',
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
    'username' => [
            'field' => 'nombre',
            'rules' => 'min_length[0]',
            'errors' => [
                'min_length' => 'Mínimo 2 caracteres',
            ],
    ],
    'password' => [
            'field' => 'token',
            'rules' => 'min_length[0]',
            'errors' => [
                'min_length' => 'Mínimo 2 caracteres',
            ],
    ],
   
];