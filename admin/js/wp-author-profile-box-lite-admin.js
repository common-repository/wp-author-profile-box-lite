(function( $ ) {
	'use strict';
	
	$( window ).load(function() {
    var count = "";
    count = $('.ab-social-tr select').size();
    if(count < 5){
      $(".pro-msg").hide();
    }
    else{
      $(".pro-msg").show();
    }

    $("#no-icon").show();

    $( function() {
      $( "#ab-accordion" ).accordion({
        animate: 200,
        collapsible: true, 
        active: 3,
        autoHeight: true,     
      });
    } );

    $( "#append" ).click(function(e) {
      e.preventDefault();
      $("#no-icon").hide();
      if (count < 5) {
      $(".pro-msg").hide();
      count = count + 1 ;
      $( ".append-table" ).append( $( '<tr id = "newtd" class= "ab-social-td"><td class= "ab-social-tr"><a class="ab-remove"></a><select class="ab-select" name="social_select[]" ><option value="facebook" selected>Facebook</option><option value="twitter">Twitter</option><option value="google">Google Plus</option><option value="instagram">Instagram</option><option value="wordpress">Wordpress</option></select><span class="description">Select social type.</span></td><td><input type="text" name="social[]" id="" value="" class="regular-text" /><br /><span class="description">Please enter your  link.</span></td></tr>') )
      }
      else{
        $(".pro-msg").show();
      }
      $('.ab-select').select2();
      }); 

    $(document).on('click','.ab-remove',function(e) {
        count = count -1;
        $(this).closest("tr").remove();
         if(count < 5){
          $(".pro-msg").hide();
        }
        else{
          $(".pro-msg").show();
        }
      });
    
    $('.ab-select').select2();

	});


})( jQuery );