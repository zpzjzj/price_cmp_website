path="/home/zhaoping/work/website/codeigniter/application/models/"
args="keyword=$1"

if [ -n "$2" ]; then
	args=$args" -a page_num=$2"
fi

cd $path"price_cmp"

scrapy crawl taobao -a $args -t json -o $path"taobao_"$1.json
scrapy crawl amazon -a $args -t json -o $path"amazon_"$1.json
