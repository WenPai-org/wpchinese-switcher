<?php

/**
 *wp super cache plugin. Add basic compability with "php cache" mode of wp super cache plugin. Experimental!
 *
 *Don't edit this file manully.
 *
 * @since 1.1.11
 *
 */

$GLOBALS['wp_supercache_wpcs_version'] = '1.0';

function wp_supercache_wpcs_get_prefered_language($accept_languages, $target_langs, $flag = 0) {
    $langs = array();
    preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $accept_languages, $lang_parse);

    if (count($lang_parse[1])) {
        $langs = array_combine($lang_parse[1], $lang_parse[4]);//array_combine需要php5以上版本
        foreach ($langs as $lang => $val) {
            if ($val === '') {
                $langs[$lang] = '1';
            }
        }
        arsort($langs, SORT_NUMERIC);
        $langs = array_keys($langs);
        $langs = array_map('strtolower', $langs);

        foreach ($langs as $val) {
            if (in_array($val, $target_langs)) {
                return $val;
            }
        }

        if ($flag) {
            $array = array('zh-hans', 'zh-cn', 'zh-sg', 'zh-my');
            $a     = array_intersect($array, $target_langs);
            if ( ! empty($a)) {
                $b = array_intersect($array, $langs);
                if ( ! empty($b)) {
                    $a = each($a);

                    return $a[1];
                }
            }

            $array = array('zh-hant', 'zh-tw', 'zh-hk', 'zh-mo');
            $a     = array_intersect($array, $target_langs);
            if ( ! empty($a)) {
                $b = array_intersect($array, $langs);
                if ( ! empty($b)) {
                    $a = each($a);

                    return $a[1];
                }
            }
        }

        return 'null';
    }

    return 'null';
}

function wp_supercache_wpcs_admin() {
    $id = 'wpcs-section';
    ?>
  <fieldset id="<?php echo $id; ?>" class="options">
    <h4>WP Chinese Switcher</h4>
    <p>Wp super cache - WP Chinese Switcher plugin is activated. To uninstall it, go to WP Chinese Switcher plugin
      setting page.</p>
  </fieldset>
    <?php
}

add_cacheaction('cache_admin_page', 'wp_supercache_wpcs_admin');

function wp_supercache_wpcs_cache_key($cachekey) {
    global $wpcs_options;

    $browser_lang = wp_supercache_wpcs_get_prefered_language($_SERVER['HTTP_ACCEPT_LANGUAGE'], $wpcs_options['wpcs_used_langs'], $wpcs_options['wpcs_auto_language_recong']);

    $cookie_lang = 'null';
    foreach ($_COOKIE as $key => $val) {
        if (preg_match("/^wpcs_variant_/", $key)) {
            $cookie_lang = $val;
            break;
        }
    }

    $is_redirect = 'direct';
    foreach ($_COOKIE as $key => $val) {
        if (preg_match("/^wpcs_is_redirect_/", $key)) {
            $is_redirect = 'redirect';
            break;
        }
    }

    return $cachekey . '_' . $browser_lang . '_' . $cookie_lang . '_' . $is_redirect;
}

add_cacheaction('wp_cache_key', 'wp_supercache_wpcs_cache_key');
