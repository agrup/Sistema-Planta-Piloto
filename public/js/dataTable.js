$(document).ready(function() {
   $('table#tablaBase').dataTable({
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

   $('table#tablaStock').dataTable({
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       "aaSorting": [[ 2, "desc" ]],
       "bInfo": false,
       "bAutoWidth": false,
       "scrollY":        "200rem",
       "scrollCollapse": true,
       "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""}
   });
});
