<?php
require_once "./Classes/DB.php";
/**
 * Commencez par importer le fichier sql live.sql via PHPMyAdmin.
 * 1. Sélectionnez tous les utilisateurs.
 * 2. Sélectionnez tous les articles.
 * 3. Sélectionnez tous les utilisateurs qui parlent de poterie dans un article.
 * 4. Sélectionnez tous les utilisateurs ayant au moins écrit deux articles.
 * 5. Sélectionnez l'utilisateur Jane uniquement s'il elle a écris un article ( le résultat devrait être vide ! ).
 *
 * ( PS: Sélectionnez, mais affichez le résultat à chaque fois ! ).
 */

$stmt = DB::getInstance()->prepare("SELECT * FROM user");

if($stmt->execute()) {
    echo "<pre>";
    print_r($stmt->fetchAll());
    echo "</pre>";
}

$stmt = DB::getInstance()->prepare("SELECT * FROM article");

if($stmt->execute()) {
    echo "<pre>";
    print_r($stmt->fetchAll());
    echo "</pre>";
}

$stmt = DB::getInstance()->prepare("SELECT * FROM user WHERE id = ANY (SELECT user_fk FROM article WHERE contenu LIKE '%poterie%')");

if($stmt->execute()) {
    echo "<pre>";
    print_r($stmt->fetchAll());
    echo "</pre>";
}

$stmt = DB::getInstance()->prepare("SELECT * FROM user WHERE id = ANY (SELECT user_fk FROM article HAVING COUNT(user_fk) >= 2)");

if($stmt->execute()) {
    echo "<pre>";
    print_r($stmt->fetchAll());
    echo "</pre>";
}

$stmt = DB::getInstance()->prepare("SELECT * FROM user WHERE id = exists (SELECT user_fk FROM article)");

if($stmt->execute()) {
    echo "<pre>";
    print_r($stmt->fetchAll());
    echo "</pre>";
}