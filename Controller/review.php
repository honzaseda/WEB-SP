<?php

class Review extends Controller{

    public function index(){
        if (isset($_SESSION["id"])) {
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') {
                $reviews = $this->model->getArticlesToReview($_SESSION["id"]);
                $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);

                require ROOT . 'View/template/header.php';
                require ROOT . 'View/review/index.php';
                require ROOT . 'View/template/footer.php';
            }
            else header('location: ' . URL . 'login/access_denied');
        }
        else header('location: ' . URL . 'login/access_denied');
    }

    public function addReview(){
        $user = $this->model->getUserInfo($_SESSION["id"]);
        if (isset($_SESSION["id"])) {
            if ($user->rights == 'recenzent') {
                $this->model->addNewReview($_POST["Rating"], $_POST["Comment"], $_POST["reviewer"], $_POST["article"]);
                header('location: ' . URL . 'review');
            } else header('location: ' . URL . 'login/access_denied');
        } else header('location: ' . URL . 'login/access_denied');
    }

    public function review_article($id){
        if (isset($_SESSION["id"])) {
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') {
                $article = $this->model->getArticleDetail($id);
                $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);

                require ROOT . 'View/template/header.php';
                require ROOT . 'View/review/review_article.php';
                require ROOT . 'View/template/footer.php';
            }
            else header('location: ' . URL . 'login/access_denied');
        }
        else header('location: ' . URL . 'login/access_denied');
    }
}