<?php

class Admin extends Controller
{
    public function index()
    {
        if (isset($_SESSION["id"])) {
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'admin') {
                $disapprovedArticles = $this->model->getDisapprovedArticles();
                $reviewers = $this->model->getReviewers();
                $ratings = $this->model->getAllArticleRatings();

                require ROOT . 'View/template/header.php';
                require ROOT . 'View/admin/index.php';
                require ROOT . 'View/template/footer.php';
            }
            else header('location: ' . URL . 'login/access_denied');
        }
        else header('location: ' . URL . 'login/access_denied');
    }

    public function add_reviewer(){
        $user = $this->model->getUserInfo($_SESSION["id"]);
        if (isset($_SESSION["id"])) {
            if ($user->rights == 'admin') {
                $user_id = $this->model->getUserByLogin($_POST["selRev"]);
                $this->model->addReview($_POST["article"], $user_id->id);
                if($_POST["reviewer"] == 'reviewer1') $this->model->addReviewer1($user_id->id, $_POST["article"]);
                elseif($_POST["reviewer"] == 'reviewer2') $this->model->addReviewer2($user_id->id, $_POST["article"]);
                elseif($_POST["reviewer"] == 'reviewer3') $this->model->addReviewer3($user_id->id, $_POST["article"]);
                header('location: ' . URL . 'admin');
            } else header('location: ' . URL . 'login/access_denied');
        } else header('location: ' . URL . 'login/access_denied');
    }

    public function remove_reviewer($article_id, $reviewer, $row){
        $user = $this->model->getUserInfo($_SESSION["id"]);
        if (isset($_SESSION["id"])) {
            if ($user->rights == 'admin') {
                $this->model->removeReview($article_id, $reviewer);

                if($row == 1) $this->model->removeReviewer1($article_id);
                elseif($row == 2) $this->model->removeReviewer2($article_id);
                elseif($row == 3) $this->model->removeReviewer3($article_id);

                header('location: ' . URL . 'admin');
            } else header('location: ' . URL . 'login/access_denied');
        } else header('location: ' . URL . 'login/access_denied');
    }

    public function approve_article($article_id){
        $user = $this->model->getUserInfo($_SESSION["id"]);
        if (isset($_SESSION["id"])) {
            if ($user->rights == 'admin') {
                $this->model->approveArticle($article_id);
                header('location: ' . URL . 'admin');
            } else header('location: ' . URL . 'login/access_denied');
        } else header('location: ' . URL . 'login/access_denied');

    }
}