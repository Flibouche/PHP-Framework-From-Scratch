<?php

/**
 * Utilisation du trait Database au lieu de l'héritage dans la classe Model
 * Avantages :
 * - Permet la réutilisation du code sans les limitations de l'héritage simple
 * - Facilite la composition de classes avec des fonctionnalités partagées
 * - Réduit la duplication de code en centralisant les méthodes communes
 */

class Model
{
    use Database;

    protected $table = 'user';
    protected $limit = 10;
    protected $offset = 0;

    public function where(array $data, array $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function first($data, $data_not)
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        $result = $this->query($query, $data);
        if ($result) {
            return $result[0];
        }

        return false;
    }

    public function insert($data) {}

    public function update($id, $data, $id_column = 'id') {}

    public function delete($id, $id_column = 'id') {}
}
