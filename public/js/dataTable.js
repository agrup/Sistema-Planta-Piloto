$(document).ready(function() {
   $('table#tablaBase').dataTable({
       "bPaginate": false,
       //"bLengthChange": false,
       "bFilter": false,
       "aaSorting": [[ 2, "desc" ]],
       "bInfo": false,
      // "bAutoWidth": true,
       "scrollY":        "200px",
          "scrollCollapse": true,
       "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""},
           "columnDefs": [
               { "width": "16%", "targets": 0 }
           ],
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
