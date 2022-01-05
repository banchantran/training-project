<?php
require_once('models/BaseModel.php');

class UserModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
        $this->tabelName = 'users';
    }

    public function list(" where name ..... ", " order by id desc")
    {
        $where = "";
        if (isset($conditions['name']) {
              $where .= " name like %$conditions['name']%";
        }
            
        if (isset($conditions['email']) {
              $where .= " name like %$conditions['email']%";
        }
        
        $sql = "select * from $this->tabelName where del_flag =" . ACTIVED . " $where . $orderBy";
        $query = $this->conn->query($sql);
        return $query->fetchAll();
    }

    public function checkLogin($email, $pass)
    {
        $fields = "id, email";
        $dataGetByEmailPass = $this->getByEmailAndPass($email, $pass, $fields);
        $dataGetByEmail = $this->getByEmail($email, "id");
        return array(
            'dataGetByEmailPass' => $dataGetByEmailPass,
            'dataGetByEmail' => $dataGetByEmail
        );
    }

    public function getUserBanned($email, $fields)
    {
        $query = $this->conn->prepare("select $fields from $this->tabelName where del_flag =:_del_flag and email=:_email");
        $query->execute(array('_del_flag' => BANNED, '_email' => $email));
        return $query->fetch();
    }

}
