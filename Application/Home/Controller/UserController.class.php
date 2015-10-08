<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    // 检验用户登录状态
    function userinfo() {
        $userinfo = $_SESSION['userinfo'];
        if($userinfo) {
            $userinfo['status'] = true;
            $this->ajaxReturn($userinfo);
        } else {
            $userinfo['status'] = false;
            $userinfo['errorinfo'] = '您还没有登录，没有查看权限。';
            $this->ajaxReturn($userinfo);
        }
    }

    function resetpassword() {
        $newpassword = $_POST['newpassword'];
        $User = M('User');
        $User->password =$newpassword;
        $condition['username'] = $_SESSION['userinfo']['username'];
        if($User->where($condition)->save()) {
            $result['status'] = true;
            $result['info'] = 'reset password success';
            session_unset();
            session_destroy();
            $this->ajaxReturn($result);
        } else {
            $result['status'] = false;
            $result['info'] = 'reset password error';
            $this->ajaxReturn($result);
        }
    }

    // user avatar upload function
    function useravatar() {
        $filename = $_FILES['uploadimg']['name'];
        $type = $_FILES['uploadimg']['type'];
        $tmp_name = $_FILES['uploadimg']['tmp_name'];
        $error = $_FILES['uploadimg']['error'];
        $size = $_FILES['uploadimg']['size'];

        $maxSize = 2097152; //允许上传的大小为2M
        $allowExt = array('jpeg', 'jpg', 'png'); // 允许上传的文件类型

        if($error == UPLOAD_ERR_OK)
        {
            // 文件上传的后台限制
            if($size > $maxSize)
                exit('上传文件过大');

            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!in_array($ext, $allowExt))
                exit('非法的文件类型');

            // 判断是否是通过HTTP POST 方式上传， move_uploaded_file(filename, destination) 只能移动POST 上传的文件
            if(!is_uploaded_file($tmp_name))
                exit('文件不是通过HTTP POST方式上传的');

            // 检测是否为真实图片, 适用于图片上传校验，该方法只能用于jpeg, jpg, png
            if(!getimagesize($tmp_name))
                exit('不是真正图片类型');

            // 生成唯一文件名防止重复上传被覆盖
            $uinName = md5(uniqid(microtime(true), true)).'.'.$ext;

            $path = 'public/uploads';
            if(!file_exists($path))
            {
                mkdir($path, 0777, true);
                chmod($path, 0777);
            }

            //移动临时文件到制定目录
            //方法1：move_uploaded_file(filename, destination)

            //move_uploaded_file($tmp_name, 'uploadImg/'.$filename);

            //方法2：copy(source, dest)

            if(copy($tmp_name, $path.'/'.$uinName))
            {
                $User = M('user');
                $User->avatar = $path.'/'.$uinName;
                $condition['username'] = $_SESSION['userinfo']['username'];
                if($User->where($condition)->save()) {
                    $_SESSION['userinfo']['avatar'] = $path.'/'.$uinName;
                    $result['status'] = true;
                    $result['info'] = '成功';
                    $this->ajaxReturn($result);
                }
                else
                {
                    $result['status'] = false;
                    $result['info'] = '图片路径写入数据库错误';
                    $this->ajaxReturn($result);
                }
            }
            else
            {
                $result['status'] = false;
                $result['info'] = '拷贝图片错误';
                $this->ajaxReturn($result);
            }
        }
        else
        {
            //匹配错误信息
            switch ($error) {
                case 1:
                    $result['status'] = false;
                    $result['info'] = '拷贝图片错误';
                    $this->ajaxReturn($result);
                    echo '上传文件超过了PHP配置文件中upload_max_filesize选项值';
                    break;

                case 2:
                    $result['status'] = false;
                    $result['info'] = '超过了表单MAX_FILE_SIZE限制的大小';
                    $this->ajaxReturn($result);
                    break;

                case 3:
                    $result['status'] = false;
                    $result['info'] = '文件部分被上传';
                    $this->ajaxReturn($result);
                    break;

                case 4:
                    $result['status'] = false;
                    $result['info'] = '没有选择上传文件';
                    $this->ajaxReturn($result);
                    break;

                case 6:
                    $result['status'] = false;
                    $result['info'] = '没有找到临时目录';
                    $this->ajaxReturn($result);
                    break;

                case 7:
                case 8:
                    $result['status'] = false;
                    $result['info'] = '系统错误';
                    $this->ajaxReturn($result);
                    break;
            }
        }
    }

    // admin editor user function
    function editoruser() {

    }

    // admin delete user function
    function deleteuser() {

    }
}
?>