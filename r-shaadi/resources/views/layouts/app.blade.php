<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') Shaadivibes @show</title>

    @section('meta_keywords')
        <meta name="keywords" content="your, awesome, keywords, here"/>
    @show @section('meta_author')
        <meta name="author" content="Jon Doe"/>
    @show @section('meta_description')
        <meta name="description"
              content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei."/>
    @show

    <!-- Styles -->
    <link href="{{ asset('public/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/dropzone.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/responsive.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('public/assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/lightbox.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700" rel="stylesheet">
    <link href="{{ asset('public/assets/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/star-rating.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom.js') }}" type="text/javascript"></script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&amp;libraries=places"></script>
    <script src="{{ asset('public/assets/js/jquery.geocomplete.js') }}" type="text/javascript"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' =>  url(''),
        ]); ?>

        var url = <?php echo json_encode(url('')) ?>;
        var is_login = <?php echo json_encode(!empty(auth()->guard('user')->id()) ?TRUE:FALSE) ;?>;
    </script>
</head>
<body>
    <div id="app">
        <!-- navbar -->
        @include('frontend.includes.nav')
        <!-- /navbar -->

        @yield('content')

        <!-- footer -->
        @include('frontend.includes.footer')
        <!-- /footer -->
    </div>
</body>
<script type="text/javascript" src="{{ asset('public/assets/js/float-panel.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/bootstrap.js') }}"></script>
<script  type="text/javascript" src="{{ asset('public/assets/js/bootbox.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
@if(Request::is('user/dashboard'))
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endif
<script type="text/javascript" src="{{ asset('public/assets/js/dropzone.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/assets/js/bootstrap-multiselect.js') }}"></script>

<script src="{{ asset('public/assets/js/star-rating.js') }}" type="text/javascript" /></script>
<!-- Custom js by designer -->

@if(Request::is('contact_us'))
<script>
    $(function () {
        var lat = {{ (isset($site_settings['contact_lat']) && !empty($site_settings['contact_lat'])) ? $site_settings['contact_lat'] : '' }},
            lng = {{ (isset($site_settings['contact_long']) && !empty($site_settings['contact_long'])) ? $site_settings['contact_long'] : '' }},
            latlng = new google.maps.LatLng(lat, lng),
            image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';

        //zoomControl: true,
        //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,

        var mapOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: true,
                panControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE,
                    position: google.maps.ControlPosition.TOP_left
                }
            },
            map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: image
            });

        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"]
        });

        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
            infowindow.close();
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            moveMarker(place.name, place.geometry.location);
            alert(place.name);
            $('.MapLat').val(place.geometry.location.lat());
            $('.MapLon').val(place.geometry.location.lng());
        });
        google.maps.event.addListener(map, 'click', function (event) {
            $('.MapLat').val(event.latLng.lat());
            $('.MapLon').val(event.latLng.lng());
            alert(event.latLng.place.name)
        });
        $("#searchTextField").focusin(function () {
            $(document).keypress(function (e) {
                if (e.which == 13) {
                    return false;
                    infowindow.close();
                    var firstResult = $(".pac-container .pac-item:first").text();
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        "address": firstResult
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            var lat = results[0].geometry.location.lat(),
                                lng = results[0].geometry.location.lng(),
                                placeName = results[0].address_components[0].long_name,
                                latlng = new google.maps.LatLng(lat, lng);

                            moveMarker(placeName, latlng);
                            $("input").val(firstResult);
                            alert(firstResult)
                        }
                    });
                }
            });
        });

        function moveMarker(placeName, latlng) {
            marker.setIcon(image);
            marker.setPosition(latlng);
            infowindow.setContent(placeName);
            //infowindow.open(map, marker);
        }
    });
</script>
@endif
@yield('scripts')
</html>
