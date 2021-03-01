<?php
$volunteers=getVolunteers()
$partners=getPartners()
$partners_volunteers=get
?>
<div>
    <p>
        information du compte :0
            <?php foreach ($volunteers as $volunteer) { ?>
                <div class="xLarge-6 large-6 medium-12 small-12 xSmall-12 articles-preview">
                    <div class="padd-around">
                        <article>
                               <h3><?= $volunteers['title'] ?></h3>
                                 <small>Crée le <?= formatDate($volunteers['created_at']) ?> par <b style="font-family: 'texte-bold', sans-serif;"><?= $volunteers['author'] ?></b></small> <!-- Récupération donné création du compte et affichage-->
                                     <div class="compte">
                                        <p>
                                        </p>
                                    </div>
                       </article>
                    </div>
                </div>
    </p>
</div>
<div>
    <p>
        Votre partenaire : 
        <?php foreach ($partners as $partner) { ?>
            <div class="xLarge-6 large-6 medium-12 small-12 xsmall-12 articles-preview">
                <div class="padd-around">
                    <ul>
                        <li>
                        <?=
                        </li>
                    </ul>
    </p>
</div>
<div>
    <p>
        Voulez vous changer de partenaire ?
        <button onclick="window.location.href = '<!--Lien vers la page des partenaires-->;">Cliquez Ici</button>    
    </p>
</div>
<div>
    <p>
        Ou nous avons besoin d'aide :
        <!--Allez chercher la table des aides-->
    </p>
</div>
<div>
    <p>
        L'aide que vous nous avez apporté :
        <!--Allez chercher dans la table utilisateurs l'aide du bénévole-->
    </p>
</div>