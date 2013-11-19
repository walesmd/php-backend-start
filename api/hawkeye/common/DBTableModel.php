<?php namespace Hawkeye\common;

class DBTableModel {

    protected $config = array();

    public function __construct($config) {
        $this->config = $config;
        $this->initDb();
    }

    public function initDb() {
        $this->db = new \Illuminate\Database\Capsule\Manager;

        $this->db->addConnection($this->config);
        $this->db->setAsGlobal();
        $this->db->setFetchMode(\PDO::FETCH_CLASS);
    }

    public function get($table, $offset = 0, $limit = null) {
        return $this->db->table($table)->get();
    }
}
