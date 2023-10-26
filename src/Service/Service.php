<?php
// namespace Service;

// use Repository\Repository;

class Service
{

    private $httpClient;
    private $doc;
    private $xpath;
    private $repository;


    public function __construct()
    {
        require 'vendor/autoload.php';
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => 'http://test.net',

        ]);
        $this->doc = new DOMDocument();
        $this->xpath = new DOMXPath($this->doc);

        include 'src/Repository/Repository.php';
        $this->repository = new Repository();
    }

    public function scrape()
    {
        $url = '/';
        $response = $this->httpClient->request('GET', $url);
        $htmlString = (string) $response->getBody();
        libxml_use_internal_errors(true);
        $this->doc->loadHTML($htmlString);
        $this->xpath = new DOMXPath($this->doc);
        $titles = $this->xpath->evaluate('//div[@id="wrapper"]//ul//li');
        $url = $this->xpath->evaluate('//div[@id="wrapper"]//ul//li//a/@href');
        $extractedTitles = [];
        return $this->repository->saveResults($titles, $url);
    }

    public function createTable($table_name)
    {
        if ($table_name == 'results' || $table_name == 'user' || $table_name == 'content') {
            $response = $this->repository->createTable(strtolower($table_name));
            echo ($response) ? 'Table ' . $table_name . ' created' : 'Table ' . $table_name . ' not created';
        } else {
            echo 'Only user, results and content tables can be created';
        }
    }

    public function dropTable($table_name)
    {
        if ($table_name == 'results' || $table_name == 'user' || $table_name == 'content') {
            $this->repository->dropTable(strtolower($table_name));
            echo 'Table ' . $table_name . ' dropped';
        } else {
            echo 'Only user, results and content tables can be dropped';
        }
    }

    public function postRegistration($username, $password)
    {
        $checkUser = $this->repository->checkUser($username);
        if ($username == '' || $password == '' || $checkUser > 0) {
            echo 'at least one field is empty or the user you inputed already exist';
        } else {
            $response = $this->repository->createUser($username, $password);
            echo ($response) ? 'User added. You can now <a href="/login">Login</a>' : 'error creating user';
        }
    }

    public function postLogin($username, $password)
    {
        $user = $this->repository->getUser($username);
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $username;
            header('Location: /admin');
        } else {
            echo 'Invalid username or password';
        }
    }

    public function getResults()
    {
        return $this->repository->getResults();
    }

    public function postContent($title, $url)
    {
        if ($title == '' || $url == '') {
            echo 'at least one field is empty';
        } else {
            $response = $this->repository->postContent($title, $url);
            echo ($response) ? 'Content added. You can go to the <a href="/">home page</a> to confirm'  : 'error creating new post';
        }
    }

    public function getContent()
    {
        $countRows = $this->repository->countContent();
        return ($countRows > 0 ) ? $this->repository->getContent() : 'No content created yet';
    }
}
