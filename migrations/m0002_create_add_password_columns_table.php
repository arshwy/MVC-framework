<?php

use app\core\Migration;


class m0002_create_add_password_columns_table extends Migration {

    public function up(){
        $this->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;");
    }

    public function down(){
        $this->exec("ALTER TABLE users DROP COLUMN password;");
    }

}