function JCSmartFilter(ajaxURL, viewMode, params)
{
	this.ajaxURL = ajaxURL;
	this.form = null;
	this.timer = null;
	this.cacheKey = '';
	this.cache = [];
	this.viewMode = viewMode;
	if (params && params.SEF_SET_FILTER_URL)
	{
		this.bindUrlToButton('set_filter', params.SEF_SET_FILTER_URL);
		this.sef = true;
	}
	if (params && params.SEF_DEL_FILTER_URL)
	{
		this.bindUrlToButton('del_filter', params.SEF_DEL_FILTER_URL);
	}
}

JCSmartFilter.prototype.keyup = function(input)
{
	if(!!this.timer)
	{
		clearTimeout(this.timer);
	}
	this.timer = setTimeout(BX.delegate(function(){
		this.reload(input);
	}, this), 500);
};

JCSmartFilter.prototype.click = function(checkbox)
{
	if(!!this.timer)
	{
		clearTimeout(this.timer);
	}

	this.timer = setTimeout(BX.delegate(function(){
		this.reload(checkbox);
	}, this), 500);
};

JCSmartFilter.prototype.reload = function(input)
{
	if (this.cacheKey !== '')
	{
		//Postprone backend query
		if(!!this.timer)
		{
			clearTimeout(this.timer);
		}
		this.timer = setTimeout(BX.delegate(function(){
			this.reload(input);
		}, this), 1000);
		return;
	}
	this.cacheKey = '|';

	this.position = BX.pos(input, true);
	this.form = BX.findParent(input, {'tag':'form'});
	if (this.form)
	{
		var values = [];
		values[0] = {name: 'ajax', value: 'y'};
		this.gatherInputsValues(values, BX.findChildren(this.form, {'tag': new RegExp('^(input|select)$', 'i')}, true));

		for (var i = 0; i < values.length; i++)
			this.cacheKey += values[i].name + ':' + values[i].value + '|';

		if (this.cache[this.cacheKey])
		{
			this.curFilterinput = input;
			this.postHandler(this.cache[this.cacheKey], true);
		}
		else
		{
			if (this.sef)
			{
				var set_filter = BX('set_filter');
				set_filter.disabled = true;
			}

			this.curFilterinput = input;
			BX.ajax.loadJSON(
				this.ajaxURL,
				this.values2post(values),
				BX.delegate(this.postHandler, this)
			);
		}
	}
};

JCSmartFilter.prototype.updateItem = function (PID, arItem)
{
	if (arItem.PROPERTY_TYPE === 'N' || arItem.PRICE)
	{
		var trackBar = window['trackBar' + PID];
		if (!trackBar && arItem.ENCODED_ID)
			trackBar = window['trackBar' + arItem.ENCODED_ID];

		if (trackBar && arItem.VALUES)
		{
			if (arItem.VALUES.MIN && arItem.VALUES.MIN.FILTERED_VALUE)
			{
				trackBar.setMinFilteredValue(arItem.VALUES.MIN.FILTERED_VALUE);
			}

			if (arItem.VALUES.MAX && arItem.VALUES.MAX.FILTERED_VALUE)
			{
				trackBar.setMaxFilteredValue(arItem.VALUES.MAX.FILTERED_VALUE);
			}
		}
	}
	else if (arItem.VALUES)
	{
		for (var i in arItem.VALUES)
		{
			if (arItem.VALUES.hasOwnProperty(i))
			{
				var value = arItem.VALUES[i];
				var control = BX(value.CONTROL_ID);

				if (!!control)
				{
					var label = document.querySelector('[data-role="label_'+value.CONTROL_ID+'"]');
					if (value.DISABLED)
					{
						if (label)
							BX.addClass(label, 'disabled');
						else
							BX.addClass(control.parentNode, 'disabled');
					}
					else
					{
						if (label)
							BX.removeClass(label, 'disabled');
						else
							BX.removeClass(control.parentNode, 'disabled');
					}

					if (value.hasOwnProperty('ELEMENT_COUNT'))
					{
						label = document.querySelector('[data-role="count_'+value.CONTROL_ID+'"]');
						if (label)
							label.innerHTML = value.ELEMENT_COUNT;
					}
				}
			}
		}
	}
};

JCSmartFilter.prototype.postHandler = function (result, fromCache)
{
	var hrefFILTER, url, curProp;
	var modef = BX('modef');
	var modef_num = BX('modef_num');

	if (!!result && !!result.ITEMS)
	{
		for(var PID in result.ITEMS)
		{
			if (result.ITEMS.hasOwnProperty(PID))
			{
				this.updateItem(PID, result.ITEMS[PID]);
			}
		}

		if (!!modef && !!modef_num)
		{
			modef_num.innerHTML = result.ELEMENT_COUNT;
			hrefFILTER = BX.findChildren(modef, {tag: 'A'}, true);

			if (result.FILTER_URL && hrefFILTER)
			{
				hrefFILTER[0].href = BX.util.htmlspecialcharsback(result.FILTER_URL);
			}

			if (result.FILTER_AJAX_URL && result.COMPONENT_CONTAINER_ID)
			{
				BX.bind(hrefFILTER[0], 'click', function(e)
				{
					url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
					BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
					return BX.PreventDefault(e);
				});
			}

			if (result.INSTANT_RELOAD && result.COMPONENT_CONTAINER_ID)
			{
				url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
				BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
			}
			else
			{
				/*---bgn 2016-10-17---*/
				//если нет кол-ва, то скрываем информацию о выбранных эл-тах, иначе отображаем кол-во выбранных эл-тов
				if (parseInt(result.ELEMENT_COUNT) == 0) {
					jQuery(modef).addClass('hide-selected');
				} else {
					jQuery(modef).removeClass('hide-selected');
				}
				/*---end 2016-10-17---*/
				
				if (modef.style.display === 'none')
				{
					modef.style.display = 'inline-block';
				}

				if (this.viewMode == "vertical")
				{
					curProp = BX.findChild(BX.findParent(this.curFilterinput, {'class':'bx_filter_parameters_box'}), {'class':'bx_filter_container_modef'}, true, false);
					curProp.appendChild(modef);
				}

				if (result.SEF_SET_FILTER_URL)
				{
					this.bindUrlToButton('set_filter', result.SEF_SET_FILTER_URL);
				}
				
				/*---bgn 2016-10-17---*/
				fltr_pos = jQuery('.sidebar .bx_filter_vertical').offset().top;
				sel_param_pos = jQuery(this.curFilterinput).offset().top;
				t = sel_param_pos - fltr_pos + 5;
				modef.style.top = t + 'px';
				/*---end 2016-10-17---*/
			}
		}
	}

	if (this.sef)
	{
		var set_filter = BX('set_filter');
		set_filter.disabled = false;
	}

	if (!fromCache && this.cacheKey !== '')
	{
		this.cache[this.cacheKey] = result;
	}
	this.cacheKey = '';
};

JCSmartFilter.prototype.bindUrlToButton = function (buttonId, url)
{
	var button = BX(buttonId);
	if (button)
	{
		var proxy = function(j, func)
		{
			return function()
			{
				return func(j);
			}
		};

		if (button.type == 'submit')
			button.type = 'button';

		BX.bind(button, 'click', proxy(url, function(url)
		{
			window.location.href = url;
			return false;
		}));
	}
};

JCSmartFilter.prototype.gatherInputsValues = function (values, elements)
{
	if(elements)
	{
		for(var i = 0; i < elements.length; i++)
		{
			var el = elements[i];
			if (el.disabled || !el.type)
				continue;

			switch(el.type.toLowerCase())
			{
				case 'text':
				case 'textarea':
				case 'password':
				case 'hidden':
				case 'select-one':
					if(el.value.length)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'radio':
				case 'checkbox':
					if(el.checked)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'select-multiple':
					for (var j = 0; j < el.options.length; j++)
					{
						if (el.options[j].selected)
							values[values.length] = {name : el.name, value : el.options[j].value};
					}
					break;
				default:
					break;
			}
		}
	}
};

JCSmartFilter.prototype.values2post = function (values)
{
	var post = [];
	var current = post;
	var i = 0;

	while(i < values.length)
	{
		var p = values[i].name.indexOf('[');
		if(p == -1)
		{
			current[values[i].name] = values[i].value;
			current = post;
			i++;
		}
		else
		{
			var name = values[i].name.substring(0, p);
			var rest = values[i].name.substring(p+1);
			if(!current[name])
				current[name] = [];

			var pp = rest.indexOf(']');
			if(pp == -1)
			{
				//Error - not balanced brackets
				current = post;
				i++;
			}
			else if(pp == 0)
			{
				//No index specified - so take the next integer
				current = current[name];
				values[i].name = '' + current.length;
			}
			else
			{
				//Now index name becomes and name and we go deeper into the array
				current = current[name];
				values[i].name = rest.substring(0, pp) + rest.substring(pp+1);
			}
		}
	}
	return post;
};

JCSmartFilter.prototype.hideFilterProps = function(element)
{
	var easing;
	var obj = element.parentNode;
	var filterBlock = BX.findChild(obj, {className:"bx_filter_block"}, true, false);

	if(BX.hasClass(obj, "active"))
	{
		easing = new BX.easing({
			duration : 300,
			start : { opacity: 1,  height: filterBlock.offsetHeight },
			finish : { opacity: 0, height:0 },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
				filterBlock.setAttribute("style", "");
				BX.removeClass(obj, "active");
			}
		});
		easing.animate();
	}
	else
	{
		filterBlock.style.display = "block";
		filterBlock.style.opacity = 0;
		filterBlock.style.height = "auto";

		var obj_children_height = filterBlock.offsetHeight;
		filterBlock.style.height = 0;

		easing = new BX.easing({
			duration : 300,
			start : { opacity: 0,  height: 0 },
			finish : { opacity: 1, height: obj_children_height },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
			}
		});
		easing.animate();
		BX.addClass(obj, "active");
	}
};

JCSmartFilter.prototype.showDropDownPopup = function(element, popupId)
{
	var contentNode = element.querySelector('[data-role="dropdownContent"]');
	BX.PopupWindowManager.create("smartFilterDropDown"+popupId, element, {
		autoHide: true,
		offsetLeft: 0,
		offsetTop: 3,
		overlay : false,
		draggable: {restrict:true},
		closeByEsc: true,
		content: contentNode
	}).show();
};

JCSmartFilter.prototype.selectDropDownItem = function(element, controlId)
{
	this.keyup(BX(controlId));

	var wrapContainer = BX.findParent(BX(controlId), {className:"bx_filter_select_container"}, false);

	var currentOption = wrapContainer.querySelector('[data-role="currentOption"]');
	currentOption.innerHTML = element.innerHTML;
	BX.PopupWindowManager.getCurrentPopup().close();
};

/*----*/
function cDoubleTrackBar(Track, Tracker,LeftDrag, RightDrag, Settings) {
	switch(typeof Track){
		case 'string': this.Track = document.getElementById(Track); break;
		case 'object': this.Track = Track; break;
	}
	switch(typeof Tracker){
		case 'string': this.Tracker = document.getElementById(Tracker); break;
		case 'object': this.Tracker = Tracker; break;
	}
	switch(typeof LeftDrag){
		case 'string': this.LeftDrag = document.getElementById(LeftDrag); break;
		case 'object': this.LeftDrag = LeftDrag; break;
	}
	switch(typeof RightDrag){
		case 'string': this.RightDrag = document.getElementById(RightDrag); break;
		case 'object': this.RightDrag = RightDrag; break;
	}
	if (!Track || !Tracker)
		return false;
	this.OnUpdate = Settings.OnUpdate;
	this.OnComplete = Settings.OnComplete;
	this.FingerOffset = Settings.FingerOffset || 0;
	this.Min = Settings.Min || 0;
	this.Max = Settings.Max || 100;
	this.MinSpace = Settings.MinSpace || 0;
	this.RoundTo = Settings.RoundTo || 1;
	if (this.RoundTo < 1)
	{
		this.Precision = parseInt(Settings.Precision, 10) || 0;
		if (isNaN(this.Precision))
		{
			this.Precision = 0;
		}
	}
	else
	{
		this.Precision = 0;
	}
	this.PrecisionFactor = Math.pow(10,this.Precision);

	this.Disabled = (typeof Settings.Disabled != 'undefined') ? Settings.Disabled : false;

	if (this.Min >= this.Max)
		this.Max = this.Min +1;
	this.MinPos = this.Min;
	this.MaxPos = this.Max;
	if (this.Max - this.Min < this.MinSpace)
		this.MinSpace =  this.Max - this.Min;
	if (this.Max - this.Min < this.RoundTo)
		this.RoundTo =  this.Max - this.Min;
	this.MinSpace = Math.ceil(this.MinSpace/this.RoundTo)*this.RoundTo;

	//this.Track.style.width = (this.Track.clientWidth || this.Track.offsetWidth) + 'px';
	this.OnTrackMouseDown = this.bindAsEventListener(this.TrackMouseDown);
	this.OnDocumentMouseMove = this.bindAsEventListener(this.DocumentMouseMove);
	this.OnDocumentMouseUp = this.bindAsEventListener(this.DocumentMouseUp);

	if ('ontouchstart' in document.documentElement)
	{
		this.bindEvent(this.Track, 'touchstart', this.OnTrackMouseDown);
	}
	else
		this.bindEvent(this.Track, 'mousedown', this.OnTrackMouseDown);

	this.TrackerLeft = 0;
//	this.UpdateTracker(this.Track.offsetWidth + this.FingerOffset);
/*	if (typeof this.OnUpdate == 'function') {
		this.OnUpdate.call(this);
	}*/

	this.MinInputId = Settings.MinInputId || 0;
	this.MaxInputId = Settings.MaxInputId || 1000;

	BX.defer(BX.proxy(this.startPosition, this))();
}
cDoubleTrackBar.prototype = {

	TrackMouseDown: function(event) {
		this.TrackerLeft = this.Tracker.offsetLeft;
		this.TrackerRight = this.TrackerLeft + this.Tracker.offsetWidth;

		this.TrackerOffsets = this.getOffsets(this.Track);

		var currentX = ('ontouchmove' in document.documentElement) ? event.targetTouches[0].pageX : event.clientX;
		var X = currentX + document.documentElement.scrollLeft;
		X -= this.TrackerOffsets[0];

		var diff = Math.abs(this.TrackerLeft-X) - Math.abs(this.TrackerRight-X);
		if (diff == 0 && this.TrackerLeft == 0)
			this.Left = false;
		else
			this.Left = (diff <= 0);

		if (typeof this.Disabled == 'function') {
			if ( this.Disabled.call(this) )
				return true;
		} else if ( this.Disabled )
			return true;

		this.UpdateTracker(X);

		if ('ontouchmove' in document.documentElement)
		{
			this.bindEvent(document, 'touchmove', this.OnDocumentMouseMove);
			this.bindEvent(document, 'touchend', this.OnDocumentMouseUp);
		}
		else
		{
			this.bindEvent(document, 'mousemove', this.OnDocumentMouseMove);
			this.bindEvent(document, 'mouseup', this.OnDocumentMouseUp);
		}
		return this.stopEvent(event);
	},
	DocumentMouseMove: function(event) {
		var currentX = ('ontouchmove' in document.documentElement) ? event.targetTouches[0].pageX : event.clientX;
		this.UpdateTracker(currentX + document.documentElement.scrollLeft - this.TrackerOffsets[0]);
		return this.stopEvent(event);
	},
	DocumentMouseUp: function(event) {
		if ('ontouchmove' in document.documentElement)
		{
			this.unbindEvent(document, 'touchmove', this.OnDocumentMouseMove);
			this.unbindEvent(document, 'touchend', this.OnDocumentMouseUp);
		}
		else
		{
			this.unbindEvent(document, 'mousemove', this.OnDocumentMouseMove);
			this.unbindEvent(document, 'mouseup', this.OnDocumentMouseUp);
		}

		if (typeof this.OnComplete == 'function') {
			this.OnComplete.call(this);
		}
		return this.stopEvent(event);
	},
	UpdateTracker: function(X)
	{
		var _LogicWidth = this.Track.clientWidth;
		var _minSpace = Math.floor(_LogicWidth*this.MinSpace/(this.Max-this.Min));
		var _oldMin = this.MinPos;
		var _oldMax = this.MaxPos;

		if (this.Left)
		{
			X += this.FingerOffset;
			this.TrackerLeft = Math.max(0, Math.min(this.TrackerRight - _minSpace - 1, X));
			this.MinPos = Math.round((this.Min + this.TrackerLeft*(this.Max-this.Min)/_LogicWidth) / this.RoundTo) * this.RoundTo;
			if (this.MinSpace >= this.MaxPos - this.MinPos)
			{
				this.MinPos = this.MaxPos - this.MinSpace;
			}
			if (this.Precision > 0)
			{
				this.MinPos = Math.round(this.MinPos*this.PrecisionFactor)/this.PrecisionFactor;
			}

			this.TrackerLeft = this.price2px(this.Track, this.MinPos - this.Min);

			this.LeftDrag.style.left = this.px2percent(this.Track, this.TrackerLeft) + '%';
			this.Tracker.style.width = this.px2percent(this.Track, this.TrackerRight - this.TrackerLeft) + '%';
			this.Tracker.style.left = this.px2percent(this.Track, this.TrackerLeft) + '%';
			this.MinInputId.value = this.MinPos;
			smartFilter.keyup(this.MinInputId);
		}
		else
		{
			X -= this.FingerOffset;
			this.TrackerRight = Math.max(this.TrackerLeft + _minSpace + 1 , Math.min(_LogicWidth + 1, X));
			this.MaxPos = Math.round((this.Min + (this.TrackerRight-1)*(this.Max-this.Min)/_LogicWidth) / this.RoundTo) * this.RoundTo;
			if (this.MinSpace >= this.MaxPos - this.MinPos)
			{
				this.MaxPos = this.MinPos + this.MinSpace;
			}
			if (this.Precision > 0)
			{
				this.MaxPos = Math.round(this.MaxPos*this.PrecisionFactor)/this.PrecisionFactor;
			}

			this.TrackerRight = this.price2px(this.Track, this.MaxPos - this.Min);

			this.Tracker.style.left = this.px2percent(this.Track, this.TrackerLeft) + '%';
			this.Tracker.style.width = this.px2percent(this.Track, this.TrackerRight - this.TrackerLeft) + '%';
			this.RightDrag.style.left = this.px2percent(this.Track, this.TrackerRight) + '%';
			this.MaxInputId.value = this.MaxPos;
			smartFilter.keyup(this.MaxInputId);
		}
	},
	getOffsets: function(element) {
		var valueT = 0, valueL = 0;
		do {
			valueT += element.offsetTop  || 0;
			valueL += element.offsetLeft || 0;
			element = element.offsetParent;
		} while (element);
		return [valueL, valueT];
	},
	bindEvent: function(element, event, callBack){
		if (element.addEventListener) {
			element.addEventListener(event, callBack, false);
		} else {
			element.attachEvent('on' + event, callBack);
		}
	},
	unbindEvent: function(element, event, callBack){
		if (element.removeEventListener) {
			element.removeEventListener(event, callBack, false);
		} else if (element.detachEvent) {
			element.detachEvent('on' + event, callBack);
		}
	},
	bindAsEventListener: function (callBack) {
		var _object = this;
		return function(event) {
			return callBack.call(_object, event || window.event);
		}
	},
	stopEvent: function (event){
		if (event.preventDefault) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.returnValue = false;
			event.cancelBubble = true;
		}
		return false;
	},
	startPosition: function ()
	{
		var curMinPrice = this.MinInputId.value || 0,
			curMaxPrice = this.MaxInputId.value || 0,
			curLeft = 0,
			curRight = 0;

		if (curMinPrice || curMaxPrice)
		{
			if (!curMinPrice || curMinPrice < this.Min || curMinPrice > this.Max)
				curMinPrice = this.Min;
			if (!curMaxPrice || curMaxPrice > this.Max || curMaxPrice < this.Min)
				curMaxPrice = this.Max;

			if (curMinPrice)
				curLeft = this.price2px(this.Track, curMinPrice - this.Min);
			if (curMaxPrice)
				curRight = this.price2px(this.Track, curMaxPrice - this.Min);

			this.LeftDrag.style.left = this.px2percent(this.Track, curLeft) + "%";
			this.Tracker.style.left = this.px2percent(this.Track, curLeft) + "%";
			this.Tracker.style.width = this.px2percent(this.Track, curRight - curLeft) + "%";
			if (Math.round(this.px2percent(this.Track, curRight)) < 100)
				this.RightDrag.style.left = this.px2percent(this.Track, curRight)  + "%";
		}
	},
	px2percent: function (control, px)
	{
		return px / control.clientWidth * 100;
	},
	price2px: function (control, price)
	{
		var scale = (this.Max - this.Min) / control.clientWidth;
		return Math.round(price / scale);
	}
}

function hideFilterProps(element)
{
	var obj = element.parentNode;

	var filterBlock = BX.findChild(obj, {className:"bx_filter_block"}, true, false);

	if(BX.hasClass(obj, "active"))
	{
		var easing = new BX.easing({
			duration : 300,
			start : { opacity: 1,  height: filterBlock.offsetHeight },
			finish : { opacity: 0, height:0 },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
				filterBlock.setAttribute("style", "");
				BX.removeClass(obj, "active")
			}
		});
		easing.animate();
	}
	else
	{
		filterBlock.style.display = "block";
		filterBlock.style.opacity = 0;
		filterBlock.style.height = "auto";

		var obj_children_height = filterBlock.offsetHeight;
		filterBlock.style.height = 0;

		var easing = new BX.easing({
			duration : 300,
			start : { opacity: 0,  height: 0 },
			finish : { opacity: 1, height: obj_children_height },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
			}
		});
		easing.animate();
		BX.addClass(obj, "active")
	}
}
/*----*/

BX.namespace("BX.Iblock.SmartFilter");
BX.Iblock.SmartFilter = (function()
{
	var SmartFilter = function(arParams)
	{
		if (typeof arParams === 'object')
		{
			this.leftSlider = BX(arParams.leftSlider);
			this.rightSlider = BX(arParams.rightSlider);
			this.tracker = BX(arParams.tracker);
			this.trackerWrap = BX(arParams.trackerWrap);

			this.minInput = BX(arParams.minInputId);
			this.maxInput = BX(arParams.maxInputId);

			this.minPrice = parseFloat(arParams.minPrice);
			this.maxPrice = parseFloat(arParams.maxPrice);

			this.curMinPrice = parseFloat(arParams.curMinPrice);
			this.curMaxPrice = parseFloat(arParams.curMaxPrice);

			this.fltMinPrice = arParams.fltMinPrice ? parseFloat(arParams.fltMinPrice) : parseFloat(arParams.curMinPrice);
			this.fltMaxPrice = arParams.fltMaxPrice ? parseFloat(arParams.fltMaxPrice) : parseFloat(arParams.curMaxPrice);

			this.precision = arParams.precision || 0;

			this.priceDiff = this.maxPrice - this.minPrice;

			this.leftPercent = 0;
			this.rightPercent = 0;

			this.fltMinPercent = 0;
			this.fltMaxPercent = 0;

			this.colorUnavailableActive = BX(arParams.colorUnavailableActive);//gray
			this.colorAvailableActive = BX(arParams.colorAvailableActive);//blue
			this.colorAvailableInactive = BX(arParams.colorAvailableInactive);//light blue

			this.isTouch = false;

			this.init();

			if ('ontouchstart' in document.documentElement)
			{
				this.isTouch = true;

				BX.bind(this.leftSlider, "touchstart", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "touchstart", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}
			else
			{
				BX.bind(this.leftSlider, "mousedown", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "mousedown", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}

			BX.bind(this.minInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));

			BX.bind(this.maxInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));
		}
	};

	SmartFilter.prototype.init = function()
	{
		var priceDiff;

		if (this.curMinPrice > this.minPrice)
		{
			priceDiff = this.curMinPrice - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		this.setMinFilteredValue(this.fltMinPrice);

		if (this.curMaxPrice < this.maxPrice)
		{
			priceDiff = this.maxPrice - this.curMaxPrice;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		this.setMaxFilteredValue(this.fltMaxPrice);
	};

	SmartFilter.prototype.setMinFilteredValue = function (fltMinPrice)
	{
		this.fltMinPrice = parseFloat(fltMinPrice);
		if (this.fltMinPrice >= this.minPrice)
		{
			var priceDiff = this.fltMinPrice - this.minPrice;
			this.fltMinPercent = (priceDiff*100)/this.priceDiff;

			if (this.leftPercent > this.fltMinPercent)
				this.colorAvailableActive.style.left = this.leftPercent + "%";
			else
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";

			this.colorAvailableInactive.style.left = this.fltMinPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.left = "0%";
			this.colorAvailableInactive.style.left = "0%";
		}
	};

	SmartFilter.prototype.setMaxFilteredValue = function (fltMaxPrice)
	{
		this.fltMaxPrice = parseFloat(fltMaxPrice);
		if (this.fltMaxPrice <= this.maxPrice)
		{
			var priceDiff = this.maxPrice - this.fltMaxPrice;
			this.fltMaxPercent = (priceDiff*100)/this.priceDiff;

			if (this.rightPercent > this.fltMaxPercent)
				this.colorAvailableActive.style.right = this.rightPercent + "%";
			else
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";

			this.colorAvailableInactive.style.right = this.fltMaxPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.right = "0%";
			this.colorAvailableInactive.style.right = "0%";
		}
	};

	SmartFilter.prototype.getXCoord = function(elem)
	{
		var box = elem.getBoundingClientRect();
		var body = document.body;
		var docElem = document.documentElement;

		var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;
		var clientLeft = docElem.clientLeft || body.clientLeft || 0;
		var left = box.left + scrollLeft - clientLeft;

		return Math.round(left);
	};

	SmartFilter.prototype.getPageX = function(e)
	{
		e = e || window.event;
		var pageX = null;

		if (this.isTouch && event.targetTouches[0] != null)
		{
			pageX = e.targetTouches[0].pageX;
		}
		else if (e.pageX != null)
		{
			pageX = e.pageX;
		}
		else if (e.clientX != null)
		{
			var html = document.documentElement;
			var body = document.body;

			pageX = e.clientX + (html.scrollLeft || body && body.scrollLeft || 0);
			pageX -= html.clientLeft || 0;
		}

		return pageX;
	};

	SmartFilter.prototype.recountMinPrice = function()
	{
		var newMinPrice = (this.priceDiff*this.leftPercent)/100;
		newMinPrice = (this.minPrice + newMinPrice).toFixed(this.precision);

		if (newMinPrice != this.minPrice)
			this.minInput.value = newMinPrice;
		else
			this.minInput.value = "";
		smartFilter.keyup(this.minInput);
	};

	SmartFilter.prototype.recountMaxPrice = function()
	{
		var newMaxPrice = (this.priceDiff*this.rightPercent)/100;
		newMaxPrice = (this.maxPrice - newMaxPrice).toFixed(this.precision);

		if (newMaxPrice != this.maxPrice)
			this.maxInput.value = newMaxPrice;
		else
			this.maxInput.value = "";
		smartFilter.keyup(this.maxInput);
	};

	SmartFilter.prototype.onInputChange = function ()
	{
		var priceDiff;
		if (this.minInput.value)
		{
			var leftInputValue = this.minInput.value;
			if (leftInputValue < this.minPrice)
				leftInputValue = this.minPrice;

			if (leftInputValue > this.maxPrice)
				leftInputValue = this.maxPrice;

			priceDiff = leftInputValue - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.makeLeftSliderMove(false);
		}

		if (this.maxInput.value)
		{
			var rightInputValue = this.maxInput.value;
			if (rightInputValue < this.minPrice)
				rightInputValue = this.minPrice;

			if (rightInputValue > this.maxPrice)
				rightInputValue = this.maxPrice;

			priceDiff = this.maxPrice - rightInputValue;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.makeRightSliderMove(false);
		}
	};

	SmartFilter.prototype.makeLeftSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice !== false);

		this.leftSlider.style.left = this.leftPercent + "%";
		this.colorUnavailableActive.style.left = this.leftPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.rightPercent = 100 - this.leftPercent;
			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		if (this.leftPercent >= this.fltMinPercent && this.leftPercent <= (100-this.fltMaxPercent))
		{
			this.colorAvailableActive.style.left = this.leftPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.leftPercent + "%";
			}
		}
		else if(this.leftPercent <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.fltMinPercent + "%";
			}
		}
		else if(this.leftPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.left = 100-this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMinPrice();
			if (areBothSlidersMoving)
				this.recountMaxPrice();
		}
	};

	SmartFilter.prototype.countNewLeft = function(event)
	{
		var pageX = this.getPageX(event);

		var trackerXCoord = this.getXCoord(this.trackerWrap);
		var rightEdge = this.trackerWrap.offsetWidth;

		var newLeft = pageX - trackerXCoord;

		if (newLeft < 0)
			newLeft = 0;
		else if (newLeft > rightEdge)
			newLeft = rightEdge;

		return newLeft;
	};

	SmartFilter.prototype.onMoveLeftSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.leftSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.touchend = null;
			};
		}

		return false;
	};

	SmartFilter.prototype.makeRightSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice !== false);

		this.rightSlider.style.right = this.rightPercent + "%";
		this.colorUnavailableActive.style.right = this.rightPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.leftPercent = 100 - this.rightPercent;
			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		if ((100-this.rightPercent) >= this.fltMinPercent && this.rightPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.rightPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.rightPercent + "%";
			}
		}
		else if(this.rightPercent <= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.fltMaxPercent + "%";
			}
		}
		else if((100-this.rightPercent) <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.right = 100-this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMaxPrice();
			if (areBothSlidersMoving)
				this.recountMinPrice();
		}
	};

	SmartFilter.prototype.onMoveRightSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.rightSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.ontouchend = null;
			};
		}

		return false;
	};

	return SmartFilter;
})();