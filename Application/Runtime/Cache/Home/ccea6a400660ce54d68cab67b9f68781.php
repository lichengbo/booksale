<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书销售系统-登录</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css"></head>
    <link rel="stylesheet" type="text/css" href="public/css/login.css"></head>
<body>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal">
                <div class="form-group">
                    <h2 class="form-signin-heading text-center">管理员登录</h2>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">用户名</label>
                    <div class="col-md-7">
                        <input type="text" id="username" class="form-control" placeholder="用户名" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">密码</label>
                    <div class="col-md-7">
                        <input type="password" id="password" class="form-control" placeholder="密码" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="yzm" class="col-md-3 control-label">验证码</label>

                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="yzm" placeholder="输入验证码" maxlength="4">
                    </div>
                    <img id="yzm-img" src="php/code_char.php" title="看不清，点击换一张">
                    <span class="yzm-img-click">点击换一张</span>
                </div>

                <div class="form-group">
                    <div class="checkbox col-md-offset-3">
                        <label>
                            <input type="checkbox" value="remember-me">记住登录状态 &nbsp;|&nbsp; <a href="index.php?c=index&a=register" style="text-decoration: none;">注册</a>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <button id="login" class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
                    </div>
                </div>
            </form>
        </div>        
    </div>

<script type="text/javascript" src="public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="public/js/login.js"></script>
</body>
</html>