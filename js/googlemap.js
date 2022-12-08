(function( $ ) {

    /**
     * initMap
     *
     * Renders a Google Map onto the selected jQuery element
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @return  object The map instance.
     */
    function initMap( $el ) {
    
        // Find marker elements within map.
        var $markers = $el.find('.marker');
    
        // Create gerenic map.
        var mapArgs = {
            zoom        : $el.data('zoom') || 16,
            mapTypeId   : google.maps.MapTypeId.ROADMAP ,
            styles       :[
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#6195a0"
                        }
                    ]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "lightness": "0"
                        },
                        {
                            "saturation": "0"
                        },
                        {
                            "color": "#f5f5f2"
                        },
                        {
                            "gamma": "1"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "all",
                    "stylers": [
                        {
                            "lightness": "-3"
                        },
                        {
                            "gamma": "1.00"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural.terrain",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#bae5ce"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#fac9a9"
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "color": "#4e4e4e"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#787878"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.airport",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "hue": "#0a00ff"
                        },
                        {
                            "saturation": "-77"
                        },
                        {
                            "gamma": "0.57"
                        },
                        {
                            "lightness": "0"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.rail",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#43321e"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.rail",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "hue": "#ff6c00"
                        },
                        {
                            "lightness": "4"
                        },
                        {
                            "gamma": "0.75"
                        },
                        {
                            "saturation": "-68"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#eaf6f8"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#c7eced"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "lightness": "-49"
                        },
                        {
                            "saturation": "-53"
                        },
                        {
                            "gamma": "0.79"
                        }
                    ]
                }
            ]
        };
        var map = new google.maps.Map( $el[0], mapArgs );
    
        // Add markers.
        map.markers = [];
        $markers.each(function(){
            initMarker( $(this), map );
        });
    
        // Center map based on markers.
        centerMap( map );
    
        // Return map instance.
        return map;
    }
    
    /**
     * initMarker
     *
     * Creates a marker for the given jQuery element and map.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @param   object The map instance.
     * @return  object The marker instance.
     */
    function initMarker( $marker, map ) {
    
        // Get position from marker.
        var lat = $marker.data('lat');
        var lng = $marker.data('lng');
        var latLng = {
            lat: parseFloat( lat ),
            lng: parseFloat( lng )
        };
    
        // Create marker instance.
        var marker = new google.maps.Marker({
            position : latLng,
            map: map
        });
    
        // Append to reference for later use.
        map.markers.push( marker );
    
        // If marker contains HTML, add it to an infoWindow.
        if( $marker.html() ){
    
            // Create info window.
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });
    
            // Show info window when marker is clicked.
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }
    
    /**
     * centerMap
     *
     * Centers the map showing all markers in view.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   object The map instance.
     * @return  void
     */
    function centerMap( map ) {
    
        // Create map boundaries from all map markers.
        var bounds = new google.maps.LatLngBounds();
        map.markers.forEach(function( marker ){
            bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng()
            });
        });
    
        // Case: Single marker.
        if( map.markers.length == 1 ){
            map.setCenter( bounds.getCenter() );
    
        // Case: Multiple markers.
        } else{
            map.fitBounds( bounds );
        }
    }
    
    // Render maps on page load.
    $(document).ready(function(){
        $('.acf-map').each(function(){
            var map = initMap( $(this) );
        });
    });
    
    })(jQuery);