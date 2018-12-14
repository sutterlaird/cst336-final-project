<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>MySQL Map</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
    
    <body>
        <div id="map"></div>
    
        <script>
            var infoWindow, map;
            var customLabel = {
                WI: {
                  label: 'WI'
                },
                AS: {
                  label: 'AS'
                },
                MA: {
                  label: 'MA'
                },
                CY: {
                  label: 'CY'
                },
                SA: {
                  label: 'SA'
                },
                TO: {
                  label: 'TO'
                },
                AV: {
                  label: 'AV'
                },
                YA: {
                  label: 'YA'
                },
                VI: {
                  label: 'VI'
                },
                PI: {
                  label: 'PI'
                },
                ST: {
                  label: 'ST'
                },
                PRW: {
                  label: 'PRW'
                },
                PRC: {
                  label: 'PRC'
                },
                PRE: {
                  label: 'PRE'
                }
            };
        
            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 36.654687, lng: -121.798885},
              zoom: 17
            });
            infoWindow = new google.maps.InfoWindow;
          
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };
                
                var userMarker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: '../img/bluecircle.png'
                });
                
                map.setCenter(pos);
              }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
              });
            } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
            }
          }
          
          // Change this depending on the name of your PHP or XML file
          downloadUrl('db.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var desc = markerElem.getAttribute('description');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
        
              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name;
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));
        
              var text = document.createElement('text');
              var description = document.createElement('desc');
              
              var strong2 = document.createElement('strong');
              strong2.textContent = desc;
              text.textContent = address;
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));
              infowincontent.appendChild(document.createElement('br'));
              infowincontent.appendChild(strong2);
              
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        
        
          function downloadUrl(url, callback) {
              var request = window.ActiveXObject ?
              new ActiveXObject('Microsoft.XMLHTTP') :
              new XMLHttpRequest;
          
          request.onreadystatechange = function() {
            if (request.readyState == 4) {
              request.onreadystatechange = doNothing;
              callback(request, request.status);
            }
          };
              
              request.open('GET', url, true);
              request.send(null);
          }
          
          function doNothing() { }
        
      </script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDX-Bg7XIQuMCYO1htyvZXMv3RsHo3uuK8&callback=initMap"></script>
    </body>
</html>