<?php if (isset($_SESSION['id'])) {

    require_once __REALPATH__ . '/includes/admin/common/aside.php';

    if (!isset($_GET['mode'])) {

        $results = crudBuilder('messages');
        $messages = $results[0];
        $headers = $results[1];

    ?>

    <section class="row wrap admin-section">
        <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
            <div class="padd-around">
                <h3>Messages</h3>
                <br>
                <table class="crud-table">
                    <thead>
                    <tr>
                        <?php foreach ($headers as $header) { ?>
                            <th><?= ucfirst($header) ?></th>
                        <?php } ?>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($messages as $message) { ?>

                        <tr>
                            <td><?= $message['id'] ?></td>
                            <td><?= $message['email'] ?></td>
                            <td><?= $message['sujet'] ?></td>
                            <td><?= $message['message'] ?></td>
                            <td><?= $message['created_at'] ?></td>
                            <td>
                                <a href="<?= DOMAIN ?>/admin/messages?mode=delete&id=<?= $message['id'] ?>">&#128581;</a>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php } ?>

<?php } else {

    header('Location: ' . DOMAIN . '/login');
}