<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>图书销售系统-进书</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/animate.css" type="text/css" />

</head>
<body>
<?php
include 'navbar'; ?>
    <div class="container">
            <div class="panel panel-default" style="margin-top:80px;">
                <div class="panel-heading">
                    书籍供应表
                </div>
                <div class="table-responsive">
                    <table role="grid" id="DataTables_Table_1"class="table table-striped m-b-none">
                        <thead>
                            <tr role="row">
                                <th>ISBN</th>
                                <th>书名</th>
                                <th>作者</th>
                                <th>出版社</th>
                                <th>供货商ID</th>
                                <th>供货商</th>
                                <th>报价</th>
                                <th>确认进货</th>
                            </tr>
                        </thead>
                        <tbody id="storagetable">
                            <!-- <tr class="odd" role="row">
                                <td class="sorting_1">1222222222</td>
                                <td>599</td>
                                <td>1000</td>
                            </tr>
                            -->
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
            <h4 class="modal-title" id="myModalLabel">进货订单详细</h4>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
                    <table role="grid" id="DataTables_Table_1"class="table table-striped m-b-none">
                        <tbody id="buydetailbody">
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="stockInSubmit" class="btn btn-primary">进货</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </div>
      </div>
    </div>
<!-- Modal end-->

<script type="text/javascript" src="public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script> 

<script type="text/javascript">

    $(document).ready(function()
    {
        
        $('#mynav').find('li').each(function(i)
        {
            if(i == 0)
                $(this).addClass('active');
        });

        $.ajax({
            type: "GET",
            url: "http://localhost/BookSale/contraller/stock_in.php",
            data:{},
            dataType: "json",
            success: function(result)
            {
                for(var i = 0; i < result.length; i++)
                {
                    $('#storagetable').append($('<tr class="odd" role="row"><td class="sorting_1">'+result[i].ISBN+'</td><td>《'+result[i].name+'》</td><td>'+result[i].author+'</td><td>'+result[i].publisher+'</td><td>'+result[i].id+'</td><td>'+result[i].supplier_name+'</td><td>'+result[i].supply_price+'</td><td><button data-toggle="modal" data-target="#myModal" class="btn btn-default">提交</button></td></tr>'));
                }

                var d_ISBN = 0, d_supplyID = null, d_price = 0, d_size = 0;

                $('#storagetable').find('button').each(function(i)
                {
                    $(this).click(function()
                    {
                    $('#buydetailbody').find('tr').remove();

                        $('#buydetailbody').append($('<tr class="odd" role="row"><td class="sorting_1">ISBN</td><td>'+result[i].ISBN+'</td></tr><tr><td>书名</td><td>《'+result[i].name+'》</td></tr><tr><td>作者</td><td>'+result[i].author+'</td></tr><tr><td>出版社</td><td>'+result[i].publisher+'</td></tr><tr><td>供货商ID</td><td>'+result[i].id+'</td></tr><tr><td>供货商</td><td>'+result[i].supplier_name+'</td></tr><tr><td>进价</td><td>'+result[i].supply_price+'</td></tr><tr><td>进货量</td><td><input type="number" min=0></td></tr>'));

                        d_ISBN = result[i].ISBN, d_supplyID = result[i].id, d_price = result[i].supply_price;
                    });
                })
                
                //$('#buydetailbody').find('tr').remove();

                $('#stockInSubmit').click(function()
                {
                    d_size = $('#buydetailbody').find('input').val();
                    //alert(d_ISBN+ ' ' +d_supplyID+ ' '+d_price+ ' ' +d_size);
                    if(d_size)
                    {                      
                        $.ajax({
                            type: "GET",
                            url: "http://localhost/BookSale/contraller/stock_out_submit.php",
                            data:{ISBN: d_ISBN,supplyID:d_supplyID, price:d_price, size:d_size},
                            dataType: "text",
                            success: function(result)
                            {
                                if(result == '进货成功')
                                {
                                    alert(result)
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
                        alert('购买数量必须大于0')
                    }
                    
                });
                
            },
            error: function()
            {
                alert("ajax submit error");
            }

        });
    });

</script>
</body>
</html>