/*
 * IKEA Lamp Updater
 * Turns on a wemos relay, if the corresponding button is pressed on the webpage.
 */
/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE" (Revision 42):
 * <black@blackthorne.dk> wrote this file. As long as you retain this notice you
 * can do whatever you want with this stuff. If we meet some day, and you think
 * this stuff is worth it, you can buy me a beer in return Jacob V. Rasmussen
 * ----------------------------------------------------------------------------
 */
$('#white.btn-danger').click(function() {
    $.post( "/ikea/", 
	{ setState : 1 , white : 0 }, 
	function() { location.reload(); } );
});
$('#white.btn-success').click(function() {
    $.post( "/ikea/", 
	{ setState : 1 , white : 1 }, 
	function() { location.reload(); } );
});

$('#black.btn-danger').click(function() {
    $.post( "/ikea/", 
	{ setState : 1 , black : 0 }, 
	function() { location.reload(); } );
});
$('#black.btn-success').click(function() {
    $.post( "/ikea/", 
	{ setState : 1 , black : 1 }, 
	function() { location.reload(); } );
});
