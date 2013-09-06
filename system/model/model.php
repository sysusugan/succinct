<?php
/**
 * Model基类
 * @author: sugan
 * @date: 13-9-6
 */

abstract class Model {

    protected $db;

    protected $dbName;

    public function __construct($config) {
        if (!empty($config)) {
            $this->db = DB::getInstance($config);
            if (isset($config['dbase'])) {
                $this->dbName = $config['dbase'];
                $this->db->selectDb($this->dbNamed);
            }
        }
    }
}