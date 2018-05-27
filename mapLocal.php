<!DOCTYPE html>
<html>
<head>
    <title>แจ้งเตือนอุบัติเหตุ</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
          href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
          integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css"/>
    <link rel="stylesheet" href="./css/bootstrap-material-datetimepicker.css"/>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
            integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
            crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
            integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-material-datetimepicker.js"></script>

    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-messaging.js"></script>


    <style>
        .c-pointer {
            cursor: pointer;
        }

        #map {
            height: calc(100vh - 56px); /*ความสูง map - ความสูงเมนู*/
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<!--แถบเมนู-->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f8bb15;">
    <div class="container">
        <a class="navbar-brand text-white" href="#">4Crash</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link c-pointer" data-toggle="modal"
                       data-target="#searchByDate">ค้นหาจากวันที่</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link c-pointer" data-toggle="modal"
                       data-target="#searchByEmail">ค้นหาจากอีเมล</a>
                </li>
            </ul>
        </div>
        <form class="form-inline">
            <span id="searchBy"></span>
        </form>
    </div>
</nav>

<!-- Modal แสดง input ค้าหาจากวันที่ -->
<div class="modal fade" id="searchByDate" tabindex="-1" role="dialog" aria-labelledby="modalSearchByDate"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ค้นหาจากวันที่</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="dateInput" class="form-control floating-label" placeholder="วันที่">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" onclick="searchByDate()" data-dismiss="modal">ค้นหา
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal แสดง input ค้าหาจาก Email -->
<div class="modal fade" id="searchByEmail" tabindex="-1" role="dialog" aria-labelledby="modalSearchByEmail"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ค้นหาจากอีเมล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="emailInput" class="form-control floating-label" placeholder="อีเมล"
                       value="thiti2539@hotmail.com">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" onclick="searchByEmail()" data-dismiss="modal">ค้นหา
                </button>
            </div>
        </div>
    </div>
</div>


<div id="map"></div>


<script>
    $('#dateInput').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true
    });

    $('body').bootstrapMaterialDesign();

    var inputDate = '';
    var keyEmail = '';

    var map;
    var image = 'img/marker.png';

    var markersAll = [];
    //var locationsEvent = [];

    var config = {
        apiKey: "AIzaSyDiFx7CFrGt_iKu7QHWMyrKxYbbnw5fYbU",
        authDomain: "testproject1-b9213.firebaseapp.com",
        databaseURL: "https://testproject1-b9213.firebaseio.com/",
        projectId: "testproject1-b9213",
        storageBucket: "testproject1-b9213.appspot.com",
        messagingSenderId: "153725249592"
    };
    firebase.initializeApp(config);

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 13.751362, lng: 100.506815},
            zoom: 11
        });

        //////////////////////////////////

        // Load GeoJSON.
        map.data.loadGeoJson('dt.json');

        // Color each letter gray. Change the color when the isColorful property
        // is set to true.
        map.data.setStyle(function (feature) {
            var color = 'gray';
            if (feature.getProperty('isColorful')) {
                color = feature.getProperty('color');
            }
            return /** @type {google.maps.Data.StyleOptions} */({
                fillColor: color,
                strokeColor: color,
                strokeWeight: 1.5
            });
        });

        var clickEvent = true;
        var eventOld = null;
        map.data.addListener('click', function (event) {
            if (clickEvent) {
                clickEvent = false;
                event.feature.setProperty('isColorful', true);
                eventOld = event.feature;
            } else {
                eventOld.setProperty('isColorful', false);
                event.feature.setProperty('isColorful', true);
                eventOld = event.feature;
            }
            if (event.feature.getGeometry().getType() === 'Polygon') {

                var polyPath = event.feature.getGeometry().getAt(0).getArray();
                var poly = new google.maps.Polygon({
                    paths: polyPath
                });

                for (var i = 0; i < markersAll.length; i++) {
                    if (google.maps.geometry.poly.containsLocation(markersAll[i].position, poly)) {
                        markersAll[i].setMap(map);
                    } else {
                        markersAll[i].setMap(null);
                    }
                }


            }
        });

        map.data.addListener('mouseover', function (event) {
            map.data.revertStyle();
            map.data.overrideStyle(event.feature, {strokeWeight: 8});
        });

        map.data.addListener('mouseout', function (event) {
            map.data.revertStyle();
        });


        ////////////////////////////////
        if (keyEmail === '') {
            var count = 0;
            firebase.database().ref('/AccidentLocation2/Event').on("value", function (snapshot) {
                var locationsEvent = [];
                var infoHtmlEvent = [];
                markersAll = [];
                snapshot.forEach(function (eventUser) {
                    if (eventUser.val().Date === inputDate || inputDate === '') {
                        pushInfo(eventUser, infoHtmlEvent, locationsEvent);
                        count++;
                    }
                });

                addMakers(locationsEvent, infoHtmlEvent, map);
            }, function (errorObject) {
                console.log("The read failed: " + errorObject.code);
            });
            if (count === 0 && inputDate !== '') alert("ไม่มีข้อมูล");
        } else if (keyEmail !== '') {
            firebase.database().ref('/AccidentLocation2/Send-Report/' + keyEmail).on("value", function (snapshot) {
                var locations = [];
                var infoHtml = [];
                markersAll = [];
                snapshot.forEach(function (eventUser) {
                    pushInfo(eventUser, infoHtml, locations);
                });

                addMakers(locations, infoHtml, map);
            }, function (errorObject) {
                console.log("The read failed: " + errorObject.code);
            });
        }
        //////////////////////////////


    }

    function pushInfo(eventUser, infoHtml, locations) {
        locations.push({
            lat: parseFloat(eventUser.val().Location.Latitude),
            lng: parseFloat(eventUser.val().Location.Longitude)
        });
        infoHtml.push('<div class="row mt-3"><div class="col-2"><h6>เหตุการณ์</h6></div><div class="col-10">' + eventUser.val().Detail + '</div></div> <div class="row mt-3"><div class="col-2"><h6>รูป</h6></div> <div class="col-10"><img style="width: 300px;" src="' + eventUser.val().ImagePath + '" class="img-thumbnail"></div> </div> <div class="row mt-3"> <div class="col-2"><h6>เวลา</h6></div> <div class="col-10">' + eventUser.val().Time + ' / ' + eventUser.val().Date + '</div> </div>');
    }

    function addMakers(locations, infoHtml, map) {
        locations.forEach(function (location, i) {
            var marker = new google.maps.Marker({
                map: map,
                position: location,
                icon: image
            });
            infoMarkerMessage(marker, infoHtml[i]);
            markersAll.push(marker);
            //return marker;
        });

//        var markerCluster = new MarkerClusterer(map, markers, {
//            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
//            gridSize: 100,
//        });
    }

    function infoMarkerMessage(marker, text) {
        var infowindow = new google.maps.InfoWindow({
            content: text
        });
        marker.addListener('click', function () {
            infowindow.open(marker.get('map'), marker);
        });
    }

    //ค้นหาโดยวันที่
    function searchByDate() {
        inputDate = $('#dateInput').val();
        $('#searchBy').html(inputDate);
        initMap();
    }

    //ค้นหาโดย Email
    function searchByEmail() {
        var inputEmail = $('#emailInput').val();
        keyEmail = '';
        firebase.database().ref('/AccidentLocation2').child("User").orderByChild("email").equalTo(inputEmail).on("value", function (snapshot) {
            if (snapshot.val() !== null) {
                keyEmail = Object.keys(snapshot.val())[0];
                $('#searchBy').html(inputEmail);
                console.log("Key user : " + keyEmail);
                initMap();
            } else {
//                console.log("Key user = null");
                alert("ไม่มีอีเมลนี้ในระบบ");
            }
        }, function (errorObject) {
            console.log("The read failed: " + errorObject.code);
        });
    }
</script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA61nJJ7uFmvqKI_p0FN36g-jL3d4nl3Xk&libraries=geometry&callback=initMap"
        async defer></script>
</body>
</html>