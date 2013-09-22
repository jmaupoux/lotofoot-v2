$(document).ready( function () {
	$(".bloc-letter-b").hide();
});
	
	function afficher_cacher(id)
}
{
    if(document.getElementById(id).style.visibility=="hidden")
    {
        document.getElementById(id).style.visibility="visible";
        document.getElementById('bloc-'+id).innerHTML='Cacher le texte';
    }
    else
    {
        document.getElementById(id).style.visibility="hidden";
        document.getElementById('bloc-'+id).innerHTML='Afficher le texte';
    }
    return true;
}

