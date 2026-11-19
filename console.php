<?php
$parc = [
    ["nom" => "srv-web-01",  "type" => "serveur", "etat" => "critique"],
    ["nom" => "srv-bdd-01",  "type" => "serveur", "etat" => "normal"],
    ["nom" => "pc-sio-12",   "type" => "poste",   "etat" => "surveillance"],
    ["nom" => "pc-sio-27",   "type" => "poste",   "etat" => "normal"],
    ["nom" => "sw-etage-02", "type" => "reseau",  "etat" => "normal"]
];

$couleurs = [
    "normal"       => "#2e7d32",
    "surveillance" => "#e67e22",
    "critique"     => "#c0392b"
];

$typesAutorises = ["tous", "serveur", "poste", "reseau"];
$trisAutorises  = ["nom", "etat"];

$typeDemande = $_GET["type"] ?? "tous";
$triDemande  = $_GET["tri"] ?? "nom";

if (!in_array($typeDemande, $typesAutorises, true)) {
    echo "Type de filtre inconnu";
    return;
}

if (!in_array($triDemande, $trisAutorises, true)) {
    echo "Tri inconnu";
    return;
}

$nbCritiques = 0;
foreach ($parc as $machine) {
    if ($typeDemande === "tous" || $machine["type"] === $typeDemande) {
        if ($machine["etat"] === "critique") {
            $nbCritiques++;
        }
    }
}

echo "<h1>Console de supervision — Tri : " . htmlspecialchars($triDemande) . "</h1>";
echo "<p>" . htmlspecialchars((string)$nbCritiques) . " machine(s) en état critique</p>";

echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Machine</th><th>Type</th><th>État</th></tr>";

foreach ($parc as $machine) {
    if ($typeDemande === "tous" || $machine["type"] === $typeDemande) {
        $couleur = $couleurs[$machine["etat"]];
        echo "<tr>";
        echo "<td>" . htmlspecialchars($machine["nom"]) . "</td>";
        echo "<td>" . htmlspecialchars($machine["type"]) . "</td>";
        echo "<td style='color:white; background:" . $couleur . "'>" . htmlspecialchars($machine["etat"]) . "</td>";
        echo "</tr>";
    }
}

echo "</table>";
