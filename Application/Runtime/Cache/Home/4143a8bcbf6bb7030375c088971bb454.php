<?php if (!defined('THINK_PATH')) exit();?><nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="nav-header">
                <a class="navbar-brand" href="#">图书销售系统</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul id="mynav" class="nav navbar-nav">
                    <li>
                        <a href="index.php?c=index&a=stock_in">进书</a>
                    </li>
                    <li >
                        <a href="index.php?c=index&a=sale">购书</a>
                    </li>
                    <li>
                        <a href="index.php?c=index&a=stock_out">退书</a>
                    </li>
                    <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            统计
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">-->
                            <li>
                                <a href="index.php?c=index&a=storage">库存表</a>
                            </li>
                            <li>
                                <a href="index.php?c=index&a=salerecord">销售量表</a>
                            </li>
                            <li>
                                <a href="index.php?c=index&a=stock_inrecord">进货记录</a>
                            </li>
                            <li>
                                <a href="index.php?c=index&a=stock_outrecord">退货记录</a>
                            </li>
                        <!--</ul>-->
                    </li>
                </ul>

                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a href="#" id="infolist" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img id="avatar" src="public/img/avatar.png" width="20px" height="20px" title="头像" class="img-circle">
                        </a>
                        <ul id="avatarlist" class="dropdown-menu animated fadeInRight">
                            <li>
                                <a href="index.php?c=user&a=profile">账户信息</a>
                            </li>
                            <li>
                                <a href="index.php?c=user&a=userlist">用户列表</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a id="logout" href="index.php?c=index&a=login">注销</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<script src="public/js/jquery-1.11.2.min.js"></script>
<script src="public/js/userinfo.js"></script>