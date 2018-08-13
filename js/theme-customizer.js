/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title a' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	
	
	
	//Update site background color...
	wp.customize( 'body_background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );

	//Update header background in real time...
	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( newval ) {
			$('.blog-masthead').css('background-color', newval );
		} );
	} );
	

	//Update site theme_background_color in real time...
	wp.customize( 'theme_background_color', function( value ) {
		value.bind( function( newval ) {
			$('.widget-title,.fn,.corner-ribbon, #searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link,.current_page_item:hover,.navbar-default .navbar-nav .active a:hover').css('background-color', newval );
		    $('#searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link').css('border-color', newval );

		} );
	} );


	//Update site theme_text_color in real time...
	wp.customize( 'theme_text_color', function( value ) {
		value.bind( function( newval ) {
			$('.widget-title,.fn,.corner-ribbon, #searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link,.current_page_item:hover,.navbar-default .navbar-nav .active a:hover').css('color', newval );
		} );
	} );
	


	//Update site sidebar_widget_inner_background_color in real time...
	wp.customize( 'sidebar_widget_inner_background_color', function( value ) {
		value.bind( function( newval ) {
			$('.widget_recent_entries li,.widget_categories li,.widget_polylang li,.widget_recent_comments li,.widget_archive li,.sidebar-module-inset').css('background-color', newval );
		} );
	} );
	


	//Update site menu_background_color in real time...
	wp.customize( 'menu_background_color', function( value ) {
		value.bind( function( newval ) {
			$('.navbar-default,.current_page_item,.navbar-default .navbar-nav .active a').css('background-color', newval );
			$('.navbar-default').css('border-color', newval );

		} );
	} );


	//Update site active_menu_background_color in real time...
	wp.customize( 'active_menu_background_color', function( value ) {
		value.bind( function( newval ) {
			$('.current_page_item,.navbar-default .navbar-nav .active a').css('background-color', newval );

		} );
	} );


  //Update site form_background_color in real time...
	wp.customize( 'form_background_color', function( value ) {
		value.bind( function( newval ) {
			$('#s,#cntctfrm_contact_name, #cntctfrm_contact_email, #cntctfrm_contact_subject,#cntctfrm_contact_message ,.input, .input-email, .input-text,.field-select,blockquote,.comment-body,#author, #email, #url, .cptch_input,#comment').css('background-color', newval );

		} );
	} );



	//Update footer background color real time...
	wp.customize( 'footer_background_color', function( value ) {
		value.bind( function( newval ) {
			$('.blog-footer').css('background-color', newval );
		} );
	} );



  //Update site ordinary_text_color in real time...
	wp.customize( 'ordinary_text_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	} );
	

	//Update site llink_text_color in real time...
	wp.customize( 'link_text_color', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		} );
	} );
	


	//Update site hover_link_text_color in real time...
	wp.customize( 'hover_link_text_color', function( value ) {
		value.bind( function( newval ) {
			$('a:hover').css('color', newval );
		} );
	} );



	//Update site header_text_color in real time...
	wp.customize( 'header_text_color', function( value ) {
		value.bind( function( newval ) {
			$('.blog-title,.blog-description,.blog-post-meta').css('color', newval );
		} );
	} );
	

	//Update site sidebar_widget_text_color in real time...
	wp.customize( 'sidebar_widget_text_color', function( value ) {
		value.bind( function( newval ) {
			$('.widget_recent_entries li,.widget_categories li,.widget_polylang li,.widget_recent_comments li,.widget_archive li').css('color', newval );
		} );
	} );


    //Update menu_text_color real time...
	wp.customize( 'menu_text_color', function( value ) {
		value.bind( function( newval ) {
			$('.navbar-default').css('color', newval );
		} );
	} );

	

	//Update form_text_color real time...
	wp.customize( 'form_text_color', function( value ) {
		value.bind( function( newval ) {
			$(' #s,#cntctfrm_contact_name, #cntctfrm_contact_email, #cntctfrm_contact_subject,#cntctfrm_contact_message ,.input, .input-email, .input-text,.field-select,blockquote,.comment-body,#author, #email, #url, .cptch_input,#comment').css('color', newval );
		} );
	} );


	//Update footer text color real time...
	wp.customize( 'footer_text_color', function( value ) {
		value.bind( function( newval ) {
			$('.blog-footer').css('color', newval );
		} );
	} );





} )( jQuery );
