<?php

namespace app\core;

use stdClass;

/** !! FUTURE CLASS !!
 * Class DB
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */

 class DB {

    private string $table;

    function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Returns an instance of the current class initialized by the table name
     */
    public static function table(string $tableName): DB
    {
        $obj = new DB($tableName) ;


        return $obj;
    }

    /**
     * Find a row from th atable by id
     */
    public function find(mixed $id): object
    {
        $t = $this->table;

        return new stdClass; # return the searched row
    }

    /**
     * Create a row in the database
     */
    public function create(array $assoc_array_data_values): object
    {
        $t = $this->table;
        
        return new stdClass; #return the creates row
    }

    /**
     * Update a row in the database
     */
    public function update(array $assoc_array_data_values): object
    {
        $t = $this->table;
        
        return new stdClass; # return the updated row
    }


    /**
     * Read data by $sql command from the database
     */
    public function read(string $sql): array
    {
        $t = $this->table;
        
        return [];
    }


    /**
     * Write data by $sql command to the database
     */
    public function write(string $sql): bool
    {
        $t = $this->table;
        
        return true; # return true if success
    }





 }