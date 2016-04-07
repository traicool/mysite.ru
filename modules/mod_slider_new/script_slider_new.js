jQuery(document).ready(function(){
	var ffgh = 480;
	var sch = 1;
	var ddr = 0;
	jQuery('.right_sl_new').live('click',function(){
		sch = 1;
		var scroll_sl = jQuery(this).siblings('.mid_sl_new').children('.scroll_sl_new');
		if(scroll_sl.children(".img_sl_new").length>1 && scroll_sl.queue()==0) {
			scroll_sl.animate({left: "-"+ffgh+"px"}, 800);
			scroll_sl.children(".img_sl_new").eq(0).clone().appendTo(scroll_sl);
			setTimeout(function () {
				if(scroll_sl.children(".img_sl_new").eq(-1).html() == scroll_sl.children(".img_sl_new").eq(0).html())
				{
					scroll_sl.children(".img_sl_new").eq(0).remove();
				}
				scroll_sl.animate({left: "0px"}, 0);
			}, 805);
		}
	});

	jQuery('.left_sl_new').live('click',function(){
		sch = 1;
		var scroll_sl = jQuery(this).siblings('.mid_sl_new').children('.scroll_sl_new');
		if(jQuery(".img_sl_new").length>1 && scroll_sl.queue()==0) {
			scroll_sl.css('left', "-"+ffgh+"px");
			scroll_sl.children(".img_sl_new").eq(-1).clone().prependTo(scroll_sl);
			scroll_sl.animate({left: "0px"}, 800);
			setTimeout(function () {
				if(scroll_sl.children(".img_sl_new").eq(-1).html() == scroll_sl.children(".img_sl_new").eq(0).html())
				{
					scroll_sl.children(".img_sl_new").eq(-1).remove();
				}
			}, 805);
		}
	});

	jQuery('.obert_sl_new').mouseover(function () {
		ddr = 1;
	});
	jQuery('.obert_sl_new').mouseleave(function () {
		ddr = 0;
	});

	function timclk()
	{
			setTimeout(function () {
				if(ddr == 0)
				{
					if(sch == 5)
					{
						jQuery('.right_sl_new').click();
						sch = 1;
					}
					sch = sch+1;
				}
				timclk();
			}, 1000);
	}
	timclk();
});


