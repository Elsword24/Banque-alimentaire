</main>
<?php if (!defined('MAINTENANCE') && !defined('ERROR_404') && !defined('ADMIN')) { ?>
<section class="row wrap" id="newsletter">
    <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
        <div class="padd-around">
            <form method="post">
                <p>Abonnez-vous à la Newsletter !</p>
                <input type="email" name="email" autocomplete="off" required spellcheck="false" placeholder="exemple@domaine.com">
                <button type="submit" class="btns">S'inscrire</button>
            </form>
        </div>
    </div>
</section>
<footer>
    <section class="row wrap">
        <div class="xLarge-4 large-4 medium-12 small-12 xSmall-12">
            <div class="padd-around">
                <p>Informations</p>
                <ul>
                    <li>
                        <a href="<?= DOMAIN ?>/rgpd">RGPD</a>
                    </li>
                    <li>
                        <a href="<?= DOMAIN ?>/cgu">CGU</a>
                    </li>
                    <li>
                        <a href="<?= DOMAIN ?>/mentions-legales">Mentions Légales</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="xLarge-4 large-4 medium-12 small-12 xSmall-12">
            <div class="padd-around">
                <p>
                    <img id="footer-logo" src="<?= DOMAIN ?>/assets/media/images/logo-QS.png">
                    La banque alimentaire de Gironde
                </p>
                <ul>
                    <li>3 quai Numa Sensine</li>
                    <li>33310 LORMONT - FRANCE</li>
                    <li>
                        <a href="mailto:in-touch-fg@quanticalsolutions.com">Email : in-touch-fg@quanticalsolutions.com</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="xLarge-4 large-4 medium-12 small-12 xSmall-12">
            <div class="padd-around">
                <p>Derniers articles</p>
                <ul>
                    <li>
                        <a href="<?= DOMAIN ?>/blog/papa-a-la-plage">Papa à la plage</a>
                    </li>
                    <li>
                        <a href="<?= DOMAIN ?>/blog/l-epsi-c-est-cool">L'EPSI c'est cool !</a>
                    </li>
                    <li>
                        <a href="<?= DOMAIN ?>/blog/toto-a-gagne-au-loto">Toto a gagné au Loto</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</footer>
<?php } ?>
<script type="text/javascript" src="<?= DOMAIN ?>/assets/js/script.js"></script>
</body>
</html>
