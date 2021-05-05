<?php
Configure::set('Keyhelp.email_templates', [
    'en_us' => [
        'lang' => 'en_us',
        'text' => 'Your Keyhelp account is now active, details below:

Username: {service.cpanel_username}
Password: {service.cpanel_password}

To log into cPanel please visit https://{module.host_name}


Thank you for your business!',
        'html' => '<p>Your cPanel account is now active, details below:</p>
<p>Username: {service.cpanel_username}<br />Password: {service.cpanel_password}</p>
<p>To log into cPanel please visit https://{module.host_name}<br /></p>


<p>Thank you for your business!</p>'
    ]
]);
