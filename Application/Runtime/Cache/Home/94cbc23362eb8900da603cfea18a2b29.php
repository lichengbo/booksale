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
    <?php
 include 'navbar.php'; ?>

    <div class="container">
        <div class="panel panel-default" style="margin-top:80px;">
            <div class="panel-heading">库存表</div>
            <div class="table-responsive">
                <table role="grid" id="DataTables_Table_1"class="table table-striped m-b-none">
                    <thead>
                        <tr role="row">
                            <th>ISBN</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版社</th>
                            <th>进价</th>
                            <th>月销量</th>
                            <th>库存量</th>
                            <th>月利润</th>
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
            url: "http://localhost/BookSale/contraller/storage.php",
            data:{},
            dataType: "json",
            success: function(result)
            {
                
                //console.log(result);
                for(var i = 0; i < result.length; i++)
                {
                    $('#storagetable').append($('<tr class="odd" role="row"><td class="sorting_1">'+result[i].ISBN+'</td><td>《'+result[i].name+'》</td><td>'+result[i].author+'</td><td>'+result[i].publisher+'</td><td>'+result[i].price+'</td><td>'+result[i].saled_size_monthly+'</td><td>'+result[i].storage_size+'</td><td>'+result[i].profit_monthly+'</td></tr>'));
                }
                
            },
            error: function()
            {
                alert("ajax submit error");
            }

        })
    })
</script>
</body>
</html>