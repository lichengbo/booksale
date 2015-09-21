<?php if (!defined('THINK_PATH')) exit();?><nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="nav-header">
                <a class="navbar-brand" href="#">图书销售系统</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul id="mynav" class="nav navbar-nav">
                    <li>
                        <a href="stock_in.php">进书</a>
                    </li>
                    <li>
                        <a href="stock_out.php">退书</a>
                    </li>
                    <li>
                        <a href="sale.php">销售</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            统计
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="storage.php">库存表</a>
                            </li>
                            <li>
                                <a href="salerecord.php">销售量表</a>
                            </li>
                            <li>
                                <a href="stock_inrecord.php">进货记录</a>
                            </li>
                            <li>
                                <a href="stock_outrecord.php">退货记录</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>