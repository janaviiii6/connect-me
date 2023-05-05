<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

// Add a click event listener to the "Add Guest" button

$(document).ready(function() {
    // Current user location
    var mymap = L.map('mapid').setView([51.505, -0.09], 13);

    // Add a tile layer to the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(mymap);

    $('#is_host').change(function() {
        if ($(this).is(':checked')) {
            $('#total_fare_group').show();
            $('#wait_till_time_group').show();
        } else {
            $('#total_fare_group').hide();
            $('#wait_till_time_group').hide();
        }
    });

    function storeLocation(latitude, longitude, userId, csrfToken) {
    // Check if there is already an entry for the user
    $.ajax({
        url: '/check-location',
        type: 'GET',
        data: {
            user_id: userId,
            '_token': csrfToken
        },
        success: function(response) {
            if (response.exists == true) {
                console.log('Location already stored.');

            }else {
                // Make a new entry for the user
                $.ajax({
                    url: '/store-location',
                    type: 'POST',
                    data: {
                        latitude: latitude,
                        longitude: longitude,
                        user_id: userId,
                        '_token': csrfToken
                    },
                    success: function(response) {
                        console.log('Location stored successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


    function getLocationAndStore() {
        if (navigator.geolocation) {
        // Check if the user is authenticated
            if ({{ auth()->check() ? 'true' : 'false' }}) {
                var userId = {{ auth()->id() }};
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var pos = [latitude, longitude];
                    mymap.setView(pos, 17);
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Call the function to store the location using AJAX
                    storeLocation(latitude, longitude, userId, csrfToken);

                    var marker = L.marker(pos).addTo(mymap);
                    var circle = L.circle([latitude,longitude], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: 100
                    }).addTo(mymap);
                });
            } else {
                console.log('User is not authenticated.');
            }
        } else {
            alert('Geolocation is not supported by this browser.');
        }

    }
    getLocationAndStore();

});
</script>
