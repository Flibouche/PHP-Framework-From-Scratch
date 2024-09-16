<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied');

/**
 * User class
 */
class User
{
    use Model;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'email';

    protected $allowedColumns = [
        'username',
        'email',
        'password',
    ];

    /*****************************
     *  rules include : 
        'required',
        'alpha',
        'email',
        'numeric',
        'unique',
        'symbol',
        'longer_than_8_chars',
        'alpha_numeric',
        'alpha_numeric_symbol',
        'alpha_symbol',
     *
     *****************************/
    protected $validationRules = [
        'username' => [
            'alpha_space',
            'required', // Required à la fin puisque l'ordre des règles est important
        ],
        'email' => [
            'email',
            'unique',
            'required',
        ],
        'password' => [
            'not_less_than_8_chars',
            'required',
        ],
    ];

    public function signup($data)
    {
        if ($this->validate($data)) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['date'] = date("Y-m-d H:i:s");
            $data['date_created'] = date("Y-m-d H:i:s");

            $this->insert($data);
            redirect('login');
        }
    }

    public function login($data)
    {
        $row = $this->first([$this->loginUniqueColumn => $data[$this->loginUniqueColumn]]);

        if ($row) {
            if (password_verify($data['password'], $row->password)) {
                $session = new \Core\Session();
                $session->auth($row);
                redirect('home');
            } else {
                $this->errors[$this->loginUniqueColumn] = "Wrong " . $this->loginUniqueColumn . " or password !";
            }
        } else {
            $this->errors[$this->loginUniqueColumn] = "Wrong " . $this->loginUniqueColumn . " or password !";
        }
    }
}
