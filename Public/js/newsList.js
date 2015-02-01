var news_list=$('#news_list a');
	news_list.each(function() {
		var html=$(this).html();
		var newHtml=''
		$.each(html,function(i){
			newHtml+='<span>'+html.charAt(i)+'</span>'
		})
		$(this).html(newHtml);
		var aSpan=$(this).find('span');
		var aPos=[];
		aSpan.each(function(i) {
            aPos[i]={left:$(this).position().left}
        });
		aSpan.css('position','absolute');
		aSpan.each(function(i) {
            $(this).css({left:aPos[i].left})
        });
    });
news_list.mouseenter(function(){
	var aSpan=$(this).find('span');
	var _this=$(this)
	var top=$(this).offset().top;
	$(this).mousemove(function(event){
		var pageX=event.pageX;
		var pageY=event.pageY;
		
		aSpan.each(function(event) {
			var els=1-Math.abs(pageX-$(this).offset().left)/100;
			if(els<0){els=0}
			$(this).css('top',(pageY-top-12)*els)
		});
	})
})
news_list.mouseleave(function(){
	var aSpan=$(this).find('span')
	aSpan.animate({top:0},100)	
})