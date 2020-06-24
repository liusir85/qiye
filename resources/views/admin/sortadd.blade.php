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
					href="#">分类管理</a>&nbsp;-</span>&nbsp;分类添加
			</div>
		</div>
		<div class="page ">
			<!-- 会员注册页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>分类添加</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;分类名称：<input type="text" class="input3" name="sort"/>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;是否显示：<label><input type="radio" checked="checked" name="hidden" value="1"/>是</label> <label><input
									type="radio" name="hidden" value="2"/>否</label>
					</div>

					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" name="btn">提交</button>
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
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(document).ready(function(){
        $("button[name='btn']").click(function () {
            var data={};
            data.sort=$("input[name='sort']").val();
            data.hidden=$("input[name='hidden']").val();
            var url="/classifyadd";
            $.ajax({
                type:"post",
                data:data,
                url:url,
                dataTypr:"json",
                success:function(msg){
                    console.log(msg.status);
                    window.location.href = "reveal";
                }
            })
        })
    })
</script>