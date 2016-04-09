<?php


class Login extends Controller
{

    public function index()
    {
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/login/index.php';
        require ROOT . 'View/template/footer.php';
    }

    public function wrong_user(){
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/login/wrong_user.php';
        require ROOT . 'View/template/footer.php';
    }
    
    public function access_denied(){
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/login/access_denied.php';
        require ROOT . 'View/template/footer.php';
    }
    
    public function reg_success(){
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        require ROOT . 'View/template/header.php';
        require ROOT . 'View/login/reg_success.php';
        require ROOT . 'View/template/footer.php';
    }
    
    public function log_in(){
            $user_rows = $this->model->loginUser_sameRows($_POST["Login"], md5($_POST["Heslo"]));
            if($user_rows == 1){
                $user_id = $this->model->loginUser($_POST["Login"], md5($_POST["Heslo"]));
                $_SESSION['id'] = $user_id->id;
                header('location: ' . URL . 'user');
            }
            else header('location: ' . URL . 'login/wrong_user');
    }
    
    public function log_out(){
        if (isset($_SESSION["id"])) {
            session_destroy();
            header('location: ' . URL . 'home');
        }    
    }
}
