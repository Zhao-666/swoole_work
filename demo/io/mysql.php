<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/17
 * Time: 21:04
 */

class AysMysql
{

    public $db = null;
    public $dbConfig = null;

    public function __construct()
    {
        $this->db = new Swoole\Mysql();
        $this->dbConfig = [
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => 123456,
            'database' => 'swoole',
            'charset' => 'utf8'
        ];
    }

    public function execute($id, $username)
    {
        $this->db->connect($this->dbConfig, function ($db, $result) use ($id, $username) {
            if ($result == false) {
                var_dump($db->connect_error);
            }
//            $sql = "select * from test where id = 1";
            $sql = "update test set username = '$username' where id = $id";
            $db->query($sql, function ($db, $result) {
                if ($result === false) {
                    var_dump($db->error);
                } elseif ($result === true) {
                    var_dump($db->affected_rows);
                } else {
                    print_r($result);
                }
                $db->close();
            });
        });
    }

    public function update()
    {

    }

    public function add()
    {

    }
}

$mysql = new AysMysql();
$mysql->execute(1, 'hello');