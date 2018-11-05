(function($){ 
    "use strict";

    $(document).ready( function() { 

        // Show/Hide Sidebar option 
        if ( $("#ct-metabox-page-sidebar [name='_ct_sidebar_position']:checked").val() == 'no' ) {
            $("#_ct_sidebar_widget_area").closest(".rwmb-field").hide();
        }

        $( "#ct-metabox-page-sidebar [name='_ct_sidebar_position']" ).click( function() {
            if ($(this).val() == 'no') {
                $("#_ct_sidebar_widget_area").closest(".rwmb-field").hide();
            } else {
                $("#_ct_sidebar_widget_area").closest(".rwmb-field").show();
            }
        });

        // Show/Hide "Header Image Settings" option in single Product editor
        if ( $( "#product_header_image_setting [name='_show_header_image']" ).val() == 'hide' ) { 
            $( "#product_header_image_setting [name='_header_image[]']" ).closest(".rwmb-field").hide();
            $( "#product_header_image_setting #_header_image_height" ).closest(".rwmb-field").hide();
            $( "#product_header_image_setting #_header_content" ).closest(".rwmb-field").hide();
        }

        $( "#product_header_image_setting [name='_show_header_image']" ).change( function() {
            if ($(this).val() == 'hide') {
                $( "#product_header_image_setting [name='_header_image[]']" ).closest(".rwmb-field").hide();
                $( "#product_header_image_setting #_header_image_height" ).closest(".rwmb-field").hide();
                $( "#product_header_image_setting #_header_content" ).closest(".rwmb-field").hide();
            } else {
                $( "#product_header_image_setting #_header_image" ).closest(".rwmb-field").show();
                $( "#product_header_image_setting #_header_image_height" ).closest(".rwmb-field").show();
                $( "#product_header_image_setting #_header_content" ).closest(".rwmb-field").show();
            }
        });

        // Show/Hide unnecessary tabs in single Tour editor
        if ( $( '#tour_booking_settings #_tour_booking_type' ).length > 0 ) { 
            if ( $( '#tour_booking_settings #_tour_booking_type' ).val() == 'default' ) { 
                $( '#tour_details' ).show();
                $( '#inquiry_form' ).hide();
                $( '#external_link' ).hide();
            } else if ( $( '#tour_booking_settings #_tour_booking_type' ).val() == 'inquiry' ) { 
                $( '#tour_details' ).hide();
                $( '#inquiry_form' ).show();
                $( '#external_link' ).hide();
            } else { 
                $( '#tour_details' ).hide();
                $( '#inquiry_form' ).hide();
                $( '#external_link' ).show();
            }

            $( '#tour_booking_settings #_tour_booking_type' ).change( function() { 
                if ( $(this).val() == 'default' ) { 
                    $( '#tour_details' ).show();
                    $( '#inquiry_form' ).hide();
                    $( '#external_link' ).hide();
                } else if ( $(this).val() == 'inquiry' ) { 
                    $( '#tour_details' ).hide();
                    $( '#inquiry_form' ).show();
                    $( '#external_link' ).hide();
                } else { 
                    $( '#tour_details' ).hide();
                    $( '#inquiry_form' ).hide();
                    $( '#external_link' ).show();
                }
            } );
        }

        // Show/Hide unnecessary tabs in single Hotel editor
        if ( $( '#hotel_booking_settings #_hotel_booking_type' ).length > 0 ) { 
            if ( $( '#hotel_booking_settings #_hotel_booking_type' ).val() == 'default' ) { 
                $( '#hotel_details' ).show();
                $( '#inquiry_form' ).hide();
                $( '#external_link' ).hide();
            } else if ( $( '#hotel_booking_settings #_hotel_booking_type' ).val() == 'inquiry' ) { 
                $( '#hotel_details' ).hide();
                $( '#inquiry_form' ).show();
                $( '#external_link' ).hide();
            } else { 
                $( '#hotel_details' ).hide();
                $( '#inquiry_form' ).hide();
                $( '#external_link' ).show();
            }

            $( '#hotel_booking_settings #_hotel_booking_type' ).change( function() { 
                if ( $(this).val() == 'default' ) { 
                    $( '#hotel_details' ).show();
                    $( '#inquiry_form' ).hide();
                    $( '#external_link' ).hide();
                } else if ( $(this).val() == 'inquiry' ) { 
                    $( '#hotel_details' ).hide();
                    $( '#inquiry_form' ).show();
                    $( '#external_link' ).hide();
                } else { 
                    $( '#hotel_details' ).hide();
                    $( '#inquiry_form' ).hide();
                    $( '#external_link' ).show();
                }
            } );
        }

        // Show/Hide unnecessary tabs in single Car editor
        if ( $( '#car_booking_settings #_car_booking_type' ).length > 0 ) { 
            if ( $( '#car_booking_settings #_car_booking_type' ).val() == 'default' ) { 
                $( '#car_details' ).show();
                $( '#inquiry_form' ).hide();
                $( '#external_link' ).hide();
            } else if ( $( '#car_booking_settings #_car_booking_type' ).val() == 'inquiry' ) { 
                $( '#car_details' ).hide();
                $( '#inquiry_form' ).show();
                $( '#external_link' ).hide();
            } else { 
                $( '#car_details' ).hide();
                $( '#inquiry_form' ).hide();
                $( '#external_link' ).show();
            }

            $( '#car_booking_settings #_car_booking_type' ).change( function() { 
                if ( $(this).val() == 'default' ) { 
                    $( '#car_details' ).show();
                    $( '#inquiry_form' ).hide();
                    $( '#external_link' ).hide();
                } else if ( $(this).val() == 'inquiry' ) { 
                    $( '#car_details' ).hide();
                    $( '#inquiry_form' ).show();
                    $( '#external_link' ).hide();
                } else { 
                    $( '#car_details' ).hide();
                    $( '#inquiry_form' ).hide();
                    $( '#external_link' ).show();
                }
            } );
        }

    });

})( jQuery );