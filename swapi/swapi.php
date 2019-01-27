<?php
function starships() {
    $api_url="https://swapi.co/api/starships/"; // Swapi endpoint
    $json_data = file_get_contents($api_url); // Decode the incoming JSON data feed
    $json_file = "swapi-data/starships.json";

    // Check if we have live data, if not, use local backup-file until we have live data again.
    if (!empty($json_data)) {
        $json = json_decode($json_data);
        file_put_contents($json_file, json_encode($json_data));
    } else {
        $json = json_decode(file_get_contents($json_file));
    }

    // Build up the html to present data
    $html = "<section class='ships'>";
    $html .= "<header>";
    $html .= "<h2>List of ships</h2>";
    $html .= "</header>";

    // Start looping through data in the array and assign keys and print to screen.
    foreach ($json->results as $key => $ships) {
        $html .= "<article class='content'>";
        $html .= "<div class='card' style='width: 36rem;'>";
        if ($ships->name === 'Millennium Falcon') {
            $html .= "<img class='card-img-top' src='media/millenium-falcon-1627322_960_720.jpg' alt='Millenlium Falcon'>";
        }elseif ($ships->name === 'Executor') {
            $html .= "<img class='card-img-top' src='media/executor.jpg' alt='the Dark Side Is Calling'>";
        }         
        else {
            $html .= "<img class='card-img-top' src='https://placeholder.pics/svg/286x180' alt='Card image caption'>";
        }
        $html .= "<div class='card-body'>";
        $html .= "<h4 class='card-title'>{$ships->name}</h4>";
        $html .= "<p class='card-text'>This starship was originally manufactured in the empire by a manufacturer called {$ships->manufacturer}</p>";
        $html .= "</div>"; // close first part of card body

        $html .= "<ul class='list-group list-group-flush'>";
        $html .= "<li class='list-group-item'>Model: {$ships->model}</li>";
        $html .= "<li class='list-group-item'>Cost in galactic credits: {$ships->cost_in_credits}</li>";
        $html .= "<li class='list-group-item'>Length of ship: {$ships->length}</li>";
        $html .= "<li class='list-group-item'>Max speed: {$ships->max_atmosphering_speed}</li>";
        $html .= "<li class='list-group-item'>Crew: {$ships->crew}</li>";
        $html .= "<li class='list-group-item'>Passengers: {$ships->passengers}</li>";
        $html .= "<li class='list-group-item'>Cargo capacity: {$ships->cargo_capacity}</li>";
        $html .= "<li class='list-group-item'>Consumables: {$ships->consumables}</li>";
        $html .= "<li class='list-group-item'>Hyperdrive rating: {$ships->hyperdrive_rating}</li>";
        $html .= "<li class='list-group-item'>MGLT: {$ships->MGLT}</li>";
        $html .= "<li class='list-group-item'>Starship Class: {$ships->starship_class}</li>";
        $html .= "<li class='list-group-item'>Created: {$ships->created}</li>";
        $html .= "<li class='list-group-item'>Edited: {$ships->edited}</li>";
        $html .= "</ul>";
        $html .= "<div class='card-body'>";
        $html .= "<a href='{$ships->url}' class='btn btn-primary' target='_blank'>Link to ship</a>";
        $html .= "</div></div>";
        $html .= "</article>"; // End of every ships article
    }
    $html .= "</section>"; // end of section
    return $html; 
}
?>