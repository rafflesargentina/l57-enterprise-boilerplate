
export const gmaps = {
    data() {
        return {
            autocomplete: null,
            bounds: [],
            circle: null,
            pickedAddressComponents: {
                street_number: ["street_number", "short_name"],
                route: ["street_name", "long_name"],
                locality: ["locality", "long_name"],
                administrative_area_level_1: ["state", "short_name"],
                country: ["country", "long_name"],
                postal_code: ["zip", "short_name"],
                sublocality_level_1: ["sublocality", "long_name"],
            },
            geolocation: null,
            infowindow: null,
            map: null,
            marker: null,
            markers: [],
            place: null,
        }
    },

    methods: {
        fillInAddress() {
            return new Promise((resolve, reject)=> {
                if (this.form.address) {
                    // Get the place details from the autocomplete object.
                    this.place = this.autocomplete.getPlace()

                    // Clear and enable the form fields.
                    for (var component in this.pickedAddressComponents) {
                        var addressType = this.pickedAddressComponents[component][0]
                        if (this.form.address[addressType]) {
                            this.form.address[addressType] = ""
                        }

                        var el = document.getElementById(component)
                        if (el) {
                            el.disabled = false
                        }
                    }

                    // Get each component of the address from the place details,
                    // and then fill-in the corresponding field on the form.
                    var addressComponents = this.place.address_components
                    for (var i = 0; i < addressComponents.length; i++) {
                        var addressType = addressComponents[i].types[0]
    
                        if (this.pickedAddressComponents[addressType]) {
                            var val = addressComponents[i][this.pickedAddressComponents[addressType][1]]

                            component = this.pickedAddressComponents[addressType][0]
                            this.form.address[component] = val
                        }
                    }

                    this.updateFormMapCoordinates(this.place.geometry.location.toJSON())

                    return resolve(this.form.address) 
                }

                return reject("There's no address object to fill.")
            })
        },

        fitBoundsToVisibleMarkers() {
            this.bounds = new window.google.maps.LatLngBounds()

            for (var i=0; i < this.markers.length; i++) {
                if(this.markers[i].getVisible()) {
                    this.bounds.extend( this.markers[i].getPosition() )
                }
            }

            this.map.fitBounds(this.bounds)
        },

        geolocate() {
            return new Promise((resolve, reject)=> {
                return navigator.geolocation.getCurrentPosition((position, error) => {
                    if (position) {
                        this.geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        }

                        this.circle = this.makeCircle(
                            { center: this.geolocation, radius: position.coords.accuracy }
                        )

                        if (this.autocomplete) {
                            this.autocomplete.setBounds(this.circle.getBounds())
                        }

                        return resolve(this.geolocation)
                    }

                    return reject(error)
                })
            })
        },

        initAutocomplete(el = "autocomplete", options = { types: ["geocode"], componentRestrictions: { country: "ar" }}) {
            // Create the autocomplete object, restricting the search predictions to geographical location types.
            this.autocomplete = new window.google.maps.places.Autocomplete(
                document.getElementById(el), options
            )
        
            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            // Set the data fields to return when the user selects a place.
            this.autocomplete.setFields(["address_components", "geometry", "icon", "name"]),
      
            // When the user selects an address from the drop-down, populate the address fields in the form.
            this.autocomplete.addListener("place_changed", this.fillInAddress)

            return Promise.resolve(this.autocomplete)
        },

        initMap(el, options) {
            this.map = this.makeMap(el, options)

            if (this.form) {
                if (this.form.map) {
                    this.map.addListener("zoom_changed", ()=> {
                        this.form.map.zoom = this.map.getZoom()
                    })
                }
            }

            var markerOptions = {
                draggable: true,
                map: this.map,
                position: options.center
            }

            this.marker = this.makeMarker(markerOptions)
            this.marker.addListener("dragend", (event)=> this.updateFormMapCoordinates(event.latLng.toJSON()))

            if (this.autocomplete) {
                // Bind the map's bounds (viewport) property to the autocomplete object,
                // so that the autocomplete requests use the current map bounds for the
                // bounds option in the request.
                this.autocomplete.bindTo("bounds", this.map)

                this.autocomplete.addListener("place_changed", ()=> {
                    this.marker.setVisible(false)

                    if (!this.place.geometry) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        console.error("No details available for input: '" + this.place.name + "'")
                    } else {
                        // If the place has a geometry, then present it on a map.
                        if (this.place.geometry.viewport) {
                            this.map.fitBounds(this.place.geometry.viewport)
                        } else {
                            this.map.setCenter(this.place.geometry.location)
                            this.map.setZoom(zoom)
                        }

                        this.marker.setPosition(this.place.geometry.location)
                        this.marker.setVisible(true)
                    }
                })
            }

            return Promise.resolve(this.map)
        },

        makeCircle(options) {
            return new window.google.maps.Circle(options)
        },

        makeInfowindow(el) {
            var infowindow = new window.google.maps.InfoWindow()
            var infowindowContent = document.getElementById(el)
            infowindow.setContent(infowindowContent)

            return infowindow
        },

        makeMap(el, options) {
            return new window.google.maps.Map(document.getElementById(el), options)
        },

        makeMarker(options) {
            var marker = new window.google.maps.Marker(options)
            this.markers.push(marker)
            return marker
        },

        updateFormMapCoordinates(coordinates) {
            if (this.form.map)  {
                this.form.map.lat = coordinates.lat
                this.form.map.lng = coordinates.lng
            }
        }
    }
}
