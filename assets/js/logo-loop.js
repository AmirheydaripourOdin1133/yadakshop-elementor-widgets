/**
 * Logo Loop widget frontend handler.
 *
 * Vanilla port of React Bits Logo Loop – https://reactbits.dev/animations/logo-loop
 *
 * @package Yadakshop
 */

( function ( $ ) {
	'use strict';

	var ANIMATION_CONFIG = {
		SMOOTH_TAU: 0.25,
		MIN_COPIES: 2,
		COPY_HEADROOM: 2,
	};

	/**
	 * Logo loop instance.
	 *
	 * @param {HTMLElement} root     Root element.
	 * @param {Object}      settings Elementor settings.
	 */
	function YadakshopLogoLoopInstance( root, settings ) {
		this.root = root;
		this.settings = settings || {};
		this.track = root.querySelector( '.yadakshop-logo-loop__track' );
		this.seqRef = null;
		this.rafId = null;
		this.lastTimestamp = null;
		this.offset = 0;
		this.velocity = 0;
		this.seqWidth = 0;
		this.seqHeight = 0;
		this.copyCount = ANIMATION_CONFIG.MIN_COPIES;
		this.isHovered = false;
		this.isUpdating = false;
		this.isReady = false;
		this.resizeObserver = null;
		this.onResize = this.updateDimensions.bind( this );
		this.onMouseEnter = this.handleMouseEnter.bind( this );
		this.onMouseLeave = this.handleMouseLeave.bind( this );

		this.applyCssVariables();
		this.updateClasses();
		this.init();
	}

	YadakshopLogoLoopInstance.prototype.getNumericSetting = function ( key, fallback ) {
		var value = parseFloat( this.settings[ key ] );

		if ( isNaN( value ) ) {
			return fallback;
		}

		return value;
	};

	YadakshopLogoLoopInstance.prototype.getAnimationConfig = function () {
		var direction = this.settings.direction || 'left';
		var speed = this.getNumericSetting( 'speed', 120 );
		var isVertical = 'up' === direction || 'down' === direction;
		var magnitude = Math.abs( speed );
		var directionMultiplier;
		var speedMultiplier = speed < 0 ? -1 : 1;
		var hoverSpeed = this.settings.hover_speed;
		var effectiveHoverSpeed;
		var parsedHoverSpeed = parseFloat( hoverSpeed );

		if ( isVertical ) {
			directionMultiplier = 'up' === direction ? 1 : -1;
		} else {
			directionMultiplier = 'left' === direction ? 1 : -1;
		}

		if ( '' !== hoverSpeed && null !== hoverSpeed && undefined !== hoverSpeed && ! isNaN( parsedHoverSpeed ) ) {
			effectiveHoverSpeed = parsedHoverSpeed;
		} else if ( 'yes' === this.settings.pause_on_hover ) {
			effectiveHoverSpeed = 0;
		} else {
			effectiveHoverSpeed = undefined;
		}

		return {
			targetVelocity: magnitude * directionMultiplier * speedMultiplier,
			isVertical: isVertical,
			effectiveHoverSpeed: effectiveHoverSpeed,
		};
	};

	YadakshopLogoLoopInstance.prototype.applyCssVariables = function () {
		var gap = this.getNumericSetting( 'gap', 32 );
		var logoHeight = this.getNumericSetting( 'logo_height', 28 );
		var fadeColor = this.settings.fade_out_color || '#ffffff';

		this.root.style.setProperty( '--yadakshop-logoloop-gap', gap + 'px' );
		this.root.style.setProperty( '--yadakshop-logoloop-logoHeight', logoHeight + 'px' );
		this.root.style.setProperty( '--yadakshop-logoloop-fadeColor', fadeColor );
	};

	YadakshopLogoLoopInstance.prototype.updateClasses = function () {
		var direction = this.settings.direction || 'left';
		var isVertical = 'up' === direction || 'down' === direction;

		this.root.classList.toggle( 'yadakshop-logo-loop--vertical', isVertical );
		this.root.classList.toggle( 'yadakshop-logo-loop--horizontal', ! isVertical );
		this.root.classList.toggle( 'yadakshop-logo-loop--fade', 'yes' === this.settings.fade_out );
		this.root.classList.toggle( 'yadakshop-logo-loop--scale-hover', 'yes' === this.settings.scale_on_hover );
	};

	YadakshopLogoLoopInstance.prototype.init = function () {
		var self = this;

		if ( ! this.track ) {
			return;
		}

		this.seqRef = this.track.querySelector( '[data-logoloop-seq]' );

		if ( ! this.seqRef ) {
			return;
		}

		this.track.addEventListener( 'mouseenter', this.onMouseEnter );
		this.track.addEventListener( 'mouseleave', this.onMouseLeave );

		if ( window.ResizeObserver ) {
			this.resizeObserver = new ResizeObserver( function () {
				if ( ! self.isUpdating ) {
					self.onResize();
				}
			} );
			this.resizeObserver.observe( this.root );
		} else {
			window.addEventListener( 'resize', this.onResize );
		}

		this.waitForImages( function () {
			self.updateDimensions();

			if ( self.seqWidth > 0 || self.seqHeight > 0 ) {
				self.isReady = true;
				self.startAnimation();
			}
		} );
	};

	YadakshopLogoLoopInstance.prototype.waitForImages = function ( callback ) {
		var images = this.seqRef ? this.seqRef.querySelectorAll( 'img' ) : [];

		if ( ! images.length ) {
			callback();
			return;
		}

		var remaining = images.length;

		var handleImageLoad = function () {
			remaining -= 1;

			if ( remaining <= 0 ) {
				callback();
			}
		};

		images.forEach( function ( img ) {
			if ( img.complete ) {
				handleImageLoad();
			} else {
				img.addEventListener( 'load', handleImageLoad, { once: true } );
				img.addEventListener( 'error', handleImageLoad, { once: true } );
			}
		} );
	};

	YadakshopLogoLoopInstance.prototype.stripCopies = function () {
		var lists = this.track.querySelectorAll( '.yadakshop-logo-loop__list' );
		var index;

		for ( index = lists.length - 1; index > 0; index -= 1 ) {
			lists[ index ].remove();
		}

		this.seqRef = this.track.querySelector( '[data-logoloop-seq]' );
	};

	YadakshopLogoLoopInstance.prototype.measureSequence = function () {
		var width = 0;
		var height = 0;
		var savedTransform;

		if ( ! this.seqRef || ! this.track ) {
			return { width: width, height: height };
		}

		savedTransform = this.track.style.transform;
		this.track.style.transform = 'none';

		width = Math.ceil( this.seqRef.scrollWidth || this.seqRef.offsetWidth || 0 );
		height = Math.ceil( this.seqRef.scrollHeight || this.seqRef.offsetHeight || 0 );

		this.track.style.transform = savedTransform;

		return { width: width, height: height };
	};

	YadakshopLogoLoopInstance.prototype.rebuildCopies = function () {
		var index;

		if ( ! this.seqRef ) {
			return;
		}

		for ( index = 1; index < this.copyCount; index += 1 ) {
			var clone = this.seqRef.cloneNode( true );
			clone.removeAttribute( 'data-logoloop-seq' );
			clone.setAttribute( 'aria-hidden', 'true' );
			this.track.appendChild( clone );
		}
	};

	YadakshopLogoLoopInstance.prototype.updateDimensions = function () {
		var config = this.getAnimationConfig();
		var containerWidth = this.root.clientWidth || 0;
		var size;
		var copiesNeeded;
		var viewport;
		var previousSeqWidth = this.seqWidth;
		var previousSeqHeight = this.seqHeight;

		if ( ! this.track || ! this.seqRef || this.isUpdating ) {
			return;
		}

		this.isUpdating = true;
		this.stripCopies();
		size = this.measureSequence();

		if ( config.isVertical ) {
			var parentHeight = this.root.parentElement ? this.root.parentElement.clientHeight : 0;

			if ( parentHeight > 0 ) {
				this.root.style.height = Math.ceil( parentHeight ) + 'px';
			}

			if ( size.height > 0 ) {
				this.seqHeight = size.height;
				viewport = this.root.clientHeight || parentHeight || size.height;
				copiesNeeded = Math.ceil( viewport / size.height ) + ANIMATION_CONFIG.COPY_HEADROOM;
				this.copyCount = Math.max( ANIMATION_CONFIG.MIN_COPIES, copiesNeeded );
			}
		} else if ( size.width > 0 ) {
			this.seqWidth = size.width;
			copiesNeeded = Math.ceil( containerWidth / size.width ) + ANIMATION_CONFIG.COPY_HEADROOM;
			this.copyCount = Math.max( ANIMATION_CONFIG.MIN_COPIES, copiesNeeded );
		}

		this.rebuildCopies();

		if ( this.seqWidth > 0 && previousSeqWidth > 0 && previousSeqWidth !== this.seqWidth ) {
			this.offset = ( ( this.offset % this.seqWidth ) + this.seqWidth ) % this.seqWidth;
		}

		if ( this.seqHeight > 0 && previousSeqHeight > 0 && previousSeqHeight !== this.seqHeight ) {
			this.offset = ( ( this.offset % this.seqHeight ) + this.seqHeight ) % this.seqHeight;
		}

		this.applyTransform();
		this.isUpdating = false;
	};

	YadakshopLogoLoopInstance.prototype.applyTransform = function () {
		var config = this.getAnimationConfig();
		var seqSize = config.isVertical ? this.seqHeight : this.seqWidth;
		var transformValue;

		if ( ! this.track || seqSize <= 0 ) {
			return;
		}

		this.offset = ( ( this.offset % seqSize ) + seqSize ) % seqSize;
		transformValue = config.isVertical
			? 'translate3d(0, ' + ( -this.offset ) + 'px, 0)'
			: 'translate3d(' + ( -this.offset ) + 'px, 0, 0)';

		this.track.style.transform = transformValue;
	};

	YadakshopLogoLoopInstance.prototype.handleMouseEnter = function () {
		var config = this.getAnimationConfig();

		if ( undefined !== config.effectiveHoverSpeed ) {
			this.isHovered = true;
		}
	};

	YadakshopLogoLoopInstance.prototype.handleMouseLeave = function () {
		var config = this.getAnimationConfig();

		if ( undefined !== config.effectiveHoverSpeed ) {
			this.isHovered = false;
		}
	};

	YadakshopLogoLoopInstance.prototype.startAnimation = function () {
		var self = this;

		if ( this.rafId ) {
			cancelAnimationFrame( this.rafId );
		}

		this.lastTimestamp = null;

		var animate = function ( timestamp ) {
			var config = self.getAnimationConfig();
			var seqSize = config.isVertical ? self.seqHeight : self.seqWidth;
			var deltaTime;
			var target;
			var easingFactor;

			if ( ! self.isReady || seqSize <= 0 ) {
				self.rafId = requestAnimationFrame( animate );
				return;
			}

			if ( null === self.lastTimestamp ) {
				self.lastTimestamp = timestamp;
			}

			deltaTime = Math.max( 0, timestamp - self.lastTimestamp ) / 1000;
			self.lastTimestamp = timestamp;

			target = self.isHovered && undefined !== config.effectiveHoverSpeed
				? config.effectiveHoverSpeed
				: config.targetVelocity;

			easingFactor = 1 - Math.exp( -deltaTime / ANIMATION_CONFIG.SMOOTH_TAU );
			self.velocity += ( target - self.velocity ) * easingFactor;

			self.offset += self.velocity * deltaTime;

			while ( self.offset >= seqSize ) {
				self.offset -= seqSize;
			}

			while ( self.offset < 0 ) {
				self.offset += seqSize;
			}

			self.applyTransform();
			self.rafId = requestAnimationFrame( animate );
		};

		this.rafId = requestAnimationFrame( animate );
	};

	YadakshopLogoLoopInstance.prototype.destroy = function () {
		if ( this.rafId ) {
			cancelAnimationFrame( this.rafId );
			this.rafId = null;
		}

		if ( this.resizeObserver ) {
			this.resizeObserver.disconnect();
			this.resizeObserver = null;
		} else {
			window.removeEventListener( 'resize', this.onResize );
		}

		if ( this.track ) {
			this.track.removeEventListener( 'mouseenter', this.onMouseEnter );
			this.track.removeEventListener( 'mouseleave', this.onMouseLeave );
		}

		this.isReady = false;
		this.lastTimestamp = null;
	};

	var LogoLoopHandler = elementorModules.frontend.handlers.Base.extend( {
		getDefaultSettings: function () {
			return {
				selectors: {
					wrapper: '.yadakshop-logo-loop',
				},
			};
		},

		getDefaultElements: function () {
			return {
				$wrapper: this.$element.find( this.getSettings( 'selectors.wrapper' ) ),
			};
		},

		onInit: function () {
			elementorModules.frontend.handlers.Base.prototype.onInit.apply( this, arguments );
			this.initLoop();
		},

		initLoop: function () {
			if ( this.loopInstance ) {
				this.loopInstance.destroy();
			}

			if ( ! this.elements.$wrapper.length ) {
				return;
			}

			this.loopInstance = new YadakshopLogoLoopInstance(
				this.elements.$wrapper[ 0 ],
				this.getElementSettings()
			);
		},

		onDestroy: function () {
			if ( this.loopInstance ) {
				this.loopInstance.destroy();
			}

			elementorModules.frontend.handlers.Base.prototype.onDestroy.apply( this, arguments );
		},

		onElementChange: function () {
			this.initLoop();
		},
	} );

	var registerHandler = function () {
		elementorFrontend.elementsHandler.attachHandler( 'yadakshop-logo-loop', LogoLoopHandler );
	};

	if ( window.elementorFrontend && elementorFrontend.elementsHandler ) {
		registerHandler();
	} else {
		$( window ).on( 'elementor/frontend/init', registerHandler );
	}
}( jQuery ) );
