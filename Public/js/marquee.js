/*
marquee scroll
by niewei
2010-11-29
*/

(function($)
{
	$.fn.marquee = function (opt)
	{
		var _this	= $(this);  //滚动对象
		var defa	= {  //默认值
			direction	: 'up',
			next		: 'next',
			prev		: 'prev',
			autoPlay	: false,
			perPage		: 22,
			step		: 1,
			waitTime	: 2000,
			delayTime	: 500,
			conType		: 'ul > li'
		}
		var opts	= $.fn.extend(defa, opt);
		var dArray	= {  //方向JSON
			'top'		: 0,
			'up'		: 0,
			'bottom'	: 1,
			'down'		: 1,
			'left'		: 2,
			'right'		: 3
		};
		var marqId	= [null, null];  //时间ID
		var marqInd	= 0;  //当前序号
		var marqLen	= _this.find('>' + opts.conType).length;
		if (typeof opts.direction == 'string')
		{
			opts.direction = dArray[opts.direction.toString().toLowerCase()];
		}
		if (opts.direction < 0 || opts.direction > 3)
		{
			opts.direction = 0;
		}

		//生成HTML
		if (opts.direction <= 1)
		{
			_this.html('<div>' + _this.html() + '</div><div>' + _this.html() + '</div>');
		}
		else
		{
			_this.html('<div style="width:8000px;"><div style="float:left;">' + _this.html() + '</div><div style="float:left;">' + _this.html() + '</div></div>');
		}

		//初始化
		function initialize ()
		{
			clsTimeId();
			var isWait	= arguments[0] == null ? true : false;

			if (isWait)
			{
				marqId[1]	= setInterval(function(){
					scroll();
				}, opts.waitTime);
			}
			else
			{
				scroll();
				if (arguments[1] != null) opts.direction = parseInt(arguments[1]);
				if (opts.autoPlay)
				{
					initialize();
				}
			}
		}

		//滚动核心函数
		function scroll ()
		{
			switch (opts.direction)
			{
				case 0:  //向上
					_this.animate({
						'scrollTop' : (marqInd + opts.step) * opts.perPage
					}, opts.delayTime, 'swing', function(){
						marqInd	= marqInd + opts.step;
						if (marqInd >= marqLen)
						{
							marqInd	= 0;
							_this.scrollTop(0);
						}
						//每次滚动完成后CallBack
						
					});
				break;

				case 1:  //向下
					_this.animate({
						'scrollTop' : (marqInd - opts.step) * opts.perPage
					}, opts.delayTime, 'swing', function(){
						marqInd	= marqInd - opts.step;
						if (marqInd <= 0)
						{
							marqInd	= marqLen;
							_this.scrollTop(marqLen * opts.perPage);
						}
						//每次滚动完成后CallBack
						
					});
				break;

				case 2:  //向左
					_this.animate({
						'scrollLeft' : (marqInd + opts.step) * opts.perPage
					}, opts.delayTime, 'swing', function(){
						marqInd	= marqInd + opts.step;
						if (marqInd >= marqLen)
						{
							marqInd	= 0;
							_this.scrollLeft(0);
						}
						//每次滚动完成后CallBack
						
					});
				break;

				case 3:  //向右
					_this.animate({
						'scrollLeft' : (marqInd - opts.step) * opts.perPage
					}, opts.delayTime, 'swing', function(){
						marqInd	= marqInd - opts.step;
						if (marqInd <= 0)
						{
							marqInd	= marqLen;
							_this.scrollLeft(marqLen * opts.perPage);
						}
						//每次滚动完成后CallBack
						
					});
				break;
			}
		}

		//暂停
		function pause ()
		{
			_this.stop();
			clsTimeId();
		}
		//继续
		function cont ()
		{
			if (opts.autoPlay)
			{
				initialize();
			}
		}

		//如果自动播放，则开启滚动
		if (opts.autoPlay)
		{
			initialize();
		}

		//添加控制按钮 ========== 如果不需要建议删除此段
		$('#' + opts.next).click(function(){
			pause();
			initialize(false);
		});
		$('#' + opts.prev).click(function(){
			pause();
			switch (opts.direction)
			{
				case 0:
					opts.direction = 1;
					initialize(false, 0);
				break;

				case 1:
					opts.direction = 0;
					initialize(false, 1);
				break;

				case 2:
					opts.direction = 3;
					initialize(false, 2);
				break;

				case 3:
					opts.direction = 2;
					initialize(false, 3);
				break;
			}
		});
		//===============

		//添加鼠标移入/移出 事件
		_this.hover(function(){
			pause();
		}, function(){
			cont();
		});

		//清除时钟
		function clsTimeId ()
		{
			var id = arguments[0] == null ? 1 : arguments[0];
			if (marqId[id] != null)
			{
				clearInterval(marqId[id]);
			}
		}
	}
})(jQuery);