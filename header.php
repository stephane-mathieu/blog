<?php
    session_start();
    // Connexion BDD utilisateurs
    $bdd = mysqli_connect('localhost', 'root', '', 'blog');
    mysqli_set_charset($bdd, 'utf-8');
  

$loogin = $_SESSION['user'];

$queryUser = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE login = '$loogin'");
$resultUser = mysqli_fetch_all($queryUser,MYSQLI_ASSOC);

?>
<nav>
    <li><a href="index.php">Accueil</a></li>
    <li>
        <select>
            <option value="">Catégories</option>
            <option value="">Italien</option>
            <option value="">Vietnamien</option>
            <option value="">Russe</option>
        </select>
    </li>

    <!-- Si l'user n'est pas connecté -->
    <li><a href="inscription.php">Inscription</a></li>
    <li><a href="connexion.php">Connexion</a></li>
    <li><a href="articles.php">Articles</a></li>
    <li><a href="deconnexion.php">deconnexion</a></li>

    <!-- Si l'user est connecté -->
    <li><a href="profil.php">Profil</a></li>
    <!-- Boutton se déconnecter -->

    <!-- SI admin ou modo -->
        <?php
            if($resultUser[0]["id_droits"] == "1337" || $resultUser[0]["id_droits"] == "42" ){
                ?><li class="nav-item">
                <a href="creer-articles.php">Créer articles</a>
        </li>
        <?php }; ?>
        <?php
            if($resultUser[0]["id_droits"] == "1337" || $resultUser[0]["id_droits"] == "42" ){
                ?><li class="nav-item">
                <a href="admin.php">admin</a>
        </li>
        <?php }; ?>
</nav>