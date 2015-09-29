<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>图书销售系统-库存</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/animate.css" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="panel panel-default" style="margin-top:80px;">
            <div class="panel-heading">库存表</div>
            <div class="table-responsive">
                <table role="grid" id="DataTables_Table_1"class="table table-striped table-bordered table-hover m-b-none">
                    <thead>
                        <tr role="row">
                            <th>ISBN</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版社</th>
                            <th>库存量</th>
                        </tr>
                    </thead>
                    <tbody id="storagetable">
                        <!-- <tr class="odd" role="row">
                            <td class="sorting_1">1222222222</td>
                            <td>599</td>
                            <td>1000</td>
                        </tr>
                        <tr class="even" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Firefox 1.5</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="odd" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Firefox 2.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                         -->
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
            if(i == 3)
                $(this).addClass('active');
        });
        $.ajax({
            type: "GET",
            url: "index.php?c=index&a=storage_data",
            data:{},
            dataType: "json",
            success: function(result)
            {
                if(result.status) {
                    for(var i = 0; i < result.data.length; i++)
                    {
                        $('#storagetable').append($('<tr class="odd" role="row"><td class="sorting_1">'+result.data[i].isbn+'</td><td>《'+result.data[i].bookname+'》</td><td>'+result.data[i].author+'</td><td>'+result.data[i].publisher+'</td><td>'+result.data[i].storage_size+'</td></tr>'));
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