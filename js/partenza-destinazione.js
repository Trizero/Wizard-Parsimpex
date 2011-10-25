(function() {  
  $(function() {
    var map,
        rome = new google.maps.LatLng(41.442726,12.392578),
        startZoom = 1,
        markers, addresses,
        request = {};
    
    function makeMap() {
      var myOptions, lastInfoWindow;
      // Mostro la mappa centrata su Roma con zoom al minimo
      myOptions = {
        zoom: startZoom,
        center: rome,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    }
    
    function centerMap() {
      map.setCenter(rome);
      map.setZoom(startZoom);
    }
    
    function closeLastInfoWindow() {
      if(typeof lastInfoWindow !== "undefined" && lastInfoWindow !== null) {
        lastInfoWindow.close();
      }
    }
    
    $('#address_fld').keypress(function(e) {
      if(e.which == 13) {
        startQuery();
      }
    });
    
    $('#verify_btn').click(function() {
      startQuery();
    });
    
    function startQuery() {
      var query, geocoder;
      
      closeLastInfoWindow();
      centerMap();
      
      // Ottengo la query di ricerca
      query = $('#address_fld').val();
      
      // Effettua richiesta a google maps
      geocoder = new google.maps.Geocoder();
      geocoder.geocode({ 'address': query }, function(results, status){
        var i, result, lat, lng, latlng, marker, infoWindow, infoWindowContent;
        
        if(typeof markers !== "undefined" && markers !== null) {
          for(i = 0; i < markers.length; i++) {
            marker = markers[i];
            marker.setVisible(false);
            delete markers[i];
          }
        }
        markers = [];
        
        if(status === 'OK') {
          addresses = results;
          
          for(i = 0; i < results.length; i++) {
            result = results[i];
            
            lat = result.geometry.location.lat();
            lng = result.geometry.location.lng();
            latlng = new google.maps.LatLng(lat, lng);
            
            marker = new google.maps.Marker({
              position: latlng,
              map: map,
              title: 'hello',
              animation: google.maps.Animation.DROP
            });
            infoWindowContent = '<p>'+result.formatted_address+'</p><a href="#" class="start_btn" data-result_id="'+i+'">Seleziona come indirizzo di partenza</a>';
            infoWindow = new google.maps.InfoWindow({
              content: infoWindowContent
            });
            
            google.maps.event.addListener(marker, 'click', (function(infoWindow, marker){
              return function() {
                closeLastInfoWindow();
                infoWindow.open(map, marker);
                lastInfoWindow = infoWindow;
              };
            })(infoWindow, marker));
            
            markers.push(marker);
          }
        } else if(status === 'ZERO_RESULTS') {
          alert('Nessun risulatato trovato');
        } else if(status === 'OVER_QUERY_LIMIT') {
          alert('Limite di richieste superato');
        } else if(status === 'REQUEST_DENIED') {
          alert('La tua richiesta è stata rifiutata da Google Maps');
        } else if(status === 'INVALID_REQUEST') {
          alert('La tua richiesta non è valida');
        }
      });
    }
    
    $('.start_btn').live('click', function() {
      var id, data;
      id = $(this).attr('data-result_id');
      data = addresses[id];
      request[startStop] = data;
      $('#hidden_fld').val(JSON.stringify(request));
      $('form').submit();
    });
    
    request = JSON.parse(request_json);
    $('#hidden_fld').val(request_json);
    
    makeMap();
  });
})(this);