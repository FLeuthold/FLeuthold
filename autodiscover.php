<?php
// Set the correct header
header("Content-Type: text/xml; charset=utf-8");

// Get the raw POST data from Outlook
$request = file_get_contents("php://input");

// Extract the email address using a simple regex (or an XML parser)
preg_match('/<EMailAddress>(.*)<\/EMailAddress>/', $request, $matches);
$email = $matches[1] ?? '';

// Output the XML response
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">
  <Response xmlns="http://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a">
    <Account>
      <AccountType>email</AccountType>
      <Action>settings</Action>
      <Protocol>
        <Type>IMAP</Type>
        <Server>mail.your-server.de</Server>
        <Port>993</Port>
        <LoginName><?php echo $email; ?></LoginName>
        <SSL>on</SSL>
      </Protocol>
      <Protocol>
        <Type>SMTP</Type>
        <Server>mail.your-server.de</Server>
        <Port>465</Port>
        <SSL>on</SSL>
        <LoginName><?php echo $email; ?></LoginName>
        <AuthRequired>on</AuthRequired>
      </Protocol>
    </Account>
  </Response>
</Autodiscover>
