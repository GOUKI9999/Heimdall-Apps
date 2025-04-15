<?php

namespace App\SupportedApps\MeTube;

class MeTube extends \App\SupportedApps implements \App\EnhancedApps
{
    public $config;

    //protected $login_first = true; // Uncomment if api requests need to be authed first
    //protected $method = 'POST';  // Uncomment if requests to the API should be set by POST

    public function __construct()
    {
        //$this->jar = new \GuzzleHttp\Cookie\CookieJar; // Uncomment if cookies need to be set
    }

    public function test()
    {
        $test = parent::appTest($this->url('history'));
        echo $test->status;
    }

    public function livestats()
    {
        $status = 'inactive';
        $res = parent::execute($this->url('history'));
        $details = json_decode($res->getBody());

        $data['queue_size'] = count($details->queue);
        $data['done_size'] = count($details->done);
        return parent::getLiveStats($status, $data);
    }

    public function url($endpoint)
    {
        $api_url = parent::normaliseurl($this->config->url) . $endpoint;
        return $api_url;
    }
}
