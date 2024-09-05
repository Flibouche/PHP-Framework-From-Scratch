<?php

class App
{
    // Je déclare les variables par défaut pour le contrôleur et la méthode.
    private $controller = 'Home';
    private $method = 'index';

    // Cette fonction va découper l'URL à partir du paramètre GET 'url'.
    // Si aucune URL n'est spécifiée, je retourne 'home' par défaut.
    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }

    // Cette fonction charge le contrôleur approprié en fonction de l'URL.
    public function loadController()
    {
        $URL = $this->splitURL();

        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename; // Si le fichier existe je le charge
            $this->controller = ucfirst($URL[0]);
        } else {
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        // Je crée une instance du contrôleur et je charge la méthode appropriée, par défaut ça sera le contrôleur 'Home' et la méthode 'index'.
        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], []);
    }
}
