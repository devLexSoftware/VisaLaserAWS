<footer class="footer1">
  <div class="container">
    <div class="row"><!-- row -->
      <div class="col-lg-4 col-md-4"><!-- widgets column left -->
        <ul class="list-unstyled clear-margins"><!-- widgets -->
          <li class="widget-container widget_nav_menu"><!-- widgets list -->
            <h1 class="title-widget">Mapa del sitio</h1>
            <ul>
              <li><a  href="http://localhost:8080/csc/"><i class="fa fa-angle-double-right"></i> Inicio</a></li>
              <li><a  href="tramite"><i class="fa fa-angle-double-right"></i>  Trámites de visa B1/B2</a></li>
              <li><a  href="registerUser"><i class="fa fa-angle-double-right"></i>  Renovación de visa B1/B2</a></li>
              <li><a  href="contact"><i class="fa fa-angle-double-right"></i>  Contacto</a></li>              
            </ul>
          </li>
        </ul>
      </div><!-- widgets column left end -->
      <div class="col-lg-4 col-md-4"><!-- widgets column left -->
        <ul class="list-unstyled clear-margins"><!-- widgets -->
          <li class="widget-container widget_nav_menu"><!-- widgets list -->
            <h1 class="title-widget">Ayuda</h1>
            <ul>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Aviso de privacidad</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i> Términos y Condiciones</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- widgets column left end -->
      <div class="col-lg-4 col-md-4"><!-- widgets column center -->
        <ul class="list-unstyled clear-margins"><!-- widgets -->
          <li class="widget-container widget_recent_news"><!-- widgets list -->
            <h1 class="title-widget">Contacto</h1>
            <div class="footerp">
              <p><a href="mailto:rastreo@csc-americanvisa-mexico.com">rastreo@csc-americanvisa-mexico.com</a></p>
              <p><a href="mailto:pagos@csc-americanvisa-mexico.com">pagos@csc-americanvisa-mexico.com</a></p>
              <p><a href="mailto:atencionaclientes@csc-americanvisa-mexico.com">atencionaclientes@csc-americanvisa-mexico.com</a></p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!--header-->

  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="copyright">
            Copyright@CSC-American Visa Todos los Derechos Reservados 2020
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        </div>
      </div>
    </div>
  </div>


    <!-- <script src="js/jquery.min.js"></script> -->
  <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
    <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/site.js"></script>
    <script src="js/procedure.js"></script>
    <script src="js/intro.js"></script>


    <!-- Metodo de pago -->    
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>


    <script type="text/javascript" >

    $( document ).ready(function() {

      var dtToday = new Date();

      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();

      if(month < 10)
          month = '0' + month.toString();
      if(day < 10)
          day = '0' + day.toString();

      var maxDate = year + '-' + month + '-' + day;    
      $('#in_birthday').attr('max', maxDate);
    });


    function loadingSpinner()
    {            
      $('#loading').modal('show');      

    }
    </script>

    <script type="text/javascript" >
      Conekta.setPublicKey('key_HnQUGWyaPznx9Co39NrtKcg');

debugger;


$("#show_password a").on('click', function(event) {
            debugger;
            event.preventDefault();
            if($('#show_password input').attr("type") == "text")
            {
                $('#show_password input').attr('type', 'password');
                $('#show_password i').addClass( "fa-eye-slash" );
                $('#show_password i').removeClass( "fa-eye" );
            }
            else if($('#show_password input').attr("type") == "password")
            {
                $('#show_password input').attr('type', 'text');
                $('#show_password i').removeClass( "fa-eye-slash" );
                $('#show_password i').addClass( "fa-eye" );
            }
        });

        
      var conektaSuccessResponseHandler = function(token) {
        debugger;
        var $form = $("#card-form");
          
        // var pay = $("#metodoPagoPreferente").val();
        // var pay = $form.find("metodoPagoPreferente").val();
        // if(pay == "tarjeta")
        // {          
          //Inserta el token_id en la forma para que se envíe al servidor
          $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
        // }
        $form.get(0).submit(); //Hace submit

      };

      var conektaErrorResponseHandler = function(response) {
        var $form = $("#card-form");
        $("#erroresTarjeta").show();
        $form.find(".card-errors").text(response.message_to_purchaser);
        $form.find("button").prop("disabled", false);
        $('#loading').modal('hide');      
        
      };
      
      //jQuery para que genere el token después de dar click en submit
      $(function () {
        $("#card-form").submit(function(event) {     

          var $form = $(this);

          var name = $.trim($('#metodoPagoPreferente').val());

          if(name == "tarjeta")
          {          
            // Previene hacer submit más de una vez
            $form.find("button").prop("disabled", true);        
            Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);            
            return false;
          }          
            $('#loading').modal('show');      

                    
        });
      });
    </script>
    

    
    <script type="text/javascript">
    // var formTrue = 0;
    function OptionInitial (e){
      var value = e.options[e.selectedIndex].value;
      var item = e.id;

      switch(item){
        case 'pregunta_1':
          if(value === "Si"){
            document.getElementById("error_1").style.visibility = "hidden";            
            document.getElementById("error_1").innerHTML = "";
            // formTrue = formTrue - 1;
          }
          else if(value === "No"){        
            document.getElementById("error_1").innerHTML  = "Si usted NO es ciudadano Mexicano y NO se encuentra legalmente en México, NO podrá realizar el trámite de Visa Americana de turista categoría B1/B2 en la Embajada o Consulados de Los Estados Unidos en México.";    
            document.getElementById("error_1").style.visibility = "visible";
            // formTrue = formTrue + 1;
          }
          break;

        case 'pregunta_2':        
        if(value === "Estudio"){
          document.getElementById("error_2").innerHTML  = "Usted no puede realizar estudios en Los Estados Unidos con este tipo de Visa de turista categoría B1/B2";
          document.getElementById("error_2").style.visibility = "visible";            
          // formTrue = false;
        }
        else if(value === "Trabajar"){            
          document.getElementById("error_2").innerHTML  = "Usted no puede trabajar en Los Estados Unidos con este tipo de Visa de turista categoría B1/B2";
          document.getElementById("error_2").style.visibility = "visible";
          // formTrue = false;
        }
        else{          
          document.getElementById("error_2").style.visibility = "hidden";
          document.getElementById("error_2").innerHTML = "";
          // formTrue = true;
        }
        break;

        case 'pregunta_3':        
        if(value === "3"){
          document.getElementById("error_3").innerHTML  = "Usted no puede permanecer mas de seis meses en Los Estados Unidos con este tipo de Visa de turista categoría B1/B2";
          document.getElementById("error_3").style.visibility = "visible";            
          // formTrue = false;
        }        
        else{          
          document.getElementById("error_3").style.visibility = "hidden";
          document.getElementById("error_3").innerHTML = "";
          // formTrue = true;
        }
        break;

        case 'pregunta_4':        
        if(value === "No"){
          document.getElementById("error_4").innerHTML  = " Si usted No cuenta con lazos fuertes en México o en su país de origen, es muy posible que no le sea otorgada una Visa de turista categoría B1/B2";
          document.getElementById("error_4").style.visibility = "visible";            
          // formTrue = false;
        }        
        else{          
          document.getElementById("error_4").style.visibility = "hidden";
          document.getElementById("error_4").innerHTML = "";
          // formTrue = true;
        }
        break;

        case 'pregunta_5':        
        if(value === "Si"){
          document.getElementById("error_5").innerHTML  = "Usted no puede ni podrá ingresar a Los Estados Unidos.";
          document.getElementById("error_5").style.visibility = "visible";            
          // formTrue = false;
        }        
        else{          
          document.getElementById("error_5").style.visibility = "hidden";
          document.getElementById("error_5").innerHTML = "";
          // formTrue = true;
        }
        break;

        case 'pregunta_6':        
        if(value === "Si"){
          document.getElementById("error_6").innerHTML  = "Usted no puede vivir permanentemente en Los Estados Unidos con este tipo de Visa de turista categoría B1/B2";
          document.getElementById("error_6").style.visibility = "visible";            
          // formTrue = false;
        }        
        else{          
          document.getElementById("error_6").style.visibility = "hidden";
          document.getElementById("error_6").innerHTML = "";
          // formTrue = true;
        }
        break;
      }

    }
    </script>
