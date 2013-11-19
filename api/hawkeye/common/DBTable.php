<?php namespace Hawkeye\common;

class DBTable {

    protected $config = array();

    private $contentType = array(
        'csv' => 'text/csv',
        'json' => 'application/vnd.api+json'
    );

    public $table;
    public $format;

    public function __construct($config, $table, $format = 'json') {
        require 'DBTableModel.php';

        $this->config = $config;
        $this->config['DBTable']['table'] = $this->table = $table;
        $this->format = $format;

        $this->tableModel = new DBTableModel($config);
        $this->tableModel->initDb();
    }

    private function response($data) {
        switch ($this->format) {
            case 'csv':
                // This is a ghetto hack
                $data = json_encode($data);
                $array = json_decode($data, true);
                $fh = fopen('php://output', 'w');

                $firstLineKeys = false;
                foreach ($array as $line) {
                    if (!$firstLineKeys) {
                        $firstLineKeys = array_keys($line);
                        fputcsv($fh, $firstLineKeys);
                        $firstLineKeys = array_flip($firstLineKeys);
                    }

                    fputcsv($fh, array_merge($firstLineKeys, $line));
                }
                fclose($fh);
                break;

            case 'json':
            default:
                echo '{' . '"' . $this->table . '": ' . json_encode($data) . '}';
        }
    }

    public function getData($table = null) {
        if ($table === null) {
            $table = $this->table;
        }

        $data = $this->tableModel->get($table);
        return $this->response($data);
    }

    public function getContentType() {
        return $this->contentType[$this->format];
    }
}
