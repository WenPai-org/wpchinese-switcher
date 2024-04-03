function wpcsRedirectToPage() {
    var selectEle = document.getElementById('wpcs_translate_type');
    var variantValue = selectEle.value;
    var currentUrl = new URL(window.location.href);
    
    if (currentUrl.searchParams.get('variant')) {
        currentUrl.searchParams.set('variant', variantValue);
    } else {
        currentUrl.searchParams.append('variant', variantValue);
    }
    
    window.location.href = currentUrl.href;
}