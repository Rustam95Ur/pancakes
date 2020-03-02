APP.V.BasketHeader = {
	basket: '.js--basket-header__container',
	totalQ: '.js--basket-header__count',

	recountBasket: function () {
		if (parseInt(APP.D.Basket.totalQ) > 0) {
			$(this.totalQ).show();
			$(this.totalQ).text(APP.D.Basket.totalQ);
		}
		else {
			$(this.totalQ).hide();
		}
	}
};

APP.V.Selects = {
	cafeSelector: '.js--cafe_selector',
	paymethodSelector: '.js--paymethod_selector',
	personsSelector: '.js--persons_selector',

	init: function () {
		var _this = this;
		_this.reinitSelector(_this.cafeSelector);
		_this.reinitSelector(_this.paymethodSelector);
		_this.reinitSelector(_this.personsSelector);
	},

	reinitSelector: function (selector, before, after) {
		var _this = this;

		if (before && typeof(before) === "function") before();

		$(selector).chosen("destroy");
		$(selector).chosen({
			disable_search_threshold: 10,
			width: '100%',
			search_contains: true
		});

		if (after && typeof(after) === "function") after();
	}
};

// Инициализация селектов chosen
APP.V.Selects.init();

APP.V.Basket = {
	$item: $(),
	basketFooter: '.js--basket-footer',
	items: '.js--basket-unit',
	minuser: '.js--basket-unit__minus',
	pluser: '.js--basket-unit__plus',
	remover: '.js--basket-unit__remove',
	emptyBlock: '.js--empty-basket',
	itemPrice: '.js--basket-unit__sum',
	itemCount: '.js--basket-unit__count',
	totalSum: '.js--basket-total__sum',
	summAllProducts: '.js--basket-total__sum',
	noticeMinPrice: '.js--basket-notice',
	container: '.js--basket-container',
	getBlocking: '.js--blocking-cart__get',
	resetBasket: '.js--blocking-cart__reset',
	resumeBtn: '.js--blocking-cart__close',
	noticeWindow: '#js--notice-window',
	noticeWindowOver: '#js--notice-window-over',
	continueBtn: '.js--basket-continue__btn',
	complementBtn: '.js--notice-window__complement',
	continueNoticeBtn: '.js--notice-window__continue',

	init: function () {
		var _this = this;

		$(_this.getBlocking).unbind('click').on('click', function () {
			APP.E.Basket.isBasketBlock(function (param) {
				if (param) {
					$.colorbox({
						href: '#blocking-cart-info',
						title: false,
						inline: true,
						fixed: true,
						maxWidth: '97%',
						maxHeight: '97%',
						opacity: '.7',
						current: false,
						previous: false,
						next: false,
						close: '&times;',
						onOpen: function () {
							$('body').addClass('page_overflow');
						},
						onClosed: function () {
							$('body').removeClass('page_overflow');
						}
					});
				} else {
					location.href = window.location.protocol + '//' + AnotherHost;
				}
			});
		});

		$(_this.resetBasket).unbind('click').on('click', function () {
			APP.E.Basket.resetBasket(function () {
				location.href = window.location.protocol + '//' + AnotherHost;
			});
		});

		$(_this.resumeBtn).unbind('click').on('click', function () {
			$.colorbox.close();
		});

		/* Сообщение о минимальной и максимальной сумме в корзине */
		$(_this.continueBtn).unbind('click').on('click', function () {
			APP.E.Basket.checkMinMaxSum(function (param) {
				//console.log(param, _this.noticeWindowOver); return false;
				if (param === -1) {
					$.colorbox({
						href: _this.noticeWindow,
						title: false,
						inline: true,
						fixed: true,
						maxWidth: '95%',
						maxHeight: '95%',
						opacity: '.7',
						current: false,
						previous: false,
						scrolling: false,
						next: false,
						close: '&times;',
						onOpen: function () {
							$('body').addClass('page_overflow');
						},
						onClosed: function () {
							$('body').removeClass('page_overflow');
						}
					});
				} else if(param === 1) {
					$.colorbox({
						href: _this.noticeWindowOver,
						title: false,
						inline: true,
						fixed: true,
						maxWidth: '95%',
						maxHeight: '95%',
						opacity: '.7',
						current: false,
						previous: false,
						scrolling: false,
						next: false,
						close: '&times;',
						onOpen: function () {
							$('body').addClass('page_overflow');
						},
						onClosed: function () {
							$('body').removeClass('page_overflow');
						}
					});
				} else {
					location.href = window.location.protocol + '//' + window.location.hostname + '/order';
				}
			});
		});

		$(_this.items).each(function () {
			var $item = $(this);

			// ивент на плюсик
			$item.find(_this.pluser).on('click', function () {
				if (APP.E.Basket.access) {
					_this.$item = $item;
					_this.more();
				}

				return false;
			});

			// ивент на минус
			$item.find(_this.minuser).on('click', function () {

				if (APP.E.Basket.access) {
					_this.$item = $item;
					_this.less();
				}

				var q = parseInt($item.find(_this.itemCount).text());
				if (q === 0) {
					if (APP.E.Basket.access) {
						_this.$item = $item;
						_this.remove();
					}
				}

				return false;
			});

			$item.find(_this.remover).on('click', function () {
				if (APP.E.Basket.access) {
					_this.$item = $item;
					_this.remove();
				}

				return false;
			});
		});
	},

	more: function () {
		var _this = this;
		var dataId = this.$item.data('id');
		
		_this.buy(1);
	},

	less: function () {
		var _this = this;
		var dataId = this.$item.data('id');

		_this.buy(-1);
	},

	remove: function () {
		var _this = this;
		var dataId = this.$item.data('id');

		var before = function () {
			APP.E.Basket.access = false;
		};
		var after = function () {
			APP.E.Basket.access = true;

			_this.$item.hide();
			_this.recount();
			if (window.location.pathname === '/basket') {
				APP.V.Catalog.$item = $('#cu' + dataId);
				if (APP.V.Catalog.$item.length > 0)
					APP.V.Catalog.recount();
			}

			APP.V.BasketHeader.recountBasket();
		};

		APP.E.Basket.remove(dataId, before, after);
	},

	removeAll: function () {
		var _this = this;
		var before = function () {
			APP.E.Basket.access = false;
		};
		var after = function () {
			APP.E.Basket.access = true;

			$(_this.emptyBlock).removeClass('hidden');
			$(_this.basket).remove();
			APP.V.BasketHeader.recountBasket();
		};
		APP.E.Basket.removeAll(before, after);
	},

	buy: function (q) {
		var _this = this;
		var dataId = this.$item.data('id');

		var before = function () {
			APP.E.Basket.access = false;
		};
		var after = function () {
			APP.E.Basket.access = true;
			_this.recount();
			if (window.location.pathname === '/basket') {
				APP.V.Catalog.$item = $('#cu' + dataId);
				if (APP.V.Catalog.$item.length > 0)
					APP.V.Catalog.recount();
			}
			APP.V.BasketHeader.recountBasket();
		};
		APP.E.Basket.buy(dataId, q, before, after);
	},

	recount: function () {
		var _this = this;
		var dataId = _this.$item.data('id');
		var productKey = APP.E.Basket.getProductKey(dataId);
		
		if(APP.D.Basket.products !== undefined)
			var product = APP.D.Basket.products[productKey];
		else
			var product = undefined;
		
		if (product === undefined) {
			_this.$item.remove();
		}
		else if (parseInt(product.quantity) === 0) {
			_this.$item.remove();
		}
		else {
			var itemSum = APP.U.priceFormat(parseInt(product.price) * parseInt(product.quantity));
			_this.$item.find(_this.itemPrice)
				.text(itemSum);
			_this.$item.find(_this.itemCount).text(product.quantity);
		}
		$(_this.basketFooter).show();
		$(_this.emptyBlock).hide();

		$(_this.totalSum).html(APP.U.priceFormat(APP.D.Basket.totalS));
		if (parseInt(APP.D.Basket.totalS) < parseInt(APP.D.MinSum) && parseInt(APP.D.Basket.totalS) !== 0)
			$(_this.noticeMinPrice).show();
		else
			$(_this.noticeMinPrice).hide();

		if (parseInt(APP.D.Basket.totalQ) === 0) {
			$(_this.emptyBlock).show();
			$(_this.basketFooter).hide();
		}

		var catalogUnit = $("#cu" + dataId);
		APP.V.Catalog.$item = catalogUnit;
	},

	renderBasketUnit: function (unit) {
		var _this = this;
		var params = {};
		var csrfParam = $('meta[name="csrf-param"]').attr("content");
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		params[csrfParam] = csrfToken;
		params.unit = JSON.stringify(unit);
		$.ajax({
			url: '/basket/unit',
			global: false,
			type: 'POST',
			data: params,
			success: function (result) {
				$(_this.container).append(result);
				_this.init();
			}
		});
	},

	// проверяет, отрисован ли товар в корзине, если нет - то отрисовывает
	checkUnit: function (id) {
		var u = document.getElementById('bu' + id);
		if (u === null) {
			var productKey = APP.E.Basket.getProductKey(id);
			this.renderBasketUnit(APP.D.Basket.products[productKey]);
		}
	}
};
APP.V.Basket.init();

APP.V.Catalog = {
	$item: $(),
	btnAdd: '.js--add-to-basket__btn',
	product: '.product-unit',
	icon: '.js--basket-product__icon',
	iconPlus: '.js--basket-product__plus',
	ok: '.basket-mini__icon-ok',
	count: '.js--basket-product__count',

	// инициализация продукта для корзины
	init: function () {
		var _this = this;
		var id = false;

		$(_this.product).each(function () {
			var $item = $(this);
			var id = $item.data('id');

			// ивент на кнопку купить
			$item.unbind('click').on('click', function () {
				if (APP.E.Basket.access) {
					_this.$item = $item;
					_this.add(id, 1);
				}
				return false;
			});
			// ивент на кнопку купить
			$item.find(_this.btnAdd).unbind('click').on('click', function () {
				if (APP.E.Basket.access) {
					_this.$item = $item;
					_this.add(id, 1);
				}
				return false;
			});
		});
	},

	// basket add
	add: function (id, q) {
		var _this = this;
		
		// блокируем покупку
		var before = function () {
			APP.E.Basket.access = false;
		};
		var after = function () {
			APP.E.Basket.access = true;
			// пересчёт корзины в шапке
			APP.V.BasketHeader.recountBasket();
			_this.recount();
			if (window.location.pathname === '/basket') {
				APP.V.Basket.checkUnit(id);
				APP.V.Basket.$item = $('#bu' + id);
				APP.V.Basket.recount();
			}
		};

		APP.E.Basket.buy(id, q, before, after);
	},

	recount: function () {
		var _this = this;
		var dataId = _this.$item.data('id');
		var productKey = APP.E.Basket.getProductKey(dataId);

		if (APP.D.Basket.products === undefined)
			APP.D.Basket.products = [];
		var product = APP.D.Basket.products[productKey];

		if (product !== undefined && product !== null && parseInt(product.quantity) > 0) {
			$('.header').removeClass('header_hidden');
			_this.$item.find(_this.count).show().text(product.quantity);
		}
		else {
			_this.$item.find(_this.icon).show();
			_this.$item.find(_this.count).hide();
		}

		return false;
	}
};

APP.V.Catalog.init();

APP.V.Order = {
	init: function () {
		//отслеживаем нажатие чекбокса соглашения
		$('[name="agreement"]').unbind().click(function(){
			//состояние чекбокса
			if($('[name="agreement"]').prop("checked")){
				let _this = this;
				//снимаем с кнопки disabled и удаляем класс disabled_btn
				$('#form-order__btn').prop('disabled',false);
				$('#form-order__btn').removeClass('disabled_btn');
			}else{
				//если чекбокс отжат - накидываем disabled и класс disabled_btn
				$('#form-order__btn').prop('disabled',true);
				$('#form-order__btn').addClass('disabled_btn');
			}
		});
	}
};

APP.V.Order.init();


/**************
 * EXTENSIONS *
 **************/

/**
 * Корзина
 */
APP.E.Basket = {
	access: true,

	initBasket: function () {
		if (!APP.D.Basket || APP.D.Basket.length === 0) {
			APP.D.Basket = {
				products: []
			};
		}

		if (!APP.D.Basket.products) APP.D.Basket.products = [];
		if (APP.D.Basket.products.length === 0) APP.D.Basket.products = [];
	},
	
	getProductKey: function (id) {
		for(var key in APP.D.Basket.products) {
			if(parseInt(APP.D.Basket.products[key].id) === parseInt(id))
				return key;
		}
	},

	getBasket: function (after) {
		var _this = this;

		var params = {};
		var csrfParam = $('meta[name="csrf-param"]').attr("content");
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		params[csrfParam] = csrfToken;

		$.ajax({
			url: '/basket/getbasketjson',
			global: false,
			type: 'POST',
			data: params,
			dataType: 'json',
			success: function (result) {
				APP.D.Basket = result;
				_this.initBasket();
				if (after && typeof(after) === "function") after();
			},
			error: function (request, status, error) {
				console.log('Ошибка: ' + request.responseText);
			}
		});
	},

	// get true if basket not empty end basket blocking setting enabled
	isBasketBlock: function (after) {
		var params = {};
		var csrfParam = $('meta[name="csrf-param"]').attr("content");
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		params[csrfParam] = csrfToken;

		$.ajax({
			url: '/basket/is-basket-block',
			global: false,
			type: 'POST',
			data: params,
			success: function (result) {
				if (after && typeof(after) === "function")
					after(parseInt(result) === 1);
			},
			error: function (request, status, error) {
				console.log('Ошибка: ' + request.responseText);
			}
		});
	},

	checkMinMaxSum: function (after) {
		var params = {},
			isMin = 0;
			isMax = 0,
			csrfParam = $('meta[name="csrf-param"]').attr("content"),
			csrfToken = $('meta[name="csrf-token"]').attr("content");

		params[csrfParam] = csrfToken;

		$.ajax({
			url: '/basket/check-min-max-sum',
			global: false,
			type: 'POST',
			data: params,
			success: function (result) {
				//console.log('1:', result); return false;
				if (after && typeof(after) === "function")
					after(parseInt(result));
			},
			error: function (request, status, error) {
				console.log('Ошибка: ' + request.responseText);
			}
		});
	},

	// get true if basket not empty end basket blocking setting enabled
	resetBasket: function (after) {
		var params = {};
		var csrfParam = $('meta[name="csrf-param"]').attr("content");
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		params[csrfParam] = csrfToken;

		$.ajax({
			url: '/basket/reset-basket',
			global: false,
			type: 'POST',
			data: params,
			success: function (result) {
				if (after && typeof(after) === "function")
					after();
			},
			error: function (request, status, error) {
				console.log('Ошибка: ' + request);
			}
		});
	},

	buy: function (id, q, before, after) {
		var _this = this;

		this.initBasket();
		// собираем продукт
		var product;
		var productKey = _this.getProductKey(id);
		
		if(productKey !== undefined) {
			var quantity = APP.D.Basket.products[productKey].quantity;
			product = APP.U.cloneObj(APP.D.Basket.products[productKey]);
			product.quantity = q + parseInt(quantity);
		} else {
			product = APP.U.cloneObj(APP.D.Products[id]);
			product.quantity = q;
		}
		
		// кладём в корзину
		if (product.quantity > 0) {
			if(productKey === undefined)
				APP.D.Basket.products.push(product);
			else
				APP.D.Basket.products[productKey] = product;
		} else {
			APP.D.Basket.products.splice(productKey, 1);
		}
		// пересчитываем корзину
		_this.recount(before, after);
	},

	recount: function (before, after) {
		if (before && typeof(before) === "function") before();

		var params = {};
		var csrfParam = $('meta[name="csrf-param"]').attr("content");
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		params[csrfParam] = csrfToken;
		params.basket = APP.D.Basket;

		$.ajax({
			url: '/basket/recount',
			global: false,
			type: 'POST',
			data: params,
			dataType: 'json',
			success: function (json) {
				APP.D.Basket = json;
				if (after && typeof(after) === "function") after();
			},
			error: function (request, status, error) {
				console.log('Ошибка: ' + request.responseText);
			}
		});
	},

	more: function (id, before, after) {
		var _this = this;
		
		APP.D.Basket.products[id].quantity = parseInt(APP.D.Basket.products[id].quantity) + 1;
		_this.recount(before, after);
	},

	less: function (id, before, after) {
		var _this = this;

		APP.D.Basket.products[id].quantity = parseInt(APP.D.Basket.products[id].quantity) - 1;
		_this.recount(before, after);
	},

	removeAll: function (before, after) {
		var _this = this;

		APP.D.Basket.products = [];
		_this.recount(before, after);
	},

	remove: function (id, before, after) {
		var _this = this;
		var productKey = _this.getProductKey(id);
		
		APP.D.Basket.products.splice(productKey, 1);
		_this.recount(before, after);
	}
};

/**************
 *    RUN     *
 **************/
$.fn.reverse = [].reverse;
(function ($) {

	if (sessionStorage.getItem('try_bella') === undefined || sessionStorage.getItem('try_bella') !== 'ok')
		$('.tooltip-unit').show();

	$('.tooltip-unit__btn').on('click', function () {
		$('.tooltip-unit').hide();
		sessionStorage.setItem('try_bella', 'ok');
	});

	$('.runet').on('mouseover', function () {
		$('.tooltip-runet').show();
	});
	$('.runet').on('mouseout', function () {
		$('.tooltip-runet').hide();
	});

})(jQuery);

function changeDeliveryMethod($method) {
	$('#deliveryMethod').val($method);
}