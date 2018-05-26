$(document).ready(function() {
     // on button click we are getting values by input name.
      $("#guardar").click(function(e){
        e.preventDefault();
        var _token = $("input[name='_token']").val(); // get csrf field.
        var name = $("input[name='name']").val();
        var contemail = $("input[name='contemail']").val();
        var contmobile = $("input[name='contmobile']").val();
        var subject = $("input[name='subject']").val();
        var message = $("textarea[name='message']").val();
        $.ajax({
              url: "/produccion/loteNoPlanificado",
              type:'POST',
              data: {_token:_token, name:name, contemail:contemail, contmobile:contmobile, subject:subject, message:message},
              success: function(data) {
                  // No error empty the field and previous error msg if any.
                  if($.isEmptyObject(data.error)){
                    /*$(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").html('');
                    $(".print-success-msg").css('display','block');
                    $(".print-success-msg").html(data.success);
                    $("input[name='name']").val('');
                    $("input[name='contemail']").val('');
                    $("input[name='contmobile']").val('');
                    $("input[name='subject']").val('');
                    $("textarea[name='message']").val('');*/
                  }else{
                    errorMsg(data.error);
                  }
              }
          });
      }); 
      // Function to show error messages
    function errorMsg (msg) {
      $(".print-success-msg").find("ul").html('');
      $(".print-success-msg").css('display','none');
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });
    }
  });