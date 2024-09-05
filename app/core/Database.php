<?php

/**
 * Utilisation d'un "trait" au lieu d'une "class" pour permettre la réutilisation du code dans plusieurs classes si besoin
 * Le trait Database est utilisé dans le fichier Model.php, donc le trait ne peut pas être utilisé directement sans être inclus dans une classe 
 */

trait Database
{
    private function connect()
    {
        $string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
        $con = new PDO($string, DBUSER, DBPASS);
        return $con;
    }

    public function query(string $query, array $data = []): array|false
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);

        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (is_array($result) && count($result)) {
                return $result;
            }
        }

        return false;
    }

    public function get_row(string $query, array $data = []): object|false
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);

        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (is_array($result) && count($result)) {
                return $result[0];
            }
        }

        return false;
    }
}
