<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    /*
     *  Developed by: Active IT zone
     *  Date    : 18 September, 2017
     *  Active Matrimony CMS
     *  http://codecanyon.net/user/activeitezone
     */

    public function __construct()
    {
        parent::__construct();

        if(!demo()){
            return false;
        }

        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 600);

        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->dbforge();
    }


    public function index()
    {
        //all at once
        $this->cron_1();
        $this->cron_2();

    }

    public function cron_1()
    {
        $this->drop_tables();
        $this->upload_sql('demo.sql');
    }

    public function cron_2()
    {
        $this->delete_uploads_folder('uploads');
        $this->extract_uploads_folder('uploads.zip',FCPATH);
    }


    function drop_tables()
    {

        $tables = $this->db->list_tables($this->db->database);
        foreach ($tables as $table)
        {
            $this->dbforge->drop_table($table,TRUE);
        }
    }

    function upload_sql($filename)
    {
        // Set line to collect lines that wrap
        $templine = '';
        // Read in entire file
        $lines = file($filename);

        // Loop through each line
        foreach ($lines as $line)
        {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
            continue;

            // Add this line to the current templine we are creating
            $templine .= $line;

            // If it has a semicolon at the end, it's the end of the query so can process this templine
            if (substr(trim($line), -1, 1) == ';')
            {
            // Perform the query
            $this->db->query($templine);

            // Reset temp variable to empty
            $templine = '';
            }
        }
    }

    function delete_uploads_folder($dirname = '')
    {
        if (is_dir($dirname))
           $dir_handle = opendir($dirname);
             if (!$dir_handle)
                  return false;
             while($file = readdir($dir_handle)) {
                   if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file))
                             unlink($dirname."/".$file);
                        else
                             $this->delete_uploads_folder($dirname.'/'.$file);
                   }
             }
             closedir($dir_handle);
             rmdir($dirname);
             return true;
    }

    function extract_uploads_folder($zipped_file = 'uploads.zip',$destination = 'uploads/')
    {
        $zip = new ZipArchive();
        $file = $zip->open($zipped_file);
        if ($file === TRUE) {
            $zip->extractTo($destination);
            $zip->close();
        } else {
            echo 'failed';
        }

    }
    // Do not create zip of upload folder.
    // Select all folder from upload folders and create a zip

  }
