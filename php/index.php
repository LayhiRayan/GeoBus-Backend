<?php
// Inclure les classes et services nécessaires
include_once './racine.php';
require_once RACINE . '/service/BusService.php';
require_once RACINE . '/service/ArretService.php';
require_once RACINE . '/service/CoordonneesService.php';
require_once RACINE . '/service/LigneBusService.php';
require_once RACINE . '/service/NotificationService.php';
require_once RACINE . '/service/TrajetService.php';
require_once RACINE . '/service/UsagerService.php';
require_once RACINE . '/service/AdministrateurService.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Gestion des Transports</title>
    </head>
    <body>
        <h1>Gestion des Transports</h1>
        <br> <hr>
        <!-- Ajouter un Bus -->
        <h2>Ajouter un Bus</h2>
        <form method="POST" action="controller/addBus.php">
            Matricule: <input type="text" name="matricule" required>
            État: <input type="text" name="etat" required>
            <button type="submit">Ajouter</button>
        </form>

        <!-- Liste des Bus -->
        <h2>Liste des Bus</h2>
        <table border="1">
            <tr><th>ID</th><th>Matricule</th><th>État</th><th>Actions</th></tr>
            <?php
            $bs = new BusService();
            foreach ($bs->findAll() as $bus) {
                echo "<tr><td>{$bus->getId()}</td><td>{$bus->getMatricule()}</td><td>{$bus->getEtat()}</td>
                  <td><a href='controller/deleteBus.php?id={$bus->getId()}'>Supprimer</a></td></tr>";
            }
            ?>
        </table>
        <br> <hr>

        <!-- Ajouter un Arrêt -->
        <h2>Ajouter un Arrêt</h2>
        <form method="POST" action="controller/AddArret.php">
            <label for="coordonnees">Coordonnées:</label>
            <input type="text" name="coordonnees" id="coordonnees" required>

            <label for="longitude">Longitude:</label>
            <input type="text" name="longitude" id="longitude" required>

            <label for="latitude">Latitude:</label>
            <input type="text" name="latitude" id="latitude" required>

            <label for="ligne_id">Ligne ID:</label>
            <input type="number" name="ligne_id" id="ligne_id" required>

            <button type="submit">Ajouter</button>
        </form>

        <!-- Liste des Arrêts -->
        <h2>Liste des Arrêts</h2>
        <table border="1">
            <tr><th>ID</th><th>Latitude</th><th>Longitude</th><th>Ligne Bus</th><th>Actions</th></tr>
            <?php
            $as = new ArretService();
            foreach ($as->findAll() as $arret) {
                echo "<tr>
                <td>{$arret->getId()}</td>
                <td>{$arret->getLatitude()}</td>
                <td>{$arret->getLongitude()}</td>
                <td>{$arret->getLigneBus()}</td>
                <td><a href='controller/deleteArret.php?id={$arret->getId()}'>Supprimer</a></td>
              </tr>";
            }
            ?>
        </table>




        <br> <hr>
        <!-- Ajouter des Coordonnées -->
        <h2>Ajouter des Coordonnées</h2>
        <form method="POST" action="controller/AddCoordonnees.php">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
            <button type="submit">Ajouter</button>
        </form>

        <h2>Liste des Coordonnées</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'service/CoordonneesService.php';

                $cs = new CoordonneesService();
                foreach ($cs->getAllCoordonnees() as $coordonnees) {
                    echo "<tr>
                    <td>{$coordonnees['id']}</td>
                    <td>{$coordonnees['date']}</td>
                    <td><a href='controller/deleteCoordonnees.php?id={$coordonnees['id']}'>Supprimer</a></td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>

        <br> <hr>
        <!--Ajouter une Ligne de Bus-->
        <h2>Ajouter une Ligne de Bus</h2>
        <form method="get" action="controller/AddLigneBus.php">
            <label for="code">Bus Line Code:</label>
            <input type="text" name="code" id="code" required>
            <button type="submit">Ajouter</button>
        </form>

        <!-- Liste des Lignes de Bus -->
        <h2>Liste des Lignes de Bus</h2>
        <?php
        require_once __DIR__ . '/service/LigneBusService.php';

        $ligneBusService = new LigneBusService();
        $lignes = $ligneBusService->getAllLignesBus();
        ?>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Supprimer</th> 
            </tr>

            <?php foreach ($lignes as $ligne): ?>
                <tr>
                    <td><?= htmlspecialchars($ligne['id']) ?></td>
                    <td><?= htmlspecialchars($ligne['code']) ?></td>
                    <td>
                        <a href="controller/DeleteLigneBus.php?id=<?= htmlspecialchars($ligne['id']) ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>





        <br> <hr>
        <!-- Ajouter une Notification -->
        <h2>Ajouter une Notification</h2>
        <form method="post" action="controller/AddNotification.php">
            <label>Message:</label>
            <textarea name="message" required></textarea>

            <label>Usager:</label>
            <input type="text" name="usager_id" required>

            <button type="submit">Ajouter</button>
        </form>

        <!-- Liste des Notifications -->
        <h2>Liste des Notifications</h2>
        <?php
        require_once __DIR__ . '/service/NotificationService.php';

        $notificationService = new NotificationService();
        $notifications = $notificationService->getAllNotifications();
        ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Usager ID</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($notifications as $notification): ?>
                <tr>
                    <td><?= htmlspecialchars($notification['id']) ?></td>
                    <td><?= htmlspecialchars($notification['message']) ?></td>
                    <td><?= htmlspecialchars($notification['usager_id']) ?></td>
                    <td>
                        <a href="controller/deleteNotification.php?id=<?= $notification['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>



        <br> <hr>
        <!-- Ajouter un Trajet -->
        <h2>Ajouter un Trajet</h2>
        <form method="POST" action="controller/addTrajet.php">
            Heure Départ: <input type="time" name="heureDepart" required>
            Heure Arrivée: <input type="time" name="heureArrivee" required>
            Itinéraire: <input type="text" name="itineraire" required>
            Bus: <input type="text" name="bus">
            Ligne Bus: <input type="text" name="ligneBus">
            <button type="submit">Ajouter</button>
        </form>

        <!-- Liste des Trajets -->
        <h2>Liste des Trajets</h2>
        <?php
        require_once __DIR__ . '/service/TrajetService.php';


        $trajetService = new TrajetService();
        $trajets = $trajetService->getAllTrajets();
        ?>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Itinéraire</th>
                <th>Heure de Départ</th>
                <th>Heure d'Arrivée</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($trajets as $trajet): ?>
                <tr>
                    <td><?= htmlspecialchars($trajet['id']) ?></td>
                    <td><?= htmlspecialchars($trajet['itineraire']) ?></td> 

                    <td><?= htmlspecialchars($trajet['heureDepart']) ?></td> 
                    <td><?= htmlspecialchars($trajet['heureArrivee']) ?></td> 

                    <td><a href="controller/deleteTrajet.php?id=<?= $trajet['id'] ?>">Supprimer</a></td>

                </tr>
            <?php endforeach; ?>
        </table>


        <br> <hr>
        <!-- Ajouter un Usager -->
        <h2>Ajouter un Usager</h2>
        <form method="POST" action="controller/AddUsager.php">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="motDePasse">Mot de Passe:</label>
            <input type="password" name="motDePasse" required>

            <button type="submit">Ajouter</button>
        </form>

        <!-- Liste des Usagers -->
        <h2>Liste des Usagers</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php
            require_once __DIR__ . '/service/UsagerService.php';

            $usagerService = new UsagerService();
            foreach ($usagerService->getAllUsagers() as $usager) {
                echo "<tr>
                <td>{$usager['id']}</td>
                <td>{$usager['nom']}</td>
                <td>{$usager['prenom']}</td>
                <td>{$usager['email']}</td>
                <td>
                    <a href='controller/deleteUsager.php?id={$usager['id']}'>Supprimer</a>
                </td>
              </tr>";
            }
            ?>
        </table>


        <br> <hr>
        <!-- Ajouter un Administrateur -->
        <h2>Ajouter un Administrateur</h2>
        <form action="controller/AddAdministrateur.php" method="POST">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="motDePasse" placeholder="Mot de passe" required>
            <button type="submit">Ajouter</button>
        </form>

        <!-- Liste des Administrateurs -->
        <h2>Liste des Administrateurs</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php
            require_once __DIR__ . '/service/AdministrateurService.php';

            $adminService = new AdministrateurService();
            foreach ($adminService->getAllAdministrateurs() as $admin) {
                echo "<tr>
                <td>{$admin['id']}</td>
                <td>{$admin['nom']}</td>
                <td>{$admin['prenom']}</td>
                <td>{$admin['email']}</td>
                <td>
                    <a href='controller/deleteAdministrateur.php?id={$admin['id']}'>Supprimer</a>
                </td>
              </tr>";
            }
            ?>
        </table>
        <br> <hr>


    </body>
</html>
