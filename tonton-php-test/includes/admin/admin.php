<?php if (isset($_SESSION['id'])) {

    require_once __REALPATH__ . '/includes/admin/common/aside.php'; ?>

    <section class="row wrap admin-section">
        <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
            <div class="padd-around">
                <h3>Tableau de bord</h3>
            </div>
        </div>
    </section>

<?php } else {

    header('Location: ' . DOMAIN . '/login');
}