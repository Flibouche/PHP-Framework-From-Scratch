<?php

defined('ROOTPATH') or exit('Access Denied');

// Fonction qui permet de vérifier les différentes extensions PHP requises
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

// Fonction qui retourne les variables URL
function URL($key): mixed
{
    $URL = $_GET['url'] ?? 'home';
    $URL = explode("/", trim($URL, "/"));

    switch ($key) {
        case 'page':
        case 0:
            return $URL[0] ?? null;
            break;
        case 'section':
        case 'slug':
        case 1:
            return $URL[1] ?? null;
            break;
        case 'action':
        case 2:
            return $URL[2] ?? null;
            break;
        case 'id':
        case 3:
            return $URL[3] ?? null;
            break;
        default:
            return null;
            break;
    }
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

// Fonction qui convertit les chemins des images de relatifs à absolus en ajoutant le chemin racine
function add_root_to_images($contents)
{
    // Récupère toutes les balises <img> dans le contenu
    preg_match_all('/<img[^>]+>/', $contents, $matches);

    // Vérifie si des balises <img> ont été trouvées
    if (is_array($matches) && count($matches) > 0) {

        foreach ($matches[0] as $match) {

            // Récupère l'attribut src de chaque balise <img>
            preg_match('/src="[^"]+/', $match, $matches2);

            // Vérifie si le chemin n'est pas déjà absolu (ne contient pas 'http')
            if (!strstr($matches2[0], 'http')) {

                // Remplace le chemin relatif par un chemin absolu en ajoutant la constante ROOT
                $contents = str_replace($matches2[0], 'src="' . ROOT . '/' . str_replace('src="', "", $matches2[0]), $contents);
            }
        }
    }

    // Retourne le contenu modifié
    return $contents;
}

// Fonction qui convertit les images du contenu de l'éditeur de texte en fichiers réels
function remove_images_from_content($content, $folder = "uploads/")
{
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
        file_put_contents($folder . "index.php", "Access Denied!");
    }

    // Enlève les images du contenu
    preg_match_all('/<img[^>]+>/', $content, $matches);
    $new_content = $content;

    if (is_array($matches) && count($matches) > 0) {

        $image_class = new \Model\Image();
        foreach ($matches[0] as $match) {

            if (strstr($match, "http")) {
                // Ignore les images qui ont déjà des liens
                continue;
            }

            // On récupère la source
            preg_match('/src="[^"]+/', $match, $matches2);

            // On récupère le nom du fichier
            preg_match('/data-filename="[^\"]+/', $match, $matches3);

            if (strstr($matches2[0], 'data:')) {

                $parts = explode(",", $matches2[0]);
                $basename = $matches3[0] ?? 'basename.jpg';
                $basename = str_replace('data-filename="', "", $basename);

                $filename = $folder . "img_" . sha1(rand(0, 9999999999)) . $basename;

                $new_content = str_replace($parts[0] . "," . $parts[1], 'src="' . $filename, $new_content);
                file_put_contents($filename, base64_decode($parts[1]));

                // On redimensionne l'image
                $image_class->resize($filename, 1000);
            }
        }
    }

    return $new_content;
}

// Fonction qui supprime les images du contenu de l'éditeur de texte
function delete_images_from_content(string $content, string $content_new = ''): void
{
    // Supprime les images du contenu si aucun contenu nouveau n'est fourni
    if (empty($content_new)) {

        // Récupère toutes les balises <img> dans le contenu
        preg_match_all('/<img[^>]+>/', $content, $matches);

        if (is_array($matches) && count($matches) > 0) {
            foreach ($matches[0] as $match) {

                // Récupère l'attribut src de chaque image
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                // Supprime le fichier image s'il existe
                if (file_exists($matches2[0])) {
                    unlink($matches2[0]);
                }
            }
        }
    } else {
        // Compare l'ancien contenu au nouveau et supprime du contenu ancien ce qui n'est pas présent dans le nouveau

        // Récupère toutes les balises <img> dans l'ancien contenu
        preg_match_all('/<img[^>]+>/', $content, $matches);
        // Récupère toutes les balises <img> dans le nouveau contenu
        preg_match_all('/<img[^>]+>/', $content_new, $matches_new);

        $old_images = [];
        $new_images = [];

        /** Collecte des anciennes images **/
        if (is_array($matches) && count($matches) > 0) {
            foreach ($matches[0] as $match) {

                // Récupère l'attribut src de chaque image ancienne
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                // Ajoute le chemin de l'image à l'array des anciennes images si elle existe
                if (file_exists($matches2[0])) {
                    $old_images[] = $matches2[0];
                }
            }
        }

        /** Collecte des nouvelles images **/
        if (is_array($matches_new) && count($matches_new) > 0) {
            foreach ($matches_new[0] as $match) {

                // Récupère l'attribut src de chaque image nouvelle
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                // Ajoute le chemin de l'image à l'array des nouvelles images si elle existe
                if (file_exists($matches2[0])) {
                    $new_images[] = $matches2[0];
                }
            }
        }

        /** Compare et supprime toutes les images qui n'apparaissent pas dans le tableau des nouvelles images **/
        foreach ($old_images as $img) {

            // Supprime l'image si elle n'est pas présente dans le nouveau contenu
            if (!in_array($img, $new_images)) {

                if (file_exists($img)) {
                    unlink($img);
                }
            }
        }
    }
}
