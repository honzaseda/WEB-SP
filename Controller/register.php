<?php


class Register extends Controller
{

    public function index()
    {
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/register/index.php';
        require ROOT . 'View/template/footer.php';
    }
    
    public function user_exists(){
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/register/user_exists.php';
        require ROOT . 'View/template/footer.php';
    }
    
    public function registerNew(){
        $check = $this->model->registerCheck($_POST["Login"], $_POST["Email"]);
        if($check > 0){
            header('location: ' . URL . 'register/user_exists');
        }
        else{
            if (isset($_POST["submit-register"])) {
                if($_POST["Heslo"] == $_POST["HesloZnovu"]) {
                    $this->model->registerNewUser($_POST["Login"], md5($_POST["Heslo"]), $_POST["Email"]);
                    header('location: ' . URL . 'login/reg_success');
                }
            }
            else header('location: ' . URL . 'register');
        }
    }
}
