/**
 * Services Carousel widget frontend handler.
 *
 * @package Yadakshop
 */

( function ( $ ) {
	'use strict';

	var sharedMethods = {
		getDefaultSettings: function () {
			return {
				selectors: {
					carousel: '.yadakshop-services-carousel__swiper',
				},
			};
		},

		getSlidesPerView: function ( device ) {
			var settings = this.getElementSettings();
			var key = 'slides_per_view' + ( 'desktop' !== device ? '_' + device : '' );
			var value = settings[ key ];

			if ( undefined === value || '' === value || null === value ) {
				if ( 'mobile' === device ) {
					value = 1;
				} else if ( 'tablet' === device ) {
					value = 2;
				} else {
					value = 3;
				}
			}

			return parseInt( value, 10 );
		},

		getSlidesCount: function () {
			return this.elements.$carousel.find( '.swiper-slide' ).length;
		},

		isLoopEnabled: function () {
			var settings = this.getElementSettings();

			if ( 'yes' !== settings.loop ) {
				return false;
			}

			var slidesCount = this.getSlidesCount();
			var maxPerView = Math.max(
				this.getSlidesPerView( 'desktop' ),
				this.getSlidesPerView( 'tablet' ),
				this.getSlidesPerView( 'mobile' )
			);

			return slidesCount > maxPerView;
		},

		getSpaceBetween: function () {
			var settings = this.getElementSettings();
			var space = parseInt( settings.space_between, 10 );

			if ( isNaN( space ) ) {
				return 30;
			}

			return Math.max( 0, space );
		},

		getSwiperSettings: function () {
			var settings = this.getElementSettings();
			var loop = this.isLoopEnabled();
			var spaceBetween = this.getSpaceBetween();
			var swiperOptions = {
				slidesPerView: this.getSlidesPerView( 'desktop' ),
				spaceBetween: spaceBetween,
				speed: parseInt( settings.transition_speed, 10 ) || 500,
				loop: loop,
				loopAdditionalSlides: 2,
				centeredSlides: 'yes' === settings.center_mode,
				rewind: 'yes' === settings.infinite && ! loop,
				watchOverflow: true,
				breakpoints: {
					0: {
						slidesPerView: this.getSlidesPerView( 'mobile' ),
						spaceBetween: spaceBetween,
					},
					768: {
						slidesPerView: this.getSlidesPerView( 'tablet' ),
						spaceBetween: spaceBetween,
					},
					1025: {
						slidesPerView: this.getSlidesPerView( 'desktop' ),
						spaceBetween: spaceBetween,
					},
				},
			};

			if ( 'yes' === settings.autoplay ) {
				swiperOptions.autoplay = {
					delay: parseInt( settings.autoplay_speed, 10 ) || 5000,
					disableOnInteraction: false,
					pauseOnMouseEnter: 'yes' === settings.pause_on_hover,
				};
			}

			var $prev = this.$element.find( '.yadakshop-services-carousel__arrow--prev' );
			var $next = this.$element.find( '.yadakshop-services-carousel__arrow--next' );
			var $pagination = this.$element.find( '.yadakshop-services-carousel__pagination' );

			if ( $prev.length && $next.length ) {
				swiperOptions.navigation = {
					prevEl: $prev[ 0 ],
					nextEl: $next[ 0 ],
				};
			}

			if ( $pagination.length ) {
				swiperOptions.pagination = {
					el: $pagination[ 0 ],
					clickable: true,
				};
			}

			return swiperOptions;
		},
	};

	var ServicesCarouselHandler;

	if ( elementorModules.frontend.handlers.Carousel ) {
		ServicesCarouselHandler = elementorModules.frontend.handlers.Carousel.extend( sharedMethods );
	} else {
		ServicesCarouselHandler = elementorModules.frontend.handlers.Base.extend( $.extend( {}, sharedMethods, {
			getDefaultElements: function () {
				return {
					$carousel: this.$element.find( this.getSettings( 'selectors.carousel' ) ),
				};
			},

			onInit: function () {
				elementorModules.frontend.handlers.Base.prototype.onInit.apply( this, arguments );

				if ( ! this.elements.$carousel.length ) {
					return;
				}

				this.initSwiperInstance();
			},

			initSwiperInstance: async function () {
				var Swiper = elementorFrontend.utils.swiper;

				if ( this.swiper ) {
					this.swiper.destroy( true, true );
				}

				this.swiper = await new Swiper(
					this.elements.$carousel,
					this.getSwiperSettings()
				);
			},

			onDestroy: function () {
				if ( this.swiper ) {
					this.swiper.destroy( true, true );
				}

				elementorModules.frontend.handlers.Base.prototype.onDestroy.apply( this, arguments );
			},
		} ) );
	}

	var registerHandler = function () {
		elementorFrontend.elementsHandler.attachHandler(
			'yadakshop-services-carousel',
			ServicesCarouselHandler
		);
	};

	if ( window.elementorFrontend && elementorFrontend.elementsHandler ) {
		registerHandler();
	} else {
		$( window ).on( 'elementor/frontend/init', registerHandler );
	}
}( jQuery ) );
