echo "arg1:<"$1">"

path="/home/zhaoping/work/website/codeigniter/application/models/"
arg_keyword=" -a keyword=\"$1\""
echo "arg_keyword: $arg_keyword"

if [ -n "$2" ]; then
	arg_page=" -a page_num=$2"
else
	arg_page=""
fi

cd $path"price_cmp"

filename=$(echo $1 | tr -d '\"' | tr ' ' '_')
echo "filename: $filename"
#suppose $1 are list of keyword seperated by space
#replace space with _

cmd="scrapy crawl taobao $arg_keyword $arg_page  -t json -o  $path'taobao_'$filename.json"
echo $cmd
eval "$cmd"
cmd="scrapy crawl amazon $arg_keyword $arg_page  -t json -o  $path'amazon_'$filename.json"
echo $cmd
eval "$cmd"
