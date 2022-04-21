<?php 

# don not use namespace so it can be visible to app\migrations.php

use app\core\Migration;


 class m0001_create_users_table extends Migration {

    public function up()
    {
        $this->exec("CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            `status` TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function down()
    {
        $this->exec("DROP TABLE users;");
    }

 }