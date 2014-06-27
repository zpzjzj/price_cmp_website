<?php
class Search_model extends CI_model{
	const PAGE_NUM = 10;
	public function scrape($keyword){
		exec("/home/zhaoping/work/website/codeigniter/application/models/scrape.sh \"".join(" ", $keyword)."\" ".self::PAGE_NUM." 2>&1", $output);
		// var_dump($output);
	}
}
?>