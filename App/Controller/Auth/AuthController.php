<?php
namespace app\Controller;
use libs\DBConnect;
use libs\BaseController;
use PDO;


class AuthController extends BaseController
{
    public function loginform(){
        return $this->view('auth/login' );
    }

    public function checklogin(){
        if (isset($_SESSION['name'])){
            echo $_SESSION['name']." đã đăng nhập vui lòng đăng xuất";
        }else{
            $db = DBConnect::getConnect();
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $sql = $db->query("select * from users where email = '$email' and password = '$password'");
            $user = $sql->fetchAll(PDO::FETCH_ASSOC);

            if ($user != null){
                foreach ($user as $u){
                    if ($u["email"] == $email && $u['password'] == $password ){
                        $_SESSION['id'] = $u['id'];
                        $_SESSION['name'] = $u['name'];
                        $_SESSION['email'] = $u['email'];
                        $_SESSION['password'] = $u['password'];
                        $_SESSION['roles'] = $u['roles'];
                        header('location:users/index');
                    }
                }
            }else{
                echo "login fail : login information not found. <a href='/login'>login</a>";
            }
        }
    }
    public function logout(){
        if (isset($_SESSION['id'])){
            unset($_SESSION['id'],$_SESSION['name'],$_SESSION['email'],$_SESSION['password'],$_SESSION['roles']);
            header('location:login');
        }else{
            echo "chua dang nhap <a href='/login'>login</a>";
        }
    }
}