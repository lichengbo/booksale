<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        /*$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');*/
        $this->display('login');
    }

    function login() {
        $this->display('login');
    }

    function login_data() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $User = M('User');
        $result = $User->find($username);

        if($result['password'] == $password) {
            echo 'success';
            $_SESSION['userinfo'] = $result;
        } else {
            echo 'username or password error';
        }
    }

    function checkyzm() {
        $value = $_POST['value'];
        if($value == strtolower($_SESSION['helloweba_char'])) {
            $result['status'] = true;
            $result['info'] = '验证码正确';
            $this->ajaxReturn($result);
        } else {
            $result['status'] = false;
            $result['info'] = '验证码错误';
            $this->ajaxReturn($result);
        }
    }

    function logout() {
        session_unset();
        session_destroy();
    }

    function register() {
        $this->display('register');
    }

    function register_data() {
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['email'] = $_POST['email'];

        $User = M('User');

        $result = $User->find($data['username']);
        if($result) {
            $registerInfo['status'] = false;
            $registerInfo['errorInfo'] = '用户名已存在!';

            $this->ajaxReturn($registerInfo);
        } else {
            $User->add($data);

            $result = $User->find($data['username']);

            if($result['username'] == $data['username']) {
                $registerInfo['status'] = true;
                $registerInfo['errorInfo'] = '注册成功!';
                $this->ajaxReturn($registerInfo);
            }
        }
    }

    function profile() {
        $this->display('navbar');
        $this->display('userinfo');
    }

    function stock_in() {
        $this->display('navbar');
        $this->display();
    }

    function stock_in_data() {
        $Data = M('Stock_in');
        $result = $Data->select();

        $this->ajaxReturn($result);
    }

    function stock_out() {
        $this->display('navbar');
        $this->display();
    }

    function stock_out_data() {
    }

    function sale() {
        $this->display('navbar');
        $this->display();
    }

    function sale_data() {
        
    }

    function storage() {
        $this->display('navbar');
        $this->display();
    }

    function storage_data() {
        
    }

    function salerecord() {
        $this->display('navbar');
        $this->display();
    }

    function salerecord_data() {
        
    }

    function stock_inrecord() {
        $this->display('navbar');
        $this->display();
    }

    function stock_inrecord_data() {
        
    }

    function stock_outrecord() {
        $this->display('navbar');
        $this->display();
    }

    function stock_outrecord_data() {
        
    }
}