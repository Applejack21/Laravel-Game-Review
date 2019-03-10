//A bunch of scripts for jquery

//Intialize the datepicker to be used
$(function()
{
$( ".datepicker" ).datepicker();
});
    
//Change the height size of the accordions to be in level with what content is inside of it
  $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  } );

//Include the icons next to the accordions
    $( function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
      icons: icons
    });
    $( "#toggle" ).button().on( "click", function() {
      if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
        $( "#accordion" ).accordion( "option", "icons", null );
      } else {
        $( "#accordion" ).accordion( "option", "icons", icons );
      }
    });
  } );

//Include the icons next to the accordion2
    $( function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion2" ).accordion({
      icons: icons
    });
    $( "#toggle" ).button().on( "click", function() {
      if ( $( "#accordion2" ).accordion( "option", "icons" ) ) {
        $( "#accordion2" ).accordion( "option", "icons", null );
      } else {
        $( "#accordion" ).accordion( "option", "icons", icons );
      }
    });
  } );