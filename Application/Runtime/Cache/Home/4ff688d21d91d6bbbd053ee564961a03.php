<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>图书销售系统-退货</title>

    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
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
    <div class="container">
        <div class="panel panel-default" style="margin-top:80px;">
            <div class="panel-heading">
                <div class="container">
                    <div class="row">
                        <div id="searchISBN" class="input-group col-md-6">
                            <input type="text" class="form-control" placeholder="输入您想退书籍的ISBN">        
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">搜索</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive" id="myTable" style="display:block;">
                <table role="grid" class="table table-striped table-bordered table-hover m-b-none">
                    <thead>
                        <tr role="row">
                            <th>订单号</th>
                            <th>ISBN</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版社</th>
                            <th>购买价格</th>
                            <th>购买数量</th>
                            <th>总价</th>
                            <th>购买日期</th>
                            <th>确认退货</th>
                        </tr>
                    </thead>
                    <tbody id="saledRecord">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">退货订单详细</h4>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
                    <table role="grid" id="DataTables_Table_1"class="table table-striped m-b-none">
                        <tbody id="buydetailbody">
                            
                        </tbody>
                    </table>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="stockInSubmit" class="btn btn-primary">退货</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </div>
      </div>
    </div>
<!-- Modal end-->

<script type="text/javascript" src="public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('#mynav').find('li').each(function(i)
    {
        if(i == 2)
            $(this).addClass('active');
    });

    $("#searchISBN").find('button').click(function()
    {
        var find = $("#searchISBN").find('input').val();
         $('#saledRecord').find('tr').remove();
        if(find.length > 0)
        {
            $.ajax({
            type: "GET",
            url: "http://localhost/BookSale/contraller/stock_out.php",
            data:{ISBN:find},
            dataType: "json",
            success: function(result)
            {
                console.log(result);
                if(result == '未找到该书籍的购买记录')
                {
                    alert(result);
                }

                else if(result)
                {
                   
                for(var i = 0; i < result.length; i++)
                {
                    $('#saledRecord').append($('<tr class="odd" role="row"><td>'+ result[i].id +'</td><td>'+ result[i].ISBN +'</td><td>《'+result[i].name+'》</td><td>'+result[i].author+'</td><td>'+ result[i].publisher +'</td><td>'+ result[i].price +'</td><td>'+ result[i].sale_size +'</td><td>'+ result[i].total_price +'</td><td>'+ result[i].sale_date.date +'</td><td><button data-toggle="modal" data-target="#myModal" class="btn btn-default">提交</button></td></tr>'));
                }

                var d_saledID = 0, d_stockoutSize = 0;
                $('#saledRecord').find('button').each(function(i)
                {
                    $(this).click(function()
                    {
                    $('#buydetailbody').find('tr').remove();

                        $('#buydetailbody').append($('<tr class="odd" role="row"><td class="sorting_1">订单号</td><td>'+result[i].id+'</td></tr><tr class="odd" role="row"><td class="sorting_1">ISBN</td><td>'+result[i].ISBN+'</td></tr><tr><td>书名</td><td>《'+result[i].name+'》</td></tr><tr><td>作者</td><td>'+result[i].author+'</td></tr><tr><td>出版社</td><td>'+result[i].publisher+'</td></tr><tr><td>购买价格</td><td>'+result[i].price+'</td></tr><tr><td>购买数量</td><td>'+result[i].sale_size+'</td></tr><tr><td>总价</td><td>'+result[i].total_price+'</td></tr><tr><td>购买日期</td><td>'+result[i].sale_date.date+'</td></tr><tr><td>退货数目</td><td><input type="number" min=0></td></tr>'));

                        d_saledID = result[i].id;
                    });
                });

                 $('#stockInSubmit').click(function()
                 {
                    d_stockoutSize = $('#buydetailbody').find('input').val();
                    //alert(d_ISBN+ ' ' +d_supplyID+ ' '+d_price+ ' ' +d_size);
                    if(d_stockoutSize > 0)
                    {                      
                        $.ajax({
                            type: "GET",
                            url: "http://localhost/BookSale/contraller/stock_out_submit.php",
                            data:{saledID: d_saledID,stockoutSize:d_stockoutSize},
                            dataType: "text",
                            success: function(result)
                            {
                                if(result == '退货成功')
                                {
                                    alert(result);
                                    $("#myModal").modal('hide');
                                }
                                else
                                {
                                    alert(result);
                                }
                            },
                            error: function(result)
                            {
                                alert(result);
                            }
                        });
                    }
                    else
                    {
                        alert('退货数量必须大于0')
                    }
                    
                });
            }
                
            },
            error: function()
            {
                alert("ajax submit error ...");
            }

        });
        }
    });

    
</script>
</body>
</html>