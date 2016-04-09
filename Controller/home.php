<?php


class Home extends Controller
{

    public function index()
    {
        if (isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);
        }
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/home/index.php';
        require ROOT . 'View/template/footer.php';
    }

    public function rules()
    {
        if (isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);
        }
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/home/rules.php';
        require ROOT . 'View/template/footer.php';
    }

    public function ipsum()
    {
        if (isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);
        }
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/home/ipsum.php';
        require ROOT . 'View/template/footer.php';
    }

    public function lorem()
    {
        if (isset($_SESSION["id"])){
            $user = $this->model->getUserInfo($_SESSION["id"]);
            if ($user->rights == 'recenzent') $reviewsNum = $this->model->getNumOfReviews($_SESSION["id"]);
        }
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/home/lorem.php';
        require ROOT . 'View/template/footer.php';
    }
}
