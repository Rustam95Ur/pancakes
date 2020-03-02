var APP = {
	// Data
	D: {},
	// Views
	V: {},
	// Extensions
	E: {},
	// Utils
	U: {
		setCookie: function(name, value, options) {
			options = options || {};

			var expires = options.expires;

			if (typeof expires == "number" && expires) {
				var d = new Date();
				d.setTime(d.getTime() + expires * 1000);
				expires = options.expires = d;
			}
			if (expires && expires.toUTCString) {
				options.expires = expires.toUTCString();
			}

			value = encodeURIComponent(value);

			var updatedCookie = name + "=" + value;

			for (var propName in options) {
				updatedCookie += "; " + propName;
				var propValue = options[propName];
				if (propValue !== true) {
					updatedCookie += "=" + propValue;
				}
			}

			document.cookie = updatedCookie;
		},
		getCookie: function(name) {
			var matches = document.cookie.match(new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			));
			return matches ? decodeURIComponent(matches[1]) : undefined;
		},
		cloneObj: function (obj) {
			if (typeof obj != "object") {
				return obj;
			}
			var copy = obj.constructor();
			for (var key in obj) {
				if (typeof obj[key] == "object" && obj[key] != null) {
					copy[key] = this.cloneObj(obj[key]);
				} else {
					copy[key] = obj[key];
				}
			}
			return copy;
		},
		priceFormat: function (num) {
			var str = num.toString();
			return str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
		},
		numberFormat: function (number, decimals, dec_point, thousands_sep) {	// Format a number with grouped thousands
			//
			// +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
			// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// +	 bugfix by: Michael White (http://crestidg.com)

			var i, j, kw, kd, km;

			// input sanitation & defaults
			if (isNaN(decimals = Math.abs(decimals))) {
				decimals = 2;
			}
			if (dec_point == undefined) {
				dec_point = ",";
			}
			if (thousands_sep == undefined) {
				thousands_sep = ".";
			}

			i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

			if ((j = i.length) > 3) {
				j = j % 3;
			} else {
				j = 0;
			}

			km = (j ? i.substr(0, j) + thousands_sep : "");
			kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
			//kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
			kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


			return km + kw + kd;
		},
		round: function (summ, round) {
			if (round < 0) {
				var absRound = Math.abs(round);
				var tens = 10 * absRound;
				var fakeSumm = summ / tens;
				var fakeSummRounded = parseFloat(fakeSumm).toFixed(0);
				var summRounded = fakeSummRounded * tens;
			} else {
				var summRounded = parseFloat(parseFloat(summ).toFixed(round));
			}

			// лютый костыль!
			return summRounded - 1 + 1;
			//return parseFloat( (summRounded - 1 + 1).toFixed(round) );
		},
		declOfNum: function (number, titles) {
			var cases = [2, 0, 1, 1, 1, 2];
			return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
		}
	},

	uploadPath: '/assets/upload/'
};