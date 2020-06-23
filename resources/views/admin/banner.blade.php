<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="/css/css.css" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">导航栏管理</a>&nbsp;-</span>&nbsp;展示管理
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
							<td width="450px" class="tdColor">链接</td>
							<td width="215px" class="tdColor">是否显示</td>
							<td width="180px" class="tdColor">排序</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
						@foreach($data as $v)
						<tr id="{{$v->id}}">
							<td>{{$v->id}}</td>
							<td>{{$v->name}}</td>
							<td>{{$v->url}}</td>
							<td filed="hidden">
							@if($v->hidden==1)
								<span class="span_test1">是</span>
							@else
								<span class="span_test1">否</span>
							@endif
							</td>
							<td filed="sorts">
								<span class="span_test">{{$v->sorts}}</span>
								<input type="text" style="display:none" value="{{$v->sorts}}" class="changeValue">
							</td>
							<td><a href="/updatebanner?id={{$v->id}}"><img class="operation"
									src="/img/update.png"></a> <img class="operation delban"
								src="/img/delete.png"></td>
						</tr>
						@endforeach
					</table>
					<div class="pagination">{{$data->links()}}</div>
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
				<a class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
function del(){
    var input=document.getElementsByName("check[]");
    for(var i=input.length-1; i>=0;i--){
       if(input[i].checked==true){
           //获取td节点
           var td=input[i].parentNode;
          //获取tr节点
          var tr=td.parentNode;
          //获取table
          var table=tr.parentNode;
          //移除子节点
          table.removeChild(tr);
        }
    }     
}
//删除导航栏
var Id;
$(document).on('click','.delban',function(){
	Id=$(this).parents('tr').children().first().text();
})
$(document).on('click','.yes',function(){
	$.ajax({
		type:'post',
		url:'/delete',
		data:{Id:Id},
		dataType:'json',
		success:function(msg){
			if(msg.success == true){
				window.location.href=msg.url;
			}
		}
	});
})
//即点即改
$(document).on('click','.span_test',function(){
	$(this).hide().next("input").show();
})
//排序
$(document).on('blur','.changeValue',function(){
	var _this=$(this);
	var value=_this.val();
	var filed=_this.parent('td').attr('filed');
	var id=_this.parents('tr').attr('id');
	$.ajax({
		type:'post',
		url:'/changeValue',
		data:{value:value,filed:filed,id:id},
		dataType:'json',
		success:function(msg){
			if(msg.code == 1){
				_this.hide();
				_this.prev('span').text(value).show();
			}else{
				_this.hide();
				_this.prev('span').show();
			}
		}
	});
})
//是否显示
$(document).on('click','.span_test1',function(){
	var _this=$(this);
	var aaa=_this.text();
	if(aaa=='是'){
			var aaa="否";
			var value='2';
		}else{
			var aaa="是";
			var value='1';
		}
	var filed=_this.parent('td').attr('filed');
	var id=_this.parents('tr').attr('id');
	$.ajax({
		type:'post',
		url:'/changeValue',
		data:{value:value,filed:filed,id:id},
		dataType:'json',
		success:function(msg){
			if(msg.code == 1){
				_this.text(aaa);
			}
		}
	});
})
</script>
</html>