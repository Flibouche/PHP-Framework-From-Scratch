<?php

/**
 * Pagination class for pagination
 */

namespace Core;

defined('ROOTPATH') or exit('Access Denied');

class Pager
{
    public $links = [];
    public $offset = 0;
    public $page_number = 1;
    public $start = 1;
    public $end = 1;
    public $limit = 10;
    public $nav_class = "";
    public $ul_class = "pagination justify-content-center";
    public $li_class = "page-item";
    public $a_class = "page-link";

    public function __construct($limit = 10, $extras = 1)
    {
        $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page_number = $page_number < 1 ? 1 : $page_number;

        $this->end = $page_number + $extras;
        $this->start = $page_number - $extras;
        if ($this->start < 1) {
            $this->start = 1;
        }

        $this->offset = ($page_number - 1) * $limit;
        $this->page_number = $page_number;
        $this->limit = $limit;

        $url = isset($_GET['url']) ? $_GET['url'] : '';

        $current_link = ROOT . "/" . $url . '?' . trim(str_replace("url=", "", str_replace($url, "", $_SERVER['QUERY_STRING'])), '&');
        $current_link = !strstr($current_link, "page=") ? $current_link . "&page=1" : $current_link;

        if (!strstr($current_link, "?")) {
            $current_link = str_replace("&page=", "?page=", $current_link);
        }

        $first_link = preg_replace('/page=[0-9]+/', "page=1", $current_link);
        $next_link = preg_replace('/page=[0-9]+/', "page=" . ($page_number + $extras + 1), $current_link);

        $this->links['first'] = $first_link;
        $this->links['current'] = $current_link;
        $this->links['next'] = $next_link;
    }

    public function display($record_count = null)
    {
        if ($record_count == null) {
            $record_count = $this->limit;
        }

        $template_file = ROOTPATH . "/app/views/templates/pager_template.php";

        if (file_exists($template_file)) {
            include $template_file;
        } else {
            echo "Template not found.";
        }
    }
}
