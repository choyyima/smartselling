<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends MY_Extended_Controller {

    function index() {
        $str = 'return true; aadsd asd asd';
        die(var_dump(@eval($str)));
    }

    public function back_up() {
        $this->load->library('zip');
        $date = date("dmy H:i");
        $path = "/htdocs/ices/";
        $this->zip->read_dir($path);
        $this->zip->download($date . ' - mybackup.zip');
    }

    public function backupdb() {
        $this->load->library('mysqldump');
        $this->mysqldump->do_dump();
    }

    public function backups() {
        $this->load->dbutil();

// nyiapin aturan untuk file backup
        $aturan = array(
            'format' => 'zip',
            'filename' => 'my_db_backup.sql'
        );


        $backup = & $this->dbutil->backup($aturan);

        $nama_database = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
        $simpan = '/backup' . $nama_database;

        $this->load->helper('file');
        write_file($simpan, $backup);


        $this->load->helper('download');
        force_download($nama_database, $backup);
    }

}
