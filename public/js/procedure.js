var _dUser;
$(document).ready(function(){


    /*$.validator.addMethod("fechaESP", function( value, element)
        {
            var validator = this;
            var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
            var fechaCompleta = value.match(datePat);
            var miFechaActual = new Date();
            var ano_actual = miFechaActual.getFullYear();
            var fechaInicio = new Date('01/01/1930');

            if (fechaCompleta == null) {
                $.validator.messages.fechaESP = "Favor ingresa una fecha válido";
                return false;
            }

            dia = fechaCompleta[1];
            mes = fechaCompleta[3];
            anio = fechaCompleta[5];

            if (dia < 1 || dia > 31) {
                $.validator.messages.fechaESP = "El valor del día debe estar comprendido entre 1 y 31.";
                return false;
            }
            if (mes < 1 || mes > 12) {
                $.validator.messages.fechaESP = "El valor del mes debe estar comprendido entre 1 y 12.";
                return false;
            }
            if ((mes==4 || mes==6 || mes==9 || mes==11) && dia==31) {
                $.validator.messages.fechaESP = "El mes "+mes+" no tiene 31 días!";
                return false;
            }
            if (mes == 2) { // bisiesto
                var bisiesto = (anio % 4 == 0 && (anio % 100 != 0 || anio % 400 == 0));
                if (dia > 29 || (dia==29 && !bisiesto)) {
                    $.validator.messages.fechaESP = "Febrero del " + anio + " no contiene " + dia + " dias!";
                    return false;
                }
            }

            return true;
        }, "or favor ingrese una fecha válida");*/

    $.validator.addMethod("pattern", function(value, element, param) {
        if (this.optional(element)) {
            return true;
        }
        if (typeof param === 'string') {
            param = new RegExp('^(?:' + param + ')$');
        }
        return param.test(value);
    }, "Invalid format.");

    $( "#form_register" ).validate( {
        rules: {
            nombre: {
              required: true,
              pattern: /^[a-zA-ZáéíïóúüÁÉÍÏÓÚÜñÑ\'\"\s]+$/
            },
            apellidos: {
                required: true,
                pattern: /^[a-zA-ZáéíïóúüÁÉÍÏÓÚÜñÑ\'\"\s]+$/
            },
            telefono: {
                required: true,
                minlength: 10
            },
            direccion:{
                required: true
            },
            sexo:"required",
            fecha_nac:{
                required:true
            },
            correo: {
                required: true,
                email: true
            },
            contrasena: {
                required: true,
                minlength: 6
            },
            repit_contrasena: {
                required: true,
                minlength: 6,
                equalTo: "input[name=contrasena]"
            }
        },
        messages: {
            nombre: {
                required:"Por favor ingrese su nombre",
                pattern: 'No se permite caracteres especiales'
            },
            apellidos: {
                required:"Por favor ingrese sus apellidos",
                pattern: 'No se permite caracteres especiales'
            },
            telefono: {
                required: "Por favor ingrese un número teléfonico válido",
                minlength: "Solo acepta 10 dígitos"
            },
            direccion: {
                required:"Por favor ingrese una dirección correcta"
            },
            sexo: "Por favor selecciona una opción",
            fecha_nac: "Por favor ingrese su fecha de nacimiento",
            correo: "Por favor ingrese un correo válido",
            contrasena: {
                required: "Por favor ingrese una contraseña",
                minlength: "Su contraseña debe tener al menos 6 caracteres de largo"
            },
            repit_contrasena: {
                required: "Por favor confirme su contraseña",
                minlength: "Su contraseña debe tener al menos 6 caracteres de largo",
                equalTo: "Por favor ingrese la misma contraseña"
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        },
        submitHandler: function(form) {

            var check_options = {'action':'validateCustomer','email':$('input[name=correo]').val()};

             $.ajax({
                url:'controller/controller.php',
                type:'POST',
                data:check_options,
                dataType:'JSON',
                success:function(request){
                    if (request.success == 1) {
                    swal({
                    title: "Información",
                    text: request.msj,
                    type: "info",
                    showCancelButton: false,
                    confirmButtonClass: 'btn-primary',
                    confirmButtonText: 'Acceso a mi cuenta'
                    },function(){
                      window.location.href = "login";
                    });
                    }else{
                       var formData = {
                        'nombre' : $('input[name=nombre]').val(),
                        'apellidos' : $('input[name=apellidos]').val(),
                        'telefono' : $('input[name=telefono]').val(),
                        'direccion' : $('input[name=direccion]').val(),
                        'sexo' : $('select[name=sexo]').val(),
                        'fecha_nac' : $('input[name=fecha_nac]').val(),
                        'correo' : $('input[name=correo]').val(),
                        'contrasena' : $('input[name=contrasena]').val(),
                        'repit_contrasena' : $('input[name=repit_contrasena]').val()};
                        var _data = {'dataUser':JSON.stringify(formData)};
                        $.redirectPost(_data,'result');
                    }
                }
             });
            /*var formData = {
                'nombre' : $('input[name=nombre]').val(),
                'apellidos' : $('input[name=apellidos]').val(),
                'telefono' : $('input[name=telefono]').val(),
                'direccion' : $('input[name=direccion]').val(),
                'sexo' : $('select[name=sexo]').val(),
                'fecha_nac' : $('input[name=fecha_nac]').val(),
                'correo' : $('input[name=correo]').val(),
                'contrasena' : $('input[name=contrasena]').val(),
                'repit_contrasena' : $('input[name=repit_contrasena]').val()
            };
            var _data = {'dataUser':JSON.stringify(formData)};
            $.redirectPost(_data,'result');*/
        }
    });
     $( "#form-reset" ).validate( {
        rules: {
            email_reset: {
                required: true,
                email: true
            },
            reset_pwd: {
                required: true,
                minlength: 6
            },
            repit_reset_pwd: {
                required: true,
                minlength: 6,
                equalTo: "input[name=reset_pwd]"
            }
        },
        messages: {
            email_reset: "Por favor ingrese un correo válido",
             reset_pwd: {
                required: "Por favor ingrese una nueva contraseña",
                minlength: "Su contraseña debe tener al menos 6 caracteres de largo"
            },
            repit_reset_pwd: {
                required: "Por favor confirme su  nueva contraseña",
                minlength: "Su contraseña debe tener al menos 6 caracteres de largo",
                equalTo: "Por favor ingrese la misma contraseña"
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        },
        submitHandler: function(form) {
            var _reset = {
                'action':'resetPassword',
                'reset_email':$('input[name=email_reset]').val(),
                'reset_pwd':$('input[name=reset_pwd').val()
            }
            $.ajax({
                url: 'controller/controller.php',
                type: 'POST',
                dataType: 'json',
                data: _reset,
                beforeSend: function(){
                    $('button#btn-reset').html('<i class="fa fa-circle-o-notch faa-spin animated"></i> Procesando');
                  $('button#btn-reset').prop('disabled', true);
              },
              success:function(request){
                if(request.success == 1){
                    //$('#msj-reset').html("<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Felicidades! </strong>"+ request.msj +" </div>");
                    $('button#btn-reset').prop('disabled', false);
                    $('button#btn-reset').html('<i class="fa fa-sign-in"></i> Acceder a mi cuenta');
                    $("#form-reset")[0].reset();
                swal({
                       title: "Felicidades!",
                       text: request.msj,
                       type: "success",
                       showCancelButton: false,
                       confirmButtonClass: 'btn-primary',
                       confirmButtonText: 'Acceder a mi cuenta'
                   },function(){
                      window.location.href = "login";
                   });
                }else{
                    $('#msj-reset').html("<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Advertencia! </strong>"+ request.error +"</div>");
                    $('button#btn-reset').prop('disabled', false);
                    $('button#btn-reset').html('<i class="fa fa-sign-in"></i> Cambiar contraseña');
                }
              }
            });

        }
    });
    $('.add').click(function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="item_name[]" class="form-control item_name" style="width: 100%;text-align: left;" placeholder="Nombre Completo"/></td>';
        html += '<td><input type="email" name="item_email[]" class="form-control  item_email" style="width: 100%;text-align: left;" placeholder="Correo"/></td>';
        html += '<td><input type="text" name="item_birthday[]" class="form-control item_birthday" style="width: 100%;text-align: left;" placeholder="Fecha Nacimiento"/></td>';
        html += '<td><select name="item_sex[]" class="form-control item_sex" style="width: 100%;text-align: left;"><option value="Masculino">Masculino</option><option value="Femenino">Femennino</option></select></td>';
        html += '<td><input type="text" name="item_relation[]" class="form-control item_relation" style="width: 100%;text-align: left;" placeholder="Parentesco"/></td>';
        // html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fa fa-trash"></i> Eliminar</button></td></tr>';
        $('#item_table').append(html);
        /*$('.form-control.item_birthday').mask("99/99/9999");*/
        $('.form-control.item_birthday').datepicker();

    });
    // $(document).on('click', '.remove', function(){
    //     $(this).closest('tr').remove();
    //
    // });
    $('.btn-cancel').click(function(){
         var remove = $('table tr:not(:first-child)').remove();
         if(remove){
           $("#opt_no").attr('checked', true);
           $("#opt_si").attr('checked', false);
           $('#modalUsuarios').modal('hide');
           $('#next-procedure').show();
            sendResult();
           // $('#next-procedure').click(function(){
           //    var users = {'User':JSON.stringify(_dUser)};
           //    $.redirectPost(users,'checkout');
           //  });
           $('#insert_form')[0].reset();
         }else{
           console.log("No paso nada");
         }
    });
    /* Change value*/
    $('input[type=radio][name=optradio]').change(function(){

        var error = '';
        var _data;
        _dUser = {
            'nombre':nameU,
            'apellidos':apellidosU,
            'telefono':telefonoU,
            'direccion':direccionU,
            'sexo':sexoU,
            'fecha_nac':fecha_nacU,
            'correo':correoU,
            'contrasena':contrasenaU
        }
        if($(this).val() == 'si'){
            $('#modalUsuarios').modal('show');
            $('#next-procedure').hide();
            //mostrar lonlyos btns

            $('#insert_form').on('submit', function(event){
                event.preventDefault();
                var error = '';
                var item_name  = [];
                var item_email = [];
                var item_birthday = [];
                var item_sex = [];
                var item_relation = [];
                $('.item_birthday').mask("99/99/9999");
                $('.item_name').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                        error += "<p>Ingrese el nombre faltante en la fila</p>";
                        return false;
                    }
                    count = count + 1;
                    item_name.push($(this).val());
                });
                $('.item_email').each(function(){
                    var count = 1;
                    var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if($(this).val() == '')
                    {
                        error += "<p>Por favor ingrese el correo faltante en la fila</p>";
                        return false;
                    }
                    count = count + 1;
                    item_email.push($(this).val());
                });
                $('.item_birthday').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                        error += "<p>Por favor ingrese su fecha de nacimiento faltante en la fila</p>";
                        return false;
                    }
                    count = count + 1;
                    item_birthday.push($(this).val());
                });
                $('.item_sex').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                        error += "<p>Por favor seleccione una opción faltante en la fila</p>";
                        return false;
                    }
                    count = count + 1;
                    item_sex.push($(this).val());
                });
                $('.item_relation').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                        error += "<p>Por favor ingrese un tipo de relación faltante en la fila</p>";
                        return false;
                    }
                    count = count + 1;
                    item_relation.push($(this).val());
                });
                var form_data = {
                    'action':'multi-user',
                    'item_name':item_name,
                    'item_email':item_email,
                    'item_birthday':item_birthday,
                    'item_sex':item_sex,
                    'item_relation':item_relation};
                //var form_data = $(this).serialize();
                if(error == '')
                {
                  var multiU = {'User':JSON.stringify(_dUser),'multiUser':JSON.stringify(form_data)};
                  $.redirectPost(multiU,'checkout');
                }
                else
                {
                    //$('#error').html('<div class="alert alert-danger">'+error+'</div>');
                    $('#error').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>'+error+'</div>');
                }
            });
        }else{
            $('#next-procedure').show();
            $('#modalUsuarios').modal('hide');
             sendResult();
            // $('#next-procedure').click(function(){
            //   var users = {'User':JSON.stringify(_dUser)};
            //   $.redirectPost(users,'checkout');
            // });
        }
    });
    $('#send-paypal').click(function(){
     var selected = $('input[type=radio][name=optpayment]:checked').val();
      var json_array;
      var adinfo = {
        'acountrie':$('select[name="countries"]').val(),
        'astate':$('select[name="states"]').val(),
        'acity': $('input[name="city"]').val(),
        'aaddress': $('input[name="address"]').val(),
        'aaddress1': $('input[name="address1"]').val(),
        'azipcode': $('input[name="zipcode"]').val(),
        'cardnumber':$('input[name="card_number"]').val(),
        'cardname':$('input[name="namecard"]').val(),
        'expmount':$('input[name="exp_mount"]').val(),
        'expyear':$('input[name="exp_year"]').val(),
        'cvv':$('input[name="cvv"]').val()
      }
       if(selected == 'paypal'){
          json_array = {'action':'openProcedure','option':selected,'cuser': JSON.stringify(cUser),'musers':JSON.stringify(mperson)};
       }else{
         json_array = {'action':'openProcedure','option':selected,'cuser': JSON.stringify(cUser),'musers':JSON.stringify(mperson),'addInfo':JSON.stringify(adinfo)};
       }
      $.ajax({
        url:'controller/controller.php',
        data:json_array,
        type:'POST',
        dataType:'JSON',
        beforeSend: function(){
				$('button#send-paypal').html('<i class="fa fa-circle-o-notch faa-spin animated"></i> Procesando Pago');
				$('button#send-paypal').prop('disabled', true);
			  },
        success:function(request){
            location.href = request.url;
           //console.log(request);
        }
      });
    });
    $('#btn-login').click(function(){
      var send = {
        'action':'login',
        'uemail':$('input[name="username"]').val(),
        'password':$('input[name="password"]').val()
      }
      $.ajax({
        url:'controller/controller.php',
        type:'POST',
        data:send,
        dataType:'JSON',
        beforeSend: function(){
          $('button#btn-login').html('<i class="fa fa-circle-o-notch faa-spin animated"></i> Procesando');
          $('button#btn-login').prop('disabled', true);
        },
        success:function(request){
          if(request.success == 1){
            $('#msj').html("<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Logueado exitosamente! </strong> <i class='fa fa-spinner fa-spin'></i> Datos encontrados correctamente</div>");
            setTimeout(function(){ window.location.href = 'admin'; }, 3000);

          }else{
            $('#msj').html("<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Advertencia! </strong>"+ request.error +"</div>");
            $('button#btn-login').prop('disabled', false);
            $('button#btn-login').html('<i class="fa fa-sign-in"></i> Acceder a mi cuenta');
          }
        }
      });
    });
    //FROMS
   $("#pay-button").click(function(){
        var error = '';
        var cardnumber = $('input[name="card_number"]').val();
        var mes = $('select[name=mesV]').val();
        var anno = $('select[name=anoV]').val();
        var cvv = $('input[name="cvv2"]').val();
        var _date = mes+"/"+anno;
        var errores = "";
        var count = 1;

        if (!validateCardNumber(cardnumber)) {
            alert("Ingresa una tarjeta valida");
            return false;
        }

        if (!validExpirationDate(_date)) {
           alert("Ingresa una fecha valida");
            return false;
        }
        if (!validateCvv(cvv)) {
            alert("Ingresa un CVV valida");
            return false;
        }
        var data = {
            'cardnumber':cardnumber,
            'mes':mes,
            'anno':anno,
            'cvv':cvv
        }
    
       var  data_json = {'action':'openPayworks','cUser': JSON.stringify(cUser),'mUsers':JSON.stringify(mperson),'addPay':JSON.stringify(data)};
       $.ajax({
            url: 'controller/controller.php',
            type: 'POST',
            dataType: 'JSON',
            data: data_json,
            success:function(request){
                location.href = request;
            }
        });
        
        

    });
});


var sendResult = function(){
    $('#next-procedure').click(function(){
      var users = {'User':JSON.stringify(_dUser)};
      $.redirectPost(users,'checkout');
  });
}

function valid_credit_card(value) {
  // accept only digits, dashes or spaces
    if (/[^0-9-\s]+/.test(value)) return false;
    // The Luhn Algorithm. It's so pretty.
    var nCheck = 0, nDigit = 0, bEven = false;
    value = value.replace(/\D/g, "");
    for (var n = value.length - 1; n >= 0; n--) {
        var cDigit = value.charAt(n),
              nDigit = parseInt(cDigit, 10);

        if (bEven) {
            if ((nDigit *= 2) > 9) nDigit -= 9;
        }

        nCheck += nDigit;
        bEven = !bEven;
    }
    return (nCheck % 10) == 0;
}



function validateCardNumber(number) {
    var regex = new RegExp("^[0-9]{16}$");
    if (!regex.test(number))
        return false;
    return luhnCheck(number);
}
function luhnCheck(val) {
    var sum = 0;
    for (var i = 0; i < val.length; i++) {
        var intVal = parseInt(val.substr(i, 1));
        if (i % 2 == 0) {
            intVal *= 2;
            if (intVal > 9) {
                intVal = 1 + (intVal % 10);
            }
        }
        sum += intVal;
    }
    return (sum % 10) == 0;
}
function validExpirationDate(date) {
    var currentDate = new Date(),
        currentMonth = currentDate.getMonth() + 1, // Zero based index
        currentYear = currentDate.getFullYear(),
        expirationMonth = Number( date.substr( 0, 2 ) ),
        expirationYear = Number( date.substr( 3, date.length ) );
    if ( ( expirationYear < currentYear ) || ( expirationYear == currentYear && expirationMonth <= currentMonth ) ) {
        return false;
    }
    return true;
}
function validateCvv(cvv){
    return cvv.length > 2;
}

$.extend({
    redirectPost: function(args, location, target){
        try{
            var form = $('<form></form>');
            form.attr("method", "post");
            form.attr("action", ((location == null) ? 'controller/controller.php' : location));
            form.attr("target", (target || ''));
            $.each( args, function( key, value ) {
                var field = $('<input></input>');
                field.attr("type", "hidden");
                field.attr("name", key);
                field.attr("value", value);
                form.append(field);
            });
            $(form).appendTo('body').submit();
        }catch(err)
        {
            console.log(err);
        }
    }
});
