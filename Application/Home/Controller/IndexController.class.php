<?php
namespace Home\Controller;
use Org\Util\Date;
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
        $isremember = $_POST['isremember'];

        $User = M('User');
        $result = $User->find($username);

        if($result['password'] == md5($password)) {
            if($isremember == 'true') {
                setcookie('username', $username, time() + 3600);
                setcookie('password', $password, time() + 3600);
            }
            $_SESSION['userinfo'] = $result;
            $result1['status'] = true;
            $result1['user_type'] = $result['user_type'];
            $this->ajaxReturn($result1);
        } else {
            $result1['status'] = false;
            $result1['info'] = 'login error';
            $this->ajaxReturn($result1);
        }
    }

    function checkyzm() {
        $value = strtolower($_POST['value']);
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

    function remember_login() {
        if($_COOKIE['username']) {
            $result['status'] = true;
            $result['username'] = $_COOKIE['username'];
            $result['password'] = $_COOKIE['password'];
            $this->ajaxReturn($result);
        } else {
            $result['status'] = false;
            $result['info'] = 'cookie 失效';
            $this->ajaxReturn($result);
        }
    }

    function logout() {
        session_unset();
        session_destroy();
        setcookie('username','',time()-3600);
        setcookie('password','',time()-3600);
    }

    function register() {
        $this->display('register');
    }

    function register_data() {
        $data['username'] = $_POST['username'];
        $data['password'] = md5($_POST['password']);
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
        if($_SESSION['userinfo']['user_type'] == "2") {
            $result['status'] = false;
            $result['info'] = '您没有该操作权限';
            $this->ajaxReturn($result);
        } else {
            $Data = M('stock_in');
            $result['data'] = $Data->select();

            if($result['data']) {
                $result['status'] = true;
                $result['info'] = '成功';
                $this->ajaxReturn($result);
            } else {
                $result['status'] = false;
                $result['info'] = '数据为空';
                $this->ajaxReturn($result);
            }
        }
     }

    function stock_in_submit() {
        $data['isbn'] = $_POST['isbn'];
        $data['bookname'] = $_POST['bookname'];
        $data['author'] = $_POST['author'];
        $data['publisher'] = $_POST['publisher'];
        $data['supplier_name'] = $_POST['supplier_name'];
        $data['stock_in_price'] = $_POST['supplyPrice'];
        $data['stock_in_size'] = $_POST['stockin_Size'];
        $data['stock_in_date'] = date("Y-m-d H:i:s");


        $Stock_in_record = M('Stock_in_record');
        if($Stock_in_record->add($data)) {
            $storage = M('storage');
            $stock_in = M('stock_in');
            $find['isbn'] = $data['isbn'];
            $storage->storage_size = (int)$storage->where($find)->getField('storage_size') + (int)$data['stock_in_size'];
            $stock_in->supply_size = (int)$stock_in->where($find)->getField('supply_size') - (int)$data['stock_in_size'];
            if($storage->where($find)->save() && $stock_in->where($find)->save()) {
                $result['status'] = true;
                $result['info'] = '进货成功';
                $this->ajaxReturn($result);
            } else {
                $result['status'] = false;
                $result['info'] = '进货失败';
                $this->ajaxReturn($result);
            }
        }
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
        if($_SESSION['userinfo']['user_type'] == "2") {
            $result['status'] = false;
            $result['info'] = '您没有该操作权限';
            $this->ajaxReturn($result);
        } else {
            $Data = M('storage');
            $result['data'] = $Data->select();

            if($result['data']) {
                $result['status'] = true;
                $result['info'] = '成功';
                $this->ajaxReturn($result);
            } else {
                $result['status'] = false;
                $result['info'] = '数据为空';
                $this->ajaxReturn($result);
            }
        }
    }

    function salerecord() {
        $this->display('navbar');
        $this->display();
    }

    function salerecord_data() {
        if($_SESSION['userinfo']['user_type'] == "2") {
            $result['status'] = false;
            $result['info'] = '您没有该操作权限';
            $this->ajaxReturn($result);
        } else {
            $Data = M('salerecord');
            $result['data'] = $Data->select();

            if($result['data']) {
                $result['status'] = true;
                $result['info'] = '成功';
                $this->ajaxReturn($result);
            } else {
                $result['status'] = false;
                $result['info'] = '数据为空';
                $this->ajaxReturn($result);
            }
        }
    }

    function stock_inrecord() {
        $this->display('navbar');
        $this->display();
    }

    function stock_inrecord_data() {
        if($_SESSION['userinfo']['user_type'] == "2") {
            $result['status'] = false;
            $result['info'] = '您没有该操作权限';
            $this->ajaxReturn($result);
        } else {
            $Data = M('stock_in_record');
            $result['data'] = $Data->select();

            if($result['data']) {
                $result['status'] = true;
                $result['info'] = '成功';
                $this->ajaxReturn($result);
            } else {
                $result['status'] = false;
                $result['info'] = '数据为空';
                $this->ajaxReturn($result);
            }
        }
    }

    function stock_outrecord() {
        $this->display('navbar');
        $this->display();
    }

    function stock_outrecord_data() {
        if($_SESSION['userinfo']['user_type'] == "2") {
            $result['status'] = false;
            $result['info'] = '您没有该操作权限';
            $this->ajaxReturn($result);
        } else {
            $Data = M('stock_out_record');
            $result['data'] = $Data->select();

            if($result['data']) {
                $result['status'] = true;
                $result['info'] = '成功';
                $this->ajaxReturn($result);
            } else {
                $result['status'] = false;
                $result['info'] = '数据为空';
                $this->ajaxReturn($result);
            }
        }

    }
}