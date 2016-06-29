// JavaScript Document

    jQuery(document).ready(function() {
		
		
   if (navigator.userAgent.match(/Trident\/7\./)) { // if IE
            $('body').on("mousewheel", function () {
                // remove default behavior
                event.preventDefault();

                //scroll without smoothing
                var wheelDelta = event.wheelDelta;
                var currentScrollPosition = window.pageYOffset;
                window.scrollTo(0, currentScrollPosition - wheelDelta);
            });
        }





     
	 
	jQuery('.selectpicker').selectpicker({
      liveSearch: false,
      maxOptions: 1
    });
     
    });

jQuery(window).load(function(){
				
				jQuery(".webinar-semi").mCustomScrollbar({
					setHeight:110,
					theme:"minimal-dark"
				});
				jQuery(".pdf-semi").mCustomScrollbar({
					setHeight:110,
					theme:"minimal-dark"
				});
				jQuery(".links-semi").mCustomScrollbar({
					setHeight:110,
					theme:"minimal-dark"
				});
				 jQuery(".category-list, .new-badges-list").mCustomScrollbar({
					setHeight:170,
					theme:"minimal-dark"
				});
				
			   jQuery(".form-frame").mCustomScrollbar({
					setHeight:888,
					theme:"minimal-dark"
				});
				
				
			});