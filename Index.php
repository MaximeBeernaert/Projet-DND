<?php
// database connection
include_once('./Config.php');

// class inclusion
include_once('./Classes/Personnage.php');
include_once('./Classes/Monstre.php');
include_once('./Classes/Salle.php');
include_once('./Classes/Porter.php');
include_once('./Classes/Objet.php');
include_once('./Classes/Enigme.php');

// DAO inclusion
include_once ('./DAO/PersonnageDAO.php');
include_once ('./DAO/MonstreDAO.php');
include_once ('./DAO/PorterDAO.php');
include_once ('./DAO/ObjetDAO.php');
include_once ('./DAO/EnigmeDAO.php');

// DAO instantiation
$personnageDAO = new PersonnageDAO($db);
$monstreDAO = new MonstreDAO($db);
$porterDAO = new PorterDAO($db);
$objetDAO = new ObjetDAO($db);
$enigmeDAO = new EnigmeDAO($db);
$gestionDAO = array('personnageDAO' => $personnageDAO, 
                    'monstreDAO' => $monstreDAO, 
                    'porterDAO' => $porterDAO, 
                    'objetDAO' => $objetDAO, 
                    'enigmeDAO' => $enigmeDAO, 
                    'competenceDAO' => $competenceDAO, 
                    'utiliserDAO' => $utiliserDAO);


// $monstre = new Monstre("Dragon", 100, 20, "Souffle de feu", 10, 500);
// $monstreDAO->addMonstre($monstre);
// $monstre2 = new Monstre("Gobelin", 10, 5, "Attaque de base", 5, 100);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Ogre", 120, 25, "Frappe puissante", 15, 600);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Spectre", 80, 15, "Toucher glacial", 8, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Banshee", 90, 18, "Cri perçant", 12, 400);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Loup-garou", 110, 22, "Morsure féroce", 12, 550);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Chimère", 150, 30, "Rugissement dévastateur", 20, 700);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Hydre", 180, 35, "Morsure venimeuse", 25, 800);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Orc", 80, 12, "Frappe brutale", 10, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Elemental", 200, 40, "Furie élémentaire", 30, 1000);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Golem", 250, 45, "Frappe de pierre", 35, 1200);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Géant", 300, 50, "Frappe dévastatrice", 40, 1500);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Squelette", 50, 8, "Attaque de base", 5, 200);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Zombie", 60, 10, "Morsure infectée", 8, 250);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Vampire", 70, 12, "Morsure vampirique", 10, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Liche", 100, 15, "Toucher glacial", 12, 400);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Démon", 150, 20, "Frappe démoniaque", 15, 600);
// $monstreDAO->addMonstre($monstre);

// $enigme = new Enigme("Qu'est-ce qui est jaune et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est vert et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est rouge et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est bleu et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est noir et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);

// GAME START MENU
function menu($gestionDAO){
    popen('cls','w');
    echo "Bienvenue Joueur";
    echo "Veux-tu : \n 1 - Charger une nouvelle partie \n2 - Charger une partie déjà créée \n3 - Quitter";
    $choice = readline("");
    switch ($choice) {
        case '1':
            $personnage = createPersonnage($gestionDAO);
            menuJoueur($gestionDAO, $personnage);
            break;
        case '2':
            $personnage = chargerPartie($gestionDAO);
            menuJoueur($gestionDAO, $personnage);
            break;
        case '3':
            exitGame();
            break;
        default:
            menu($gestionDAO);
            exit;
    }
}

// CREATE A CHARACTER
function createPersonnage($gestionDAO){
    popen('cls','w');
    $nom = readline(("Quel est le nom de votre personnage ?"));
    $personnage = new Personnage($nom);
    $gestionDAO['personnageDAO']->addPersonnage($personnage);
    $id = $gestionDAO['personnageDAO']->getLastPersonnageId()[0];
    $personnage->setId($id);
    return $personnage;
}

// LOAD A GAME
function chargerPartie($gestionDAO){
    popen('cls','w');
    $gestionDAO['personnageDAO']->getPersonnages();
    echo "Choisir une partie :\n";
    foreach ($gestionDAO['personnageDAO']->getPersonnages() as $key => $personnage) {
        echo $key+1 . ' - ' . $personnage['nom'] . " - Niveau: " . $personnage['level'] . "\n";
    }
    echo "Quel est le numéro de votre partie ?";
    $choix = (int)readline("");
    if($choix <= 0 || $choix > count($gestionDAO['personnageDAO']->getPersonnages()) ){
        chargerPartie($gestionDAO);
    }
    $tempPersonnage = $gestionDAO['personnageDAO']->getPersonnage($gestionDAO['personnageDAO']->getPersonnages()[$choix-1]['id']);
    
    popen('cls','w');
    echo "Vous avez choisi la partie de " . $tempPersonnage['nom'] . "\n";
    readline("Appuyer sur entrer pour continuer");

    $personnage = new Personnage($tempPersonnage['nom']);
    $personnage->setPv($tempPersonnage['pv']);
    $personnage->setAtk($tempPersonnage['atk']);
    $personnage->setDef($tempPersonnage['def']);
    $personnage->setExp($tempPersonnage['exp']);
    $personnage->setLevel($tempPersonnage['level']);
    $personnage->setMaxpv($tempPersonnage['maxpv']);
    $personnage->setMaxdef($tempPersonnage['maxdef']);
    $personnage->setMaxatk($tempPersonnage['maxatk']);
    $personnage->setId($tempPersonnage['id']);
    return $personnage;
}

// The function menuJoueur takes a gestionDAO object and a character object as parameters
function menuJoueur($gestionDAO, $personnage){
    
    // Updates the character information using the updatePerso function
    updatePerso($gestionDAO, $personnage);
    
    // Clears the console
    popen('cls','w');
    
    // Displays the menu options
    echo ("What would you like to do? \n1-View your stats \n2-View your inventory \n3-Move to the next room \n4-Quit");
    
    // Reads user input
    $choice = readline("");
    
    // Uses a switch statement to perform an action based on the user's choice
    switch ($choice) {
        case '1':
            // Displays the character statistics using the afficherPersonnage function
            afficherPersonnage($gestionDAO, $personnage);
            break;
        case '2':
            // Displays the character's inventory using the voirInventaire function
            voirInventaire($gestionDAO, $personnage);
            break;
        case '3':
            // Advances the character to the next room using the avancerSalle function
            avancerSalle($gestionDAO, $personnage);
            break;
        case '4';
            // Exits the game using the exitGame function
            exitGame();
            break;
        default:
            // If the user's choice is not recognized, redisplays the menu
            menuJoueur($gestionDAO, $personnage);
            break;
    }
}


// CHARACTER AND ITEM STATS
function afficherPersonnage($gestionDAO, $personnage){
    updatePerso($gestionDAO, $personnage);
    popen('cls', 'w');
    echo 'Nom : ' . $personnage->getName() . "\n";
    echo 'PV : ' . $personnage->getPv() . "\n";
    echo 'Attaque : ' . $personnage->getAtk() . "\n";
    echo 'Défense : ' . $personnage->getDef() . "\n";
    echo 'Expérience : ' . $personnage->getExp() . "\n";
    echo 'Niveau : ' . $personnage->getLevel() . "\n";
    readline("Appuyer sur entrer pour continuer");
    menuJoueur($gestionDAO, $personnage);
}

// DISPLAY INVENTORY
function voirInventaire($gestionDAO, $personnage){
    popen('cls', 'w');
    $porters = $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    if($porters == null){
        echo "Vous n'avez pas d'objets !\n";
        readline("Appuyez sur Entrée");
        menuJoueur($gestionDAO, $personnage);
    }
    echo "Vos objets sont : \n\n";
    foreach($porters as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    
    echo "\n\nQue souhaitez-vous faire ?\n\n
        1 - Jeter un objet\n
        2- Retour\n\n";
    $choix = (INT)readline("Entrez votre choix : ");
    if($choix < 1 || $choix > 2){
        voirInventaire($gestionDAO, $personnage);
    }
    switch($choix){
        case 1 :
            jeterObjet($gestionDAO, $personnage);
            break;
        case 2 :
            menuJoueur($gestionDAO, $personnage);
            break;
    }
    voirInventaire($gestionDAO, $personnage);
}


// Function to discard an object
function jeterObjet($gestionDAO, $personnage){
    // Clear the console screen
    popen('cls', 'w');
    
    // Display prompt for choosing an object to discard
    echo "Quel objet voulez vous jetter?\n\n";
    
    // Get and display the list of objects carried by the character
    $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    
    foreach($gestionDAO['porterDAO']->getPorter() as $key => $porter){
        // Get the details of the object
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        
        // Display the object information
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    
    // Display the option to go back
    echo $key+2 . " - Back\n\n";
    
    // Prompt the user for the choice of the object to discard
    $choix = (int)readline("Saisissez le numéro de l'objet que vous souhaitez éliminer: ");
    
    // Validate the user's choice
    if($choix < 1 || $choix > count($gestionDAO['porterDAO']->getPorter())+1){
        // If the choice is invalid, recursively call the function
        jeterObjet($personnage);
    }

    // If the choice is to go back, call the "voirInventaire" function
    if ($choix == count($gestionDAO['porterDAO']->getPorter())+1) {
        voirInventaire($personnage);
    }

    // Get the details of the chosen object
    $objet = $gestionDAO['objetDAO']->getObjet($gestionDAO['porterDAO']->getPorter()[$choix-1]['idObj']);
    
    // Delete the object from the character's inventory
    $gestionDAO['porterDAO']->deletePorter($gestionDAO['porterDAO']->getPorter()[$choix-1]['id']);
    
    // Display a message indicating that the object has been discarded
    echo "tu as jeter l'objet " . $objet['nom'] . "\n\n";
    
    // Prompt the user to press Enter to continue
    readline("tapez entree pour continuer");
}



// LEVEL-UP AND STATS UPGRADE


// Function to update the character's attributes and apply the effects of carried objects
function updatePerso($gestionDAO, $personnage){
    // Reset character attributes to their maximum values
    $personnage->setPv($personnage->getMaxpv());
    $personnage->setDef($personnage->getMaxdef());
    $personnage->setAtk($personnage->getMaxatk());
    $personnage->setDodge(0);
    
    // Update the character's attributes in the database
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);

    // Get the list of objects carried by the character
    $porters = $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());

    // Iterate through each carried object
    foreach($porters as $key => $porter){
        // Get details of the object
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        
        // Check if the character has the required level to use the object
        if($objet['niveauMinimum'] > $personnage->getLevel()){
            // Display a message if the character does not have the required level
            echo "You do not have the required level to use the object " . $objet['nom'] . "\n\n";
            readline("Press Enter to continue");
        }else{
            // Apply the effects of the object on the character's attributes
            $personnage->setPv($personnage->getPv() + $objet['heal']);
            $personnage->setAtk($personnage->getAtk() + $objet['atk']);
            $personnage->setDef($personnage->getDef() + $objet['def']);
            $personnage->setDodge($personnage->getDodge() + $objet['dodge']);
        }
    }
    
    // Update the character's attributes in the database after applying object effects
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
}


// INCREASE PLAYER LEVEL
function levelUp($gestionDAO, $personnage){
    // Check if the character has enough experience to level up
    if($personnage->getExp() < $personnage->getLevel()*200){
        echo "Vous n'avez pas assez d'expérience pour monter en niveau!\n";
        readline("Appuyez sur la touche Entrée pour continuer");
        menuPlayer($gestionDAO, $personnage);
    }

    // Increase the character's level and reset their experience
    $personnage->setLevel($personnage->getLevel() + 1);
    $personnage->setExp(0);

    // Increase the character's statistics
    $personnage->setMaxpv($personnage->getMaxpv() + 10);
    $personnage->setMaxdef($personnage->getMaxdef() + 5);
    $personnage->setMaxatk($personnage->getMaxatk() + 5);

    // Update the character in the database
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
    
    // Update the display of the character
    updateCharacter($personnage);

    // Display a message indicating that the character has leveled up
    echo "Vous êtes passé au niveau supérieur ! Vos statistiques ont été augmentées!\n\n";

    // Check if the character reaches level 3 to choose a new skill
    if($personnage->getLevel() == 3 ){
        echo "Vous pouvez choisir une nouvelle compétence ! \nChoisissez une compétence parmi les suivantes:\n";

        // Get available skills at level 3 from the database
        $competences = $gestionDAO['competenceDAO']->getCompetencesByMinimumLevel(3);

        // Display available skills
        foreach($competences as $key => $competence){
            echo $key+1 . " - " . $competence['nom'] . " - " . $competence['desc'] . "\n";
        }
        $choice = (int)readline("Votre choix: ");
    }


    readline("Appuyer sur entrer pour continuer");
    menuJoueur($gestionDAO, $personnage);
}

// GIVES MONSTER XP TO THE PLAYER
function takeExp($gestionDAO, $personnage, $exp){
    // Add the gained experience to the character's current experience
    $exp += $personnage->getExp();
    
    // Set the character's experience to the total accumulated experience
    $personnage->setExp($exp);

    // Update the character in the database with the new experience value
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
}

// ACTION SALLE
function avancerSalle($gestionDAO, $personnage){
    popen('cls', 'w');

    echo "Vous avancez vers la salle";
    $niveau = $personnage->getLevel();
    $ennemie = rand(1,5);
    $piege = rand(0,1);
    $enigme = rand(0,1);
    $marchand = rand(0,1);
    
    $salle = new Salle ($niveau, $ennemie, $piege, $enigme, $marchand);

    readline("Appuyer sur entrer pour continuer");

    if($salle->getEnigme() > 0){
        doEnigme($personnage, $gestionDAO);
    }

    if($salle->getPiege() > 0){
        activerPiege($gestionDAO, $personnage);
    }
    if($salle->getEnnemie() > 0){
        $listeMonstres = [];
        $monstres = showMonstre($gestionDAO, $personnage);
        for($i =0; $i<$salle->getEnnemie(); $i++){
            $random = rand(1, count($monstres));
            $monstre = $monstres[$random-1];
            array_push($listeMonstres, $monstre);
        }
        combatSalle($personnage, $listeMonstres, $gestionDAO);
        ouvrirCoffre($personnage, $gestionDAO);
    }
    if($salle->getMarchand() > 0){
        marchander($personnage, $gestionDAO['objetDAO']);
    }
    menuJoueur($gestionDAO['personnageDAO'], $personnage);
}

// DISPLAY MONSTERS ACCORDING TO PLAYER LEVEL
function showMonstre($gestionDAO, $personnage){
    $monstres = $gestionDAO['monstreDAO']->getAllMonstres();
    $niveau = $gestionDAO['personnageDAO']->getPersonnageNiveau($personnage->getId());
    $monstreArray = [];
    
    foreach ($monstres as $monstre) {
        if($monstre['exp'] <= 100 * $niveau){
            $monstreObj = new Monstre($monstre['nom'], $monstre['pv'], $monstre['atk'], $monstre['descAtk'], $monstre['def'], $monstre['exp']);
            array_push($monstreArray, $monstreObj);
        }
    }
    return $monstreArray;
}

// ENIGMA MANAGEMENT
function doEnigme($personnage, $gestionDAO) {
    popen('cls', 'w');
    echo "Vous entrez dans la salle et voyez une énigme. \n\n";
    $random = rand(1, count($gestionDAO['enigmeDAO']->getEnigmes()));
    $enigme = $gestionDAO['enigmeDAO']->getEnigme($random);
    echo $enigme['intitule'] . "\n\n";
    $reponse = readline("Votre réponse : ");
    if(strtolower($reponse) == strtolower($enigme['reponse'])){
        echo "Bonne réponse !\n\n";
        $personnage->setExp($personnage->getExp() + 100);
        $personnage->setPv($personnage->getPv() + 10);
        echo "Vous gagnez 10 PV et 100 exp.\n";
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        $tempPersonnage = $gestionDAO['personnageDAO']->getPersonnage($personnage->getId());
        readline("Appuyer sur entrer pour continuer");
    }
    else{
        echo "Mauvaise réponse !\n\n";
        readline("Appuyer sur entrer pour continuer");
    }
}

// TRUNK MANAGEMENT
function ouvrirCoffre($personnage, $gestionDAO){
    popen('cls', 'w');
    $isMimic = rand(0,10);
    $choix = (int)readline("Voulez-vous ouvrir le coffre ?\n1 - Oui\n2 - Non\n\nVotre choix : ");
    if($choix < 1 || $choix > 2){
        ouvrirCoffre($personnage);
    }
    if($choix == 1){
        if($isMimic == 10){
            echo "Le coffre était un Mimic !\n\nVous perdez " . $personnage->getNiveau() * 10 . "PV\n\n";
            $personnage->setPv($personnage->getPv() - $personnage->getNiveau() * 10);
            readline("Appuyer sur entrer pour continuer");
        }else{
            echo "Le coffre contient : \n\n";
            $gestionDAO['objetDAO']->getObjets();
            $marchand = [];
            $random = rand(0, count($gestionDAO['objetDAO']->getObjets()));
            $objet = $gestionDAO['objetDAO']->getObjet($random);
            array_push($marchand, $objet);
            echo "1 - " . $objet['nom'] . "\n";
            $objet = creationObjet($gestionDAO);
            array_push($marchand, $objet);
            echo "2 - " . $objet['nom'] . "\n";
            $personnage->setExp($personnage->getExp() + ($personnage->getNiveau() * 10));
            echo "Vous gagnez " . $personnage->getNiveau() * 10 . " points d'expérience\n\n";
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
            echo "Choisissez un objet à prendre entre les deux :";
            $choix = (int)readline("Votre choix : ");
            if($choix < 1 || $choix > 2){
                echo "Le coffre se referme de manière violente, bloquant l'accès à son contenu jusqu'au prochain aventurier\n\n";
            }else{                
                if(count($gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId())) >= 10){
                    echo "Vous n'avez pas assez de place dans votre inventaire !\nVeuillez retirer un objet\n\n";
                    readline();
                    jeterObjet($gestionDAO, $personnage);
                }
                $objet = $gestionDAO['objetDAO']->getObjet($marchand[$choix-1]['idObj']);
                $porter = new Porter($personnage->getId(), $objet['id']);
                $gestionDAO['porterDAO']->addPorter($porter);
                echo "Vous avez pris l'objet " . $objet['nom'] . "\n\n";
            }
            readline("");
        }
    }
}

// TRAP MANAGEMENT
function activerPiege($gestionDAO, $personnage){
    popen('cls', 'w');
    
    $dodge = $personnage->getDodge();
    echo "Vous avez activé un piège.\n";
    if($dodge == 0){
        $personnage->setPv($personnage->getPv() - $personnage->getLevel() * 10);
        echo "Vous n'avez pas réussi à esquiver le piège.\n";
        echo "Vous perdez ". ($personnage->getLevel() * 10) ." points de vie, il vous reste : " . $personnage->getPv() . "\n";
    } else {
        echo "Vous avez réussi à esquiver le piège`\n";
    }
    readline("Appuyer sur entrer pour continuer");
}

// MERCHANT MANAGEMENT
function marchander($personnage, $gestionDAO){
    popen('cls', 'w');
    echo "Vous entrez dans la boutique du marchand. \nIl vous propose de troquer des objets. \n\nSes objets en vente sont : \n\n";
    $gestionDAO['objetDAO']->getObjets();
    $marchand = [];
    $echange = [];
    for($i = 0; $i < 4; $i++){
        $random = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        $objet = $gestionDAO['objetDAO']->getObjet($random);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . " - Niveau requis : " . $objet['niveauMinimum'] . "\n";

        $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        while ($random = $randomEchange || (
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['nom'] == $gestionDAO['objetDAO']->getObjet($random)['nom'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['heal'] == $gestionDAO['objetDAO']->getObjet($random)['heal'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['atk'] == $gestionDAO['objetDAO']->getObjet($random)['atk'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['def'] == $gestionDAO['objetDAO']->getObjet($random)['def'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['dodge'] == $gestionDAO['objetDAO']->getObjet($random)['dodge'])){
            $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        }
        $objetEchange = $gestionDAO['objetDAO']->getObjet($randomEchange);
        echo "Contre : " . $objetEchange['nom'] . " - " . $objetEchange['desc'] . " - Niveau requis : " . $objetEchange['niveauMinimum'] . "\n\n";
        array_push($echange, $objetEchange);
    }
    for ($i=0; $i < 2; $i++) { 
        $objet = creationObjet($gestionDAO);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . " - Niveau requis : " . $objet['niveauMinimum'] . "\n";

        $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        while ($random = $randomEchange){
            $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        }
        $objetEchange = $gestionDAO['objetDAO']->getObjet($randomEchange);
        echo "Contre : " . $objetEchange['nom'] . " - " . $objetEchange['desc'] . " - Niveau requis : " . $objetEchange['niveauMinimum'] . "\n\n";
        array_push($echange, $objetEchange);
    }
    
    echo "\n\nVous pouvez échanger : \n\n";
    $listeObjets = $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    $mesObjetsAEchanger = [];
    $index = 0;
    foreach($listeObjets as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        foreach($objetEchange as $i => $echange){
            if($echange['nom'] == $objet['nom'] &&
                    $echange['heal'] == $objet['heal'] &&
                    $echange['atk'] == $objet['atk'] &&
                    $echange['def'] == $objet['def'] &&
                    $echange['dodge'] == $objet['dodge']) {
                echo $key+1 . " - Votre | " . $objet['nom'] . " - Contre | " . $marchand[$i]['nom'] . "\n";
                array_push($mesObjetsAEchanger, $objet);
                $index++;
            }
        }
    }
    if($index == 0){
        echo "Vous n'avez pas d'objet à échanger\n\n";
        readline();
        menuJoueur($gestionDAO, $personnage);
    }else{
        echo $key+2 . " - Continuer votre route\n\n";

        $choix = (int)readline('Votre choix : ');
        if($choix < 1 || $choix > $key+2){
            echo "Le marchand n'a pas compris votre demande et s'en va.\n\n";
            readline();
            menuJoueur($gestionDAO, $personnage);
        }
        
        if($choix == $key+2){
            echo "Le marchand vous souhaite une bonne journée et s'en va.\n\n";
            readline();
            menuJoueur($gestionDAO, $personnage);
        }
        
        echo "Vous avez choisi l'objet " . $objetEchange[$choix-1]['nom'] . "\n\n";
        
        $gestionDAO['porterDAO']->deletePorter($mesObjetsAEchanger[$choix-1]['id']);
        $porter = new Porter($personnage->getId(), $objetEchange[$choix-1]['id']);
        $gestionDAO['porterDAO']->addPorter($porter); 

    } 
}

// CREATE OBJECTS AND MANAGE TYPES
function creationObjet($gestionDAO){
    $type = random(0,13);
    $heal = 0;
    $atk = 0;
    $def = 0;
    $dodge = 0;
    $isConsumable = 0;
    $isPoison = 0;
    
    $randNiveau = rand(1,10);
    $niveauMinimum = floor(($randNiveau*$randNiveau)/10);

    if($type <=3){
        $caracteristique = random(0,4);
        if($caracteristique == 0){
            $nom = "Potion de soin";
            $stat = random(1,5);
            $heal = $stat * 10;
            $desc = "Soigne de " . $heal . " PV";
        }else if($caracteristique == 1){
            $nom = "Potion d'attaque";
            $stat = random(1,5);
            $atk = $stat * 2;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 2){
            $nom = "Potion de défense";
            $stat = random(1,5);
            $def = $stat * 2;
            $desc = "Augmente la défense de " . $def;
        }else if($caracteristique == 3){
            $nom = "Potion d'esquive";
            $dodge = 1;
            $desc = "Augmente l'esquive";
        }else{
            $nom = "Potion de poison";
            $isPoison = 1;
            $desc = "Empoisonne l'ennemi pendant 3 tours";
        }
        $isConsumable = 1;
    }else if($type >3 && $type <=6){
        $caracteristique = random(0,2);
        $stat = random(1,5);
        if($caracteristique == 0){
            $nom = "Épée";
            $atk = $stat * 2;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 1){
            $nom = "Hache";
            $atk = $stat * 3;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 2){
            $nom = "Dague";
            $atk = $stat * 1;
            $desc = "Augmente l'attaque de " . $atk;
        }
        $stat = random(1,5);
        if($stat == 1) {
            $def = -5;
            $desc = "Augmente l'attaque de " . $atk . " - Maudit";
        }else if($stat == 2) {
            $heal = -10;
            $desc = "Augmente l'attaque de " . $atk . " - Maudit";
        }
    }else if ($type >6 && $type <= 9){
        $caracteristique = random(0,2);
            if($caracteristique == 0){
                $nom = "Bouclier";
                $stat = random(1,5);
                $def = $stat * 2;
                $desc = "Augmente la défense de " . $def;
            }else if($caracteristique == 1){
                $nom = "Armure";
                $stat = random(1,5);
                $def = $stat * 3;
                $desc = "Augmente la défense de " . $def;
            }else if($caracteristique == 2){
                $nom = "Casque";
                $stat = random(1,5);
                $def = $stat * 1;
                $desc = "Augmente la défense de " . $def;
            }
            $stat = random(1,5);
            if($stat == 1) {
                $atk = -5;
                $desc = "Augmente la défense de " . $def . " - Maudit";
            }else if($stat == 2) {
                $heal = -10;
                $desc = "Augmente la défense de " . $def . " - Maudit";
            }
    }else if ($type == 9 || $type == 10){
        $caracteristique = random(0,1);
            if($caracteristique == 0){
                $nom = "Anneau";
                $stat = random(1,5);
                $dodge = 1;
                $desc = "Augmente l'esquive";
            }else if($caracteristique == 1){
                $nom = "Amulette";
                $stat = random(1,5);
                $dodge = 1;
                $desc = "Augmente l'esquive et la vie maximale de " . $stat * 10 . " PV";
            }
            $stat = random(1,5);
            if($stat == 1) {
                $atk = -5;
                $desc = "Augmente l'esquive de " . $dodge . " - Maudit";
            }else if($stat == 2) {
                $heal = -10;
                $desc = "Augmente l'esquive de " . $dodge . " - Maudit";
            }
    }else{
        $caracteristique = random(0,4);
        if($caracteristique == 0){
            $nom = "Hache de guerre légendaire";
            $stat = random(5,8);
            $atk = $stat * 5;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 1){
            $nom = "Armure légendaire";
            $stat = random(3,5);
            $def = $stat * 5;
            $desc = "Augmente la défense de " . $def;
        }else if($caracteristique == 2){
            $nom = "Anneau de défense légendaire";
            $stat = random(2,3);
            $dodge = $stat * 5;
            $desc = "Augmente l'esquive";
        }else if($caracteristique == 3){
            $nom = "Amulette légendaire";
            $stat = random(5,8);
            $dodge = 1;
            $desc = "Augmente l'esquive et la vie maximale de " . $stat * 10 . " PV";
        }else if($caracteristique == 4){
            $nom = "Potion légendaire";
            $stat = random(1,3);
            $heal = $stat * 50;
            $isConsumable = 1;
            $desc = "Soigne de " . $heal . " PV";
        }
    }

    $objet = new Objet($nom, $desc, $heal, $atk, $def, $dodge, $isConsumable, $niveauMinimum);
    $gestionDAO['objetDAO']->addObjet($objet);
    $id = $gestionDAO['objetDAO']->getLastObjetId();
    $objet = $gestionDAO['objetDAO']->getObjet($id);
    return $objet;
}

// FLOOR COMBAT
function combatSalle( $personnage, $listeMonstres, $gestionDAO){
    echo "Vous êtes attaqué par " . count($listeMonstres) . " monstre" . ((count($listeMonstres)!=1) ? "s" : "") ."!\n";
    $exp = 0;
    foreach($listeMonstres as $monstre){
        $exp += $monstre->getExp();
    }


    while ($personnage->getPv() > 0 && count($listeMonstres) > 0){
        if($personnage->getIsDefending() == true){
            $personnage->setIsDefending(false);
        }
        echo "\nQue voulez-vous faire ?\n";
        echo "1. Attaquer\n";
        echo "2. Se défendre\n";
        echo "3. Utiliser un objet\n";
        $choix = readline("Votre choix : ");
        switch ($choix) {
            case 1:
                $listeMonstres = randAtkPerso($gestionDAO, $personnage, $listeMonstres);
                foreach($listeMonstres as $monstre){
                    $ennemiechoice = rand(1, 4);
                    if ($ennemiechoice > 1){
                        estEmpoisoné($gestionDAO,$monstre);
                        randAtkMonstre($gestionDAO, $personnage, $monstre);

                    } else {
                        estEmpoisoné($gestionDAO,$monstre);
                        echo $monstre->getNom() . " se défend!\n";
                        $monstre->setIsDefending(true);
                    }
                }
                
                break;
            case 2:
                $personnage->setIsDefending(true);
                foreach($listeMonstres as $monstre){
                    estEmpoisoné($gestionDAO,$monstre);
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                }
                break;
            case 3:
                $listeMonstres = utiliserObjet($gestionDAO, $personnage, $listeMonstres);
                foreach($listeMonstres as $monstre){
                    estEmpoisoné($gestionDAO,$monstre);
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                }
                break;
            default:
                echo "Choix invalide\n";
                break;
        }
    } if ($personnage->getPv() <= 0){
        echo "Le personnage est mort, il a perdu la partie.";
    }elseif (count($listeMonstres)){
        echo "Le monstre est mort, le personnage a gagné la partie.";
        takeExp($gestionDAO, $personnage, $exp);
        levelUp($gestionDAO, $personnage);
    }
}

// ATTACK THE CHARACTER RANDOMLY AND CHECK THE MONSTER'S DEFENSE
function randAtkPerso($gestionDAO, $personnage, $listeMonstres){
    $listeMonstres = array_values( $listeMonstres );
    $txt = "Vous attaquez ! Vous profitez d'un bonus de " . $personnage->getAtk();
    
    echo "Selectionnez le monstre à attaquer :\n";
    foreach($listeMonstres as $key => $monstre){
        echo $key+1 . " - " . $monstre->getNom() . "\n";
    }
    $choix = (int)readline('Numéro du monstre à attaquer : ');
    if($choix < 1 || $choix > count($listeMonstres)){
        randAtkPerso($gestionDAO, $personnage, $listeMonstre);
    }
    $monstre = $listeMonstres[$choix-1];

    $dice = lancerDe($txt);

    switch ($dice) {
        case 1:
            echo "Le personnage a raté son attaque (échec critique).\n";
            $personnage->setPv($personnage->getPv() - floor( $personnage->getAtk() / 2));
            $gestionDAO['personnageDAO']->updatePerso($personnage->getId(), $personnage);
            break;
        case 20:
            echo "Le personnage a fait un coup critique !\n";
            $monstre->setPv($monstre->getPv() - (($personnage->getAtk() * 2)));
            echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
            break;
        default:
            if($dice + $personnage->getAtk() > $monstre->getDef() ) {
                if($monstre->setIsDefending(true)){
                    defensemonstre($gestionDAO, $personnage, $monstre);
                } else {
                    $monstre->setPv($monstre->getPv() - ($personnage->getAtk()));
                    echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
                    
                }
            }else{
                echo "Le monstre a bloqué l'attaque du personnage.\n";
            }
            
            break;
    }
    if($monstre->getPv() <= 0){
    unset($listeMonstres[$choix-1]);
    }
    readline("Appuyer sur entrer pour continuer");
    return $listeMonstres;
}

// POISON STATUS FOR POISON POTION
function estEmpoisoné($gestionDAO,$monstre){
    if ($monstre->getpoisoned() != 0){
        $monstre->setPv($monstre->getPv() - 5);
        $monstre->setpoisoned($monstre->getpoisoned() - 1);
        echo "Le monstre est empoisonné, il lui reste " . $monstre->getPv() . " points de vie." ;
    }   
}

// PLAYER DEFENSE MANAGEMENT
function defensePerso($gestionDAO, $personnage, $monstre) {
    
    if ($personnage->getDef() == 0) {
        echo "Le personnage n'a plus de défense. ";
        $personnage->setPv($personnage->getPv() - $monstre->getAtk());
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
    } else {
        $personnage->setDef($personnage->getDef() - 1);
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        echo "Le personnage a subi une attaque. Nouvelle valeur de défense : {$personnage->getDef()}\n";
    }
}

// ATTACK THE MONSTER RANDOMLY AND CHECK THE CHARACTER'S DEFENSE
function randAtkMonstre($gestionDAO, $personnage, $monstre){
    $txt = "Attaque ennemie ! Il profite d'un bonus de " . $monstre->getAtk();
    $dice = lancerDe($txt);
    switch($dice){
        case 1:
            echo "Le monstre a raté son attaque.\n";
            $monstre->setPv($monstre->getPv() - floor($monstre->getAtk() / 2));
            echo "Le monstre prend " . floor($monstre->getAtk() / 2) . " dégats.\n";
            break;
        case 20:
            echo "Le monstre a fait un coup critique !\n";
            $personnage->setPv($personnage->getPv() - (($monstre->getAtk() * 2)));
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
            echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
            break;
    default:
        if($personnage->getIsDefending()){
            defensePerso($gestionDAO, $personnage, $monstre);
        } else {
            $personnage->setPv($personnage->getPv() - ($monstre->getAtk()));
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getID(), $personnage);
            echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
        }
        break;
    }
    readline("Appuyer sur entrer pour continuer");
}

// MONSTER DEFENSE MANAGEMENT
function defensemonstre($gestionDAO, $personnage, $monstre){
    if ($monstre->getDef() <= 0) {
        echo "Le monstre n'a plus de défense. ";
        $monstre->setPv($monstre->getPv() - $personnage->getAtk());
        echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
    } else {
        $monstre->setDef($monstre->getDef() - 1);
        echo "Le monstre a contré une attaque. Nouvelle valeur de défense : {$monstre->getDef()}\n";
    }
}

// OBJECT USAGE MANAGEMENT
function utiliserObjet($gestionDAO, $personnage, $listeMonstres){
    $consumables = $gestionDAO['objetDAO']->getObjetsByIsConsumableByPersonnage($personnage->getId());
    if($consumables == null){
        echo "Vous n'avez pas d'objet consommable\n\n";
        readline();
        menuJoueur($gestionDAO, $personnage);
    }else{
        echo "Quel objet voulez-vous utiliser ?\n";
        foreach($consumables as $key => $objet){
            echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
        }
    }
    
    $choix = (int)readline("Votre choix : ");
    if($choix < 1 || $choix > count($consumables)){
        utiliserObjet($gestionDAO, $personnage);
    }

    $objet = $gestionDAO['objetDAO']->getObjet($consumables[$choix-1]['idObj']);

    if($objet['niveauMinimum'] > $personnage->getLevel()){
        echo "Vous n'avez pas le niveau requis pour utiliser l'objet " . $objet['nom'] . "\n\n";
        readline("Appuyer sur entrer pour continuer");
        utiliserObjet($gestionDAO, $personnage);
    }

    if($objet['heal'] > 0){
        $personnage->setPv($personnage->getPv() + $objet['heal']);
        echo "Vous avez utilisé l'objet " . $objet['nom'] . " et vous avez récupéré " . $objet['heal'] . " points de vie\n\n";
    }
    if($objet['atk'] > 0){
        echo "Selectionnez le monstre à attaquer :\n";
        foreach($listeMonstres as $key => $monstre){
            echo $key+1 . " - " . $monstre->getNom() . "\n";
        }
        $choix = (int)readline('Numéro du monstre à attaquer : ');
        if($choix < 1 || $choix > count($listeMonstres)){
            randAtkPerso($gestionDAO, $personnage, $listeMonstre);
        }
        $monstre = $listeMonstres[$choix-1];
        $monstre->setPv($monstre->getPv() - $objet['atk']);
        echo "Vous avez utilisé l'objet " . $objet['nom'] . " et vous avez fait " . $objet['atk'] . " points de dégâts\n\n";
    }
    if($objet['def'] > 0){
        $personnage->setDef($personnage->getDef() + $objet['def']);
        echo "Vous avez utilisé l'objet " . $objet['nom'] . " et vous avez gagné " . $objet['def'] . " points de défense\n\n";
    }
    if($objet['dodge'] > 0){
        $personnage->setDodge($personnage->getDodge() + $objet['dodge']);
        echo "Vous avez utilisé l'objet " . $objet['nom'] . " et vous avez gagné en esquive\n\n";
    }

    if($objet->isPoison()){
        echo "Selectionnez le monstre à attaquer :\n";
        foreach($listeMonstres as $key => $monstre){
            echo $key+1 . " - " . $monstre->getNom() . "\n";
        }
        $choix = (int)readline('Numéro du monstre à attaquer : ');
        if($choix < 1 || $choix > count($listeMonstres)){
            randAtkPerso($gestionDAO, $personnage, $listeMonstre);
        }
        $monstre = $listeMonstres[$choix-1];
        $monstre->setpoisoned(3);
        echo "Vous avez utilisé l'objet " . $objet['nom'] . " et le monstre est empoisonné\n\n";
    }

    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);

    $gestionDAO['porterDAO']->deletePorter($objet['idObj']);
    if(isset($choix)){
        if($monstre->getPv() <= 0){
            unset($listeMonstres[$choix-1]);
        }
    }
    return $listeMonstres;
}


// END OF GAME
function victoireJoueur($personnage){
    popen('cls', 'w');
    if($personnage->getLevel() >= 10){
        echo "Vous avez gagné la partie !";
    }
    else{
        echo "Vous avez gagné le combat !";
    }
}

function missionAccomplie($personnage){
    popen('cls', 'w');
    echo "Vous avez gagné la partie !";
}

// DEATH OF THE PLAYER
function mortJoueur($personnage){
    popen('cls', 'w');
    echo "Vous avez perdu la partie !";
}

// CLOSE THE GAME
function exitGame(){
    exit;
}

// LAUNCH OF DEE
function affichageDe($value, $i, $txt) {
    echo "Lancement du dé...\n";
    echo $txt . "\n";
    $d1 = "\e[0;34m
            ,:::,
       ,,,:;  :  ;:,,,
   ,,,:       :       :,,,
,,;...........:...........;,,
; ;          ;';          ; ;
;  ;        ;   ;        ;  ;
;   ;      ;     ;      ;   ;
;    ;    ;       ;    ;    ;
;     ;  ;    \e[0;37m\033[1m".$value."\033[0m\e[0;34m   ;  ;     ;
;      ;:...........:;      ;
;     , ;           ; ,     ;
;   ,'   ;         ;   ',   ;
'';'      ;       ;      ';''
   ''';    ;     ;    ;'''         
       ''':;;   ;;:'''
            ':::'\n\n\e[0;37m";

    $d2 = "\e[0;34m
            ,:::,
       ,,,:;;   ;;:,,,
   ,,,;    ;     ;    ;,,,
,,;,      ;       ;      ,;,,   
;   ',   ;         ;   ,'   ;
;     ' ;           ; '     ;
;      ;:...........:;      ;
;     ;  ;    \e[0;37m\033[1m".$value."\033[0m\e[0;34m   ;  ;     ;
;    ;    ;       ;    ;    ;
;   ;      ;     ;      ;   ;
;  ;        ;   ;        ;  ;
; ;          ;';          ; ;
'';...........:...........;''
   ''':       :       :'''
       ''':;  :  ;:'''
            ':::'\n\n\e[0;37m";
    if($i % 2 == 0){
        echo $d1;
    }else{
        echo $d2;
    }
}

function lancerDe($txt){
    for($i = 1; $i < 22; $i++){
        $rand = rand(1, 20);
        
        popen('cls', 'w');
        affichageDe($rand, $i, $txt);
        $time = sqrt($i)*100*$i;
        usleep($i*$i*1000);
    }
    sleep(2);
    return $rand;
}

// lancerDe();
menu($gestionDAO);
?>