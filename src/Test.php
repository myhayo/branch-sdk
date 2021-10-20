<?php

require __DIR__ . '/../vendor/autoload.php';

use Myhayo\Branch\BranchService;

$branch = new BranchService();

$device = [
    'access_id'   => 'qqewrttr',
    'access_key'  => 'c0f66f07640669f7d2b06839f0ba609a',
    'os'          => '1',
    'imei1'       => '867401044344259',
    'imei2'       => '867401044344267',
    'oaid'        => '690b19948df93761b7d638de98de67e6',
    'android_id'  => 'f781c61efce6b845',
    'mac'         => 'C0%3A2E%3A25%3A26%3A72%3A87',
    'ip'          => '182.123.55.176',
    'app_version' => '1.0.9',
    'os_version'  => '8.1.0',
    'model'       => 'PBFM00',
    'brand'       => 'OPPO',
    'uuid'        => 'a4d4cc66-ec62-4b2a-b257-5d81fedc7cf7',
    'action_type' => '0',

];

//$ret_init = $branch->init($device);

$uuid = 'c1778bf6-1b41-4b84-a11d-ac7f609c0e52';

//$ret_report = $branch->report($uuid, 0, [
//    'user_id' => 435541,
//], $device);


$req = [
    'uuid'       => 'c1778bf6-1b41-4b84-a11d-ac7f609c0e52',
    'access_id'  => 'qqewrttr',
    'access_key' => 'c0f66f07640669f7d2b06839f0ba609a',
    'action'     => [
        'action_type'  => 0,
        'action_param' => ['user_id' => 435541],
    ],
    'channel'    => [
        'channel_id'   => 123,
        'channel_key'  => 'channel_key',
        'channel_name' => 'channel_name',
    ],
];


$branch->callback($req, function ($uuid, $action, $c) {

    dd($uuid, $action, $c);
});


//print_r($ret_report);
