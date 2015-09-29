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
    <div class="container">
            <div class="panel panel-default" style="margin-top:80px;">
                <div class="panel-heading">
                    书籍供应表
                </div>
                <div class="table-responsive">
                    <table role="grid" id="DataTables_Table_1"class="table table-striped table-bordered table-hover m-b-none">
                        <thead>
                            <tr role="row">
                                <th>ISBN</th>
                                <th>书名</th>
                                <th>作者</th>
                                <th>出版社</th>
                                <th>供货商ID</th>
                                <th>供货商</th>
                                <th>报价</th>
                                <th>供货量</th>
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
                    <table role="grid" id="DataTables_Table_"class="table table-striped m-b-none">
                        <tbody id="buydetailbody">
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="stockInSubmit" class="btn btn-success">进货</button>
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
            type: "POST",
            url: "index.php?c=index&a=stock_in_data",
            data:{},
            dataType: "json",
            success: function(result)
            {
                if(result.status) {
                    for(var i = 0; i < result.data.length; i++)
                    {
                        $('#storagetable').append($('<tr class="odd" role="row"><td class="sorting_1">'+result.data[i].isbn+'</td><td>《'+result.data[i].bookname+'》</td><td>'+result.data[i].author+'</td><td>'+result.data[i].publisher+'</td><td>'+result.data[i].id+'</td><td>'+result.data[i].supplier_name+'</td><td>'+result.data[i].supply_price+'</td><td>'+result.data[i].supply_size+'</td><td><button data-toggle="modal" data-target="#myModal" class="btn btn-primary">提交</button></td></tr>'));
                    }

                    var d_ISBN = 0, d_supplyID = null, d_price = 0, d_size = 0;

                    $('#storagetable').find('button').each(function(i)
                    {
                        $(this).click(function()
                        {
                            $('#buydetailbody').find('tr').remove();

                            $('#buydetailbody').append($('<tr class="odd" role="row"><td class="sorting_1">ISBN</td><td>'+result.data[i].isbn+'</td></tr><tr><td>书名</td><td>《'+result.data[i].bookname+'》</td></tr><tr><td>作者</td><td>'+result.data[i].author+'</td></tr><tr><td>出版社</td><td>'+result.data[i].publisher+'</td></tr><tr><td>供货商ID</td><td>'+result.data[i].id+'</td></tr><tr><td>供货商</td><td>'+result.data[i].supplier_name+'</td></tr><tr><td>进价</td><td>'+result.data[i].supply_price+'</td></tr><tr><td>供货量</td><td>'+result.data[i].supply_size+'</td></tr><tr><td>进货量</td><td><input type="number" min=0></td></tr>'));

                            d_ISBN = result.data[i].isbn, d_bookname = result.data[i].bookname, d_author = result.data[i].author, d_publisher = result.data[i].publisher, d_supplier_name = result.data[i].supplier_name, d_supplyPrice = result.data[i].supply_price, d_maxsize = parseInt(result.data[i].supply_size);
                        });
                    })

                    //$('#buydetailbody').find('tr').remove();

                    $('#stockInSubmit').click(function()
                    {
                        d_size = parseInt($('#buydetailbody').find('input').val());
                        if(d_size > d_maxsize) {
                            alert('供应量不足');
                        }
                        if(d_size > 0 && d_size <= d_maxsize)
                        {
                            $.ajax({
                                type: "POST",
                                url: "index.php?c=index&a=stock_in_submit",
                                data:{isbn: d_ISBN, bookname: d_bookname,author: d_author, publisher: d_publisher, supplier_name:d_supplier_name, supplyPrice:d_supplyPrice, stockin_Size:d_size},
                                dataType: "json",
                                success: function(result)
                                {
                                    if(result.status)
                                    {
                                        alert(result.info);
                                        $("#myModal").modal('hide');
                                    } else {
                                        alert(result.info);
                                    }
                                },
                                error: function()
                                {
                                    console.log('sotck_in ajax submit error');
                                }
                            });
                        }
                        if(d_size <= 0) {
                            alert('进货数量必须大于0')
                        }

                    });
                } else {
                    alert(result.info);
                    if(result.info == '您没有该操作权限') {
                        location.href = 'index.php?c=index&a=sale';
                    }
                }
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