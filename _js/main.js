history.scrollRestoration = "manual";

$(document).ready(function () {
    /********** LISTE OISEAU & LEPIDO **********/
    $("#oiseaux-list li, #lepido-list li").on("click", function (e) {
        const $this = $(this);
        const $birdContent = $this.find(".birdcontent, .lepidocontent");

        if ($(e.target).hasClass("fa-angles-right")) return;

        // Retirer la classe active des autres éléments
        $("#oiseaux-list li, #lepido-list li").not($this).removeClass("li-active");

        // Cacher les autres contenus
        $(".birdcontent, .lepidocontent").not($birdContent).each(function () {
            $(this).animate({
                right: "-51%" // Déplacement hors écran
            }, 200, function () {
                $(this).hide(); // Masquer complètement après animation
            });
        });

        // Afficher et animer le contenu de l'élément cliqué
        if ($birdContent.css('display') === 'none') {
            $this.addClass("li-active");
            $birdContent.show().animate({
                right: "0"
            }, 200);
        }

        e.stopPropagation();
    });

    $(document).on("click", ".fa-angles-right", function (e) {
        e.stopPropagation();
        const $birdContent = $(this).closest(".birdcontent, .lepidocontent");

        if ($birdContent.length > 0) {
            $birdContent.animate({
                right: "-51%" // Déplacement hors écran
            }, 200, function () {
                $(this).hide(); // Masquer après animation
            });

            $birdContent.closest("li").removeClass("li-active");
        }
    });

    /********** TRAITEMENTS GLOBAUX **********/
    $('li').each(function () {
        const imgStatusDiv = $(this).find('.img-status');
        const imageMin = imgStatusDiv.find('img').attr('src');
        const nameLatinDiv = $(this).find('div:first > div:first i');
        const nameDiv = $(this).find('div:first > div:first');

        // Gestion des images vides
        if (!imageMin || imageMin.trim() === "") {
            imgStatusDiv.remove();
        } else {
            nameLatinDiv.after(' <i class="fa-solid fa-camera"></i>');
        }

        // Gestion de la répartition
        const repartition = $(this).find('.birdinfo p:contains("Répartition"), .lepidoinfo p:contains("Répartition")').text().replace('Répartition : ', '').trim();
        nameDiv.html(`<i class="fa-regular ${repartition ? 'fa-file-lines' : 'fa-file'}"></i> ${nameDiv.html()}`);

        // Gestion de la rareté
        const rareteSpan = $(this).find('.birdinfo p:contains("Rareté de l\'espèce") span, .lepidoinfo p:contains("Rareté de l\'espèce") span');
        addClassBasedOnValue(rareteSpan, {
            "Commune": "commun",
            "Peu commune": "peu-commun",
            "Rare": "rare",
            "Très rare": "tres-rare"
        });

        // Gestion des familles lépido
        const familleSpan = $(this).find('.famille span');
        addClassBasedOnValue(familleSpan, {
            "Hespéridé": "hesperide",
            "Papilionidé": "papilionide",
            "Piéridé": "pieride",
            "Lycénidé": "lycenide",
            "Nymphalidé": "nymphalide"
        });
    });

    // Fonction utilitaire pour ajouter des classes dynamiquement
    function addClassBasedOnValue(element, mapping) {
        const value = element.text().trim();
        if (mapping[value]) element.addClass(mapping[value]);
    }
});
