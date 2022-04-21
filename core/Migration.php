<?php

namespace app\core;

/**
 * Class Migration
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */

use app\core\Application;


abstract class Migration {

    // must be created in all imgration tables
    abstract public function up();

    // must be created in all imgration tables
    abstract public function down();

    protected function exec($sql)
    {
        Application::$app->db->pdo->exec($sql);
    }

 }