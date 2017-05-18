# null_handle
在今天的开发过程中发现这样的一个问题：

因数据库字段类型包含null类型，然后服务器端查询到的数据封装成json格式后也包含null，然后导致客户端在解析的时候出现奔溃的情况。

本打算由客户端来解决这个问题，无非就是加个判断，但仔细一想，若返回的数据是一个多维数组且包含N多的字段，那么客户端在判断的时候需要逐一判断，如此一来CPU、内存什么的杠杠的就上去了

而后如此艰巨的任务自然而然就交由服务器端来解决。

你们都知道程序员大都很懒的，因此针对这个问题我也去搜索了，结果给出的答案不出我所料，基本上都是客户端来解决，可你他妈想啊，客户端就那么点内存还不够跑程序的，怎么能用来处理这种琐事呢。介于此，服务器端果断发挥大无畏的精神，既然搜索不到，那我们就自己写。

在对查询到的数据进行分析之后发现是一个多维数组，而且他娘的数组的长度还不确定，这尼玛还得用递归。

无限修改调试中…

经过不懈的努力终于有所成就了，我也就不卖关子了，直接上代码。

（请注意其中的&符号）

//数据null处理

/*

* 该方法递归判断传入的数组中的每一个值是否为null,若为Null，则转换为””

* $array:为要处理的数组或字符串

* $replace:为null要 替换成的字符串，默认为””，也可在调用该方法的时候，默认一个值例如 “kong”

* */

function null_handle(&$array,$replace=””){

if(is_array($array)){

foreach($array as $first_key=>&$first_item){

if(is_null($first_item)){

$array[$first_key] = &$replace;

}

if(is_array($first_item)){

null_handle($first_item,$replace);

}

}

}else{

$array = $replace;

}

return $array;

}

 

//调用方法

//第二个参数，可填可不填，填了则使用该参数，否则则使用默认””

null_handle($data,”kong”)

如果还有什么不明白的地方，欢迎加我QQ进行咨询，请注明技术咨询

本人QQ：980569038

也可以扫码本人微信：

![image](http://www.itinfor.cn/wp-content/uploads/2017/04/微信图片_20170518101335.jpg)

若该文章对您有一定帮助，欢迎打赏
![image](http://www.itinfor.cn/wp-content/uploads/2017/04/微信图片_20170518101700-577x1024.png)
![image](http://www.itinfor.cn/wp-content/uploads/2017/04/微信图片_20170518101629.jpg)
![image](http://www.itinfor.cn/wp-content/uploads/2017/04/微信图片_20170518101625-1-754x1024.jpg)

（点击图片可放大）

本人原创，转载请注明出处

http://www.itinfor.cn/archives/1278
