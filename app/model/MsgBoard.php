<?php
/**
 * 留言板API
 * @author: sugan
 * @date: 13-8-22
 */


class MsgBoard_Model {

    protected $db;
    protected $dbName;

    public function __construct(array $config) {
        $this->db = DB::getInstance($config );
        $this->dbName = 'msgboard';
    }

    public function getMsg() {
        $sql = "select * from {$this->dbName}.msgboard order by ut desc ";
        return $this->db->getAll($sql);
    }

    public function addMsg($data) {
        $fieldArr = array();
        $valArr = array();

        foreach ($data as $field => $val) {
            $fieldArr[] = "`{$field}`";
            $val = mysql_real_escape_string(htmlspecialchars($val));
            $valArr[] = "'{$val}'";
        }

        $fieldStr = implode(',', $fieldArr);
        $valStr = implode(',', $valArr);
        $sql = "insert into {$this->dbName}.msgboard ( $fieldStr) values  ($valStr) ";
        return $this->db->query($sql);
    }

    public function delMsg($msgId) {
        $sql = "delete from {$this->dbName}.msgboard where id={$msgId}";
        return $this->db->query($sql);
    }

    /**
     * @param array $data
     * @param string $where  eg: id=1 and rt>'20130822'
     * @return mixed
     */
    public function updateMsg($data, $where) {
        if (!empty($where)) $where = 'where ' . $where;
        else $where = '';
        $valArr = array();
        foreach ($data as $field => &$val) {
            $val = mysql_real_escape_string($val);
            $valArr[] = "$field='{$val}'";
        }

        $sql = "update {$this->dbName}.msgboard set " . implode(',', $valArr) . " {$where}";

        return $this->db->query($sql);
    }

    public function error() {
        return $this->db->error();
    }

}