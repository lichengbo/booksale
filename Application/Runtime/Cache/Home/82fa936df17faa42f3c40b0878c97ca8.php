<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>图书销售系统-销售</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="panel panel-default" style="margin-top:80px;">
            <div class="panel-heading">
                <div class="container">
                    <div class="row">
                        <div id="searchISBN" class="input-group col-md-6">
                            <input type="text" class="form-control" placeholder="输入您想购买的书籍">        
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">搜索</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table role="grid" id="DataTables_Table_1" class="table table-striped m-b-none">
                    <thead>
                        <tr role="row">
                            <th>ISBN</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版社</th>
                            <th>价格</th>
                            <th>剩余数量</th>
                            <th>购买</th>
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
            <h4 class="modal-title" id="myModalLabel">购买订单详细信息</h4>
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
            <button type="button" id="stockInSubmit" class="btn btn-primary">确认购买</button>
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
        $.ajax({
            type: "GET",
            url: "http://localhost/BookSale/contraller/sale.php",
            data:{ISBN:find},
            dataType: "json",
            success: function(result)
            {
                
                console.log(result);

                if(result == '库存中未找到该书籍')
                    alert(result);

                else if(result)
                {

                    for(var i = 0; i < result.length; i++)
                        $('#saledRecord').append($('<tr class="odd" role="row"><td>'+ result[i].ISBN +'</td><td>《'+result[i].name+'》</td><td>'+result[i].author+'</td><td>'+ result[i].publisher +'</td><td>'+ result[i].price +'</td><td>'+ result[i].storage_size +'</td><td><button data-toggle="modal" data-target="#myModal" class="btn btn-default">提交</button></td></tr>'));

                    var d_ISBN = 0, d_saleSize = 0, storageSize = 0;
                    $('#saledRecord').find('button').each(function(i)
                    {
                        $(this).click(function()
                        {
                            $('#buydetailbody').find('tr').remove();

                            $('#buydetailbody').append($('<tr class="odd" role="row"><td class="sorting_1">ISBN</td><td>'+result[i].ISBN+'</td></tr><tr><td>书名</td><td>《'+result[i].name+'》</td></tr><tr><td>作者</td><td>'+result[i].author+'</td></tr><tr><td>出版社</td><td>'+result[i].publisher+'</td></tr><tr><td>价格</td><td>'+result[i].price+'</td></tr><tr><td>剩余数量</td><td>'+result[i].storage_size+'</td></tr><tr><td>购买数目</td><td><input type="number" min=0 max='+result[i].storage_size+'></td></tr>'));

                            d_ISBN = result[i].ISBN;
                            storageSize = result[i].storage_size;
                        });
                    });

                     $('#stockInSubmit').click(function()
                    {
                        d_saleSize = $('#buydetailbody').find('input').val();
                        //alert(d_ISBN+ ' ' +d_supplyID+ ' '+d_price+ ' ' +d_size);
                        if(d_saleSize > 0 && d_saleSize <= storageSize)
                        {                      
                            $.ajax({
                                type: "GET",
                                url: "http://localhost/BookSale/contraller/sale_submit.php",
                                data:{ISBN: d_ISBN,saleSize:d_saleSize},
                                dataType: "text",
                                success: function(result)
                                {
                                    if(result == '购买成功')
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
                        else if(d_saleSize > storageSize)
                        {
                            alert('购买数量大于库存量')
                        }

                        else 
                        {
                            alert('购买数量必须大于0')
                        }
                        
                    });
                        
                }
               else
                    alert('没能找到该书籍！');
                
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