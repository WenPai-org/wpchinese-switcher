/*
Powered by WP Chinese Switcher Plugin  ( https://oogami.name/project/wpcs/ )
Search Variant JS

This JS  try to get your blog's search form element , and append a '<input type="hidden" name="variant" value="VALUE" />' child to this element . So If you run a search , browser will submit the "variant" var to server , the "variant" 's value is set  by your current Chinese Language ( 'zh-hans' for Chinese Simplfied or 'zh-hant' for Chinese Traditional etc...)

If you are in a page with no Chinese Switcher, this file will not be loaded .

*/

window.addEventListener('load', function() {
	if(typeof wpcs_target_lang == 'undefined') return;

	var theTextNode = document.querySelector('input[name="s"]');
	if (theTextNode) {
		var wpcs_input_variant = document.createElement("input");
    wpcs_input_variant.id = 'wpcs_input_variant';
    wpcs_input_variant.type = 'hidden';
    wpcs_input_variant.name = 'variant';
    wpcs_input_variant.value = wpcs_target_lang;
    theTextNode.parentNode.appendChild(wpcs_input_variant);
	}
});
