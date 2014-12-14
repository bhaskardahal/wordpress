( function( $ ) { 
	$( document ).ready( function(){ 
		/* script for display image in menu */
		$( '#menu ul:first-child > li' ).children( 'a' ).before( '<div class="image"><img class="menu_image" src="'+ newlife_localization.theme_url +'/image/menu.jpg"></div>' );
		$( '.image' ).css( "visibility","hidden" );

		/* script for display content and sidebar - correct height */
		var content=$( '.content' ).css( "height" );
		if( typeof content == 'undefined' )
			content = $( '#container' ).css( "height" );

		var bar=$( '#sidebar' ).css( "height" );
		var leg=$( '#legend' ).css( "height" );
		var research=$( '#newlife-searches' ).css( "height" );
		var content_home=$( '.newlife-content-home' ).css( "height" );

		if ( content ) { 
			content = content.split( 'px' ); 
		}
		if ( leg ) { 
			leg = leg.split( 'px' ); 
		}
		if ( research ) { 
			research = research.split( 'px' ); 
		}
		if ( content_home ) { 
			content_home = content_home.split( 'px' ); 
		}
		bar = bar.split( 'px' );

		if ( content ) { 
			if ( parseInt( content[0] ) > parseInt( bar[0] ) ) { 
				$( '#sidebar' ).css( 'height', function( index ) { 
					return content[0]; 
				} );
			} 
			else {
				$( '.content' ).css( 'height', function( index ) { 
					return bar[0]; 
				} );
			} 
		}
		if ( content_home ) { 
			if ( parseInt( content_home[0] )<parseInt( bar[0] ) ) { 
				$( '.line_home' ).css( 'height', function( index ) { return bar[0]; } );
			}
			else { 
				$( '#sidebar' ).css( 'height', function( index ) { 
					return content_home[0]; 
				} );
				$( '.newlife-line-home' ).css( 'height', function( index ) { 
					return $( '.newlife-content-home' ).css( "height" ); 
				} );
			} 
		}
		if ( leg ) { 
			if ( parseInt( leg[0] ) > parseInt( research[0] ) ) { 
				$( '#newlife-searches' ).css( 'height', function( index ) { 
					return leg[0]; 
				} );
			} 
		}
		/* script for search field */
		$( 'input#s' ).each( function(){ 
			$( this ).focus( function () {
				if( $( this ).val() == newlife_localization.search_string )
					$( this ).val( "" );
			});
			$( this ).blur( function () {
				if( $( this ).val() == '' )
					$( this ).val( newlife_localization.search_string );
			});
		});

		$( ".newlife-title-searches p" ).hover( function () { 
			$( this ).addClass( "hilite" ); }, function () { 
				$( this ).removeClass( "hilite" );
		} );
		/* script for hover menu */
		$( "#menu li" ).hover( function(){ 				
			$( this ).find( 'ul:first' ).css( { visibility: "visible", display: "block" } ).show( 250 );
			$( this ).find( 'ul:first>li a' ).css( { background:"#A9D046" } );
		},function(){ 
			$( this ).find( 'ul:first' ).css( { "display": "none" } );
		} );
		
		if ( navigator.userAgent.indexOf( 'MSIE' ) !=-1 ) { 
			$( "#menu  ul:first-child > li" ).each( function(){ 
				$( this ).width( $( this ).width() );
			} );
		};
		$( "#menu li" ).hover( function() { 
			$( this ).children( "a" ).css( { "position":"relative", "color":"white" } );
			$( this ).find( '.image' ).css( "visibility", "visible" );
			$( this ).find( 'ul' ).css( "background", "#A9D046" ); 
		},function(){ 
			$( this ).find( 'a' ).css( "color","#515151" );
			$( this ).find( '.image' ).css( "visibility","hidden" ); 
		} );

	 } );
 } )( jQuery );
