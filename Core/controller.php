<?php

class Controller
{
    /**
     * @var db
     */
    public $db = null;
    /**
     * @var model
     */
    public $model = null;

    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
        if (isset($_SESSION["id"])) $user = $this->model->getUserInfo($_SESSION["id"]);
        
    }

    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    public function loadModel()
    {
        require ROOT . 'model/model.php';
        $this->model = new Model($this->db);
        
    }
}
