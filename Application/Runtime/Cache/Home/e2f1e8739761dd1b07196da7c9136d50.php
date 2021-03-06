<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书销售系统-注册</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
</head>
<body>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal">
                <div class="form-group">
                    <h2 class="form-signin-heading text-center">注册</h2>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">用户名</label>
                    <div class="col-md-7">
                        <input type="text" id="username" class="form-control" placeholder="用户名" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">邮箱</label>
                    <div class="col-md-7">
                        <input type="email" id="email" class="form-control" placeholder="常用邮箱" required>
                        <span class="help-inline help">邮箱格式错误</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password1" class="col-md-3 control-label">密码</label>
                    <div class="col-md-7">
                        <input type="password" id="password1" class="form-control" placeholder="密码" required>
                        <span id="passwordErrorInfo" class="help-inline help">密码长度应大于或等于6</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password2" class="col-md-3 control-label">确认密码</label>
                    <div class="col-md-7">
                        <input type="password" id="password2" class="form-control" placeholder="再次输入密码" required>
                        <span id="passwordErrorInfo2" class="help-inline help">密码长度应大于6</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="yzm" class="col-md-3 control-label">验证码</label>

                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="yzm" placeholder="输入验证码" maxlength="4">
                        <span class="help-inline help">验证码输入错误</span>
                    </div>
                    <img id="yzm-img" src="public/php/code_char.php" title="看不清，点击换一张">
                    <span class="yzm-img-click">点击换一张</span>
                </div>

                <div class="form-group">
                    <div class="checkbox col-md-offset-3">
                        <label>
                            <input id="isagree" type="checkbox" value="remember-me">同意网站策略 &nbsp;|&nbsp; <a href="index.php?c=index&a=login" style="text-decoration: none;">登录</a>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <button id="register" class="btn btn-lg btn-primary btn-block" type="button">注册</button>
                    </div>
                </div>
            </form>
        </div>        
    </div>

<script type="text/javascript" src="public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="public/js/register.js"></script>
</body>
</html>