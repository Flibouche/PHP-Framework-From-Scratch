<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied');

/**
 * Utilisation du trait Database au lieu de l'héritage dans la classe Model
 * Avantages :
 * - Permet la réutilisation du code sans les limitations de l'héritage simple
 * - Facilite la composition de classes avec des fonctionnalités partagées
 * - Réduit la duplication de code en centralisant les méthodes communes
 */

/**
 * Model trait
 */
trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_column = "id";
    protected $order_type = "DESC";
    public $errors = [];

    public function findAll()
    {
        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return $this->query($query);
    }

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

        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
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

    public function insert($data)
    {
        // Permet d'enlever les colonnes non autorisées
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";

        $this->query($query, $data);

        return false;
    }

    public function update($id, $data, $id_column = 'id')
    {
        // Permet d'enlever les colonnes non autorisées
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");

        $query .= " where $id_column = :$id_column";

        $data[$id_column] = $id;

        $this->query($query, $data);
        return false;
    }

    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";

        $this->query($query, $data);

        return false;
    }

    // Fonction qui permet de récupérer les erreurs de validation
    public function getError($key)
    {
        if (!empty($this->errors[$key])) {
            return $this->errors[$key];
        }
        return "";
    }

    protected function getPrimaryKey()
    {
        return $this->primaryKey ?? 'id';
    }

    public function validate($data)
    {
        $this->errors = [];

        if (!empty($this->validationRules)) {
            foreach ($this->validationRules as $column => $rules) {

                if (!isset($data[$column])) {
                    continue;
                }

                foreach ($rules as $rule) {
                    switch ($rule) {
                        case 'required':
                            if (empty($data[$column])) {
                                $this->errors[$column] = ucfirst($column) . " is required !";
                            }
                            break;

                        case 'email':
                            if (!filter_var(trim($data[$column]), FILTER_VALIDATE_EMAIL)) {
                                $this->errors[$column] = "Invalid email address !";
                            }
                            break;

                        case 'alpha':
                            if (!preg_match("/^[a-zA-Z]+$/", trim($data[$column]))) {
                                $this->errors[$column] = ucfirst($column) . " should only have alphabetical letters without spaces !";
                            }
                            break;

                        case 'alpha_space':
                            if (!preg_match("/^[a-zA-Z ]+$/", trim($data[$column]))) {
                                $this->errors[$column] = ucfirst($column) . " should only have alphabetical letters & spaces !";
                            }
                            break;

                        case 'alpha_numeric':
                            if (!preg_match("/^[a-zA-Z0-9]+$/", trim($data[$column]))) {
                                $this->errors[$column] = ucfirst($column) . " should only have alphabetical letters & numbers !";
                            }
                            break;

                        case 'alpha_numeric_symbol':
                            if (!preg_match("/^[a-zA-Z0-9\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column]))) {
                                $this->errors[$column] = ucfirst($column) . " should only have alphabetical letters, numbers, symbols & spaces !";
                            }
                            break;

                        case 'alpha_symbol':
                            if (!preg_match("/^[a-zA-Z\-\_\$\%\*\[\]\(\)\& ]+$/", trim($data[$column]))) {
                                $this->errors[$column] = ucfirst($column) . " should only have alphabetical letters, symbols & spaces !";
                            }
                            break;

                        case 'not_less_than_8_chars':
                            if (strlen(trim($data[$column])) < 8) {
                                $this->errors[$column] = ucfirst($column) . " should not be less than 8 characters !";
                            }
                            break;

                        case 'unique':
                            $key = $this->getPrimaryKey();
                            if (!empty($data[$key])) {
                                // Edit mode
                                if ($this->first([$column => $data[$column]], [$key => $data[$key]])) {
                                    $this->errors[$column] = ucfirst($column) . " should be unique !";
                                }
                            } else {
                                // Insert mode
                                if ($this->first([$column => $data[$column]])) {
                                    $this->errors[$column] = ucfirst($column) . " should be unique !";
                                }
                            }
                            break;

                        default:
                            $this->errors['rules'] = "The rule " . $rule . " was not found !";
                            break;
                    }
                }
            }
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
