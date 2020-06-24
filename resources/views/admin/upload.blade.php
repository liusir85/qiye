<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<link rel="stylesheet" href="/js/uploadify/uploadify.css">
<script src="/js/uploadify/jquery.js"></script>
<script src="/js/uploadify/jquery.uploadify.js"></script>
<style>
	.show img {
		width:  200px;
		height: 200px;
	}
	.show video {
		width:  240px;
		height: 150px;
	}
</style>
<body>
	<input type="file" name="file_upload" id="file_upload">
	<div class="show">上传</div>
</body>
</html>

<script>
	$(document).ready(function(){
		$("#file_upload").uploadify({
			'swf' : "/js/uploadify/uploadify.swf",
			'uploader' : "/uploadadd",
			'buttonText' : "上传",
			onUploadSuccess:function(msg,newpath,info){
				if(msg.type=='.mp4'){
					var video_str='<video src="'+newpath+'" controls="controls"></video>';
					$(".show").append(video_str);
				}else{
					var img_str='<img src="'+newpath+'" controls="controls">';
					$(".show").append(img_str);
				}
			}
		});
	});
</script>