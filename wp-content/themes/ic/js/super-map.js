//super map 1
	$(document).ready(function() {

		/* Submit tweet */
		$('#twitter-form').submit(function(){
			//setup variables
			var form = $(this),
			formData = form.serialize(),
			formUrl = form.attr('action'),
			formMethod = form.attr('method'),
			responseMsg = $('#response')

			//show response message - waiting
			responseMsg.hide()
				.addClass('response-waiting')
				.text('Please Wait...')
				.fadeIn(200);

				//send data to server for validation
				$.ajax({
					url: formUrl,
					type: formMethod,
					data: formData,
					success:function(data) {
						//setup variables
						var responseData = jQuery.parseJSON(data),
											klass = '';

						//response conditional
						switch(responseData.status){
							case 'error':
								klass = 'response-error';
							break;

							case 'success':
								klass = 'response-success';
								$("#tweet").html("");
							break;
						}

						//show reponse message
						responseMsg.fadeOut(200,function(){
							$(this).removeClass('response-waiting')
									.addClass(klass)
									.text(responseData.message)
									.fadeIn(200,function(){
										//set timeout to hide response message
										setTimeout(function(){
											responseMsg.fadeOut(200,function(){
												$(this).removeClass(klass);
											});
										},3000);
									});
						});
					}
				});

			//prevent form from submitting
			return false;
		})
		
		$("#infoBox").show();

		/* Hide Sidebar */
		$("a#controlbtn").click(function(e) {

			e.preventDefault();

			var slidepx=$("div#sidebar").width() + 10;

			if ($('div#sidebar').hasClass("open")) {

				margin = -280;
				$('div#sidebar').removeClass("open");

			} else {
				margin = 0;
				$("div#sidebar").addClass("open");
			}

			$("div#sidebar").animate({ 
				marginLeft: margin
			}, {
				duration: 'slow',
				easing: 'easeOutQuint'
			});
		}); 

	});


$(document).ready(function() {

	$("#infoBox").show();

	/* Hide Sidebar */
	$("#closePanelButton").click(function(e) {

		e.preventDefault();
		var slidepx=$("div#sidepanelWrapper").width() + 10;

		if ($('div#sidepanelWrapper').hasClass("open")) {
			right = -215;
			$('div#sidepanelWrapper').removeClass("open");

		} else {
			right = 0;
			$("div#sidepanelWrapper").addClass("open");

		}

		$("div#sidepanelWrapper").animate({ 
			right: right
		}, {
			duration: 'slow',
			easing: 'easeOutQuint'
		});
	}); 

});



//super_map 2
$(document).ready(function(){
	var list = [];
	var i = 0; // Ordinal for locations.
	var locations = [];
	var map_center = php_variables.cebo_mapcenter.split(",");
	$("#clearMap").click(function(e) {
		clearMap();
		e.preventDefault();
	});

	$("#maparea").gmap3({
		marker:{
			address:php_variables.cebo_address,
			data:php_variables.bloginfo_name, 
			options:{icon: php_variables.cebo_mapmarker}
		},
		map: {
			action: 'init',
			options: {
				center:map_center,
				scrollwheel: false,
				zoom: 14,
				mapTypeId: "style2",
				mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1", "style2"]
			}
			}
		},

		styledmaptype:{
			id: "style1",
			options:{
				name: "Style 1"
			},
			styles: [
				{
					featureType: "road.highway",
					elementType: "geometry",
					stylers: [
						{ hue: "#ff0022" },
						{ saturation: 60 },
						{ lightness: -20 }
					]
				}
			]
		}
	},
	{
		styledmaptype:{
			id: "style2",
			options:{
				name: "Style 2"
			},
			styles: [
			{
				featureType: "all",
				stylers: [
					{ saturation: -80 }
				]
			},{
				featureType: "road.arterial",
				elementType: "geometry",
				stylers: [
					{ hue: "#00ffee" },
					{ saturation: 50 }
				]
			},{
				featureType: "poi.business",
				elementType: "labels",
				stylers: [
					{ visibility: "off" }
				]
			}
			]
		}
	}
	);

	getPlaces();

	$("#toggles li a").click(function(e) {
		e.preventDefault();
		clearMap();
		$("#toggles li a").removeClass("active");
		$(".placeData").hide(); 
		$(this).addClass("active");
		//alert("does not has");
		getPlaces();
	});

	$(".sidenav li a").attr("href", "").click(function(e) {
		clearMap();
		getLocations();
		var latlon = $(this).attr("rel");
		var latlonsplit = latlon.split(",");
		var pos = new google.maps.LatLng(latlonsplit[0], latlonsplit[1]);
		getTweets(latlonsplit[0], latlonsplit[1]);
		obLatLon = [latlonsplit[0], latlonsplit[1]];
		$("#maparea").gmap3({
			action: 'panTo',
			args: [pos],
			options: {
				zoom: 8, 
			}
		},
		{
			action: 'addOverlay',
			content: '<div class="location"><span>' + $(this).children("h1").html() + '</span></div>',
			latLng: obLatLon,
			offset:{
				y: -40,
				x:-30
			}
		}
		);
		e.preventDefault();
	});

	function getTweets(lat, lon) {
		$.getJSON(
		php_variables.template_directory+"/svc/cache.php?lat=" + lat + "&long=" + lon,
		function(data) {
			list = $.parseJSON(data);
			$("#maparea").gmap3("");
			$.each(data["tweets"], function(key, val){
				var latlon = [val["lat"], val["lon"]];
				$("#maparea").gmap3({
					action: 'addMarker',
					latLng: latlon,
					map:{
						center: false
					}
				},{
					action:'addOverlay',
					content:  '<div id="tweet' + val["tweet_id"] + '" class="marker"><img src="' + val["profile_image"] + '" class="tweetMarker" />' + '<div class="tweet"><span>' + val["user"] + '</span><p>' + val["content"] + '</p><a class="retweet" href="#"></a><a class="mention" href="#"></a></div></div>', 
					latLng: latlon,
					offset:{
						y: -40,
						x:-30
					}
				});
			});
		});
		return;
	}



	$(".info").click(function() {
		$("#infoBox").toggle();
	});

	$(".twitterl a").click(function() {
		clearMap();
		$(".placeData").hide();
		getLocations();
	});

	$("#maparea").mouseover(function(e) {

		$("#infoBox .closeData").click(function() {
			$("#infoBox").hide();  
		});

		$("#warning .closeData").click(function() {
			$("#warning").hide();  
		});

		$(".location").bind("click", function() {
			$(":contains(" + $(this).children("span").html() + ")").show();
			return;
		});


		$(".placeMark a").mouseover("click", function() {
			$(".placeData").hide();
			$("#placeData" + $(this).attr("rel")).show();
			e.preventDefault();
		});

		$("a.retweet").bind("click", function(e) {
			if ($(".signin").length > 0){
				$("#warning").show();
			} else {
				$("#tweet").html("");
				$("#ref").val("");
				name = $(this).parent().children("span").html();
				tweet = $(this).parent().children("p").html();
				status = "RT @" + name + " " + tweet;
				$("#tweet").html(status);
			}
			e.preventDefault();
		});

		$("a.mention").bind("click", function(e) {
			if ($(".signin").length > 0){
				$("#warning").show();
			} else {
				$("#tweet").html("");
				$("#ref").val("");
				name = $(this).parent().children("span").html();
				tweet = $(this).parent().children("p").html();
				$("#tweet").html("@" + name);
			}
			e.preventDefault();
		});
	});

	function buildPlaceCarousel(obImages){
		var imageCarousel = '<div class="imageCarousel">';
		$.each(obImages, function(key, img) {
			imageCarousel += '<a href="' + img["src"] + '" rel="example1"><img src="' + img["src"] + '" />';
		});
		imageCarousel += '</div>';
		return imageCarousel;
	}

	function getPlaces() {
		$("#toggles li a.active").each(function() {
			var jsonMap = $(this).data('pins');
        	getPlaceData(jsonMap, $(this).parent().attr("class"));
		});
	}

	function getPlaceData(url, type) {
		$.getJSON(
			url,
			function(data) {
				list = $.parseJSON(data);
				$.each(data["places"], function(key, val){
					var docRoot = php_variables.template_url;
					var coords = val["coords"].split(",", 2);
					var latlon = [coords[0], coords[1]];
					var goid = val["cater"];

					placeContainer = '<div class="placeData" id="placeData' + i + '"><p class="streetview">See it up close. Drag your streeview!</p><a href="#" class="closeData">X</a><div class="qualinfo"><a href="' + val["permalink"] + '"><img src="' + val["photo"] + '"/></a><div class="marco"><h4><span>' + val["name"] + '</span></h4><p class="smaller" id="' + val["cater"] + '">' + val["cater"] + '</p><p class="desc">' + val["desc"] + '</p></div></div><div class="specialinfo"><a href="' + val["permalink"] + '">More Info</a><a class="fac" href="//www.facebook.com/sharer.php?s= 100&amp;p[title]=' + val["name"] + '&amp;p[url]=' + val["permalink"] + '&amp;p[images][0]=' + val["photo"] + '&amp;p[summary]=' + val["desc"] + '" target="_blank">Share It</a><a href="//twitter.com/share?text=' + val["name"] + '&url=' + val["permalink"] + '" target="_blank">Tweet It</a><a class="pin" href="//pinterest.com/pin/create/button/?url=http%3A%2F%2F' + php_variables.perm + '&media=http%3A%2F%2F' +php_variables.img+ '&description=' + val["desc"] + ' on ' + php_variables.bloginfo_url + '" target="_blank">Pin It</a></div>';

					$("#maparea").gmap3({ 
						marker:{
							latLng: latlon,
							id: goid,
							options:{
								draggable: false,
								icon : new google.maps.MarkerImage('yourImage.png')
							}
						},
						overlay:{
							latLng: latlon,
							options:{
								content: '<div id="mako" class="placeMark ' + type + '"><a target="_blank" rel="' + i + '" title="' + val["name"] + '"><p class="infobox"><i class="piccontainer" style="background-image: url(' + val["photo"] + ');"></i><span>'+ val["name"] +'</span><span class="info">'+ val["address"] +'<br>'+ val["phone"] +'<br>'+ val["distance"] +'</span><b class="monumental" id="' + val["cater"] + '">' + val["cater"] + '</b></p><small></small></a></div>',
								offset:{
									y: -12,
									x: -15
								}
							}
						}
					});

					$("body").append(placeContainer);
					i++;
				});
			}
		);
	}

	function getLocations(args) {
		$(".sidenav li a").each(function(e) {
			var latlon = $(this).attr("rel");
			var latlonsplit = latlon.split(",");
			getTweets(latlonsplit[0], latlonsplit[1]);
		});
	}

	function clearMap() {
		$("#maparea").gmap3('clear', 'markers');
		$(".placeData").hide();
		$("#maparea").gmap3({
			marker:{
				address:php_variables.cebo_address,
				data:php_variables.bloginfo_name,
				options:{icon:php_variables.cebo_mapmarker}
			},
			map: {
				action: 'init',
				options: {
					center:[map_center],
					scrollwheel: false,
					zoom: 14,
					mapTypeId: "style2",
					mapTypeControlOptions: {
						mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1", "style2"]
					}
				}
			},

			styledmaptype:{
				id: "style1",
				options:{
					name: "Style 1"
				},
				styles: [
					{
						featureType: "road.highway",
						elementType: "geometry",
						stylers: [
							{ hue: "#ff0022" },
							{ saturation: 60 },
							{ lightness: -20 }
						]
					}
				]
			}
		},{
			styledmaptype:{
			id: "style2",
			options:{
				name: "Style 2"
			},
			styles: [
			{
				featureType: "all",
				stylers: [
					{ saturation: -80 }
				]
			},{
				featureType: "road.arterial",
				elementType: "geometry",
				stylers: [
					{ hue: "#00ffee" },
					{ saturation: 50 }
				]
			},{
				featureType: "poi.business",
				elementType: "labels",
				stylers: [
					{ visibility: "off" }
				]
			}
			]
			}
		});
	}

	function wait() {
		// Just wait, buddy...
	}


	$(function() {

		$('.panelMenu li#linkerson').toggle(function(){
			$(this).addClass("active");
			$(this).next('.largebox').addClass("widest").animate({ right:'215px', opacity: 1 },{queue:false,duration:500});
		}, 
		function(){
			$(this).removeClass("active");
			$(this).next('.largebox').removeClass("widest", 500).animate({ right:'0px', opacity: 0 },{queue:false,duration:500});
		});
	});

	$(function() {

		$('.linkersonclose').click(function(){
			$('.panelMenu li#linkerson').removeClass("active");
			$('.largebox').removeClass("widest", 500).animate({ right:'0px', opacity: 0 },{queue:false,duration:500});
		});
	});

	// TOGGLE FUNCTION //
	$('#toggle-view li').click(function () {
		var text = $(this).children('div.panel');
		if (text.is(':hidden')) {
			text.slideDown('200');
			$(this).children('span').addClass('toggle-minus');     
			$(this).addClass('activated');     
		} else {
			text.slideUp('200');
			$(this).children('span').removeClass('toggle-minus'); 
			$(this).children('span').addClass('toggle-plus'); 
			$(this).removeClass('activated');       
		}
	});

	function scrollToAnchor(aid){
		var aTag = $("a[name='"+ aid +"']");
		$('html,body').animate({scrollTop: aTag.offset().top},'slow');
	}

	$("#link").click(function() {
		scrollToAnchor('id3');
	});

});