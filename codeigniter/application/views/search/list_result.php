<!DOCTYPE html>
<html>
<head>
	<title> Price Compare Search </title>
	<link href="/static/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<h1>Price Compare</h1>
	<form method="get" action="/index.php/search/scrape">
      <div class="col-lg-6">
        <input class="form-control input-lg" name="keyword"></div>
      <div class="col-lg-6">
			<button type="submit" class="btn-lg btn-primary"> search </button>
      </div>
	</form>
	<div class="col-lg-6" style="padding-top: 20px;">
		<table class="table table-striped table-hover ">
			<?php $index = 1 ?>
			<?php foreach ($items as $item): ?>
				<?php if($index % 2 == 0): ?>
					<tr class="info">
				<?php else: ?>
					<tr class="success">
				<?php endif ?>
				<td><h4><a href=<?= $item["url"] ?>><?=$item["name"] ?></a></h4></td>
				<td><p><strong>￥<?= $item["price"] ?></strong><p></td>
			</tr>
			<?php ++$index ?>
			<?php endforeach; ?>
		</table>
	</div>

	<ul class="pagination pagination-lg">
		<?php
			$keyword = join("+", 
				array_map(function($str){
					return urlencode($str);
				}, $keyword));	//encode keyword string
			$goto_page = function($page_index) use($keyword){
				return "/index.php/search/scrape?keyword=$keyword&page_index=$page_index";
			};
			
			const PAGE_NUM = 5;
			if($page_index > 1): ?>
	  			<li><a href=<?= $goto_page($page_index - 1) ?>>«</a></li>
	  	<?php endif ?>
	  		<!-- go to previous page -->

	  	<?php 
	  		$low = intval(($page_index - 1) / PAGE_NUM) * PAGE_NUM + 1;
	  		for($i = $low; $i < min($low + PAGE_NUM, $page_num + 1); ++$i): ?>
	  	<?php if($i == $page_index): ?>
	  		<li class="active">
	  	<?php else: ?>
	  		<li>
	  	<?php endif ?>
	  		<a href=<?= $goto_page($i) ?>> <?= $i ?></a></li>
	  	<?php endfor ?>		
	  	<?php if($page_index < $page_num): ?>
	  		<li><a href=<?= $goto_page($page_index + 1) ?>>»</a></li>
	  		<!-- go to next page -->
	  	<?php endif ?>
	  	
	</ul>
</div>
	<script src="/static/jquery-1.11.1.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</body>
</html>