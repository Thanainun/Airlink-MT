<?php ?>
<h1 style="text-align: center;">Ligingin</h1>
  <center>
    Login
  </center>

<?php
echo "
<!--
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<WISPAccessGatewayParam 
  xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
  xsi:noNamespaceSchemaLocation=\"http://www.acmewisp.com/WISPAccessGatewayParam.xsd\">
<AuthenticationReply>
<MessageType>120</MessageType>
<ResponseCode>201</ResponseCode>

<LoginResultsURL>".$url_refresh."</LoginResultsURL>

</AuthenticationReply> 
</WISPAccessGatewayParam>
-->
";