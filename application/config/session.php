<?php defined('SYSPATH') or die('No direct script access.');
return array(
    'native' => array(
        'name' => 'tr_uds',
        'lifetime' => 43200,
    ),
    'cookie' => array(
        'name' => 'nih_cgh',
        'encrypted' => TRUE,
        'lifetime' => 43200,
    ),
    'database' => array(
        'name' => 'cookie_name',
        'encrypted' => TRUE,
        'lifetime' => 43200,
        'group' => 'default',
        'table' => 'table_name',
        'columns' => array(
            'session_id'  => 'session_id',
            'last_active' => 'last_active',
            'contents'    => 'contents'
        ),
        'gc' => 500,
    ),
);
?>