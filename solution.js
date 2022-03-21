#!/usr/bin/env node

const getWinner = (player1, player2) => {
  /*------------------------------------------------
     I- Vérification de la validité des inputs
  ------------------------------------------------*/

  // 1. Les deux paramètres doivent être des objets
  if (
    typeof player1 !== "object" ||
    Array.isArray(player1) ||
    player1 === null ||
    typeof player2 !== "object" ||
    Array.isArray(player2) ||
    player2 === null
  ) {
    console.log("Paramètres erronés: veuillez entrer deux objets en paramètre.");
    return null;
  }

  // 2. Les objets doivent avoir les propriétés 'nom' (string) et 'notes' (array)
  if (
    typeof player1.nom !== "string" ||
    !player1.nom.trim() ||
    !Array.isArray(player1.notes) ||
    !player1.notes.length ||
    typeof player2.nom !== "string" ||
    !player2.nom.trim() ||
    !Array.isArray(player2.notes) ||
    !player2.notes.length
  ) {
    console.log(
      "Chacun des objets en paramètre doit avoir les propriétés non vides suivantes: 'nom' (string) et 'notes' (array)."
    );
    return null;
  }

  // 3. Les deux joueurs doivent avoir participé au même nombre de jeux
  if (player1.notes.length !== player2.notes.length) {
    console.log("Paramètres erronés: les deux joueurs n'ont pas le même nombre de notes.");
    return null;
  }

  /*-----------------------------------------------
     II- Détermination du vainqueur
  -----------------------------------------------*/

  // 1. Initialisation des scores
  let player1Score = 0,
    player2Score = 0;

  // 2. Calcul des scores
  player1.notes.forEach((player1Note, index) => {
    // En cas d'égalité, on n'augmente le score d'aucun joueur.
    if (player1Note > player2.notes[index]) player1Score++;
    if (player2.notes[index] > player1Note) player2Score++;
  });

  // 3. Construction de la chaîne de caractères à renvoyer.
  let out = `${player1.nom}: ${player1Score} point${player1Score > 1 ? "s" : ""}\n`;
  out += `${player2.nom}: ${player2Score} point${player2Score > 1 ? "s" : ""}\n`;

  if (player1Score > player2Score) {
    out += `Le gagnant du concours est ${player1.nom}.`;
  }
  if (player2Score > player1Score) {
    out += `Le gagnant du concours est ${player2.nom}.`;
  }
  if (player1Score === player2Score) {
    out += `${player1.nom} et ${player2.nom} sont à égalité.`;
  }

  // 4. Affichage et renvoi du résultat
  console.log(out);
  return out;
};

/* Test */
// getWinner(
//   {
//     nom: "Kodjo",
//     notes: [12, 8, 15, 10, 11],
//   },
//   {
//     nom: "Awa",
//     notes: [14, 14, 9, 6, 13],
//   }
// );
