<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="row">
  <div class="col-md-12">
    <form method="post" action="process.php" id="registerform" novalidate="novalidate">
      <div class="form-group">
        <p class="text-left"><strong>Draw Signature</strong></p>

        <!-- js signature widget -->
        <div class='js-signature'></div>

        <!-- action button to clear the signature -->
        <p><button type="button" id="clearBtn" class="btn btn-default" onclick="clearCanvas();">Clear Signature</button></p>
        
        <!-- populate the base64 encoded image in the textarea -->
        <textarea id="signature64" name="signed" style="display: none"></textarea>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary" id="submit">Register</button>
      </div>
    </form>
  </div>
</div>


</body>

<!-- include jQuery UI -->
<script  src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- include jq-signature library -->
<script src="js/jq-signature.js"></script>

<script>
     // initiate jq-signature
     $('.js-signature').jqSignature({
         autoFit: true, // allow responsive
         height: 182, // set height
         border: '1px solid #a0a0a0', // set widget border
     });
     
     // create hook for clear button
     function clearCanvas() {
         $('.js-signature').jqSignature('clearCanvas');
         $("#signature64").val(''); // clear the textarea as well
     }

     // update the generated encoded image in the textarea
     $('.js-signature').on('jq.signature.changed', function() {
         var data = $('.js-signature').jqSignature('getDataURL');
         $("#signature64").val(data);
     });
 </script>
</html>