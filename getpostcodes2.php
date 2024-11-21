<?php include "private/settings.php";

function getCoordinates($postcode) {
    // Replace 'YOUR_API_KEY' with your actual Google Maps API key
    $apiKey = 'AIzaSyBX5RABdr9q7B3RVQ440nt-lQP5iwM2JlQ';
    
    // Format the postcode for the API request
    $formattedPostcode = urlencode($postcode);
    
    // API endpoint URL
    $apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=$formattedPostcode&key=$apiKey";
    
    // Make the API request
    $response = file_get_contents($apiUrl);
    
    // Decode the JSON response
    $data = json_decode($response, true);
    
    // Check if the response contains results
    if ($data['status'] == 'OK' && isset($data['results'][0])) {
        // Extract latitude and longitude from the first result
        $latitude = $data['results'][0]['geometry']['location']['lat'];
        $longitude = $data['results'][0]['geometry']['location']['lng'];
        
        // Return latitude and longitude
        return array('latitude' => $latitude, 'longitude' => $longitude);
    } else {
        // Return null if no results found or if there was an error
        return null;
    }
}



// Example usage:
$postcode = 'AB10 1XG'; // Example postcode (e.g., Buckingham Palace, London)
$coordinates = getCoordinates($postcode);

if ($coordinates) {
  print  $latitude=$coordinates['latitude'];
    print $longitude=$coordinates['longitude'];

$radius = 1; // Radius in miles


}

?>