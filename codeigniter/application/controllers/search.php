<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	const ITEMS_PER_PAGE = 10;
	private $res = array();
	private $keyword = "";
	private $page_num = 0;

	public function __construct(){
        parent::__construct();	
        $this->load->model('search_model', 'search');
    }

	public function index(){
		$this->load->view('search/search');
	}

	/**
	 * @param index of page to get, start from 1, no larger than the max page number
	 */
	public function get_page($page_index){//start from 1
		$data = array(
			'items' => array_slice($this->res, 
				($page_index - 1) * self::ITEMS_PER_PAGE, self::ITEMS_PER_PAGE),
			'keyword' => $this->keyword,
			'page_index' => $page_index, 
			'page_num' => $this->page_num);
		$this->load->view('search/list_result', $data);
	}

	public function scrape(){
		$keyword = $this->input->get('keyword');
		$keyword = explode(' ', $keyword);
		sort($keyword);
		if($keyword != $this->keyword){//new keyword
			$this->generate_result($keyword);
			$this->keyword = $keyword;
		}

		$page_index = $this->input->get('page_index');
		if($page_index === false){
			//if not pass the arg then return first page
			$page_index = 1;
		}
		$this->get_page($page_index);
	}

	/**
	 *	@param array of keyword
	 *	set $res = array(taotao_list, amazon_list, ...)
	 */
	private function generate_result($keyword){
		$websites = array("taobao", "amazon");
		$files = array_map(
			function($site) use ($keyword){
				return MODELS_PATH.$site."_".join("_",$keyword).".json";
			}, array("taobao", "amazon"));
		//eg. taobao_keyboard.json
		
		if(! array_reduce($files, 
			function($carry, $filename){
				return $carry && file_exists($filename);}, true)){
			$this->search->scrape($keyword);
		}//if any of files not exists, then scrape

		$this->arrange_items(array_map(
			function($filename){
				return json_decode(file_get_contents($filename), true);}, $files));
		//list of data
	}

	/**
	 * merge the 2 things crossingly together
	 * @param array(taobao_list, amazon_list, ...)
	 */
	private function arrange_items($arr){
		while(!empty($arr)){
			foreach ($arr as $index => & $items) {
				if(empty($items))
					unset($arr[$index]);
				else
					array_push($this->res, array_pop($items));
			}
		}
		$this->page_num = ceil(count($this->res) / self::ITEMS_PER_PAGE);
	}
}

?>