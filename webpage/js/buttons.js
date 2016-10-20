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
