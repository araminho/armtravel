(function($){ 
    $(document).ready( function() { 
	"use strict";

	function append_search_results( data ) { 
            if ( $('.vc_ui-custom_search').length ) { 
                $('.vc_ui-custom_search').empty();
		} else { 
                $('body').append('<ul class="ui-autocomplete ui-front vc_ui-front vc_ui-custom_search"></ul>');
		}

		for ( var i = 0; i < data.length; i++ ) { 
                $('.vc_ui-custom_search').append('<li data-value="' + data[i]['ID'] + '" id="ui-id-' + data[i]['ID'] + '"><a>' + data[i]['title'] + '</a></li>');
		}

            var offset = $('.vc_custom_search_param').parent().offset();
            var width = $('.vc_custom_search_param').parent().width();
            var height = $('.vc_custom_search_param').parent().height();

            $('.vc_ui-custom_search').width( width ).css( 'top', offset.top + height + 3 ).css( 'left', offset.left ).show();
	}

        $('body').on( 'click', '.vc_custom_search-remove', function() { 
            var delete_value = $(this).parent().attr('data-value'), values = $('.vc_custom_search-field > input[type="hidden"]').val();

		values = values.split(",");
		for( var i = 0; i < values.length; i++ ) { 
			values[i] = values[i].trim();
		}

		var del_index = values.indexOf( delete_value );
		if ( del_index != -1 ) {
			values.splice( del_index, 1 );
		}

            if ( !values.length && ! $('.vc_custom_search-field ul').hasClass('vc_custom_search-inline') ) { 
                $('.vc_custom_search-input').show();
		}

		values = values.join();
            $(this).closest( 'div' ).find( 'input[type="hidden"]' ).val( values );

            $(this).parent().remove();
	} );

	var old_keyword = '', time_handler = null ;

        $('body').on( 'keyup', '.vc_custom_search_param', function() { 
            $('.vc_ui-custom_search').hide();
            var this_obj = $(this);

		if ( time_handler != null ) { 
			clearTimeout( time_handler );
		}

		time_handler = setTimeout( function() { 
			var new_keyword = this_obj.val();
			if ( old_keyword != new_keyword && new_keyword.trim() ) { 
				old_keyword = new_keyword;

				this_obj.addClass('ui-autocomplete-loading');
				$.ajax({
					url: ajaxurl,
					type: "POST",
					data: {
						'action': 'get_hotel_tour_by_name',
						'keyword' : new_keyword,
					},
					success: function(response){
						this_obj.removeClass('ui-autocomplete-loading');
						if ( response.success ) { 
							if ( response.data.length ) { 
								append_search_results( response.data );
							}
						}
					}
				});
			} else if ( !new_keyword.trim() ) { 
				old_keyword = new_keyword;
			}
		 }, 500 );
	} );

        $('body').on( 'mouseover', '.vc_ui-custom_search li', function() { 
            $(this).addClass('ui-state-focus');
	} );

        $('body').on( 'mouseout', '.vc_ui-custom_search li', function() { 
            $(this).removeClass('ui-state-focus');
	} );

        $('body').on( 'click', '.vc_ui-custom_search li', function() { 
            var value = $(this).attr('data-value'), label = $(this).find('a').text(), values = $('.vc_custom_search-field > input[type="hidden"]').val();

		values = values.split(",");
		var is_repeated = false;
		for( var i = 0; i < values.length; i++ ) { 
			values[i] = values[i].trim();
			if ( values[i] == value ) { 
				is_repeated = true;
			}
		}

		if ( !is_repeated ) { 
			var new_element = '<li data-value="' + value + '" data-label="' + label + '" class="vc_custom_search-label vc_data">' + 
				'<span class="vc_custom_search-label">' + label + '</span>' + 
				'<a class="vc_custom_search-remove">&times;</a>';

                $(new_element).insertBefore( '.vc_custom_search-field li.vc_custom_search-input' );

                $('.vc_ui-custom_search').hide();
			old_keyword = '';
                $('.vc_custom_search_param').val('');

			if ( values.length == 1 && !values[0].trim() ) {
				values[0] = value;
                    if ( !$('.vc_custom_search-field ul').hasClass('vc_custom_search-inline') ) { 
                        $('.vc_custom_search-input').hide();
				}
			} else { 
				values[values.length] = value;
			}
			values = values.join();
                $('.vc_custom_search-field > input[type="hidden"]').val( values );
		}
	} );

        $('body').on( 'click', 'div[data-element_type="map"] .vc_control-btn-edit', function() { 
            // $('select[name="center"]').attr( 'multiple', 'multiple' );
		console.log("clicked on VC edit button");
	} );
    });
})( jQuery );