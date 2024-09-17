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

    public function make($argv)
    {
        $mode = $argv[1] ?? null;
        $classname = $argv[2] ?? null;

        // Check si la classe est vide
        if (empty($classname)) {
            die("\n\rPlease provide a class name\n\r");
        }

        // Nettoyage du nom de la classe
        $classname = preg_replace("/[^a-zA-Z0-9_]+/", "", $classname);

        // Check si le nom de la classe commence par un chiffre
        if (preg_match("/^[^a-zA-Z_]+/", $classname)) {
            die("\n\rClass names cannot start with a number\n\r");
        }

        // Création du fichier en fonction de la commande
        switch ($mode) {
                // Controller
            case 'make:controller':
                // Check si le fichier existe déjà
                $filename = 'app' . DS . 'controllers' . DS . ucfirst($classname) . ".php";
                if (file_exists($filename)) {
                    die("\n\rThat controller already exists\n\r");
                }

                $sample_file = file_get_contents('app' . DS . 'thunder' . DS . 'samples' . DS . 'controller-sample.php');
                $sample_file = preg_replace("/\{CLASSNAME\}/", ucfirst($classname), $sample_file);
                $sample_file = preg_replace("/\{classname\}/", strtolower($classname), $sample_file);

                if (file_put_contents($filename, $sample_file)) {
                    die("\n\rController created successfully\n\r");
                } else {
                    die("\n\rFailed to create controller due to an error\n\r");
                }
                break;

                // Model
            case 'make:model':
                $filename = 'app' . DS . 'models' . DS . ucfirst($classname) . ".php";
                if (file_exists($filename)) {
                    die("\n\rThat model already exists\n\r");
                }

                $sample_file = file_get_contents('app' . DS . 'thunder' . DS . 'samples' . DS . 'model-sample.php');
                $sample_file = preg_replace("/\{CLASSNAME\}/", ucfirst($classname), $sample_file);
                $sample_file = preg_replace("/\{table\}/", strtolower($classname), $sample_file);

                if (file_put_contents($filename, $sample_file)) {
                    die("\n\rModel created successfully\n\r");
                } else {
                    die("\n\rFailed to create model due to an error\n\r");
                }
                break;

                // Migration
            case 'make:migration':
                # code...
                break;

                // Seeder
            case 'make:seeder':
                # code...
                break;

                // Default
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
