=== WP Chinese Switcher ===
Contributors: Ono Oogami
Donate link: https://oogami.name/donate/
Tags: chinese, 中文, 繁体, 简体, 繁简转换, Chinese Simplified, Chinese Traditional, widget, sidebar
Requires at least: 4.5
Tested up to: 4.8.3
Stable tag: 1.1.16

Adds the language conversion function between Chinese Simplified and Chinese Traditional to your WP Blog. Released under GPL license.

== Description ==
This plugin is designed for Chinese bloggers. It adds the language conversion function between Chinese Simplified and Chinese Traditional to your WP Blog. The conversion is done in the server-side using a conversion table copied from Mediawiki. To use this plugin, just activate it and add the widget to the sidebar. The widget will output the Chinese Simplfied / Traditional Version's link of current page.

这个插件为中文Blogger设计, 提供完整的基于服务器端的中文繁简转换解决方案. 相比用Javascript进行客户端繁简转换, 本插件提供的转换功能更为专业和可靠, 支持六种中文语言: 简体中文(zh-hans), 繁体中文(zh-hant) , 台湾正体(zh-tw), 港澳繁体(zh-hk), 马新简体(zh-sg)和大陆简体(zh-cn); 并且提供更多其它特性. 插件使用的繁简转换表和核心转换技术均来源于Mediawiki, 最早由中文维基的zhengzhu同学发明.

使用方法: 激活插件后到侧边栏添加本插件的Widget即可. 插件将在后台"Settings"菜单里增加"Chinese Switcher"子菜单. 您可以到[我的博客](https://oogami.name/ "Demo Link")查看演示, 侧边栏的右上方为本插件输出的Widget效果. (CSS是另加的)

最新稳定版本: Version 1.1.16

* 修复 Wordpress 4.8.3 下搜索关键字繁简自动转换失效问题.
* 自动修改页面html的lang=""属性为合适的中文语言.

术语定义:

*  页面原始版本: 即您博客页面的原始内容, 不进行中文繁简转换, 内容繁简共存. 这个页面URL就是您原来的Permalink.
*  中文转换版本: 本插件生成的页面版本, 把数据库中内容进行中文转换后输出. 输出的中文类型共六种: 简体中文(zh-hans), 繁体中文(zh-hant) , 台湾正体(zh-tw), 港澳繁体(zh-hk), 马新简体(zh-sg)和大陆简体(zh-cn).


特性(Features):

*  繁简转换页面URL支持<code>/permalink/to/your/original/post/?variant=zh-xx</code>, <code>/permalink/to/your/original/post/zh-xx/</code>和<code>/zh-xx/permalink/to/your/original/post/</code>三种形式.(zh-xx为语言代码)
*  基于词语繁简转换. 如 "网络" 在台湾正体(zh-tw)里会被转换为 "網路".
*  自动在转换后版本页面加上noindex的meta标签, 避免搜索引擎重复索引.
*  使用Cookie保存访客语言偏好. 插件将记录浏览者最后一次访问时的页面语言, 在浏览者再次访问显示对应版本. (此功能默认不开启)
*  自动识别浏览器语言. 插件将识别用户浏览器首选中文语言, 并显示对应版本页面. (此功能默认不开启)
*  中文搜索关键词简繁体通用. 这将增强Wordpress的搜索功能, 使其同时在数据库里搜索关键词的简繁体版本. 例如, 假如访客在浏览您博客页面时通过表单提交了关键词为 "網路" 的搜索, 如果您的文章里有 "网络" 这个词, 则这篇文章也会被放到搜索结果里返回. (此功能默认不开启)
*  后台可设置不转换部分HTML标签里中文.
*  Self-documented codes, easy to modify base your own needs.

如果使用缓存插件 (WP Super cache, Hyper Cache, etc), 上面部分功能(识别浏览器语言, 使用Cookie保存访客语言偏好)可能存在兼容性问题。

== Installation ==
Upload the WPCS plugin to your blog, Activate it,

To use this plugin, just add it's widget to the sidebar. The widget will output the Chinese Simplfied/ Traditional Version's link of current page.  You can also use the <code>&lt;?php wpcs_output_navi();  ?&gt; </code> tag in your template.

上传插件, 激活. 然后直接到侧边栏里添加本插件的Widget即可. Widget里已经定义好了相应元素的class
和id, 请自己加CSS. 您也可以在模板中调用 <code>&lt;?php wpcs_output_navi(); ?&gt; </code> 标签.

Widget将输出当前页面各种中文版本的导航链接. 如果您想自定义输出内容, 可以参考下面的代码, 在模板里添加.

<code>
<?php
//必须声明为全局变量,因为WP通过函数载入模板的...

global $wpcs_target_lang;          //当前页面语言的中文代码, 例如zh-cn; 如果是原始版本则为false.
global $wpcs_noconversion_url;  //当前页面原始版本链接, 即原来的Permalink.
global $wpcs_langs_urls;            //关联数组, 含有当前页面各个中文语言版本URL, 键值为语言代码(如zh-tw).
global $wpcs_langs;                   //二维数组, 保存有插件所有支持的中文语言相关信息, 外层键值为语言代码(如zh-tw). 内层键值为连续索引.

$output = '<div id="wpcs_output">';
$output .= '<span id="wpcs_original_link" class="' .
	( $wpcs_target_lang == false ? 'wpcs_current_lang' : 'wpcs_lang' ) .
	'" ><a href="' . $wpcs_noconversion_url . '" title="不转换">不转换</a></span>';

foreach( $wpcs_langs_urls as $key => $value ) {
	$output .= '<span id="wpcs_' . $key . '" class="' . //您可以根据自己需要修改, 如把span改为li
	( $wpcs_target_lang == $key ? 'wpcs_current_lang' : 'wpcs_lang' ) .
	'" ><a href="' . $value .
	'" title="' . $wpcs_langs[$key][2] . '" >' . $wpcs_langs[$key][2] . '</a></span>'; // $wpcs_langs[$key][2]为语言名称, 如 "简体中文", "港澳繁體", "臺灣正體"等
}

$output .= '</div>';
echo $output;

?>
</code>

设置本插件请到后台"Options"菜单里的"Chinese Switcher"子菜单页.

== Screenshots ==
Not yet. But you can see demo in [my blog](https://oogami.name/ "Demo Link")

== Frequently Asked Questions ==

= Why choosing this plugin =

I. 相比Javascrip繁简转换, 服务器端繁简转换具有非常多优点. 特别在Javascript受限制场合
(如Opera Mini/ iPhone等移动浏览器), javascript的繁简转换毫无作用, 而本插件则完全不受影响.

II. 本插件完全中文化. 从输出的Widget到后台菜单, 代码里注释都是中文; 后台管理界面内置中文繁简自适应和切换功能.
您无需任何适应就能使用本插件并根据自己需要修改代码.

III. 这个插件是作者为自己的[Blog](https://oogami.name/ "Author Homepage")写的, 作者有多年独立博客写作历史;
熟悉Wordpress, LAMP和Blog的相关技术和文化; 会一直维护本插件并定期发布稳定版本, 保持与最新版Wordpress的兼容性.

== Changelog ==

= 1.1.16 =
* 2017.11.07
* 修复 Wordpress 4.8.3 下搜索关键字繁简自动转换失效问题.
* 自动修改页面html的lang=""属性为合适的中文语言.

= 1.1.15 =
* 2016.04.22
* 修复 Wordpress 4.5 下搜索关键字繁简自动转换失效问题.
* 修复一些其它 bug.

= 1.1.14.2 =
* 2014.11.13
* 修复一个 bug

= 1.1.14.1 =
* 2013.11.08
* 修复1.1.14版本中引入的一个Bug (Wordpress未开启永久链接时繁简转换页里"首页"链接的url错误).

= 1.1.14 =
* 2013.11.05
* 新功能: 允许不转换所有lang="ja"的html tag里的内容.(默认关闭)
* 新功能: 不转换html中位于&lt;!--wpcs_NC_START--&gt;和&lt;!!--wpcs_NC_END--&gt;之间的内容.
* 新功能: 在Wordpress文章的html编辑器中增加一个Quick Tag, 方便快速插入&lt;!--wpcs_NC_START--&gt;和&lt;!--wpcs_NC_END--&gt;的不转换标记
* 功能增强: "不转换部分HTML标签中内容"功能现在支持使用CSS选择器
* 修复WP Super Cache兼容插件某些情况下无法正常工作的bug
* 修复某些情況下"中文搜索关键词简繁体通用"功能无法工作的bug
* 修复一些其它bug

= 1.1.13 =
* 2013.04.16
* 在<body>标签的class属性里添加当前显示页面的中文语言代码，可以用其对不同繁简语言页面应用独立的css样式
* 修复首页显示固定Page时繁简转换页面仍然为最新posts的错误。

= 1.1.12 =
* 2012.09.18
* 增加对wp cache plugin插件兼容性支持

= 1.1.10 =
* 2011.04.19
* 修复Bug

= 1.1.9 =
* 2010.9.7
* 修复大量Bug. 推荐所有人更新.

= 1.1.8 =
* 2010.7.14
* 修复wordpress安装在子目录时可能出现的繁简转换頁永久链接错误.
* 修复开启SSL时繁简转换頁永久链接错误.
* 在rel="canonical"的link标签里输出页面原始链接
* 优化代码
* 兼容Wordpress 3.0

= 1.1.7 =
* 2009.12
* 优化代码
* Bugs fix

= 1.1.6 =
*  2009.09.02
*  繁简转换页面增加一种<code>/zh-tw/original/permalink/</code>的URL形式.
*  允许自定义各种中文语言显示名称
*  优化代码

= 1.1.5 =
*  2009.08.02
*  Bugs fix
*  允许自定义"不转换"标签名称

= 1.1.4 =
*  2009.06.30
*  Bugs fix
*  大幅优化代码

更早版本略- -
