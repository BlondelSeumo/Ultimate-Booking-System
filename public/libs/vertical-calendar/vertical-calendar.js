(function ($) {
	window.VerticalEventCalendar = function (options) {
		this.options = options;
		this.defaults = {
			el:'',
			events:{

			},
			eventHeaderName:''
		};
		var me = this;

		return this;
	};

	VerticalEventCalendar.prototype.init = function () {
		var el = this.getOption('el');

		if(typeof el === "undefined" || !el) return false;

	};

	VerticalEventCalendar.prototype.getOption = function (key) {

		if(typeof this.options[key] === 'undefined'){

			if(typeof this.defaults[key] !== 'undefined'){
				return this.defaults[key];
			}
			return null;

		}
		return this.options[key];

	};
})(jQuery);