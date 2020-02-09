$(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '&#x3c;Ant',
        nextText: 'Sig&#x3e;',
        currentText: 'Hoy',
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
        dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        /* esto agrege */
        changeYear: true,
        changeMonth: true, 
        yearRange: '-88:+0',
        /* hasta aca*/
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['es']);

});  


$(document).ready(function(){

   
    
    var cambio = false;
    $('.nav li a').each(function(index) {
        if(this.href.trim() == window.location){
            $(this).parent().addClass("active");
            cambio = true;
        }
    });
    if(!cambio){
        $('.nav li:first').addClass("active");
    }
    $('input[type=radio][name=optpayment]').change(function(){
    switch ($(this).val()) {
      case 'paypal':
      $('.credit-card').hide();
      $('.paypal').show();
      break;
      case 'tarjetas':
      $('.credit-card').show();
      $('.paypal').hide();
      break;
      default:
    }
  });
  
    $('input[name=telefono]').mask("(999) 999-9999");
    $('input[name=fecha_nac]').datepicker();
    $('.item_birthday').datepicker();

    $('#next-shop').click(function(){
        window.location.href = 'resume';
    });
    $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });
    $('form#quiz').validate({
        rules: {
            option1: {
                required: true
            },
            option2: {
                required: true
            },
            option3: {
                required: true
            },
            option4: {
                required: true
            },
            option5: {
                required: true
            },
            option6: {
                required: true
            }
        },
        showErrors: function (errorMap, errorList) {
            var errors = this.numberOfInvalids();

            if (errors) {
                var message = errors == 1
                ? 'No ha sido seleccionado 1 campo aún.'
                : 'No ha sido seleccionado ' + errors + ' campos aún.';
                $('#message-quiz').html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Advertencia!</strong> '+message+'</div>');
                //$('#message-quiz').show();
            }

            this.defaultShowErrors();
        },
        errorPlacement: function(error, element) {
            return true;
        }
    });
    $("form#quiz").submit(function(e){
        e.preventDefault();

        var correct_answers = {
            "option1": ["y"],
            "option2": ["1","2","3","4","5","6","7"],
            "option3": ["1","2"],
            "option4": ["n"],
            "option5": ["n"],
            "option6": ["y"]
        };
        //Obtiene el valor de los inputs selects y radios
        var questions_answers = {
            "option1": $('input[name="option1"]:checked').val(),
            "option2": $('select[name="option2"]').val(),
            "option3": $('select[name="option3"]').val(),
            "option4": $('input[name="option4"]:checked').val(),
            "option5": $('input[name="option5"]:checked').val(),
            "option6": $('input[name="option6"]:checked').val()
        }

        //Variables total y puntuación
        var total = 6;
        var score = 0;

        if($(this).valid() != false)
        {
            $.each(questions_answers, function(question, question_value)
                   {
                $.each(correct_answers, function(correct, correct_value)
                       {
                    //Variable retorna estado si fue encontrado valor
                    var state = false;

                    //Verifica si existe las optiones
                    if(correct.indexOf(question) >= 0)
                    {
                        for(var i=0; i < correct_value.length; i++)
                        {
                            //Compara el valor con cada valor y verifica si exista
                            if(correct_value[i].indexOf(question_value) >= 0)
                            {
                                //Si se encuentra el estado cambia a true
                                state = true;

                                //Se suma más uno si la respuesta es correct
                                score = score + 1;

                                //console.log(question_value);
                            }
                        }

                        if(state == false){
                            swal({
                                title: "Algo salio mal?",
                                text: "Con  base a sus respuestas proporcionadas usted NO califica para aplicar para una Visa de turista categoría B1/B2 para Los Estados Unidos.",
                                type: "error",
                                showCancelButton: false,
                                confirmButtonClass: 'btn-danger',
                                confirmButtonText: 'intentar nuevamente'
                            });
                            $('label#'+question).addClass('text-danger');

                            switch(question){
                                case 'option1':
                                    $('div#alert-option1').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Si usted <b>NO</b> es ciudadano mexicano y <b>NO</b> se encuentra legalmente en México, <b>NO</b> podrá realizar el trámite de Visa Americana de Turista Categoría B1/B2 en la Embajada o Consulados de los Estados Unidos en México.</div>');
                                    break;
                                case 'option2':
                                    if(question_value == 8){
                                        $('div#alert-option2').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Usted <b>NO</b> puede realizar estudios en los Estados Unidos con este tipo de Visa Americana de Turista Categoría B1/B2.</div>');
                                    }

                                    if(question_value == 9){
                                        $('div#alert-option2').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Usted <b>NO</b> puede trabajar en los Estados Unidos con este tipo de Visa Americana de Turista Categoría B1/B2.</div>');
                                    }
                                    break;
                                case 'option3':
                                    $('div#alert-option3').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Usted <b>NO</b> puede permanecer más de seis meses en los Estados Unidos con este tipo de Visa Americana de Turista Categoría B1/B2.</div>');
                                    break;
                                case 'option4':
                                    $('div#alert-option4').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Usted <b>NO</b> puede vivir permanentemente en Los Estados Unidos con este tipo de Visa Americana de Turista Categoría B1/B2.</div>');

                                    break;
                                case 'option5':
                                    $('div#alert-option5').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>SI</b> usted pertenece a algún grupo terrorista u organización delictiva, NO LE SERA OTORGADA UNA VISA PARA LOS ESTADOS UNIDOS</div>');
                                    break;
                                case 'option6':
                                    $('div#alert-option6').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Si usted <b>NO</b> cuenta con lazos fuertes en México o en su país de origen, es muy posible que no le sea otorgada una Visa Americana de Turista Categoría B1/B2.</div>');
                                    break;
                            }

                        }else{
                            $('div#alert-'+question).html('');
                            $('label#'+question).removeClass('text-danger');
                        }

                        if(score == total)
                        {
                            $.ajax({
                                url:'controller/controller.php',
                                type:'POST',
                                data:'action=makeTest',
                                beforeSend: function(){
                                    $('button#send').html('<i class="fa fa-circle-o-notch faa-spin animated"></i> Enviando');
                                    $('button#send').prop('disabled', true);
                                },
                                success:function(data){
                                    var res = JSON.parse(data);
                                    if(res.success == true){
                                    swal({
                                        title: "Desea continuar?",
                                        text: "Con base  a sus respuestas proporcionadas usted SI califica para aplicar para una Visa de turista categoría B1/B2 para Los Estados Unidos.",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonClass: 'btn-success',
                                        confirmButtonText: 'Continuar'
                                    },function(){
                                      window.location.href = "register";
                                    });
                                    }
                                }

                            });
                        }
                    }
                });
            });
        }
    });
    /*OTPIONES*/
});
