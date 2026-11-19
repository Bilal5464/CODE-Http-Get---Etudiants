<?php
$parc = [
    ["nom" => "srv-web-01",  "type" => "serveur", "etat" => "critique"],
    ["nom" => "srv-bdd-01",  "type" => "serveur", "etat" => "normal"],
    ["nom" => "pc-sio-12",   "type" => "poste",   "etat" => "surveillance"],
    ["nom" => "pc-sio-27",   "type" => "poste",   "etat" => "normal"]
];

$typesValides = ["serveur", "poste"];

if (isset($_GET["type"])) {
    if (!in_array($_GET["type"], $typesValides, true)) {
        http_response_code(400);
        echo "Type invalide";
        return;
    }
}

if (isset($_GET["nom"])) {
    $trouve = false;
    foreach ($parc as $machine) {
        if ($machine["nom"] === $_GET["nom"]) {
            $trouve = true;
            echo "Équipement : " . htmlspecialchars($machine["nom"]) . " (" . htmlspecialchars($machine["type"]) . ") - " . htmlspecialchars($machine["etat"]);
        }
    }
    if (!$trouve) {
        http_response_code(404);
        echo "Équipement introuvable";
    }
    return;
}

foreach ($parc as $machine) {
    echo htmlspecialchars($machine["nom"]) . " - " . htmlspecialchars($machine["type"]) . "<br>";
}
