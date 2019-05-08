
export const places = {
    data() {
        return {
            autocomplete: null,
            componentForm: {
                street_number: ["street_number", "short_name"],
                route: ["street_name", "long_name"],
                locality: ["locality", "long_name"],
                administrative_area_level_1: ["state", "short_name"],
                country: ["country", "long_name"],
                postal_code: ["zip", "short_name"],
                sublocality_level_1: ["sublocality", "long_name"],
            },
            place: null
        }
    },

    methods: {
        fillInAddress() {
            // Get the place details from the autocomplete object.
            this.place = this.autocomplete.getPlace()

            var formField
            for (var component in this.componentForm) {
                formField = this.form.address[this.componentForm[component][0]]
                if (formField) {
                    formField = ""
                }

                formField = document.getElementById(component)
                if (formField) {
                    document.getElementById(component).value = ""
                }

                document.getElementById(component).disabled = false
            }

            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            for (var i = 0; i < this.place.address_components.length; i++) {
                var addressType = this.place.address_components[i].types[0]
                if (this.componentForm[addressType]) {
                    var val = this.place.address_components[i][this.componentForm[addressType][1]]
                    component = this.componentForm[addressType][0]

                    formField = this.form.address[component]
                    if (formField) {
                        formField = val
                    }

                    formField = document.getElementById(component)
                    if (formField) {
                        formField.value = val
                    }
                }
            }
        },

        geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    }
                    var circle = new window.google.maps.Circle(
                        {center: geolocation, radius: position.coords.accuracy})
                    this.autocomplete.setBounds(circle.getBounds())
                })
            }
        },

        initAutocomplete(input = "autocomplete", options = { types: ["geocode"], componentRestrictions: { country: "ar" }}) {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            this.autocomplete = new window.google.maps.places.Autocomplete(
                document.getElementById(input, options)
            )
        
            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            this.autocomplete.setFields(["address_components"]),
        
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            this.autocomplete.addListener("place_changed", this.fillInAddress)
        }
    }
}
