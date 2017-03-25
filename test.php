<?php 
 $addressinput = $_GET["addressinput"]; 
    // url encode the address
 		//echo "worked";
    $address = urlencode($addressinput);
    //echo $address;

    // google map geocode api url
    $url = "https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyALCzLyWCk4fIywwRFu8cooA4E8hPU-ke0";
 		
    // get the json response
    $resp_json = file_get_contents($url);
   //echo $resp_json;
    
    // decode the json
    $geocodedinfo = json_decode($resp_json, true);
//echo $geocodedinfo;
 
    // response status will be 'OK', if able to geocode given address 
    if($geocodedinfo['status']=='OK'){
    	echo "good";
        // get the important data
        $lati = $geocodedinfo['results'][0]['geometry']['location']['lat'];
        $longi = $geocodedinfo['results'][0]['geometry']['location']['lng'];
        $formatted_address = $geocodedinfo['results'][0]['formatted_address'];
         echo $lati;
         echo $longi;
         echo $formatted_address;
?>
         <!-- google map will be shown here -->
    <div id="gmap_canvas">Loading map...</div>
    <div id='map-label'>Map shows approximate location.</div>
 
    <!-- JavaScript to show google map -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAP0e71c-JOgdHollT1pQoMAKGDh_WO7AM"></script>    
    <script type="text/javascript">
        function init_map() {
            
            var myOptions = {
                zoom: 14,
                center: new google.maps.LatLng(<?php echo $lati; ?>, <?php echo $longi; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            /*map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(<?php echo $lati; ?>, <?php echo $longi; ?>)
            });
            infowindow = new google.maps.InfoWindow({
                content: "<?php echo $formatted_address; ?>"
            });
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);*/
        }
        google.maps.event.addDomListener(window, 'load', init_map);
    </script>
 
    <?php
 
    // if unable to geocode the address
    }else{
        echo "No map found.";
    }
 
?>