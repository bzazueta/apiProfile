<?php 

require_once __DIR__ . '/../vendor/autoload.php';

//require(dirname(__FILE__) . '/Openpay/Openpay.php');
?>


<head>
  <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript"
        src="https://js.openpay.mx/openpay.v1.min.js"></script>


        
<script type='text/javascript'
  src="https://js.openpay.mx/openpay-data.v1.min.js"></script>


<script type="text/javascript">
    
     $(document).ready(function() {
          
        OpenPay.setId('miubfajdtwkf7chvvirg');
            OpenPay.setApiKey('sk_ba7eb29cd61949f6b7b3d15387da24a4');
          
            OpenPay.setSandboxMode(true);
          
            var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
            alert(deviceSessionId);

           

            
    });

</script>


</head>
<form action="#" method="POST" id="payment-form">
    <input type="hidden" name="token_id" id="token_id">
    <input type="hidden" name="use_card_points" id="use_card_points" value="false">
    <div class="pymnt-itm card active">
        <h2>Tarjeta de crédito o débito</h2>
        <div class="pymnt-cntnt">
            <div class="card-expl">
                <div class="credit"><h4>Tarjetas de crédito</h4></div>
                <div class="debit"><h4>Tarjetas de débito</h4></div>
            </div>
            <div class="sctn-row">
                <div class="sctn-col l">
                    <label>Nombre del titular</label><input type="text" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name" value="Juan perez" >
                </div>
                <div class="sctn-col">
                    <label>Número de tarjeta</label><input type="text" autocomplete="off" data-openpay-card="card_number" value="4111111111111111"></div>
                </div>
                <div class="sctn-row">
                    <div class="sctn-col l">
                        <label>Fecha de expiración</label>
                        <div class="sctn-col half l"><input type="text" placeholder="Mes" data-openpay-card="expiration_month" value="11"></div>
                        <div class="sctn-col half l"><input type="text" placeholder="Año" data-openpay-card="expiration_year" value="21"></div>
                    </div>
                    <div class="sctn-col cvv"><label>Código de seguridad</label>
                        <div class="sctn-col half l"><input type="text" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2" value="123"></div>
                    </div>
                </div>
                <div class="openpay"><div class="logo">Transacciones realizadas vía:</div>
                <div class="shield">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
            </div>
            <div class="sctn-row">
                    <!-- <a class="button rght" name="buton" type="button" id="pay-button">Pagar</a> -->
                    <input name="buton" type="submit" id="pay-button">pagar</input>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
            
            $('#pay-button').on('click', function(event) {
                alert('click');

               
                
               // $("#pay-button").prop( "disabled", true);
                OpenPay.token.extractFormAndCreate('payment-form', success_callbak, error_callbak);

                var success_callbak = function(response) {
                    var token_id = response.data.id;
                   console.log(token_id+'entrov');
                    $('#token_id').val(token_id);
                    $('#payment-form').submit();
                };  

                var error_callbak = function(response) {
                    var desc = response.data.description != undefined ?
                    response.data.description : response.message;
                    alert("ERROR [" + response.status + "] " + desc);
                    $("#pay-button").prop("disabled", false);
                };            

            }); 

    </script>

<?php

if(isset($_POST['buton']))
{
   
  echo  $_POST["token_id"].'entro';
    
  
    try
     {
            $openpay = Openpay::getInstance('miubfajdtwkf7chvvirg',
            'sk_ba7eb29cd61949f6b7b3d15387da24a4');
          
            $customer = array(
                'name' => 'Juan dominguez',
                'last_name' => 'dominguez',
                'phone_number' =>'57575757575',
                'email' => 'juan@jhkjhjk.com',);
          
          $chargeData = array(
              'method' => 'card',
              'source_id' => $_POST["token_id"],
              'amount' => 1.00, // formato númerico con hasta dos dígitos decimales. 
              'description' => 'pruebas',
              // Opcional, si estamos usando puntos
              'device_session_id' => $_POST["deviceIdHiddenFieldName"],
              'customer' => $customer
              );
          
          $charge = $openpay->charges->create($chargeData);
          
           var_dump($charge);
    
    } catch (OpenpayApiTransactionError $e) {
        error_log('ERROR on the transaction: ' . $e->getMessage() . 
                ' [error code: ' . $e->getErrorCode() . 
                ', error category: ' . $e->getCategory() . 
                ', HTTP code: '. $e->getHttpCode() . 
                ', request ID: ' . $e->getRequestId() . ']', 0);
    
    } catch (OpenpayApiRequestError $e) {
        error_log('ERROR on the request: ' . $e->getMessage(), 0);
    
    } catch (OpenpayApiConnectionError $e) {
        error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
    
    } catch (OpenpayApiAuthError $e) {
        error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
        
    } catch (OpenpayApiError $e) {
        error_log('ERROR on the API: ' . $e->getMessage(), 0);
        
    } catch (Exception $e) {
        error_log('Error on the script: ' . $e->getMessage(), 0);
    }
}

?>



