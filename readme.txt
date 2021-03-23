=== WP Chinese Switcher ===
Contributors: wpfanyi
Donate link: https://oogami.name/donate/
Tags: chinese, 中文, 繁体, 简体, 繁简转换, Chinese Simplified, Chinese Traditional, widget, sidebar
Requires at least: 4.5
Tested up to: 5.7
Stable tag: 1.0.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the language conversion function between Chinese Simplified and Chinese Traditional to your WP Blog. Released under GPL license.

== Description ==
This plugin is designed for Chinese bloggers. It adds the language conversion function between Chinese Simplified and Chinese Traditional to your WP Blog. The conversion is done in the server-side using a conversion table copied from Mediawiki. To use this plugin, just activate it and add the widget to the sidebar. The widget will output the Chinese Simplfied / Traditional Version's link of current page.

这个插件为中文Blogger设计, 提供完整的基于服务器端的中文繁简转换解决方案. 相比用Javascript进行客户端繁简转换, 本插件提供的转换功能更为专业和可靠, 支持六种中文语言: 简体中文(zh-hans), 繁体中文(zh-hant) , 台湾正体(zh-tw), 港澳繁体(zh-hk), 马新简体(zh-sg)和大陆简体(zh-cn); 并且提供更多其它特性. 插件使用的繁简转换表和核心转换技术均来源于Mediawiki, 最早由中文维基的zhengzhu同学发明.

使用方法: 激活插件后到侧边栏添加本插件的Widget即可. 插件将在后台"Settings"菜单里增加"Chinese Switcher"子菜单. 您可以到[我的博客](https://oogami.name/ "Demo Link")查看演示, 侧边栏的右上方为本插件输出的Widget效果. (CSS是另加的)

最新稳定版本: Version 1.0

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

== Frequently Asked Questions ==

= Why choosing this plugin =

I. 相比Javascrip繁简转换, 服务器端繁简转换具有非常多优点. 特别在Javascript受限制场合
(如Opera Mini/ iPhone等移动浏览器), javascript的繁简转换毫无作用, 而本插件则完全不受影响.

II. 本插件完全中文化. 从输出的Widget到后台菜单, 代码里注释都是中文; 后台管理界面内置中文繁简自适应和切换功能.
您无需任何适应就能使用本插件并根据自己需要修改代码.


== Changelog ==

## 1.0.0 ###

* 删除/隐藏多种不常用的中文转换版本
* 修正多处新版本 PHP 报错
* 初始版本发布
