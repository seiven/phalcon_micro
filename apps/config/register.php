<?php
/**
 * 注册申明API
 */
return array(
    'namespace'=> array(
        'Tuoer'=> APP_PATH . '/library' 
    ),
    'list'=> array(
        '\Tuoer\Users'=> array(
            'prefix'=> '/tuoer/user',
            'router'=> array(
                array('get','/','index'),
            ) 
        ) 
    ) 
);