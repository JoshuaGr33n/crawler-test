<?php

class Controller
{

    private $service;
    public function __construct()
    {
        include 'src/Service/Service.php';
        $this->service = new Service();
    }

    public function createTable($table_name)
    {
        return $this->service->createTable($table_name);
    }

    public function dropTable($table_name)
    {
        return $this->service->dropTable($table_name);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->service->postRegistration($_POST['username'], $_POST['password']);
        }
        include 'src/Views/register.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->service->postLogin($_POST['username'], $_POST['password']);
        }
        include 'src/Views/login.php';
    }


    public function adminPage()
    {
        require  'src/Views/admin.php';
    }

    public function scrape()
    {
        $results = $this->service->scrape();
        include 'src/Views/result-set.php';
    }

    public function getResults()
    {
        $results = $this->service->getResults();
        include 'src/Views/results.php';
    }

    public function postContent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->service->postContent($_POST['title'], $_POST['url']);
        }
        require  'src/Views/post-content.php';
    }

    public function homepage()
    {
        $template = file_get_contents('homepage.html');
        $items = $this->service->getContent();
        $listItems = '';
        foreach ($items as $item) {
            $listItems .= "<li><a href='{$item['url']}'>{$item['title']}</a></li>";
        }
        $html = str_replace('{foreach_items}', $listItems, $template);
        echo $html;
    }
}
