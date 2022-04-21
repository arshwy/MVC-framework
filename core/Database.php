<?php

namespace app\core;

/**
 * Class Database
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */

 class Database {

    public \PDO $pdo;

    function __construct(array $config)
    {
        $databas = $config['database'] ?? 'mysql';
        $host = $config['host'] ?? 'localhost';
        $port = $config['port'] ?? '3306';
        $name = $config['name'] ?? 'algorithmi_framework';
        $user = $config['user'] ?? 'root';
        $password = $config['password'] ?? '';
        $dsn = "{$databas}:host={$host};port={$port};dbname={$name}";
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable(); // if not created it will be created
        $appliedMigrations = $this->getAppliedMigrations(); // get all the created tables
        $newMigratons = [];
        // returns list of all files in this dir mifrations
        $files = scandir(Application::$ROOT_DIR.'/migrations'); 
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migrationTable)
        {
            if ($migrationTable === '.' || $migrationTable === '..') {
                continue;
            }
            require_once Application::$ROOT_DIR."/migrations/".$migrationTable;
            //get the name of the file without the extension
            $className = pathinfo($migrationTable, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log("Applying migration $migrationTable start.");
            $instance->up();
            $this->log("Applying migration $migrationTable done.");
            $newMigratons[] = $migrationTable;
        }

        if(!empty($newMigratons)){
            $this->saveMigrations($newMigratons);
        }
        else {
            $this->log("Nothing to migrate!, all migrations are applied.");
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;"
        );
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN); 
    }

    public function saveMigrations(array $migrations)
    {
        $migStr = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migStr");
        $statement->execute();
    }

    protected function log($message)
    {
        echo "\n[".date("Y-m-dH:i:S A")."] - ".$message.PHP_EOL;
    }

 }


/*  TESTING 

    echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die; 
    
*/