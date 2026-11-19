<?php
$logiciels = [
    ["nom" => "Nextcloud",  "licence" => "libre",       "systeme" => "linux"],
    ["nom" => "Active Dir", "licence" => "proprietaire","systeme" => "windows"],
    ["nom" => "VS Code",    "licence" => "libre",       "systeme" => "multi"],
    ["nom" => "MS Office",  "licence" => "proprietaire","systeme" => "windows"]
];

$licencesAutorisees = ["tous", "libre", "proprietaire"];
$systemesAutorises  = ["tous", "linux", "windows", "multi"];

$licence = $_GET["licence"] ?? "tous";
$systeme  = $_GET["systeme"] ?? "tous";

if (!in_array($licence, $licencesAutorisees, true) || !in_array($systeme, $systemesAutorises, true)) {
    echo "Filtre invalide";
    return;
}

echo "<h1>Catalogue de logiciels</h1>";
echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Logiciel</th><th>Licence</th><th>Système</th><th>Action</th></tr>";

foreach ($logiciels as $logiciel) {
    $okLicence = ($licence === "tous" || $logiciel["licence"] === $licence);
    $okSysteme = ($systeme === "tous" || $logiciel["systeme"] === $systeme);

    if ($okLicence && $okSysteme) {
        $lien = "detail.php?nom=" . urlencode($logiciel["nom"]);
        echo "<tr>";
        echo "<td>" . htmlspecialchars($logiciel["nom"]) . "</td>";
        echo "<td>" . htmlspecialchars($logiciel["licence"]) . "</td>";
        echo "<td>" . htmlspecialchars($logiciel["systeme"]) . "</td>";
        echo "<td><a href='" . htmlspecialchars($lien) . "'>Voir détail</a></td>";
        echo "</tr>";
    }
}

echo "</table>";
