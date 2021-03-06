/**
 * jQuery Plugin to obtain touch gestures from iPhone, iPod Touch and iPad, should also work with Android mobile phones (not tested yet!)
 * Common usage: wipe images (left and right to show the previous or next image)
 *
 * @author Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
 * @version 1.1.1 (9th December 2010) - fix bug (older IE's had problems)
 * @version 1.1 (1st September 2010) - support wipe up and wipe down
 * @version 1.0 (15th July 2010)
 */
(function($){$.fn.touchwipe=function(settings){var config={min_move_x:20,min_move_y:20,wipeLeft:function(){},wipeRight:function(){},wipeUp:function(){},wipeDown:function(){},preventDefaultEvents:true};if(settings)$.extend(config,settings);this.each(function(){var startX;var startY;var isMoving=false;function cancelTouch(){this.removeEventListener('touchmove',onTouchMove);startX=null;isMoving=false}function onTouchMove(e){if(config.preventDefaultEvents){e.preventDefault()}if(isMoving){var x=e.touches[0].pageX;var y=e.touches[0].pageY;var dx=startX-x;var dy=startY-y;if(Math.abs(dx)>=config.min_move_x){cancelTouch();if(dx>0){config.wipeLeft()}else{config.wipeRight()}}else if(Math.abs(dy)>=config.min_move_y){cancelTouch();if(dy>0){config.wipeDown()}else{config.wipeUp()}}}}function onTouchStart(e){if(e.touches.length==1){startX=e.touches[0].pageX;startY=e.touches[0].pageY;isMoving=true;this.addEventListener('touchmove',onTouchMove,false)}}if('ontouchstart'in document.documentElement){this.addEventListener('touchstart',onTouchStart,false)}});return this}})(jQuery);

/*! Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 3.1.9
 *
 * Requires: jQuery 1.2.2+
 */

(function (factory) {
    if ( typeof define === 'function' && define.amd ) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
                    ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice  = Array.prototype.slice,
        nullLowestDeltaTimeout, lowestDelta;

    if ( $.event.fixHooks ) {
        for ( var i = toFix.length; i; ) {
            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
        }
    }

    var special = $.event.special.mousewheel = {
        version: '3.1.9',

        setup: function() {
            if ( this.addEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.addEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = handler;
            }
            // Store the line height and page height for this particular element
            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
        },

        teardown: function() {
            if ( this.removeEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.removeEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = null;
            }
        },

        getLineHeight: function(elem) {
            return parseInt($(elem)['offsetParent' in $.fn ? 'offsetParent' : 'parent']().css('fontSize'), 10);
        },

        getPageHeight: function(elem) {
            return $(elem).height();
        },

        settings: {
            adjustOldDeltas: true
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },

        unmousewheel: function(fn) {
            return this.unbind('mousewheel', fn);
        }
    });


    function handler(event) {
        var orgEvent   = event || window.event,
            args       = slice.call(arguments, 1),
            delta      = 0,
            deltaX     = 0,
            deltaY     = 0,
            absDelta   = 0;
        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        // Old school scrollwheel delta
        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
            deltaX = deltaY * -1;
            deltaY = 0;
        }

        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
        delta = deltaY === 0 ? deltaX : deltaY;

        // New school wheel delta (wheel event)
        if ( 'deltaY' in orgEvent ) {
            deltaY = orgEvent.deltaY * -1;
            delta  = deltaY;
        }
        if ( 'deltaX' in orgEvent ) {
            deltaX = orgEvent.deltaX;
            if ( deltaY === 0 ) { delta  = deltaX * -1; }
        }

        // No change actually happened, no reason to go any further
        if ( deltaY === 0 && deltaX === 0 ) { return; }

        // Need to convert lines and pages to pixels if we aren't already in pixels
        // There are three delta modes:
        //   * deltaMode 0 is by pixels, nothing to do
        //   * deltaMode 1 is by lines
        //   * deltaMode 2 is by pages
        if ( orgEvent.deltaMode === 1 ) {
            var lineHeight = $.data(this, 'mousewheel-line-height');
            delta  *= lineHeight;
            deltaY *= lineHeight;
            deltaX *= lineHeight;
        } else if ( orgEvent.deltaMode === 2 ) {
            var pageHeight = $.data(this, 'mousewheel-page-height');
            delta  *= pageHeight;
            deltaY *= pageHeight;
            deltaX *= pageHeight;
        }

        // Store lowest absolute delta to normalize the delta values
        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

        if ( !lowestDelta || absDelta < lowestDelta ) {
            lowestDelta = absDelta;

            // Adjust older deltas if necessary
            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
                lowestDelta /= 40;
            }
        }

        // Adjust older deltas if necessary
        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
            // Divide all the things by 40!
            delta  /= 40;
            deltaX /= 40;
            deltaY /= 40;
        }

        // Get a whole, normalized value for the deltas
        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

        // Add information to the event object
        event.deltaX = deltaX;
        event.deltaY = deltaY;
        event.deltaFactor = lowestDelta;
        // Go ahead and set deltaMode to 0 since we converted to pixels
        // Although this is a little odd since we overwrite the deltaX/Y
        // properties with normalized deltas.
        event.deltaMode = 0;

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        // Clearout lowestDelta after sometime to better
        // handle multiple device types that give different
        // a different lowestDelta
        // Ex: trackpad = 3 and mouse wheel = 120
        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
        lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
        // If this is an older event and the delta is divisable by 120,
        // then we are assuming that the browser is treating this as an
        // older mouse wheel event and that we should divide the deltas
        // by 40 to try and get a more usable deltaFactor.
        // Side note, this actually impacts the reported scroll distance
        // in older browsers and can cause scrolling to be slower than native.
        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }

}));


/**
 * @version		$Id:  $Revision
 * @package		jquery
 * @subpackage	lofslidernews
 * @copyright	Copyright (C) JAN 2010 LandOfCoder.com <@emai:landofcoder@gmail.com>. All rights reserved.
 * @website     http://landofcoder.com
 * @license		This plugin is dual-licensed under the GNU General Public License and the MIT License
 *
 * last modified by Helmut Hackbarth - info@t3solution.de 25.10.2012
 */
// JavaScript Document
(function($) {
	 $.fn.lofJSidernews = function( settings ) {
	 	return this.each(function() {
			// get instance of the lofSiderNew.
			new  $.lofSidernews( this, settings );
		});
 	 }
	 $.lofSidernews = function( obj, settings ){
		this.settings = {
		  sliderId        : '',
			direction	    	: '',
			mainItemSelector    : '.lof-item',
			navInnerSelector	: 'ul',
///			navSelector  		: 'li.navSelector' ,
			navigatorEvent		: 'click',
			wapperSelector: 	'.lof-main-wapper',
			interval	  	 	: 4000,
			auto			    : true,
			maxItemDisplay	 	: 3,
			startItem			: 0,
			navPosition			: 'vertical',
			navigatorHeight		: 100,
			navigatorWidth		: 300,
			duration			: 600,
			navItemsSelector    : '.lof-navigator li',
			navOuterSelector    : '.lof-navigator-outer' ,
			isPreloaded			: false,
      pauseOnMouseOver : false,
      pauseButton : false,
      progressBar : false,
			easing				: 'easeInOutQuad',
      topBottom : 'bottom',
			colorbox : false
		}
		$.extend( this.settings, settings ||{} );
		this.nextNo         = null;
		this.previousNo     = null;
		this.maxWidth  = this.settings.mainWidth || 600;
		this.wrapper = $( obj ).find( this.settings.wapperSelector );
		this.slides = this.wrapper.find( this.settings.mainItemSelector );
		if( !this.wrapper.length || !this.slides.length ) return ;
		// set width of wapper
		if( this.settings.maxItemDisplay > this.slides.length ){
			this.settings.maxItemDisplay = this.slides.length;
		}
		this.currentNo      = isNaN(this.settings.startItem)||this.settings.startItem > this.slides.length?0:this.settings.startItem;
		this.navigatorOuter = $( obj ).find( this.settings.navOuterSelector );
		this.navigatorItems = $( obj ).find( this.settings.navItemsSelector ) ;
		this.navigatorInner = this.navigatorOuter.find( this.settings.navInnerSelector );

    this.paginationItems = $( obj ).find( '.navigationControl li' ) ;
    this.sliderItems = $( obj ).find( '.lof-item' ) ;
		if( this.settings.navPosition == 'horizontal' ) {
			this.navigatorInner.width( this.slides.length * this.settings.navigatorWidth );
			this.navigatorOuter.width( this.settings.maxItemDisplay * this.settings.navigatorWidth );
			this.navigatorOuter.height(	this.settings.navigatorHeight );

      if (this.settings.topBottom == 'top') {
//        this.navigatorInner.width( 'auto' );
//        this.navigatorOuter.width( '100%' );
        this.navigatorOuter.height(	'auto' );
      }

		} else {
			this.navigatorInner.height( this.slides.length * this.settings.navigatorHeight );

			this.navigatorOuter.height( this.settings.maxItemDisplay * this.settings.navigatorHeight );
			this.navigatorOuter.width(	this.settings.navigatorWidth );
		}
		this.navigratorStep = this.__getPositionMode( this.settings.navPosition );
		this.directionMode = this.__getDirectionMode();

		if( this.settings.direction == 'opacity') {
			this.wrapper.addClass( 'lof-opacity' );
      $(this.slides).css({'opacity':'0', 'z-index':'0'}).eq(this.currentNo).css({'opacity':'1', 'z-index':'4'});
      this.caption = $( obj ).find( '.lof-description' );
      $( obj ).find( '.lof-description' ).hide().eq(0).show();
		} else {
			this.wrapper.css({'left':'-'+this.currentNo*this.maxSize+'px', 'width':( this.maxWidth ) * this.slides.length } );
		}

		if( this.settings.isPreloaded ) {
			this.preLoadImage( this.onComplete );
		} else {
			this.onComplete();
		}

		var self = this;
    if( self.settings.pauseOnMouseOver ) {
  		if(	self.settings.auto ){
        self.wrapper.hover(function() {
          self.stop();
          if( self.settings.progressBar ) {
            $('.progressbar'+self.settings.sliderId).stop();
            $('.progressbar'+self.settings.sliderId).animate({width: '0px', opacity:'0'});
          }
        }, function() {
          self.play( self.settings.interval,'next', true );
        });
  	 }
    }
    if( self.settings.pauseButton && self.settings.auto ) {
      var running = true;
  		$buttonControl = $( '.button-control'+self.settings.sliderId, obj);
			$buttonControl.addClass('action-stop');
  		$buttonControl.click( function() {
  			if( $buttonControl.hasClass('action-start') ){
          self.settings.auto =true;
          running = true;
  				self.play( self.settings.interval,'next', true );
  				$buttonControl.removeClass('action-start').addClass('action-stop');
  			} else {
          self.settings.auto =false;
          running = false;
  				self.stop();
          if( self.settings.progressBar ) {
            $('.progressbar'+self.settings.sliderId).stop();
            $('.progressbar'+self.settings.sliderId).animate({width: '0px', opacity:'0'});
          }
  				$buttonControl.addClass('action-start').removeClass('action-stop');
  			}
  		} );
    }

	if( self.settings.colorbox && self.settings.auto ) {
      var id = self.settings.sliderId;
      $('#cboxOverlay, #cboxClose').click( function() {
        if (running) {
          self.settings.auto =true;
          self.play( self.settings.interval,'next', true );
      	}
      } );

      jQuery('a.inline-overlay'+id+', a.iframe-overlay'+id+', a.readmore-overlay'+id+', a.image-overlay'+id+', a.pagination-overlay'+id+', a.video-overlay'+id).bind('click', function() {
        if( self.settings.progressBar ) {
          $('.progressbar'+id).stop();
          $('.progressbar'+id).animate({width: '0px', opacity:'0'});
        }
        self.settings.auto =false;
        self.stop();
      });
    }

  }

   $.lofSidernews.fn =  $.lofSidernews.prototype;
   $.lofSidernews.fn.extend =  $.lofSidernews.extend = $.extend;

	 $.lofSidernews.fn.extend({

	startUp:function( obj, wrapper ) {

    if(this.settings.navigatorEvent == 'click' ) {
      this.sliderItems.each( function(index, item ){
      	$(item).click( function(){
      		obj.setNavActive( index, item );
      	} );
      })
      if( this.settings.topBottom == 'bottom' ) {
        this.navigatorItems.each( function(index, item ){
        	$(item).click( function(){
        		obj.jumping( index, true );
        		obj.setNavActive( index, item );
        	} );
          $(item).css( {'height': obj.settings.navigatorHeight, 'width':  obj.settings.navigatorWidth} );
        })
      } else {
        this.navigatorItems.each( function(index, item ){
        	$(item).click( function(){
        		obj.jumping( index, true );
        		obj.setNavActive( index, item );
        	} );
          $(item).css( {'height': 'auto', 'width': obj.settings.navigatorWidth} );
        })
      }
      if( (this.paginationItems) ){
        this.paginationItems.each( function(index, item ){
        	$(item).click( function(){
        		obj.jumping( index, true );
        		obj.setNavActive( index, item );
        	} );
        })
      }
    }
    if(this.settings.navigatorEvent == 'mouseover' ) {
      this.sliderItems.each( function(index, item ){
      	$(item).mouseover( function(){
      		obj.setNavActive( index, item );
      	} );
      })
      if( this.settings.topBottom == 'bottom' ) {
        this.navigatorItems.each( function(index, item ){
          $(item).mouseover( function(){
          	obj.jumping( index, true );
          	obj.setNavActive( index, item );
          } );
          $(item).css( {'height': obj.settings.navigatorHeight, 'width':  obj.settings.navigatorWidth} );
        })
      } else {
        this.navigatorItems.each( function(index, item ){
        	$(item).mouseover( function(){
        		obj.jumping( index, true );
        		obj.setNavActive( index, item );
        	} );
          $(item).css( {'height': 'auto', 'width': 'auto'} );
        })
      }
      if( (this.paginationItems) ){
        this.paginationItems.each( function(index, item ){
        	$(item).mouseover( function(){
        		obj.jumping( index, true );
        		obj.setNavActive( index, item );
        	} );
        })
      }
    }

			this.navigatorItems.find('img').hover(function(){ $(this).stop().animate({'opacity':0.7},500,'easeInOutQuad') },
																					  function(){  $(this).animate({'opacity':1},500,'easeInOutSine') } );

			this.registerWheelHandler( this.navigatorOuter, this );
			this.registerTastaturHandler(this.navigatorOuter, this);
      this.registerTouchSwipe(this.sliderItems, this);

			this.setNavActive(this.currentNo );

			if( this.settings.buttons && typeof (this.settings.buttons) == "object" ){
				this.registerButtonsControl( 'click', this.settings.buttons, this );
			}
			if( this.settings.auto )
			this.play( this.settings.interval,'next', true );

			return this;
		},


		onComplete:function(){
			setTimeout( function(){ $('.preload').fadeOut( 900 ); }, 500 );	this.startUp( this );
		},
		preLoadImage:function(  callback ){
			var self = this;
			var images = this.wrapper.find( 'img' );
			if( images.length <= 0 ){
				self.onComplete();

				return ;
			}
			var count = 0;
			images.each( function(index,image){
				if( !image.complete ){
					image.onload =function(){
						count++;
						if( count >= images.length ){
							self.onComplete();
						}
					}
					image.onerror =function(){
						count++;
						if( count >= images.length ){
							self.onComplete();
						}
					}
				}else {

					count++;
					if( count >= images.length ){
						self.onComplete();

					}
				}
			} );
		},
		navivationAnimate:function( currentIndex ) {
			if (currentIndex <= this.settings.startItem
				|| currentIndex - this.settings.startItem >= this.settings.maxItemDisplay-1) {
					this.settings.startItem = currentIndex - this.settings.maxItemDisplay+2;
					if (this.settings.startItem < 0) this.settings.startItem = 0;
					if (this.settings.startItem >this.slides.length-this.settings.maxItemDisplay) {
						this.settings.startItem = this.slides.length-this.settings.maxItemDisplay;
					}
			}
			this.navigatorInner.stop().animate( eval('({'+this.navigratorStep[0]+':-'+this.settings.startItem*this.navigratorStep[1]+'})'),
												{duration:500, easing:'easeInOutQuad'} );
		},
		setNavActive:function( index, item ){
      if( (this.sliderItems) ){
      	this.sliderItems.removeClass('active-slider' );
        $(this.sliderItems.get(index)).addClass( 'active-slider' );
      }
			if( (this.navigatorItems) ){
				this.navigatorItems.removeClass( 'active' );
				$(this.navigatorItems.get(index)).addClass( 'active' );
				this.navivationAnimate( this.currentNo );
			}
			if( (this.paginationItems) ){
				this.paginationItems.removeClass( 'active' );
				$(this.paginationItems.get(index)).addClass( 'active' );
			}
		},
		__getPositionMode:function( position ){
			if(	position  == 'horizontal' ){
				return ['left', this.settings.navigatorWidth];
			}
			return ['top', this.settings.navigatorHeight];
		},
		__getDirectionMode:function(){
			switch( this.settings.direction ){
				case 'opacity': this.maxSize=0; return ['opacity','opacity'];
				default: this.maxSize=this.maxWidth; return ['left','width'];
			}
		},
		registerWheelHandler:function( element, obj ){
			 element.bind('mousewheel', function(event, delta ) {
				var dir = delta > 0 ? 'Up' : 'Down',
					vel = Math.abs(delta);
				if( delta > 0 ){
					obj.previous( true );
				} else {
					obj.next( true );
				}
				return false;
			});
		},
		registerTastaturHandler:function( element, obj ){
			 $(document).keyup(function (event) {
               if (event.keyCode == 37) {
			     obj.previous( true );
				 }
			   else if (event.keyCode == 39) {
			     obj.next( true );
			     }
			 });
		},
    registerTouchSwipe:function( element, obj ){
    		$(this.sliderItems).touchwipe({
            wipeLeft: function() {
                obj.next( true );
            },
            wipeRight: function() {
                obj.previous( true );
            }
        });
    },
		registerButtonsControl:function( eventHandler, objects, self ){
			for( var action in objects ){
				switch (action.toString() ){
					case 'next':
						objects[action].click( function() { self.next( true) } );
						break;
					case 'previous':
						objects[action].click( function() { self.previous( true) } );
						break;
				}
			}
			return this;
		},
		onProcessing:function( manual, start, end ){
			this.previousNo = this.currentNo + (this.currentNo>0 ? -1 : this.slides.length-1);
			this.nextNo 	= this.currentNo + (this.currentNo < this.slides.length-1 ? 1 : 1- this.slides.length);
			return this;
		},
		finishFx:function( manual ){
			if( manual ) this.stop();
			if( manual && this.settings.auto ){
				this.play( this.settings.interval,'next', true );
			}
			this.setNavActive( this.currentNo );
		},
		getObjectDirection:function( start, end ){
			return eval("({'"+this.directionMode[0]+"':-"+(this.currentNo*start)+"})");
		},
		fxStart:function( index, obj, currentObj ){
		  if( this.settings.direction == 'opacity' ) {
        $(this.slides).stop().animate({'opacity':0}, {duration: this.settings.duration, easing:this.settings.easing} ).css({'z-index':0});
        $(this.slides).eq(index).stop().animate( {'opacity':1},this.settings.duration, this.settings.easing, function(){
          $(currentObj.caption.slideUp().eq(index)).slideDown();
        } ).css({'z-index':4});
		  }else {
        this.wrapper.stop().animate( obj, {duration: this.settings.duration, easing:this.settings.easing  } );
			}
			return this;
		},
		jumping:function( no, manual ){
      if( this.settings.progressBar && this.settings.auto ) {
        $('.progressbar'+this.settings.sliderId).stop();
        $('.progressbar'+this.settings.sliderId).animate({width: '0px', opacity:'0'}, 0);
      }
			this.stop();
			if( this.currentNo == no ) return;
			 var obj = eval("({'"+this.directionMode[0]+"':-"+(this.maxSize*no)+"})");
			this.onProcessing( null, manual, 0, this.maxSize )
				.fxStart( no, obj, this )
				.finishFx( manual );
				this.currentNo  = no;
		},
		next:function( manual , item){
      if( this.settings.progressBar && this.settings.auto ) {
        $('.progressbar'+this.settings.sliderId).stop();
        $('.progressbar'+this.settings.sliderId).animate({width: '0px', opacity:'0'}, 0);
      }
 			this.currentNo += (this.currentNo < this.slides.length-1) ? 1 : (1 - this.slides.length);
			this.onProcessing( item, manual, 0, this.maxSize )
				.fxStart( this.currentNo, this.getObjectDirection(this.maxSize ), this )
				.finishFx( manual );
		},
		previous:function( manual, item ){
      if( this.settings.progressBar && this.settings.auto ) {
        $('.progressbar'+this.settings.sliderId).stop();
        $('.progressbar'+this.settings.sliderId).animate({width: '0px', opacity:'0'}, 0);
      }
			this.currentNo += this.currentNo > 0 ? -1 : this.slides.length - 1;
			this.onProcessing( item, manual )
				.fxStart( this.currentNo, this.getObjectDirection(this.maxSize ), this )
				.finishFx( manual	);
		},
		play:function( delay, direction, wait ){
      if( this.settings.progressBar && this.settings.auto ) {
        $('.progressbar'+this.settings.sliderId).stop();
        $('.progressbar'+this.settings.sliderId).css('width','0px');
        $('.progressbar'+this.settings.sliderId).css('opacity','0');
        $('.progressbar'+this.settings.sliderId).animate({width: '100%', opacity:'1'}, this.settings.interval );
      }
			this.stop();
			if(!wait){ this[direction](false); }
			var self  = this;
			this.isRun = setTimeout(function() { self[direction](true); }, delay);
		},
		stop:function(){
			if (this.isRun == null) return;
			clearTimeout(this.isRun);
            this.isRun = null;
		}
	})
})(jQuery);




