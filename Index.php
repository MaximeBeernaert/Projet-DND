<?php
include_once('./Config.php');
include_once('./Classes/Personnage.php');
include_once('./Classes/Monstre.php');
include_once ('./DAO/PersonnageDAO.php');
include_once ('./DAO/MonstreDAO.php');
include_once ('./DAO/SalleDAO.php');

$personnageDAO = new PersonnageDAO($db);
$monstreDAO = new MonstreDAO($db);
$salleDAO = new SalleDAO($db);




// $personnage = new Personnage('Yohann');
// $personnageDAO->addPersonnage($personnage);

// $monstre = new Monstre('Gobelin',10, 10, 'Attaque de base', 5, 10);
// $monstreDAO->addMonstre($monstre);



?>