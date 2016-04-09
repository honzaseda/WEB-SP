<?php

class Article extends Controller
{
    public function index(){
        if(isset($_SESSION["id"])){
            $articles = $this->model->getAllApprovedArticles();
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);

            require ROOT . 'View/template/header.php';
            require ROOT . 'View/article/index.php';
            require ROOT . 'View/template/footer.php';
        }
        else {
            require ROOT . 'View/template/header.php';
            require ROOT . 'View/login/access_denied.php';
            require ROOT . 'View/template/footer.php';
        }
    }
    
    public function article_detail($article_id){
        if(isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);
            if(isset($article_id)){
                $article = $this->model->getArticleDetail($article_id);
                $article_ratings = $this->model->getArticleRatings($article_id);
                $amount = $this->model->getNumOfRatings($article_id);
                $user = $this->model->getUserInfo($_SESSION["id"]);
                
                require ROOT . 'View/template/header.php';
                require ROOT . 'View/article/article_detail.php';
                require ROOT . 'View/template/footer.php';
            }
            else header('location: ' . URL . 'article');
        }
        else {
            header('location: ' . URL . 'login/access_denied');
        }
    }
    
    public function add_new(){
        if(isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == "autor"){    
                require ROOT . 'View/template/header.php';
                require ROOT . 'View/article/add_new.php';
                require ROOT . 'View/template/footer.php';
            }
            else {
                header('location: ' . URL . 'login/access_denied');
            }
        }
        else {
            header('location: ' . URL . 'login/access_denied');
        }
    }
    
    public function newArticle(){
        
        if (isset($_POST["submit-article"])) {
            $this->model->postNewArticle($_SESSION["id"], $_POST["Header"], $_POST["Text"]);
            $lastId = $this->db->lastInsertId();
            $uploadDir = '/Semestralka/upload/';
            $uploadFile = $uploadDir . $lastId . '.pdf';
            $uploadPath = $_SERVER['DOCUMENT_ROOT'].$uploadFile;
            move_uploaded_file($_FILES['File']['tmp_name'], $uploadPath);
            $this->model->uploadFile($uploadFile, $lastId);

            header('location: ' . URL . 'article/article_detail/'. $lastId);

        } else header('location: ' . URL . 'home/rules');


    }


    public function edit_article($article_id){
        if(isset($_SESSION["id"])){
            $article = $this->model->getArticleDetail($article_id);
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == "autor" && $article->article_author == $_SESSION["id"]){
                require ROOT . 'View/template/header.php';
                require ROOT . 'View/article/edit_article.php';
                require ROOT . 'View/template/footer.php';
            }
            else {
                header('location: ' . URL . 'article');
            }
        }
        else {
            header('location: ' . URL . 'login/access_denied');
        }
    }

    public function updateArticle(){
        if(isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == "autor" && $_POST["article_author"] == $_SESSION["id"]){
                if($_FILES['newFile']['error'] != UPLOAD_ERR_NO_FILE) {

                    $uploadDir = '/Semestralka/upload/';
                    $uploadFile = $uploadDir . $_POST["article_id"] . '.pdf';
                    $uploadPath = $_SERVER['DOCUMENT_ROOT'].$uploadFile;

                    unlink($uploadPath); //remove the file

                    move_uploaded_file($_FILES['newFile']['tmp_name'], $uploadPath);
                    $this->model->editArticleWithFile($_POST["article_id"], $_POST["Header"], $_POST["Text"], $uploadFile);
                }
                else $this->model->editArticle($_POST["article_id"], $_POST["Header"], $_POST["Text"]);

                header('location: ' . URL . 'article/article_detail/' . $_POST["article_id"]);
            }
            else {
                header('location: ' . URL . 'article');
            }
        }
        else {
            header('location: ' . URL . 'login/access_denied');
        }

    }

    public function delete_article($article_author, $article_id){
        if(isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == "autor" && $article_author == $_SESSION["id"]){
                $this->model->deleteArticle($article_id);
                $this->model->deleteArticleReviews($article_id);
                $file = $_SERVER['DOCUMENT_ROOT'] . '/Semestralka/upload/' . $article_id . '.pdf';
                unlink($file);

                header('location: ' . URL . 'user');
            }
            else {
                header('location: ' . URL . 'article');
            }
        }
        else {
            header('location: ' . URL . 'login/access_denied');
        }
    }

    public function download_file($file_id){
        $file_name = $_SERVER['DOCUMENT_ROOT'] . "/Semestralka/upload/" . $file_id . ".pdf";



        header('Content-Disposition: attachment; filename="'. basename($file_name) . '";');
        header('Content-Length: ' . filesize($file_name));
        header('Content-Type: application/octet-stream/');

        readfile($file_name);// push it out

    }

}