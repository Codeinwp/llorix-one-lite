/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	
		
	//Very top header Phone
	wp.customize("llorix_one_lite_very_top_header_phone", function(value) {
		
        value.bind(function( to ) {
			$( '.very-top-left span' ).html( to );
		} );
		
    });	
	
	/* Blog header */
	wp.customize("llorix_one_lite_blog_header_title", function(value) {
        value.bind(function( to ) {
			$( '.archive-top-big-title' ).html( to );
		} );
    });	
	wp.customize("llorix_one_lite_blog_header_subtitle", function(value) {
        value.bind(function( to ) {
			$( '.archive-top-text' ).html( to );
		} );
    });
	wp.customize("llorix_one_lite_blog_header_image", function(value) {
        value.bind(function( to ) {
			$(".archive-top").css('background-image', 'url(' + to + ')');
        } );
    });	
    
	/***************************************
	******** HEADER SECTION ****************
	****************************************/
	//Logo
	wp.customize("llorix_one_lite_logo", function(value) {
        value.bind(function( to ) {
			if( to != '' ) {
				$( '.navbar-brand' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.header-logo-wrap' ).addClass( 'llorix_one_lite_only_customizer' );
			}
			else {
				$( '.navbar-brand' ).addClass( 'llorix_one_lite_only_customizer' );
				$( '.header-logo-wrap' ).removeClass( 'llorix_one_lite_only_customizer' );
			}
				
            $(".navbar-brand img").attr( "src", to );
			
        } );
    });


	//Show Header Logo
	wp.customize('llorix_one_lite_header_logo', function( value ){
		value.bind(function( to ) {
			if( to != '' ) {
				$('#llorix_one_lite_header .only-logo').removeClass( 'llorix_one_lite_only_customizer' );
			} else {
				$('#llorix_one_lite_header .only-logo').addClass( 'llorix_one_lite_only_customizer' );
			}
			$( '#llorix_one_lite_header .only-logo img' ).attr('src', to);
		});
		
	});
	
	//Title
	wp.customize("llorix_one_lite_header_title", function(value) {
		
        value.bind(function( to ) {
			if( to != '' ) {
				$( '#llorix_one_lite_header .intro-section h1' ).removeClass( 'llorix_one_lite_only_customizer' );
			}
			else {
				$( '#llorix_one_lite_header .intro-section h1' ).addClass( 'llorix_one_lite_only_customizer' );
			}
			$( '#llorix_one_lite_header .intro-section h1' ).text( to );
	    } );
		
    });
	
	//Subtitle
	wp.customize("llorix_one_lite_header_subtitle", function(value) {
		
        value.bind(function( to ) {
			if( to != '' ) {
				$( '#llorix_one_lite_header .intro-section h5' ).removeClass( 'llorix_one_lite_only_customizer' );
			} else {
				$( '#llorix_one_lite_header .intro-section h5' ).addClass( 'llorix_one_lite_only_customizer' );
			}
			$( '#llorix_one_lite_header .intro-section h5' ).text( to );
		} );
		
    });
	
	//Button text
	wp.customize("llorix_one_lite_header_button_text", function(value) {
		
        value.bind(function( to ) {

			if( to != '' ) {
				$( '#llorix_one_lite_header .button a' ).removeClass( 'llorix_one_lite_only_customizer' );
			} else {
				$( '#llorix_one_lite_header .button a' ).addClass( 'llorix_one_lite_only_customizer' );
			}
			$( '#llorix_one_lite_header .button a' ).text( to );
		} );
		
    });


	//Button link
	wp.customize("llorix_one_lite_header_button_link", function(value) {
		
        value.bind(function( to ) {
			$( '#llorix_one_lite_header .button a' ).attr( 'href', to );
		} );
		
    });	
	

	/******************************************************
	************* OUR STORY SECTION ****************
	*******************************************************/
	//Title
	wp.customize("llorix_one_lite_our_story_title", function(value) {
		
        value.bind(function( to ) {
			
			if( to != '' ) {
				$( '.brief' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.brief .content-section h2' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.brief .content-section .colored-line-left').removeClass(  'llorix_one_lite_only_customizer' );
				$( '.brief .content-section h2' ).text( to );
			}
			else {
				$( '.brief .content-section h2' ).addClass( 'llorix_one_lite_only_customizer' );
				$( '.brief .content-section .colored-line-left').addClass(  'llorix_one_lite_only_customizer' );
				if( $('.brief .brief-content-two').hasClass('llorix_one_lite_only_customizer') && $('.brief .content-section .brief-content-text').hasClass('llorix_one_lite_only_customizer') ){
					$( '.brief' ).addClass( 'llorix_one_lite_only_customizer' );
				}
			}
	    } );
		
    });
	
	wp.customize("llorix_one_lite_our_story_text",function(value) {
		
		value.bind(function( to ) {
			if( to != '' ) {
				$( '.brief' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.brief .content-section .brief-content-text' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.brief .content-section .brief-content-text' ).html( to );
			} else {
				$( '.brief .content-section .brief-content-text' ).addClass( 'llorix_one_lite_only_customizer' );
				if( $( '.brief .content-section h2' ).hasClass('llorix_one_lite_only_customizer') && $('.brief .brief-content-two').hasClass('llorix_one_lite_only_customizer') ){
					$( '.brief' ).addClass( 'llorix_one_lite_only_customizer' );
				}
			}
			
		});
		
	});
	
	wp.customize("llorix_one_lite_our_story_image",function(value) {
		
		value.bind(function( to ) {
			if( to != '' ) {
				$( '.brief' ).removeClass( 'llorix_one_lite_only_customizer' );
				$('.brief .brief-content-two').removeClass( 'llorix_one_lite_only_customizer' );
				$( '.brief .brief-content-two .brief-image-right img' ).attr('src', to);
			} else {
				$('.brief .brief-content-two').addClass( 'llorix_one_lite_only_customizer' );
				if( $( '.brief .content-section h2' ).hasClass('llorix_one_lite_only_customizer') && $('.brief .content-section .brief-content-text').hasClass('llorix_one_lite_only_customizer') ){
					$( '.brief' ).addClass( 'llorix_one_lite_only_customizer' );
				}
			}
		});
		
	});

	/******************************************************
	**************** RIBBON SECTION *****************
	*******************************************************/
	
	wp.customize( 'llorix_one_lite_ribbon_background', function( value ) {
		value.bind( function( to ) {
			
			if ( '' != to ) {
				$( '.ribbon-wrap' ).attr( 'style','background-image:url('+to+')' );
			} else {
				$( '.ribbon-wrap' ).removeAttr('style');
			}
			
		} );
	} );	
	
	
	
	//Title
	wp.customize("llorix_one_lite_ribbon_title", function(value) {
		
        value.bind(function( to ) {

			if( to != '' ) {
				$( '.ribbon-wrap' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.ribbon-wrap h2' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.ribbon-wrap h2' ).text( to );
			} else {
				$( '.ribbon-wrap h2' ).addClass( 'llorix_one_lite_only_customizer' );
				if( $( '.ribbon-wrap button' ).hasClass( 'llorix_one_lite_only_customizer' ) ){
					$( '.ribbon-wrap' ).addClass( 'llorix_one_lite_only_customizer' );
				}
			}
		} );
		
    });
	
	
	//Button text
	wp.customize("llorix_one_lite_button_text", function(value) {
		
        value.bind(function( to ) {

			if( to != '' ) {
				$( '.ribbon-wrap' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.ribbon-wrap button' ).removeClass( 'llorix_one_lite_only_customizer' );
				$( '.ribbon-wrap button' ).text( to );
			} else {
				$( '.ribbon-wrap button' ).addClass( 'llorix_one_lite_only_customizer' );
				if( $( '.ribbon-wrap h2' ).hasClass( 'llorix_one_lite_only_customizer' ) ){
					$( '.ribbon-wrap' ).addClass( 'llorix_one_lite_only_customizer' );
				}
			}
		} );
		
    });


	//Button link
	wp.customize("llorix_one_lite_button_link", function(value) {
		
        value.bind(function( to ) {
			$( '#ribbon button' ).attr( 'onclick', to );
		} );
		
    });	
	
	
	/******************************************************
	************ LATEST NEWS SECTION ***************
	*******************************************************/
	
	//Title
	wp.customize("llorix_one_lite_latest_news_title", function(value) {
		
        value.bind(function( to ) {

			if( to != '' ) {
				$( '.timeline .timeline-text' ).removeClass( 'llorix_one_lite_only_customizer' );
			} else {
				$( '.timeline .timeline-text' ).addClass( 'llorix_one_lite_only_customizer' );
			}
			$( '#latestnews .timeline-text h2' ).text( to );
		} );
		
    });
    
	
	/***************************************
	******** FOOTER SECTION *********
	****************************************/
	//Copyright
	wp.customize("llorix_one_lite_copyright", function(value) {
        value.bind(function( to ) {
			if( to != '' ) {
				$( '.llorix_one_lite_copyright_content' ).removeClass( 'llorix_one_lite_only_customizer' );
			} else {
				$( '.llorix_one_lite_copyright_content' ).addClass( 'llorix_one_lite_only_customizer' );
			}
			
			$( '.llorix_one_lite_copyright_content' ).text( to );
	    } );
    });
	
	function isEmpty( el ){
		return ($.trim(el.html()) === '' ? true : false);
	}
	
} )( jQuery );
