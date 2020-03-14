<?php
$dsn = 'mysql:host=127.0.0.1;port=9086;dbname=pushdata';
$collection_switch = trim( file_get_contents(dirname(__FILE__)."/collection_switch"));//trim( file_get_contents(dirname(__FILE__)."\collection_switch") ) ? trim( file_get_contents(dirname(__FILE__)."\collection_switch") ):'-1';
if((string)$collection_switch != '-1'){       //$collection_switch 預設為 -1 , -1 = 234(正式主機) , 0 = 210(備用主機)
    $dsn = 'mysql:host=127.0.0.1;port=9086;dbname=pushdata';
}
else {
    $dsn = 'mysql:host=127.0.0.1;port=9086;dbname=pushdata';
}

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=127.0.0.1;port=9086;dbname=pushdata',
    //'dsn' => 'mysql:host=127.0.0.1;port=9086;dbname=pushdata',
    'dsn' => $dsn,
    'username' => 'collection',
    'password' => '516a2d6ac28b11e796010a002700000c',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
