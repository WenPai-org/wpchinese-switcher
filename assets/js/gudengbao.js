( function( blocks, element ) {
    var el = element.createElement;
    var registerBlockType = blocks.registerBlockType;
    const { RawHTML } = element;

    if (typeof wpc_switcher_navi_data != 'undefined') {
        var aProps = wpc_switcher_navi_data['wpcs_navi']
        var type_arr = wpc_switcher_navi_data['type_arr']
 
        if (type_arr[0] == 0) {
            var spans = aProps.map(function(props) {
                // const elHref = `javascript:void(window.location.href=window.location.href+(window.location.href.includes('?')?'&':'?')+'variant=${props.variant}')`
                let elHref;
                if (props.variant == '') {
                    elHref = `javascript:void(window.location.href=window.location.href.split('&').filter(function(item){return !item.includes('variant=')}).length>0 ? window.location.href.split('&').filter(function(item){return !item.includes('variant=')}).join('&'):'/')`
                } else {
                    elHref = `javascript:void(window.location.href=window.location.href.split('?').length>0?(window.location.href.includes('variant=') ? window.location.href.split('&').filter(function(item){return !item.includes('variant=')}).join('&')+(window.location.href.split('&').filter(function(item){return !item.includes('variant=')}).length>0?'&':'?')+'variant=${props.variant}':window.location.href+'&variant=${props.variant}'):window.location.href+'?variant=${props.variant}')`
                }
                
                return el(
                    'span',
                    { id: props.id, className: props.className },
                    el('a', { className: 'wpcs_link', href: elHref, title: props.title, style: {marginRight: '10px'} }, props.innerText)
                );
            });
            registerBlockType( 'my-theme/gutenberg-castle', {
                title: '文派简繁切换器（WPChinese Switcher）',
                icon: 'admin-home',
                category: 'widgets',
                edit: function() {
                    return el('div', { id: "wpcs_widget_inner" }, spans);
                },
                save: function() {
                    return el('div', { id: "wpcs_widget_inner" }, spans);
                },
            } );
        } else {
            const htmlString = aProps[0]
            // console.log(htmlString);
            registerBlockType( 'my-theme/gutenberg-castle', {
                title: '文派简繁切换器（WPChinese Switcher）',
                icon: 'admin-home',
                category: 'widgets',
                edit: function() {
                    return el('div', {dangerouslySetInnerHTML: { __html: htmlString }} );
                },
                save: function() {
                    return el('div', {dangerouslySetInnerHTML: { __html: htmlString }} );
                },
            } );
        }
    } 
} )(
    window.wp.blocks,
    window.wp.element
);
