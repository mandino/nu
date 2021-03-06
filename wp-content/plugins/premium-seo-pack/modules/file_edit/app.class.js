/*
Document   :  404 Monitor
Author     :  Andrei Dinca, AA-Team http://codecanyon.net/user/AA-Team
*/

// Initialization and events code for the app
pspFileEdit = (function ($) {
    "use strict";

    // public
    var debug_level = 0;
    var maincontainer = null;

	// init function, autoload
	(function init() {
		// load the triggers
		$(document).ready(function(){
			maincontainer = $(".psp-main");
			if($('#robotstxt').length > 0) maincontainer.find('.psp-fe-create-robots-txt').hide();
			triggers();
		});
	})();
	
	function saveChanges() {
		pspFreamwork.to_ajax_loader( "Loading..." );
		
		var rtVal = '', htVal = '',
		$__rt = $('.psp-main').find('#frm-save-changes #robotstxt'),
		$__ht = $('.psp-main').find('#frm-save-changes #htaccess');

		if ($__rt.length>0)
			rtVal = $__rt.is(':disabled') ? '' : $__rt.val();
		if ($__ht.length>0)
			htVal = $__ht.is(':disabled') ? '' : $__ht.val();
		
		jQuery.post(ajaxurl, {
			'action' 		: 'pspFileEdit',
			'ht'			: htVal,
			'rt'			: rtVal,
			'debug_level'	: debug_level
		}, function(response) {
			if( response.status == 'valid' ){
				pspFreamwork.to_ajax_loader_close();
			}
		}, 'json');
	}
	
	function createRobotsTxt() {
		pspFreamwork.to_ajax_loader( "Loading..." );
		var rtCreateVal = 'yes';
		jQuery.post(ajaxurl, {
			'action' 		: 'pspFileEdit',
			'rtCreate'			: rtCreateVal,
			'debug_level'	: debug_level
		}, function(response) {
			if( response.status == 'valid' ){
				pspFreamwork.to_ajax_loader_close();
				location.reload();
			}
		}, 'json');
	}
	
	function triggers()
	{
		//default message!
		if ( $('#psp-fe-ht-wrap').find('.psp-fe-err, .psp-fe-msg').length>0 ) { //.htaccess
			$('#psp-fe-ht-wrap').css({'display': 'table'});
		}
		if ( $('#psp-fe-rt-wrap').find('.psp-fe-err, .psp-fe-msg').length>0 ) { //robots.txt
			$('#psp-fe-rt-wrap').css({'display': 'table'});
		}
		
		//save changes
		maincontainer.find('.psp-fe-save').click(function(e) {
			e.preventDefault();
			//saveChanges();
			
			var rtVal = '', htVal = '',
			$__rt = $('.psp-main').find('#frm-save-changes #robotstxt'),
			$__ht = $('.psp-main').find('#frm-save-changes #htaccess');
	
			rtVal = $__rt.is(':disabled') ? '' : $.trim( $__rt.val() );
			htVal = $__ht.is(':disabled') ? '' : $.trim( $__ht.val() );

			if (rtVal=='' && htVal=='') {
				if ( confirm('Both robots.txt and .htaccess files are empty. Are you sure you wanna update their content?') )
					$('.psp-main #frm-save-changes').submit();
			} else {
				$('.psp-main').find('#frm-save-changes').submit();
			}
		});
		
		//create robots.txt
		maincontainer.find('.psp-fe-create-robots-txt').click(function(e) {
			e.preventDefault();
			createRobotsTxt();
		});
	}

	// external usage
	return {
    }
})(jQuery);
