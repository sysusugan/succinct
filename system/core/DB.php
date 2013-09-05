<?php
/**
 * 数据库操作类
 * @author: sugan
 * @date: 13-8-22
 */
//标识查询出现2006,2013错误时，进行查询重试次数
define('DB_REQUERY_COUNT', 1);
//标识查询出现2006.2013错误时，进行查询重试时间间隔，单位秒
define('DB_REQUERY_INTERVAL', 2);
//出现连接失败时，进行重试的次数
define('DB_RECONNECT_COUNT', 3);
//出现连接失败时，进行重试的时间间隔，单位秒
define('DB_RECONNECT_INTERVAL', 4);
//查询采用unbuf方式
define('DB_UNBUF_QUERY', 5);

class DB {
    private static $instance = array();


    public static function getInstance(array $config) {
        $host = $config['host'];
        $user = $config['user'];
        $pass = $config['pass'];
        if (!empty($config['port']) && is_numeric($config['port']))
            $host = $host . ':' . $config['port'];

        $key = $host . '-' . $user;
        if (empty(self::$instance[$key])) {
            self::$instance[$key] = new self($host, $user, $pass);
        }

        return self::$instance[$key];
    }

    private $host, $user, $pass;
    private $link;
    private $options;

    public function __construct($host, $user, $pass) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->link = null;

        //配置默认的数据库行为参数
        $this->options = array(
            DB_REQUERY_COUNT => 3, //查询重试次数3此
            DB_REQUERY_INTERVAL => 0, //查询重试时间间隔0秒
            DB_RECONNECT_COUNT => 3, //重连次数2此
            DB_RECONNECT_INTERVAL => 0, //重连时间间隔0秒
            DB_UNBUF_QUERY => 0 //重连时间间隔0秒
        );
    }

    /*
     * 链接数据库
     */
    public function connect() {
        if (empty($this->link)) {

            $_count = $this->options[DB_RECONNECT_COUNT];
            $_interval = $this->options[DB_RECONNECT_INTERVAL];
            while ($_count-- > 0) {
                $this->link = mysql_connect($this->host, $this->user, $this->pass, true);
                if (!empty($this->link)) break;
                if ($_interval > 0) sleep($_interval);
            }

            if (empty($this->link)) return false;

            mysql_set_charset('utf8', $this->link);

        }

        return true;
    }

    public function selectDb($dbName) {
        if (!$this->connect()) return false;
        mysql_selectdb($dbName, $this->link);
    }

    /**执行sql语句
     * @param string $sql
     * @return bool|resource
     */
    public function query($sql) {
        if (!$this->connect()) return false;

        $_count = $this->options[DB_REQUERY_COUNT];
        $_interval = $this->options[DB_REQUERY_INTERVAL];
        $_isBuf = $this->options[DB_UNBUF_QUERY];

        while ($_count-- > 0) {

            if (!$_isBuf) $rs = mysql_query($sql, $this->link);
            else $rs = mysql_unbuffered_query($sql, $this->link);

            if (!empty($rs)) break;

            if ($_interval > 0) sleep($_interval);

            //重连数据库
            $errno = mysql_errno($this->link);
            if (($flag = ($errno == 2006 || $errno == 2013))) {
                $this->close();
                if (!$this->connect()) return false;
            }

        }
        return $rs;
    }

    public function getAll($sql) {
        if ($rs = $this->query($sql)) {
            $ret = array();
            while ($v = mysql_fetch_assoc($rs)) {
                $ret[] = $v;
            }
            mysql_free_result($rs);
            return $ret;
        }

        return false;
    }

    /**
     * 关闭数据库连接
     */
    public function close() {
        if (!empty($this->link)) {
            mysql_close($this->link);
            $this->link = NULL;
        }
    }

    public function error() {
        if (is_resource($this->link))
            return mysql_error($this->link);
        return '';
    }
}