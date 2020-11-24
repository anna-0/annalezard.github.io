<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$args = array(
    'access_token' => $_ENV['API_KEY_LIVE'],
    'environment'  => \GoCardlessPro\Environment::LIVE
);

$client = new \GoCardlessPro\Client($args);

$mandates = $client->mandates()->all([
    "params" => [
        "limit" => 3000,
        "created_at[gte]" => $recordstart . "T00:00:00.000Z",
        ]
    ]);
$patrons = $client->customers()->all([
    "params" => [
        "limit" => 3000,
        "created_at[gte]" => $recordstart . "T00:00:00.000Z",
        ]
    ]);
$subscrips = $client->subscriptions()->all([
    "params" => [
        "limit" => 3000,
        "created_at[gte]" => $recordstart . "T00:00:00.000Z",
        ]
    ]);
$payments = $client->payments()->all([
    "params" => [
        "limit" => 3000,
        "status" => "paid_out",
        "created_at[gte]" => $recordstart . "T00:00:00.000Z",
        ]
    ]);

$pendings = $client->payments()->all([
    "params" => [
        "status" => "pending_submission",
        "created_at[gte]" => $recordstart . "T00:00:00.000Z",
    ]
]);

$backers = $plusbackers;
$donors = $plusdonors;
$amount = 0;
$dArray = [];
$bArray = [];

// Put actual amounts in arrays
foreach ($subscrips as $subscrip) {
    if ($subscrip->status == 'active') {
        if (!empty($subscrip->links->plan)) {
            $planid = $subscrip->links->plan;
        }
        if ($planid == $plan24 || $planid == $plan48 || $planid == $plan96 || $planid == $plan192) {
            $amount += $subscrip->amount;
            foreach ($mandates as $mandate) {
                if ($mandate->id == $subscrip->links->mandate) {
                    foreach ($patrons as $patron) {
                        if ($patron->id == $mandate->links->customer) {
                            $bArray[] = $patron;
                        }
                    }
                }
            }
        }
    }
}

echo count($bArray);