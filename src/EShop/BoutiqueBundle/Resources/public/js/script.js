/*
 * This file is part of the EShop application.
 *
 * (c) Jean-Michel VILOMET <jmvilomet@faeryscape.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

$(document).ready(function(){
    // Accueil / boutons d'ajout d'article au panier
    $(".ajouterPanier").click(creer);

    // Panier / boutons changeant les quantités ou supprimant un article
    $(".plusPanier").click(ajouter);
    $(".moinsPanier").click(enlever);
    $(".retirerPanier").click(retirer);
});

// Cette fonction extrait l'identifiant article de l'identifiant DOM de la ligne 
// de panier passé en paramètre
function extract_id(varName){
    idx = varName.lastIndexOf('_');
    if (idx==-1) 
        return 0;
    id = varName.substr(varName.lastIndexOf('_')+1);
    if (isNaN(id))
        return 0;
    return id;
}

/** /
var urlVar = "{{path('e_shop_rest_ajouter',{id:1,puht:2,quantite:3})}}";
function prepareURL(urlVar){
    reg = new RegExp("(\\d+)", "g");
    return urlVar.replace(reg,'#$1#');
}
function replaceParam(urlVar, index, value){
    reg = new RegExp("(#"+index+"#)", "g");
    return urlVar.replace(reg,value);
}
/**/