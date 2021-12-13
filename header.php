<?php
session_start();
// Connexion BDD utilisateurs
$bdd = mysqli_connect('localhost', 'root', 'root', 'blog');
mysqli_set_charset($bdd, 'utf-8');


@$loogin = $_SESSION['user'];

$queryUser = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE login = '$loogin'");
$resultUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);

// Categorie
$sql = mysqli_query($bdd, "SELECT categories.* FROM categories ");
$result_cat = mysqli_fetch_all($sql, MYSQLI_ASSOC);

$sql_recup = mysqli_query($bdd, "SELECT categories.*, articles.id_categorie FROM categories INNER JOIN articles WHERE categories.id = articles.id_categorie;");
$result_article_tri = mysqli_fetch_all($sql_recup, MYSQLI_ASSOC);

// @$get = $_GET['categorie'];


?>
<header class="menu">
    <nav class="menuNav">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="articles.php">Articles</a></li>
            <li>
                <ul>
                    <p>Catégories</p>
                    <?php foreach ($result_cat as $cat) { ?>
                        <a href="articles.php?categorie=<?= $cat['nom'] ?>"><?= $cat['nom'] ?> </a>
                        <!-- <li>
                        <a href="article.php?id='<?php $cat['id'] ?>'"><?php echo $cat['nom']; ?></a> -->
                        <?php
                        ?>
                </ul>
            </li>
        <?php } ?>
        </li>

        <!-- Si l'user n'est pas connecté -->
        <?php if (!isset($loogin)) { ?>
            <li>
                <a href="inscription.php">Inscription</a>
            </li>
            <li>
                <a href="connexion.php">Connexion</a>
            </li>
        <?php } ?>


        <!-- Si l'user est connecté -->
        <?php if (isset($loogin)) { ?>
            <li>
                <a href="profil.php">Profil</a>
            </li>
            <li>
                <form action="deconnexion.php" method="POST">
                    <button name="deconnexion">Deconnexion</button>
                </form>
            </li>
        <?php } ?>

        <!-- SI admin ou modo -->
        <?php
        if (@$resultUser[0]["id_droits"] == "1337" || @$resultUser[0]["id_droits"] == "42") {
        ?>
            <li class="nav-item">
                <a href="creer-articles.php">Créer articles</a>
            </li>
        <?php }; ?>
        <?php
        if (@$resultUser[0]["id_droits"] == "1337") {
        ?><li class="nav-item">
                <a href="admin.php">admin</a>
            </li>
        <?php }; ?>
        </ul>
    </nav>
</header>