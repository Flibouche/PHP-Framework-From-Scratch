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
