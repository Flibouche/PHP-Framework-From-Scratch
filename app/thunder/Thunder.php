<?php

namespace Thunder;

defined('CPATH') or exit('Access Denied');

/**
 * Thunder class
 */
class Thunder
{
    private $version = '1.0.0';

    public function db()
    {
        echo "\n\rThis is the db function\n\r";
    }

    public function make($file, $mode = null, $classname = null)
    {
        if (empty($classname)) {
            die("\n\rPlease provide a controller name\n\r");
        }

        $filename = 'app' . DS . 'controllers' . DS . ucfirst($classname) . ".php";
        if (file_exists($filename)) {
            die("\n\rThat controller already exists\n\r");
        }

        switch ($mode) {
            case 'make:controller':
                $sample_file = file_get_contents('app' . DS . 'thunder' . DS . 'samples' . DS . 'controller-sample.php');
                $sample_file = preg_replace("/\{CLASSNAME\}/", ucfirst($classname), $sample_file);
                $sample_file = preg_replace("/\{classname\}/", strtolower($classname), $sample_file);

                file_put_contents($filename, $sample_file);
                break;

            case 'make:model':
                # code...
                break;

            case 'make:migration':
                # code...
                break;

            case 'make:seeder':
                # code...
                break;

            default:
                die("\n\rUnknown 'make' command !\n\r");
                break;
        }
    }

    public function migrate()
    {
        echo "\n\rThis is the migrate function\n\r";
    }

    public function help()
    {
        echo "
            Thunder v$this->version Command Line Tool

            Database
                db:create           Create a new database schema.
                db:seed             Runs the specified seeder to populate known data into the database.
                db:table            Retrieves information on the selected table.
                db:drop             Drop/Delete a database.
                migrate             Locates and runs a migration from the specified plugin folder.
                migrate:refresh     Does a rollback followed by a latest to refresh the current state of the database.
                migrate:rollback    Runs the 'down' method for a migration in the specified plugin folder.
            
            Generators
                make:controller     Generates a new controller file.
                make:model          Generates a new model file.
                make:migration      Generates a new migration file.
                make:seeder         Generates a new seeder file.
        ";
    }
}
