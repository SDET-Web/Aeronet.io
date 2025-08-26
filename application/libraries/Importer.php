<?php

include APPPATH . 'third_party/Google/autoload.php';

class Importer{
    
    function google()
    {
        $client = new Google_Client();
        $client->setApplicationName("Client_Library_Examples");
        $client->setDeveloperKey("YOUR_APP_KEY");

        $service = new Google_Service_Books($client);
        $optParams = array('filter' => 'free-ebooks');
        $results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

        foreach ($results as $item) {
            echo $item['volumeInfo']['title'], "<br /> \n";
        }
    }
    
}

?>