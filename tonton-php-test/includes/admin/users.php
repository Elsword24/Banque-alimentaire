<?php if (isset($_SESSION['id'])) {

    require_once __REALPATH__ . '/includes/admin/common/aside.php';

    if (!isset($_GET['mode'])) {

        $results = crudBuilder('users');
        $users = $results[0];
        $headers = $results[1];

    ?>

    <section class="row wrap admin-section">
        <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
            <div class="padd-around">
                <h3>Utilisateurs</h3>
                <br>
                <a class="btns" href="<?= DOMAIN ?>/admin/users?mode=new">Créer un nouvel utilisateur</a>
                <br>
                <table class="crud-table">
                    <thead>
                    <tr>
                        <?php foreach ($headers as $header) { ?>
                            <th><?= ucfirst($header) ?></th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) { ?>

                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['firstname'] ?></td>
                            <td><?= $user['lastname'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td>
                                <a href="<?= DOMAIN ?>/admin/users?mode=read&id=<?= $user['id'] ?>">&#128374;</a>
                                <a href="<?= DOMAIN ?>/admin/users?mode=edit&id=<?= $user['id'] ?>">&#128295;</a>
                                <a href="<?= DOMAIN ?>/admin/users?mode=delete&id=<?= $user['id'] ?>">&#128581;</a>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php } else { ?>

        <?php if ($_GET['mode'] == 'new') { ?>

            <section class="row wrap admin-section">
                <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                    <div class="padd-around">
                        <h1>Nouvel Utilisateurs</h1>
                        <form class="crud-single-container padd-around" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="new" value="ok">
                            <div class="inputs">
                                <label>Prénom</label>
                                <input type="text" name="firstname" required>
                            </div>
                            <div class="inputs">
                                <label>Nom</label>
                                <input type="text" name="lastname" required>
                            </div>
                            <div class="inputs">
                                <label>Email</label>
                                <input type="email" name="email" required>
                            </div>
                            <div class="inputs">
                                <label>Mot de passe</label>
                                <input type="password" name="password" required>
                            </div>
                            <div class="inputs">
                                <button type="submit" class="btns">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        <?php } else if ($_GET['mode'] == 'read') { ?>

            <?php global $result; ?>

            <section class="row wrap admin-section">
                <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                    <div class="padd-around">
                        <h1>Voir l'Utilisateurs</h1>
                        <div class="crud-single-container padd-around">
                            <div class="inputs">
                                <label>Prénom</label>
                                <input disabled type="text" name="firstname" required value="<?= $result['firstname'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Nom</label>
                                <input disabled type="text" name="lastname" required value="<?= $result['lastname'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Email</label>
                                <input disabled type="email" name="email" required value="<?= $result['email'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php } else if ($_GET['mode'] == 'edit') { ?>

            <?php global $result; ?>

            <section class="row wrap admin-section">
                <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                    <div class="padd-around">
                        <h1>&Eacute;diter un Utilisateur</h1>
                        <form class="crud-single-container padd-around" method="post">
                            <input type="hidden" name="edit" value="ok">
                            <input type="hidden" name="id" value="<?= $result['id'] ?>">
                            <div class="inputs">
                                <label>Prénom</label>
                                <input type="text" name="firstname" required value="<?= $result['firstname'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Nom</label>
                                <input type="text" name="lastname" required value="<?= $result['lastname'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Email</label>
                                <input type="email" name="email" required value="<?= $result['email'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Mot de passe</label>
                                <input type="password" name="password" autocomplete="off">
                            </div>
                            <div class="inputs">
                                <button type="submit" class="btns">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        <?php } ?>

    <?php } ?>

<?php } else {

    header('Location: ' . DOMAIN . '/login');
}