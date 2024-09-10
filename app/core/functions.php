<?php

defined('ROOTPATH') or exit('Access Denied');

check_extensions();
function check_extensions()
{
    $required_extensions = [
        'gd',
        'mysqli',
        'curl',
        'fileinfo',
        'intl',
        'mbstring',
        'exif',
        'openssl',
        'pdo_mysql',
        'xsl',
    ];

    $not_loaded = [];

    foreach ($required_extensions as $ext) {
        if (!extension_loaded($ext)) {
            $not_loaded[] = $ext;
        }
    }

    if (!empty($not_loaded)) {
        show("Please load the following extensions in your php.ini file: <br>" . implode("<br>", $not_loaded));
        die;
    }
}

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

// Fonction qui escape les caractères spéciaux
function esc($str)
{
    return htmlspecialchars($str);
}

// Fonction qui redirige vers une page
function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
    die;
}

// Fonction qui check si l'image existe, autrement retourne un placeholder
function get_image(mixed $file = '', string $type = 'post'): string
{
    $file = $file ?? '';
    if (file_exists($file)) {
        return ROOT . "/" . $file;
    }

    if ($type == 'user') {
        return ROOT . "/assets/images/user.png";
    } else {
        return ROOT . "/assets/images/no_image.png";
    }
}

// Fonction qui retourne les variables de pagination
function get_pagination_vars(): array
{
    $vars = [];
    $vars['page'] = $_GET['page'] ?? 1;
    $vars['page'] = (int)$vars['page'];
    $vars['prev_page'] = $vars['page'] <= 1 ? 1 : $vars['page'] - 1;
    $vars['next_page'] = $vars['page'] + 1;

    return $vars;
}

// Fonction qui sauvegarde ou affiche un message
function message(string $msg = null, bool $clear = false): mixed
{
    $session = new Core\Session();

    if (!empty($msg)) {
        $session->set('message', $msg);
    } else if (!empty($session->get('message'))) {
        $msg = $session->get('message');

        if ($clear) {
            $session->pop('message');
        }
        return $msg;
    }
    return false;
}

/** 
 * Affiche l'attribut 'checked' pour les cases à cocher ou les boutons radio si la valeur saisie correspond à la valeur postée ou à la valeur par défaut.
 *
 * @param string $key Le nom de l'attribut de l'entrée du formulaire.
 * @param string $value La valeur de l'attribut de l'entrée du formulaire.
 * @param string $default La valeur par défaut à utiliser si la méthode de la requête est GET.
 * @return string Retourne 'checked' si l'entrée doit être cochée, sinon retourne une chaîne vide.
 */
function old_checked(string $key, string $value, string $default = ""): string
{
    // Vérifie si le formulaire a été soumis et si le nom de l'entrée existe dans les données POST
    if (isset($_POST[$key])) {
        // Retourne 'checked' si la valeur soumise correspond à la valeur de l'entrée
        if ($_POST[$key] == $value) {
            return ' checked ';
        }
    } else {
        // Si la méthode de la requête est GET et que la valeur par défaut correspond à la valeur de l'entrée, retourne 'checked'
        if ($_SERVER['REQUEST_METHOD'] == "GET" && $default == $value) {
            return ' checked ';
        }
    }

    // Retourne une chaîne vide si aucune condition n'est remplie
    return '';
}

/** 
 * Récupère l'ancienne valeur d'une entrée de formulaire après un rafraîchissement ou une soumission.
 *
 * @param string $key Le nom de l'attribut de l'entrée du formulaire.
 * @param mixed $default La valeur par défaut à utiliser si aucune valeur n'est trouvée.
 * @param string $mode Le mode de la requête, soit 'post' pour POST, soit 'get' pour GET.
 * @return mixed Retourne la valeur soumise ou la valeur par défaut si aucune n'est trouvée.
 */
function old_value(string $key, mixed $default = "", string $mode = 'post'): mixed
{
    // Utilise les données POST ou GET selon le mode spécifié
    $POST = ($mode == 'post') ? $_POST : $_GET;

    // Retourne la valeur de l'entrée si elle existe dans les données de la requête
    if (isset($POST[$key])) {
        return $POST[$key];
    }

    // Retourne la valeur par défaut si l'entrée n'est pas trouvée
    return $default;
}

/** 
 * Affiche l'attribut 'selected' pour les options de sélection si la valeur saisie correspond à la valeur postée ou à la valeur par défaut.
 *
 * @param string $key Le nom de l'attribut de l'entrée du formulaire.
 * @param mixed $value La valeur de l'attribut de l'option.
 * @param mixed $default La valeur par défaut à utiliser si la requête ne contient pas la clé.
 * @param string $mode Le mode de la requête, soit 'post' pour POST, soit 'get' pour GET.
 * @return string Retourne 'selected' si l'option doit être sélectionnée, sinon retourne une chaîne vide.
 */
function old_select(string $key, mixed $value, mixed $default = "", string $mode = 'post'): mixed
{
    // Utilise les données POST ou GET selon le mode spécifié
    $POST = ($mode == 'post') ? $_POST : $_GET;

    // Retourne 'selected' si la valeur soumise correspond à la valeur de l'option
    if (isset($POST[$key])) {
        if ($POST[$key] == $value) {
            return ' selected ';
        }
    } else {
        // Retourne 'selected' si la valeur par défaut correspond à la valeur de l'option
        if ($default == $value) {
            return ' selected ';
        }
    }

    // Retourne une chaîne vide si aucune condition n'est remplie
    return '';
}

// Fonction qui retourne la date formatée
function get_date($date): string
{
    return date('jS M, Y', strtotime($date));
}
