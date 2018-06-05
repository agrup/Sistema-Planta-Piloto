$(document).ready(function() {
$('table').dataTable({
"bPaginate": false,
"bLengthChange": false,
"bFilter": false,
"aaSorting": [[ 2, "desc" ]],
"bInfo": false,
"bAutoWidth": false,
"scrollY":        "200px",
   "scrollCollapse": true,
"oLanguage": {"sZeroRecords": "", "sEmptyTable": ""}
});
} );
