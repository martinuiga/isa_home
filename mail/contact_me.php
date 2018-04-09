<?php
// Check for empty fields
if(empty($_POST['name'])  		||
    empty($_POST['email']) 		||
    empty($_POST['phone']) 		||
    empty($_POST['message'])	||
    !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
    echo "No arguments Provided!";
    return false;
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# First, instantiate the SDK with your API credentials
$mg = Mailgun::create('key-key-57d810c15a260711ee2e29e382182395');

# Now, compose and send your message.
# $mg->messages()->send($domain, $params);
$mg->messages()->send('https://app.mailgun.com/app/domains/sandbox50e17ddd4a0145e3a8c4cf678648b772.mailgun.org', [
    'from'    => 'bob@example.com',
    'to'      => 'uigakarlmartin@gmail.com',
    'subject' => 'The PHP SDK is awesome!',
    'text'    => 'It is so simple to send a message.'
]);

# You can see a record of this email in your logs: https://app.mailgun.com/app/logs .

# You can send up to 300 emails/day from this sandbox server.
# Next, you should add your own domain so you can send 10,000 emails/month for free.
return true;
?>
