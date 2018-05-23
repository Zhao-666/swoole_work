<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/23
 * Time: 7:51
 */

$table = new swoole_table(1024);

$table->column('id', swoole_table::TYPE_INT, 4);
$table->column('name', swoole_table::TYPE_STRING, 255);
$table->column('age', swoole_table::TYPE_INT, 4);
$table->create();

$table->set('zzphp', ['id' => 1, 'name' => 'zzphp', 'age' => 20]);
$ret = $table->get('zzphp');
$table['zzphp2']= [
  'id'=>2,
  'name'=>'zzphp2',
  'age'=>30
];

var_dump($ret);
var_dump($table['zzphp2']);