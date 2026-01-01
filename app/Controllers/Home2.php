<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class Home2 extends BaseController
{
    public function index()
    {
        $db = Database::connect();  
        $tables = $db->listTables();
        echo "<h2>Koneksi Database Berhasil!</h2>";
        echo "<pre>";
        print_r($tables);
        echo "</pre>";
    }
}
