$('.select-basic').select2({
    minimumResultsForSearch: -1,
    width: 'resolve'
});

$('.select-search').select2({
    width: 'resolve'
});

$('#kt_header_mobile_toggle').click(function(e) {
    $('#kt_header_navs').addClass('header-navs-on');
});

$('.mobile-menu-close').click(function() {
    $('#kt_header_navs').removeClass('header-navs-on');
});