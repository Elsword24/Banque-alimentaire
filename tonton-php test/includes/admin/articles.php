<?php if (isset($_SESSION['id'])) {

    require_once __REALPATH__ . '/includes/admin/common/aside.php';

    if (!isset($_GET['mode'])) {

        $results = crudBuilder('articles');
        $articles = $results[0];
        $headers = $results[1];

?>

    <section class="row wrap admin-section">
        <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
            <div class="padd-around">
                <h3>Articles</h3>
                <br>
                <a class="btns" href="<?= DOMAIN ?>/admin/articles?mode=new">Créer un nouvel article</a>
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
                    <?php foreach ($articles as $article) { ?>

                        <tr>
                            <td><?= $article['id'] ?></td>
                            <td><?= $article['uri'] ?></td>
                            <td><?= $article['title'] ?></td>
                            <td><?= $article['author'] ?></td>
                            <td><?= (strlen($article['content']) > 200) ? substr($article['content'], 0, 197) . '...' : $article['content'] ?></td>
                            <td>
                                <?= $article['image'] ?>
                                <a target="_blank" href="<?= DOMAIN ?>/assets/media/images/<?= $article['image'] ?>">
                                    <img class="crud-images" src="<?= DOMAIN ?>/assets/media/images/<?= $article['image'] ?>">
                                </a>
                            </td>
                            <td><?= $article['published'] ?></td>
                            <td><?= $article['created_at'] ?></td>
                            <td>
                                <a href="<?= DOMAIN ?>/admin/articles?mode=read&id=<?= $article['id'] ?>">&#128374;</a>
                                <a href="<?= DOMAIN ?>/admin/articles?mode=edit&id=<?= $article['id'] ?>">&#128295;</a>
                                <a href="<?= DOMAIN ?>/admin/articles?mode=delete&id=<?= $article['id'] ?>">&#128581;</a>
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
                        <h1>Nouvel Article</h1>
                        <form class="crud-single-container padd-around" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="new" value="ok">
                            <div class="inputs">
                                <label>Image</label>
                                <input type="file" name="image" required>
                            </div>
                            <div class="inputs">
                               <label>Permalien</label>
                                <input type="text" name="uri" required>
                            </div>
                            <div class="inputs">
                                <label>Titre</label>
                                <input type="text" name="title" required>
                            </div>
                            <div class="inputs">
                                <label>Auteur</label>
                                <input type="text" name="author" required>
                            </div>
                            <div class="inputs">
                                <label>Corps</label>
                                <textarea name="content" required></textarea>
                            </div>
                            <div class="inputs">
                                <label>Publié</label>
                                <select name="published" required>
                                    <option selected value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
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
                        <h1>Voir l'Article</h1>
                        <div class="crud-single-container padd-around">
                            <div class="inputs">
                                <label>Image</label>
                                <img class="preview-crud-solo" src="<?= DOMAIN ?>/assets/media/images/<?= $result['image'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Permalien</label>
                                <input disabled type="text" name="uri" required value="<?= $result['uri'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Titre</label>
                                <input disabled type="text" name="title" required value="<?= $result['title'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Auteur</label>
                                <input disabled type="text" name="author" required value="<?= $result['author'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Corps</label>
                                <textarea disabled name="content" required><?= $result['content'] ?></textarea>
                            </div>
                            <div class="inputs">
                                <label>Publié</label>
                                <select disabled name="published" required>
                                    <option <?= ($result['published'] == 0) ? 'selected' : '' ?> value="0">Non</option>
                                    <option <?= ($result['published'] == 1) ? 'selected' : '' ?> value="1">Oui</option>
                                </select>
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
                        <h1>&Eacute;diter un Article</h1>
                        <form class="crud-single-container padd-around" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="edit" value="ok">
                            <input type="hidden" name="id" value="<?= $result['id'] ?>">
                            <div class="inputs">
                                <img class="preview-crud-solo" src="<?= DOMAIN ?>/assets/media/images/<?= $result['image'] ?>">
                                <label>Image</label>
                                <input type="file" name="image" required value="<?= $result['image'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Permalien</label>
                                <input type="text" name="uri" required value="<?= $result['uri'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Titre</label>
                                <input type="text" name="title" required value="<?= $result['title'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Auteur</label>
                                <input type="text" name="author" required value="<?= $result['author'] ?>">
                            </div>
                            <div class="inputs">
                                <label>Corps</label>
                                <textarea name="content" required><?= $result['content'] ?></textarea>
                            </div>
                            <div class="inputs">
                                <label>Publié</label>
                                <select name="published" required>
                                    <option <?= ($result['published'] == 0) ? 'selected' : '' ?> value="0">Non</option>
                                    <option <?= ($result['published'] == 1) ? 'selected' : '' ?> value="1">Oui</option>
                                </select>
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