$(document).ready(function() {
$('table').dataTable({
"bPaginate": false,
"bLengthChange": false,
"bFilter": false,
"aaSorting": [[ 2, "desc" ]],
"bInfo": false,
"bAutoWidth": false
});
} );