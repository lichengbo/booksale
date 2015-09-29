<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>图书销售系统-进货记录</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/animate.css" type="text/css" />
</head>
<body>
    <?php
 include 'navbar.php'; ?>

    <div class="container">
        <div class="panel panel-default" style="margin-top:80px;">
            <div class="panel-heading">进货记录表</div>
            <div class="table-responsive">
                <table role="grid" id="DataTables_Table_1"class="table table-striped m-b-none">
                    <thead>
                        <tr role="row">
                            <th>进货ID</th>
                            <th>ISBN</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版社</th>
                            <th>供应商</th>
                            <th>进价</th>
                            <th>进货量</th>
                            <th>进货总价</th>
                            <th>进货日期</th>
                        </tr>
                    </thead>
                    <tbody id="saleRecordBody">
                        <!-- <tr class="odd" role="row">
                            <td class="sorting_1">《JavaScript进阶》</td>
                            <td>不知道</td>
                            <td>机械工业出版社</td>
                            <td>1.7</td>
                            <td>1000</td>
                        </tr>
                        <tr class="even" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Firefox 1.5</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr> -->
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>

<script type="text/javascript" src="public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script> 
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#mynav').find('li').each(function(i)
        {
            if(i == 5)
                $(this).addClass('active');
         });
        $.ajax({
            type: "POST",
            url: "index.php?c=index&a=stock_inrecord_data",
            data:{},
            dataType: "json",
            success: function(result)
            {
                if(result.status) {
                    for(var i = 0; i < result.data.length; i++)
                    {
                        var total_price = result.data[i].stock_in_price * result.data[i].stock_in_size
                        $('#saleRecordBody').append($('<tr class="odd" role="row"><td class="sorting_1">'+result.data[i].stock_in_id+'</td><td>'+result.data[i].isbn +'</td><td>《'+result.data[i].bookname +'》</td><td>'+result.data[i].author+'</td><td>'+result.data[i].publisher+'</td><td>'+result.data[i].supplier_name+'</td><td>'+result.data[i].stock_in_price+'</td><td>'+result.data[i].stock_in_size+'</td><td>'+total_price+'</td><td>'+result.data[i].stock_in_date+'</td></tr>'));
                    }
                } else {
                    alert(result.info);
                    if(result.info == '您没有该操作权限') {
                        location.href = 'index.php?c=index&a=sale';
                    }
                }

                
            },
            error: function()
            {
                console.log("ajax submit error");
            }

        })
    })
</script>
</body>
</html>