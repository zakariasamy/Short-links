<?php

use Phpmng\Database\Database;

/**
 * Generate unique value & make sure that it dosen't exists in specific column in table
 */
if(! function_exists('unique')) {
    function unique($table, $column) {
        // Get unique value
        $value = substr(md5(mt_rand()), 0, 8);

        // check if the value exists in table
        $isset = Database::table($table)->where($column, '=', $value)->first();

        return $isset ? unique($table, $column) : $value;
    }
}