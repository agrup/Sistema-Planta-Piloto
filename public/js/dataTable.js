$(document).ready(function() {
   table = $('table#tablaBase').dataTable( {
                "bPaginate": false,
              "bLengthChange": false,
              "bFilter": false,
              "aaSorting": [[ 2, "desc" ]],
                 "bInfo": false,
                 "bAutoWidth": true,
                 "scrollY":        "9.5rem",
                  "scrollCollapse": true,
                 "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""},
                     "columnDefs": [
                         { "width": "16%", "targets": 0 }
                     ],
    } );
   $('table#tablaStock').dataTable({
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       "aaSorting": [[ 2, "desc" ]],
       "bInfo": false,
       "bAutoWidth": false,
       "scrollY": "18rem",
       "scrollCollapse": true,
       "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""}
   });

    $('table#tablaBase2').dataTable({
        "bPaginate": false,
        //"bLengthChange": false,
        "bFilter": false,
        "aaSorting": [[ 2, "desc" ]],
        "bInfo": false,
        // "bAutoWidth": true,
        "scrollY":"9.5rem",
        "scrollCollapse": true,
        "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""},
        "columnDefs": [
            { "width": "16%", "targets": 0 }
        ],
    });

    $('table#tablaSinOrdenar').dataTable({
        "bPaginate": false,
        //"bLengthChange": false,
        "bFilter": false,
        "bSorting": false,
        "bInfo": false,
        // "bAutoWidth": true,
        "scrollY":"9.5rem",
        "scrollCollapse": true,
        "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""},
        "columnDefs": [
            { "width": "16%", "targets": 0 }
        ],
    });

});
