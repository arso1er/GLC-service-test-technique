#!/usr/bin/env php
<?php
// Fonction permettant de vérifier si un tableau est associatif
function isAssociative($arr)
{
    foreach ($arr as $key => $value) {
        if (is_string($key)) {
            return true;
        }
    }
    return false;
}

function getWinner($player1, $player2)
{
    /*------------------------------------------------
    I- Vérification de la validité des inputs
    ------------------------------------------------*/

    // 1. Les deux paramètres doivent être des tableaux associatifs
    if (!is_array($player1) || !isAssociative($player1) || !is_array($player2) || !isAssociative($player2)) {
        echo "Paramètres erronés: veuillez entrer deux tableaux associatifs en paramètre.\n";
        return null;
    }

    // 2. Les tableaux doivent avoir les clés 'nom' (string) et 'notes' (array)
    if (!is_string($player1['nom']) || trim($player1['nom']) === "" || !is_array($player1['notes']) || count($player1['notes']) < 1 ||
        !is_string($player2['nom']) || trim($player2['nom']) === "" || !is_array($player2['notes']) || count($player2['notes']) < 1) {
        echo "Chacun des tableaux en paramètre doit avoir les clés non vides suivantes: 'nom' (string) et 'notes' (array).\n";
        return null;
    }

    // 3. Les deux joueurs doivent avoir participé au même nombre de jeux
    if (count($player1['notes']) !== count($player2['notes'])) {
        echo "Paramètres erronés: les deux joueurs n'ont pas le même nombre de notes.\n";
        return null;
    }

    /*-----------------------------------------------
    II- Détermination du vainqueur
    -----------------------------------------------*/

    // 1. Initialisation des scores
    $player1Score = 0;
    $player2Score = 0;

    // 2. Calcul des scores
    foreach ($player1['notes'] as $key => $player1Note) {
        // En cas d'égalité, on n'augmente le score d'aucun joueur.
        if ($player1Note > $player2['notes'][$key]) {
            $player1Score++;
        }
        if ($player2['notes'][$key] > $player1Note) {
            $player2Score++;
        }
    }

    // 3. Construction de la chaîne de caractères à renvoyer.
    $out = "{$player1['nom']}: {$player1Score} point" . ($player1Score > 1 ? "s\n" : "\n");
    $out .= "{$player2['nom']}: {$player2Score} point" . ($player2Score > 1 ? "s\n" : "\n");

    if ($player1Score > $player2Score) {
        $out .= "Le gagnant du concours est {$player1['nom']}.\n";
    }
    if ($player2Score > $player1Score) {
        $out .= "Le gagnant du concours est {$player2['nom']}.\n";
    }
    if ($player1Score === $player2Score) {
        $out .= "{$player1['nom']} et {$player2['nom']} sont à égalité.\n";
    }

    // 4. Affichage et renvoi du résultat
    echo $out;
    return $out;
}

/* Test */
// getWinner([
//     "nom" => "Kodjo",
//     "notes" => [12, 8, 15, 10, 11],
// ], [
//     "nom" => "Awa",
//     "notes" => [14, 14, 9, 6, 13],
// ]);
?>