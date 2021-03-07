<?php
/**
 * 本文档是为第三方应用预留的. 本插件中不会加载和使用这个文档.
 *
 * 通过include本文档, 您可以使用中文繁简转换函数zhconversion($str, $variant)
 * 如果$_GET['doconversion']或$_POST['doconversion'])有设置, 本文档将获取$_REQUEST['data']并把其转换为$_REQUEST['variant']语言后输出.
 *
 * 您不应该也不需要在Wordpress进程, 插件/主题 或 任何已经包含wp-config.php文档的php进程中包含本文档
 *
 * 本插件目录下convert.html是一个简单的在线繁简转换工具, 使用了本php文档. 当作是本插件的bonus吧 ^_^
 */

global $zh2Hans, $zh2Hant, $zh2TW, $zh2CN, $zh2SG, $zh2HK;
require_once(dirname(__FILE__) . '/ZhConversion.php');

global $wpcs_langs;
$wpcs_langs = array(
    'zh-hans' => array('zhconversion_hans', 'zh2Hans', '简体中文'),
    'zh-hant' => array('zhconversion_hant', 'zh2Hant', '繁體中文'),
    'zh-cn'   => array('zhconversion_cn', 'zh2CN', '大陆简体'),
    'zh-hk'   => array('zhconversion_hk', 'zh2HK', '港澳繁體'),
    'zh-sg'   => array('zhconversion_sg', 'zh2SG', '马新简体'),
    'zh-tw'   => array('zhconversion_tw', 'zh2TW', '台灣正體'),
    'zh-mo'   => array('zhconversion_hk', 'zh2MO', '澳門繁體'),
    'zh-my'   => array('zhconversion_sg', 'zh2MY', '马来西亚简体'),
    'zh'      => array('zhconversion_zh', 'zh2ZH', '中文'),
);

if (empty($nochineseconversion) && empty($GLOBALS['nochineseconversion'])) {
    if ((isset($_GET['dochineseconversion']) || isset($_POST['dochineseconversion'])) &&
        isset($_REQUEST['data'])) {
        $wpcs_data = get_magic_quotes_gpc() ? stripslashes($_REQUEST['data']) : $_REQUEST['data'];
        $wpcs_variant = str_replace('_', '-', strtolower(trim($_REQUEST['variant'])));
        if ( ! empty($wpcs_variant) && in_array($wpcs_variant, array(
                'zh-hans',
                'zh-hant',
                'zh-cn',
                'zh-hk',
                'zh-sg',
                'zh-tw',
                'zh-my',
                'zh-mo'
            ))) {
            echo zhconversion($wpcs_data, $wpcs_variant);
        } else {
            echo $wpcs_data;
        }
        die();
    }
}

function zhconversion($str, $variant) {
    global $wpcs_langs;

    return $wpcs_langs[$variant][0]($str);
}

function zhconversion_hant($str) {
    global $zh2Hant;

    return strtr($str, $zh2Hant);
}

function zhconversion_hans($str) {
    global $zh2Hans;

    return strtr($str, $zh2Hans);
}

function zhconversion_cn($str) {
    global $zh2Hans, $zh2CN;

    return strtr(strtr($str, $zh2CN), $zh2Hans);
}

function zhconversion_tw($str) {
    global $zh2Hant, $zh2TW;

    return strtr(strtr($str, $zh2TW), $zh2Hant);
}

function zhconversion_sg($str) {
    global $zh2Hans, $zh2SG;

    return strtr(strtr($str, $zh2SG), $zh2Hans);
}

function zhconversion_hk($str) {
    global $zh2Hant, $zh2HK;

    return strtr(strtr($str, $zh2HK), $zh2Hant);
}

function zhconversion_zh($str) {
    return $str;
}

?>
