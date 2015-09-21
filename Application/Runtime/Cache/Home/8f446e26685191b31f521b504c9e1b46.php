<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书销售系统-登录</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css"></head>
    <link rel="stylesheet" type="text/css" href="public/css/login.css"></head>
<body>
    <div class="container">
        <div class="container">
            <form class="form-signin">
                <div class="form-group">
                    <h2 class="form-signin-heading ">管理员登录</h2>
                </div>
                <div class="form-group">
                    <input type="text" id="username" class="form-control" placeholder="Admin" required autofocus>
                </div>
                
                <div class="form-group">
                    <input type="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me">Remember me
                    </label>
                </div>
                <button id="login" class="btn btn-lg btn-primary btn-block" type="button">登录</button>
            </form>
        </div>
    </div>

<script type="text/javascript" src="public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="public/js/login.js"></script>
</body>
</html>