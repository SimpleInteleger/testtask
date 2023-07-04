$(document).ready(function(){
	
	$( "#form" ).on( "submit", function( event ) {
		var  fname = $( "#firstname" ).val();
		var lname = $( "#lastname" ).val();
		var email = $( "#email" ).val();
		var email_bool=email.search("@");
		var pwd = $( "#pwd" ).val();
		var pwdp = $( "#pwdp" ).val();
		var errormessage="";
		
		
		
		if (pwd == pwdp && email_bool != -1){
			$.post('../../assets/site/php/analis.php',{
				
				sfname: fname,
				slname: lname,
				semail: email,
				spwd: pwd,
				spwdp: pwdp
				
				}).done(function (data) {
				
				if(data.includes("done")){
					$( "#form" ).slideUp();
					$( "#truthmessage" ).slideDown();
					$( "#falsemessage" ).slideUp();
					}else{
					$( "#falsemessage h1").html("Такий емейл вже зареєстровано");
					$( "#falsemessage" ).slideDown();
				}
				
			});
			}else{
			if (pwd != pwdp){
				errormessage=errormessage+"Різні паролі"
			}
			if (email_bool == -1){
				errormessage=errormessage+" Не правильний email"
			}
			$( "#falsemessage h1").html(errormessage);
			$( "#falsemessage" ).slideDown();
		}
		event.preventDefault();
	});
	
	
});