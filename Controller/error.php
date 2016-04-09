<?php


class Error extends Controller
{
    public function index()
    {
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        if ($user->rights == 'recenzent') $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/error/index.php';
        require ROOT . 'View/template/footer.php';
    }
}
