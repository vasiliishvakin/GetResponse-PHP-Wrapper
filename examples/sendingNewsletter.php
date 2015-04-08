<?php
# Demonstrates how to sending newsletter to campaign.

# JSON::RPC module is required
# available at http://github.com/GetResponse/DevZone/blob/master/API/lib  /jsonRPCClient.php
require_once 'jsonRPCClient.php';

# your API key is available at
# https://app.getresponse.com/my_api_key.html

$api_key = 'APIKEY';

# API 2.x URL
$api_url = 'http://api2.getresponse.com';

# initialize JSON-RPC client
$client = new jsonRPCClient($api_url);

# find campaign named 'test'
$campaigns = $client->get_campaigns(
    $api_key,
    array(
        # find by name literally
        'name' => array('EQUALS' => '<enter your campaign name>')
    )
);

# uncomment following line to preview Response
print_r($campaigns);

# because there can be only one campaign of this name
# first key is the CAMPAIGN_ID required by next method
# (this ID is constant and should be cached for future use)

$CAMPAIGN_ID = array_pop(array_keys($campaigns));

$contact_id = array('p3WW', 'PEU'); // Find the contact ID by using email ID and form as array like this.

$body = "Newsletter message. we can send any HTML";

# Sending Newsletter to the campaign
$result = $client->send_newsletter(
    $api_key,
    array(
        "campaign"       => $CAMPAIGN_ID,
        "from_field"     => "<Find the From ID>", // To find it . Use this $accountDetails = $api->getAccountFromFields();
        "reply_to_field" => "<Find the From ID>", // To find it . Use this $accountDetails = $api->getAccountFromFields();
        "subject"        => "Subject of the Newsletter",
        "name"           => "Any Name",
        "contacts"       => $contact_id,
        'contents'       => array(
            'html' => $body
        )
    )

);




?>
