$(window).on("load", function() { 
    
    
$('#menu').css({'margin-top':'-100px'});
	$('#menu').delay(900).animate({'margin-top':'0'}, 600);
    
    var drapeau = 0;
	$('#menuBurger').click(function(){
		if (drapeau == 0){
		$('#navigation').css({'display':'block', 'opacity':'0'});
		$('#navigation').animate({'opacity':'1'});
		drapeau = 1;
		}
		else {
			$('#navigation').css({'display':'none'});
			drapeau = 0;
		}
	});
    
$('a[href^="#"]').click(function(){
	var the_id = $(this).attr("href");

	$('html, body').animate({
		scrollTop:$(the_id).offset().top
	}, 'slow');
	return false;
});
    
    
// Contact
if( $('#contact')[0] != undefined || $('#contact')[0] != null ){
	
	// APPARITION BOUTONS
	// 1. récupérer dans une variable, les 3 li dans #boutons
	var mesBoutons = $('#boutons li');
	var nbreBoutons = mesBoutons.length;
	
	// 2. boucle FOR qui parcours tout les li
	for(compteur=0; compteur<nbreBoutons;  compteur++){
		// 3. manipulation du CSS -> passer opacité : 0 , visibility : visible
		$(mesBoutons[compteur]).css({'visibility':'visible', 'opacity':'0'});
		// 4. animation -> delay différent pour chacun, passer opacité : 1
		$(mesBoutons[compteur]).delay(800+compteur*100).animate({'opacity':'1'}, 800);
	}
	
	// AFFICHAGE DE PARTIE 1
	var mesParties = $('.partie');
	$(mesParties).css({'visibility':'hidden', 'opacity':'0'});
	$(mesParties[0]).css({'visibility':'visible', 'z-index':'60'});
	$(mesParties[0]).delay(1000).animate({'opacity':'1'},900);	
	
	
	var HauteurPartie1 = $(mesParties[0]).height();
	$('#contenu-contact').css({'height': HauteurPartie1});
	
 	numero=0;
	function Suivant(parametre){
		numero = parametre;
		
		$(mesParties).css({'opacity':'0', 'visibility':'hidden', 'z-index':'50'});
		$(mesParties[numero]).css({'z-index':'60', 'visibility':'visible'});
		$(mesParties[numero]).animate({'opacity':'1'},600);
		var HauteurPartie = $(mesParties[numero]).height();
        $('#contenu-contact').animate({'height': HauteurPartie},600);
		
	};
	
	
	function ACTIONSboutons(){
		
		//SURVOL BOUTON
		$(mesBoutons).mouseenter(function(){
			$(this).stop().animate({'opacity':'0.7', 'padding-left':'30px', 'padding-right':'30px'}, 600);
		});
		$(mesBoutons).mouseleave(function(){
			$(this).stop().animate({'opacity':'1', 'padding-left':'10px', 'padding-right':'10px'}, 600);
		});
		
		// 1. CLIQUE BOUTONS
		var drapeauBouton=0;
		$(mesBoutons).click(function(){
			if(drapeauBouton==0){
				var numero = $(this).attr('id');
				numero = numero.substring(1);
				
				Suivant(numero);
		
				drapeauBouton=1;
				setTimeout(function(){drapeauBouton=0;}, 600);
			}
		});
	
	
	}; // fin Actions boutons
	setTimeout(ACTIONSboutons, 2000);  // lancer avec un temps de décalage
	
	// Vérification à la vollé
	
	var btSuite = $('.suite');
	var obligatoires = $(mesParties[0]).find('.obligatoire');
	var nbTotalO=obligatoires.length;
	
	$(btSuite[0]).css({'opacity':'0.2', 'cursor':'default'});
	$(btSuite[1]).css({'opacity':'0.2', 'cursor':'default'});
	$(btSuite[2]).css({'opacity':'0.2', 'cursor':'default'});
	
	$(btSuite[2]).click(function(){
		return false;	
	});
	

	
	// 1. Détecter l'événement de relevé de touche clavier
	$("input").keyup(function() {
		
		var NumeroPB=[];
		// 2. Récupérer dans une variable ce que l'internaute à saisi dans les champs .obligatoire
		for(compteur=0;  compteur<nbTotalO; compteur++){
				var champ = $(obligatoires[compteur]).val();
				var nbreCaractere = champ.length;
				// 3. Vérifier si l'internaute a écrit quelque chose dans les 3 champs
				if(nbreCaractere<2){
					NumeroPB.push(compteur);
				}
		}
		if(NumeroPB[0] != undefined || NumeroPB[0] != null){
			//alert(NumeroPB);
			$(btSuite[0]).css({'opacity':'0.2', 'cursor':'default'});
		}else{
			// réactiver mon bouton
			$(btSuite[0]).css({'opacity':'1', 'cursor':'pointer'});
			$(btSuite[0]).click(function(){
				Suivant(1);
				
				// Passage à l'étape 2
				
				
	///// ETAPE DUPLIQUER	 de la 1		
	var obligatoires = $(mesParties[1]).find('.obligatoire');
	var nbTotalO=obligatoires.length;
	
	// 1. Détecter l'événement de relevé de touche clavier
	$("input").keyup(function() {
		
		var NumeroPB=[];
		// 2. Récupérer dans une variable ce que l'internaute à saisi dans les champs .obligatoire
		for(compteur=0;  compteur<nbTotalO; compteur++){
				var champ = $(obligatoires[compteur]).val();
				var nbreCaractere = champ.length;
				// 3. Vérifier si l'internaute a écrit quelque chose dans les 3 champs
				if(nbreCaractere<2){
					NumeroPB.push(compteur);
				}
		}
		if(NumeroPB[0] != undefined || NumeroPB[0] != null){
			//alert(NumeroPB);
			$(btSuite[1]).css({'opacity':'0.2', 'cursor':'default'});
		}else{
			// réactiver mon bouton
			$(btSuite[1]).css({'opacity':'1', 'cursor':'pointer'});
			$(btSuite[1]).click(function(){
				Suivant(2);
				// passage partie 3 
				$(btSuite[2]).off();
				$(btSuite[2]).css({'opacity':'1', 'cursor':'pointer'});
			});
		}
	});
			
					
			});
		}
		
	});
	
}
            
});