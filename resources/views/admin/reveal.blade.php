<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>广告-有点</title>
    <link rel="stylesheet" type="text/css" href="css/css.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="js/page.js" ></script> -->
    <style type="text/css">
        ul li{
            list-style: none;
            float: left;
            margin-left: 20px;
        }
    </style>
</head>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">分类管理</a>&nbsp;-</span>&nbsp;分类查看
        </div>
    </div>
    <div class="page">
        <!-- banner页面样式 -->
        <div class="banner">

            <!-- banner 表格 显示 -->
            <div class="banShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66px" class="tdColor tdC">序号</td>
                        <td width="308px" class="tdColor">名称</td>
                        <td width="215px" class="tdColor">是否显示</td>
                        <td width="125px" class="tdColor">操作</td>
                    </tr>

                    @foreach($data as $spread)
                        <tr sort_id="{{$spread->id}}">
                            <td>{{$spread->id}}</td>
                            <td>{{$spread->sort}}</td>
                            @if($spread->hidden==1)
                                <td>是</td>
                            @endif
                            @if($spread->hidden==2)
                                <td>否</td>
                            @endif
                            <td>
                                    <img class="operation revise"
                                         src="img/update.png">
                                <img class="operation delban"
                                     src="img/delete.png"
                                     data-id="{{$spread->id}}"></td>
                        </tr>
                    @endforeach
                </table>
                <div class="paging">{{$data->links()}}</div>
            </div>
            <!-- banner 表格 显示 end-->
        </div>
        <!-- banner页面样式end -->
    </div>

</div>


<!-- 删除弹出框 -->
<div class="banDel">
    <div class="delete">
        <div class="close">
            <a><img src="img/shanchu.png" /></a>
        </div>
        <p class="delP1">你确定要删除此条记录吗？</p>
        <p class="delP2">
            <a href="#" class="ok yes" >确定</a><a class="ok no">取消</a>
        </p>
    </div>
</div>
<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(document).ready(function() {
        $(".delban").click(function(){
            var id=$(this).data("id");
            $('.banDel').show();
        })
        $('.ok').click(function(){
            var id=$('.delban').data("id");
            var url="/deldo";
            var data={};
            data.id=id;
            $.ajax({
                type:"post",
                data:data,
                url:url,
                dataType:"json",
                success:function(msg){
                    if(msg.code==000005)
                        console.log(msg.status);
                    window.location.href = "reveal";
                }
            })
        });
        //修改
        $(".revise").click(function(){
            var _this=$(this);//当前点击的编辑的按钮
            var sort_id= _this.parents("tr").attr('sort_id');
            location.href="alter?sort_id="+sort_id;
            })


    })
</script>
</html>
