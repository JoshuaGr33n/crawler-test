<?php
global $api;

class Repository
{

    private $model;

    public function __construct()
    {
        include 'src/Model/Model.php';
        $this->model = new Model();
    }

    private function deleteFiles()
    {
        $sitemapFile = 'sitemap.html';
        $htmlFile = 'homepage.html';
        if (file_exists($sitemapFile) && file_exists($htmlFile)) {
            if (unlink($sitemapFile) && unlink($htmlFile)) {
                echo "homepage.html and sitemap.html deleted successfully.";
            } else {
                echo "Failed to delete one or both of the files.";
            }
        } else {
            echo "One or both of the files do not exist.";
        }
    }

    private function createSiteMap()
    {

        $html = '<!DOCTYPE html>
            <html>
            <head>
                <title>Sitemap</title>
            </head>
            <body>
                <h1>Sitemap</h1>
                <ul>';

        foreach ($this->model->getResults() as $row) {
            $url = htmlspecialchars($row['url']);
            $title = htmlspecialchars($row['title']);
            $html .= '<li><a href="' . $url . '">' . $title . '</a></li>';
        }

        $html .= '</ul>
            </body>
            </html>';
        $sitemapFile = 'sitemap.html';
        file_put_contents($sitemapFile, $html);

        echo " New sitemap generated and saved to $sitemapFile";
    }

    private function createHompageFile()
    {
        $htmlContent = '<!DOCTYPE html>
                <html>
                <head>
                    <title>Welcome</title>
                </head>

                <body>
                    <a href="/admin">Admin</a><br>
                    <h1>Welcome</h1>
                    <div id="wrapper">
                        <ul>
                            {foreach_items}
                        </ul>
                    </div>
                </body>

                </html>
                ';
        $filePath = 'homepage.html';
        if (file_put_contents($filePath, $htmlContent) !== false) {
            echo "HTML file '$filePath' was generated successfully.";
        } else {
            echo "Failed to generate the HTML file.";
        }
    }

    public function createTable($table_name)
    {
        try {
            $table_name == 'users'
                ? $sql =  $this->model->createUserTable($table_name)
                : ($table_name == 'content' ? $sql =  $this->model->createContentTable($table_name) : $sql =  $this->model->createResultsTable($table_name));

            return ($sql->execute()) ? true : false;
        } catch (PDOException $e) {
            return "<br>" . $e->getMessage();
        }
    }

    public function dropTable($table_name)
    {
        try {
            $sql = $this->model->dropTable($table_name);
            return $sql->execute();
        } catch (PDOException $e) {
            return "<br>" . $e->getMessage();
        }
    }

    public function saveResults($results, $url)
    {
        $statement = $this->model->storeResults();
        $true = [];
        $values = [];
        $this->deleteFiles();
        $this->model->deleteLastResults();
        foreach ($results as $key => $result) {
            $values = [
                ':title' => $result->textContent . PHP_EOL,
                ':url' => $url[$key]->textContent,
            ];
            $true = $statement->execute($values);
        }
        if ($true) {
            $this->createHompageFile();
            $this->createSiteMap();

            return $this->model->getResults();
        }
        return false;
    }

    public function getResults()
    {
        return $this->model->getResults();
    }

    public function createUser($username, $password)
    {
        $statement = $this->model->addUser();
        $values = [
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        if ($statement->execute($values)) {
            return true;
        }
        return false;
    }

    public function checkUser($username)
    {
        $statement = $this->model->checkUser($username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['row_count'];
    }

    public function getUser($username)
    {
        $statement = $this->model->getUser($username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function postContent($title, $url)
    {
        $statement = $this->model->postContent();
        $values = [
            ':title' => $title,
            ':url' => $url
        ];
        if ($statement->execute($values)) {
            return true;
        }
        return false;
    }

    public function getContent()
    {
        return $this->model->getContent();
    }

    public function countContent()
    {
        $statement = $this->model->countContentRows();
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['row_count'];
    }
}
