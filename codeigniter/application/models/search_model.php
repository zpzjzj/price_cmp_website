<?php
class Search_model extends CI_model{
	const PAGE_NUM = 10;


	public function scrape($keyword){
		// exec("touch /home/zhaoping/work/website/public_html/test.txt 2>&1", $output);
		// echo "/home/zhaoping/work/website/codeigniter/application/models/scrape.sh ".$keyword." ".self::PAGE_NUM." 2>&1";
		exec("/home/zhaoping/work/website/codeigniter/application/models/scrape.sh ".$keyword." ".self::PAGE_NUM." 2>&1", $output);
		// var_dump($output);
	}
}
?>