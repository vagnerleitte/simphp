/*###
# Open/close and Slide function for the left-slide menu and the page title
###*/
function Mopen(){			
			var menu = $('.menuSlider').css('left');
			if(menu < '0em'){ /*verify if menu is closed and open it*/						
						$('.menuSlider').animate({left : '0em'});						
			}else{ /*this condition verify if menu is opened and it*/
						$('.menuSlider').animate({left : '-3.3em'});
			}			
}
/*### Fun�ao que mostra ou oculta detalhes sobre o link do menu ###*/
function Mdetalhes(link,acao){
//$('#link1').animate({ opacity: 1 }, 0 );
//$('#link1').fadeTo(0, 1);
if($('.menuSlider').css('left') == '0px')
	switch(link){
		case "link1":if(acao=='v')$('#link1').css({'visibility':'visible'}); else $('#link1').css({'visibility':'hidden'});break;
		case "link2":if(acao=='v')$('#link2').css({'visibility':'visible'}); else $('#link2').css({'visibility':'hidden'});break;
		case "link3":if(acao=='v')$('#link3').css({'visibility':'visible'}); else $('#link3').css({'visibility':'hidden'});break;
		case "link4":if(acao=='v')$('#link4').css({'visibility':'visible'}); else $('#link4').css({'visibility':'hidden'});break;
		case "link5":if(acao=='v')$('#link5').css({'visibility':'visible'}); else $('#link5').css({'visibility':'hidden'});break;
		case "link6":if(acao=='v')$('#link6').css({'visibility':'visible'}); else $('#link6').css({'visibility':'hidden'});break;
		case "link7":if(acao=='v')$('#link7').css({'visibility':'visible'}); else $('#link7').css({'visibility':'hidden'});break;
	}
}
$(window).resize(function() {
		if (window.innerWidth<700){
			$('.Tsocial').fadeTo('fast',1);
			$('.logo').fadeTo('fast',0);
			$('.logo').css('display','none');
			$('.social').fadeTo('fast',0);
			$('.equipe .imagem').css('margin-right','0');
			$('.imagem').css('width','30%');
			$('.logo2').css('width','25%');
		}else{
			$('.Tsocial').fadeTo('fast',0);
			$('.logo').fadeTo('fast',1);
			$('.social').fadeTo('fast',1);
			$('.equipe .imagem').css('margin-right','2em');
			$('.imagem').css('width','15%');
			$('.logo2').css('width','15%');
		}
		if (window.innerWidth<450){
			$('#Fspan').fadeTo('fast',0);
			$('#Fspan').css('display','none');
			$('.equipe .imagem').css('margin-right','0');
			$('.imagem').css('width','55%');
			$('.logo2').css('width','25%');
			$('.img1').css('width','90%');
			$('.img1').css('magin-left','0');
		}else{
				$('#Fspan').fadeTo('fast',1);
				$('footer .img1').css('magin-left','10em');
				$('.img1').css('width','50%');
		}
		if (window.innerWidth<400){
			$('.equipe .imagem').css('margin-right','0');
			$('.imagem').css('width','50%');
			$('.logo2').css('width','30%');
		}
});

$(document).ready(function(){
		if (window.innerWidth<700){
			$('.Tsocial').fadeTo('fast',1);
			$('.logo').fadeTo('fast',0);
			$('.logo').css('display','none');
			$('.social').fadeTo('fast',0);
			$('.equipe .imagem').css('margin-right','0');
			$('.imagem').css('width','30%');
			$('.logo2').css('width','25%');
		}else{
			$('.Tsocial').fadeTo('fast',0);
			$('.logo').fadeTo('fast',1);
			$('.social').fadeTo('fast',1);
			$('.equipe .imagem').css('margin-right','2em');
			$('.imagem').css('width','15%');
			$('.logo2').css('width','15%');
		}
		if (window.innerWidth<450){
			$('#Fspan').fadeTo('fast',0);
			$('#Fspan').css('display','none');
			$('.equipe .imagem').css('margin-right','0');
			$('.imagem').css('width','55%');
			$('.logo2').css('width','25%');
			$('.img1').css('width','90%');
			$('.img1').css('magin-left','0');
		}else{
				$('#Fspan').fadeTo('fast',1);
				$('footer .img1').css('magin-left','10em');
				$('.img1').css('width','50%');
		}
		if (window.innerWidth<400){
			$('.equipe .imagem').css('margin-right','0');
			$('.imagem').css('width','50%');
			$('.logo2').css('width','30%');
		}
		
		
		
		
		$('li.equipe').click(function(){
			
			$('div#formEquipe').fadeTo('fast',1)
		
		})
		$('li.investir').click(function(){
			
			$('div#formInvestir').fadeTo('fast',1)
		
		})
		$('li.video').click(function(){
			
			$('div#videos').fadeTo('fast',1)
		
		})
		$('.fechar').click(function(){
			if($('div#formEquipe').css('display') == 'block'){
				$('div#formEquipe').fadeTo('fast',0).css('display','none');
			}
			if($('div#formInvestir').css('display') == 'block'){
				$('div#formInvestir').fadeTo('fast',0).css('display','none');
			}
			if($('div#videos').css('display') == 'block'){
				$('div#videos').fadeTo('fast',0).css('display','none');
			}
		})
	
    TSC.playerConfiguration.setFlashPlayerSwf("/iggow/public/templates/default/swf/video_controller.swf");
    TSC.playerConfiguration.setMediaSrc("../../../uploads/videos/iggow.mp4");
    TSC.playerConfiguration.setAutoHideControls(true);
    TSC.playerConfiguration.setBackgroundColor("#000000");
    TSC.playerConfiguration.setCaptionsEnabled(false);
    TSC.playerConfiguration.setSidebarEnabled(false);
    
    TSC.playerConfiguration.setAutoPlayMedia(true);
    TSC.playerConfiguration.setPosterImageSrc("");
    TSC.playerConfiguration.setIsSearchable(false);
    TSC.playerConfiguration.setEndActionType("stop");
    TSC.playerConfiguration.setEndActionParam("true");
    TSC.playerConfiguration.setAllowRewind(-1);
    

    TSC.localizationStrings.setLanguage(TSC.languageCodes.PORTUGUESE);

    $(document).ready(function (e) {
        TSC.mediaPlayer.init("#tscVideoContent");
    });
	
	var val = 0;
	function doAction(){
		setInterval(function() {
			if(val == 8){
				val = 0
			}
			val++;
			changeItem(val);
			clearInterval();
		}, 2000);
	}
	
  function changeItem(val){
  			var item = '#item'+val;
  			var objL = 'l'+val;
  			var l1 = '480px';
  			var l2 = '120px';
  			var l3 = '490px';
  			var l4 = '190px';
  			var l5 = '620px';
  			var l6 = '330px';
  			var l7 = '250px';
  			var l8 = '450px';
  			var l9 = '200px';
  			var h1 = '50px';
  			var h2 = '360px';
  			var h3 = '90px';
  			var h4 = '410px';
  			var h5 = '150px';	
  			var h6 = '500px';
  			var h7 = '4200px';
  			var h8 = '230px';
  			var h9 = '350px';
  			
  			
  			
  				$('.intro-ul li').fadeOut(300, function(){
  					
					$('#item'+val).css({'position':'absolute', 'top': l1, 'left':h1});
					$('#item'+val).fadeIn(600);
				});
				
  }
  
  doAction();
});