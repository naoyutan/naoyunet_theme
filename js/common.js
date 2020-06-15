(function(window, $, undefined){

$('#color-mode').on('change', function(){
	var $this = $(this);
	var $checked = $this.is(':checked');
	// console.log($checked);
	if($checked){
		localStorage.setItem('nightmode', 'on');
		dataLayer.push({'mode': 'DarkMode'});
	} else {
		localStorage.setItem('nightmode', 'off');
		dataLayer.push({'mode': 'LightMode'});
	}
})
var nightmode = localStorage.getItem("nightmode");
if(nightmode=='on'){
	$('#color-mode').prop('checked', true);

} else {
	$('#color-mode').prop('checked', false);

}


$(function() {
	var lastH2 = '#mainCollumn h2:last-of-type';
    var findH2 = $(document).find(lastH2).length;
    if( findH2 == !0){
        var lastH2Pos = $(lastH2).offset().top;
    	$(window).on('scroll', function(){
    		var scrollPosBtm = $(window).scrollTop() + $(window).height();
    		if ( scrollPosBtm > lastH2Pos ) {
    			dataLayer.push({'event': 'dokuryou'});
                //console.log('読了event発生');
    		}
    	});
    }
});


/* sidebar固定ウィジェット */
stickyBox('#sticky_box','#footer');
function stickyBox(elm,target) {
    $(window).on('load scroll', function(){
        var $sticky    = $(elm),
            $stickyTop = $sticky.offset().top;
        var $height = $sticky.height();
        $sticky.css('height', $height);

        if($(window).scrollTop() > $stickyTop - 10) {
            $sticky.children().css({'top':10,'position':'fixed'});
        } else {
            $sticky.children().removeAttr('style');
        }

        var $stickyTarget = $(target).offset().top;
        var $trigger = $(window).scrollTop() + $sticky.height();
        var sticky_scrolled = $trigger > $stickyTarget ? true : false;

        if(sticky_scrolled) {
            var $stickyPosition = $trigger - $stickyTarget;
            $sticky.children().css('top', - $stickyPosition);
        }
    });
}

/* スクロールするとフェードイン */
function scroll_to_fadein(e) {
    var $elm = $(e);
    $elm.hide();
    $(window).on('scroll load',function () {
        if ($(this).scrollTop() > 300) {
            $elm.fadeIn();
        } else {
            $elm.fadeOut();
        }
    });
}
scroll_to_fadein('#share-btns');

/**
 * Topへ戻る
 */
function backToTop(elm) {
    var $elm = $(elm);
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $elm.fadeIn();
        } else {
            $elm.fadeOut();
        }
    });
    $elm.click(function() {
      var speed = 400;
      var href= $(this).attr("href");
      var position = $('body').offset().top;
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
    });
}
backToTop('#goTop');

/* アンカーリンクのスムーススクロール */
// $('a[href^="#"]').on('click', function(e) {
//     e.preventDefault();
//     var pc_offset = 0;
//     var sp_offset = 0;
//     var speed = 400;
//     var href = $(this).attr("href");
//     var target = $(href == "#" || href == "" ? 'html' : href);
//     var offset = window.innerWidth > 767 ? pc_offset : sp_offset;
//     var position = target.offset().top - offset
//     $('body,html').animate({scrollTop:position}, speed, 'swing');
// });

})(this, jQuery);
