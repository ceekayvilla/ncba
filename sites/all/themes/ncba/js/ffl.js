/*popup section*/
(function(){

	var Config = {
		Link: "a[data-share-class='share']",
		Width: 500,
		Height: 500,
		fb_share : "https://www.facebook.com/sharer/sharer.php?u=",
		tw_share:"https://twitter.com/intent/tweet",
		gplus_share:"https://plus.google.com/share?url=",
		url:"https://zilojolabs.com/xmas-campaign/img/"
	};

	var slink = document.querySelectorAll(Config.Link);
	for (var a = 0; a < slink.length; a++) {
		slink[a].onclick = PopupHandler;
	}

		function PopupHandler(e) {

		e = (e ? e : window.event);
		var t = (e.target ? e.target : e.srcElement);

		// popup position
		var
			px = Math.floor(((screen.availWidth || 1024) - Config.Width) / 2),
			py = Math.floor(((screen.availHeight || 700) - Config.Height) / 2);

			var link_network = t.getAttribute('data-network'),
				social_network_link='',
				popup_url,
				link_href     = t.getAttribute('href'),
				share_text ="#ChristmasInKe",
				share_img  = t.getAttribute('data-image'),
				share_title ="Coop Bank: ChristmasInKe";
				console.log(Config.url+share_img);

				switch(link_network){
					case 'facebook':
						FB.ui({
								  method: 'feed',
								  link: link_href,
								  name:"You can call Co-op Santa",
								  description: "Hey, Co-op is having the #ChristmasInKE campaign. If you transact on MCO-OP Cash, Co-op kwa Jirani, Card or use Internet banking, you can win cash vouchers, laptops, phones OR even a mbuzi! Click this link to enter!",
								  caption:'Our Christmas can be even better with #ChristmasInKE',
								  picture: Config.url+share_img,
								}, function(response){
									var provider_user_id = $("#user_id").val();

									if(response['error_code']!=4201){
									$.ajax({
			        					type: 'POST',
			        					url: 'ajax/update_points.php',
			        					data: {'user_id':provider_user_id, 'channel':'share'},
			        					success: function(data){ 
			        						console.log(data);
			        						/*success message to user*/
			        						$("div.success").slideDown().delay(5000).slideUp();
			        					}
											});
								}
								});
					break;
					case 'twitter':
						social_network_link = Config.tw_share+'?text='+share_text+'&url='+encodeURIComponent(link_href)+'&via=ArtisanFashion';
					break;
					case 'googleplus':
						social_network_link = Config.gplus_share+encodeURIComponent(link_href)+'&title=gplus title';
					break;
				}

				popup_url  = social_network_link;
		// open popup
		var popup = window.open(popup_url, "social", 
			"width="+Config.Width+",height="+Config.Height+
			",left="+px+",top="+py+
			",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
		if (popup) {
			popup.focus();
			if (e.preventDefault) e.preventDefault();
			e.returnValue = false;
		}

		return !!popup;
	}

}());

/*validate form*/
$("#referenceForm").validate({
        //wrapper:"div",
        rules:{
            name:{required: true},
            phone:{required: true},
            channel:{required:true},
            reference_number:{required: true},
        },
        messages:{
           name       : {required: "Please tell us your full name."},
           phone       : {required: "Please leave a number we can call you on."},
           channel       : {required:"Choose a channel you used to transact"},
           reference_number   : {required:"Please enter your reference number"}
        },
         errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
        submitHandler: function(form){

              var user_id = $("#user_id").val(),
              name = $("#name").val(),
              phone = $("#phone").val(),
              channel = $("#method").val(),
              reference_number = $("#reference_number").val();
              $.ajax({
  					type: 'POST',
  					url: 'ajax/update_references.php',
  					data: {'user_id':user_id, 'name':name, 'phone':phone, 'channel':channel, 'reference_number':reference_number},
  					success: function(data){ 
  						$(form)[0].reset();
  						//console.log(data);
  						$("ul.success").slideDown().delay(5000).slideUp();
  					}
			});
        },
    });
$("#sbt").click(function(){
      if (!$("#referenceForm").validate()) { // Not Valid
              return false;
          } else {
          //$("#referenceForm").submit();
          }
})