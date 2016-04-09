<?php

class User extends Controller
{
    public function index(){
        if (isset($_SESSION["id"])){ 
            $user = $this->model->getUserInfo($_SESSION["id"]);

            if($user->rights == 'autor'){
                $approvedArticles = $this->model->getApprovedArticlesByAuthor($_SESSION["id"]);
                $disapprovedArticles = $this->model->getDisapprovedArticlesByAuthor($_SESSION["id"]);
                $numApproved = $this->model->getNumOfApproved($_SESSION["id"]);
                $numDisapproved = $this->model->getNumOfDisapproved($_SESSION["id"]);
            }

            if($user->rights == 'recenzent'){
                $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);
            }



            require ROOT . 'View/template/header.php';
            require ROOT . 'View/user/index.php';
            require ROOT . 'View/template/footer.php';
        }
        else header('location: ' . URL . 'login');
    }
}