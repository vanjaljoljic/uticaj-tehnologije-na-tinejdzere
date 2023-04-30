/**
 * eightlaw Custom js
 *
 * @package eightlaw
 */
/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {
	var ajaxurl = eightlawWelcomeObject.ajaxurl;
	/** Ajax Plugin Installation **/
	$(".install").on('click', function (e) {
		e.preventDefault();
		var el = $(this);

		is_loading = true;
    	el.addClass('installing');
    	var plugin = $(el).attr('data-slug');
    	var plugin_file = $(el).attr('data-file');
    	
    	var plhref = $(el).attr('href');
    	var newPlhref = plhref.split('&');
    	var plNonce = newPlhref[newPlhref.length-1];
    	var newPlhref = plNonce.split('=');
    	var plNonce = newPlhref[newPlhref.length-1];
    	if(plNonce==''){
    		var plNonce = eightlawWelcomeObject.admin_nonce;
    	}

		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'eightlaw_lite_plugin_installer',
				plugin: plugin,
				plugin_file: plugin_file,
				nonce: plNonce,
			},
			success: function(response) {

		   		if(response == 'success'){
			   		
				   		el.attr('class', 'installed button');
				   		el.html(eightlawWelcomeObject.installed_btn);
			   			
		   		}

		   		el.removeClass('installing');
		   		is_loading = false;
		   		//location.reload();
			},
			error: function(xhr, status, error) {
	  		console.log(status);
	  		el.removeClass('installing');
	  		is_loading = false;
			}
		});
	});

	/** Ajax Plugin Installation (Offlines) **/
	$('.install-offline').on('click', function (e) {
		e.preventDefault();
		var el = $(this);

		is_loading = true;
    	el.addClass('installing');

		var file_location = el.attr('href');
		var github = $(el).attr('data-github');
		var slug = $(el).attr('data-slug');
		var file = el.attr('data-file');
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'eightlaw_lite_plugin_offline_installer',
				file_location: file_location,
				file: file,
				slug: slug,
				github: github,
				dataType: 'json'
			},
			success: function(response) {

		   		if(response == 'success'){
			   		
			   		el.attr('class', 'installed button');
			   		el.html(eightlawWelcomeObject.installed_btn);
			   			
		   		}

		   		is_loading = false;
		   		location.reload();
			},
			error: function(xhr, status, error) {
	  		el.removeClass('installing');
	  		is_loading = false;
			}
		});
	});

	/** Ajax Plugin Activation **/
	$(".activate").on('click', function (e) {
		
		var el = $(this);
		var plugin = $(el).attr('data-slug');

    	var ajaxurl = eightlawWelcomeObject.ajaxurl;
    	
    	
		$.ajax({
	   		type: 'POST',
	   		url: ajaxurl,
	   		data: {
	   			action: 'eightlaw_lite_plugin_activation',
	   			plugin: plugin,
	   			nonce: eightlawWelcomeObject.activate_nonce,
	   			dataType: 'json'
	   		},
	   		success: function(response) {
		   		if(response){
			   		if(response.status === 'success'){
				   		el.attr('class', 'installed button');
				   		el.html(eightlawWelcomeObject.installed_btn);
			   		}
		   		}
		   		is_loading = false;
		   		location.reload();
	   		},
	   		error: function(xhr, status, error) {
	      		console.log(status);
	      		is_loading = false;
	   		}
	   	});
	});

	/** Ajax Plugin Activation Offline **/
	$('.activate-offline').on('click', function (e) {
		e.preventDefault();
		
		var el = $(this);
		var plugin = $(el).attr('data-slug');

		$.ajax({
	   		type: 'POST',
	   		url: ajaxurl,
	   		data: {
	   			action: 'eightlaw_lite_plugin_offline_activation',
	   			plugin: plugin,
	   			nonce: eightlawWelcomeObject.activate_nonce,
	   			dataType: 'json'
	   		},
	   		success: function(response) {
		   		if(response){
			   		el.attr('class', 'installed button');
			   		el.html(eightlawWelcomeObject.installed_btn);
		   		}
		   		is_loading = false;
		   		location.reload();
	   		},
	   		error: function(xhr, status, error) {
	      		console.log(status);
	      		is_loading = false;
	   		}
	   	});
	});
});//document.ready close