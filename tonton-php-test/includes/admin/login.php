<?php  if (!isset($_SESSION['id'])) { ?>

<section class="row wrap center fullHeight">
    <div class="xLarge-4 large-4 medium-6 small-12 xSmall-12">
        <div class="padd-around">
            <form id="contact-form" method="post">
                <p class="title">Se connecter</p>
                <input type="hidden" name="connexion" value="ok">
                <label>Email</label>
                <input type="email" name="email" placeholder="Votre e-mail..." required spellcheck="false" autocomplete="off">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="Votre e-mail..." required spellcheck="false" autocomplete="off">
                <button type="submit" class="btns">Envoyer</button>
            </form>
        </div>
    </div>
</section>

<?php } else {

    header('Location: ' . DOMAIN . '/admin');
}