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
       function ConvertJSONDateToJSDateObject(JSONDateString) { 
var date = new Date(parseInt(JSONDateString.replace("/Date(", "").replace(")/", ""), 10)); 
return date; 
} 
        $('#mynav').find('li').each(function(i)
        {
            if(i == 3)
                $(this).addClass('active');
         });
        $.ajax({
            type: "GET",
            url: "http://localhost/BookSale/contraller/stock_inrecord.php",
            data:{},
            dataType: "json",
            success: function(result)
            {
                
                //console.log(result);
                for(var i = 0; i < result.length; i++)
                {
                    $('#saleRecordBody').append($('<tr class="odd" role="row"><td class="sorting_1">'+result[i].ISBN+'</td><td>《'+result[i].book_name +'》</td><td>'+result[i].author+'</td><td>'+result[i].publisher+'</td><td>'+result[i].supplier_name+'</td><td>'+result[i].stock_in_price+'</td><td>'+result[i].stock_in_size+'</td><td>'+result[i].total_price+'</td><td>'+result[i].stock_in_date.date+'</td></tr>'));

                   /* var dateObj = JSON.parse(result[i].stock_in_date);
                    var date = new Date(dateObj.time);
                    var dateStr = date.getYear() + '-' +date.getMonth() + '-' + date.getDate();
                    alert(dateStr);*/
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