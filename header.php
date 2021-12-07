<header>
    <nav>
        <ul>
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

            <!-- Si l'user est connecté -->
            <li><a href="profil.php">Profil</a></li>

            <!-- SI admin ou modo -->
            <li><a href="creer-articles.php">Créer articles</a></li>
            <li><a href="admin.php">admin</a></li>

            <li><button>Se deconnecter</button></li>
        </ul>
    </nav>
</header>