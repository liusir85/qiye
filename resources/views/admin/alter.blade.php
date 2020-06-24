<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加用户-有点</title>
    <link rel="stylesheet" type="text/css" href="css/css.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">分类管理</a>&nbsp;-</span>&nbsp;分类修改
        </div>
    </div>
    <div class="page ">
        <!-- 会员注册页面样式 -->
        <div class="banneradd bor">
            <div class="baTopNo">
                <span>分类修改</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;分类名称：<input type="text" class="input3"  name="sort" value="{{$sortInfo->sort}}"/>
                </div>
                <div class="bbD">
                    @if($sortInfo->hidden==1)
                    &nbsp;&nbsp;&nbsp;是否显示：<label><input type="radio" checked="checked" name="hidden" value="1"/>是</label>
                    <label>
                        <input type="radio" name="hidden" value="2"/>否</label>
                        @endif
                        @if($sortInfo->hidden==2)
                            &nbsp;&nbsp;&nbsp;是否显示：<label><input type="radio"  name="hidden" value="1"/>是</label>
                            <label>
                                <input type="radio" name="hidden" value="2" checked="checked"/>否</label>
                        @endif

                </div>

                <div class="bbD">
                    <p class="bbDP" id="{{$sortInfo->id}}">
                        <button class="btn_ok btn_yes" name="btn"  >修改</button>
                        <a class="btn_ok btn_no" href="#">取消</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- 会员注册页面样式end -->
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(document).ready(function() {
        $("button[name='btn']").click(function(){
            var _this=$(this);//当前点击的编辑的按钮
            var id= _this.parents("p").attr('id');
            var checkedx=$('input:radio:checked').val();
            var sort= $(".input3").val();

            var data={};

            data.id=id;
            data.sort=sort;
            data.checkedx=checkedx;
            var url="/updata";
            $.ajax({
                type:"post",
                data:data,
                url:url,
                dataType:"json",
                success:function(msg){
                    if(msg.code=='0005'){
                        console.log(msg.status);
                        window.location.href = "reveal";
                    }
                }
            })
        })



    })
</script>

