<?php

namespace App\Notification;

class Push
{
    //notification title
    private $title;
    //notification message
    private $message;
    //notification url
    private $url_update;
    //notification type
    private $notify_type;
    //notification match id
    private $match_id;
    //notification match type
    private $match_type;
    //notification version name
    private $version_name;

    //initializing values in this constructor
    public function __construct($title, $message, $url_update, $notify_type, $match_id, $match_type, $version_name)
    {
        $this->title = $title;
        $this->message = $message;
        $this->url_update = $url_update;
        $this->notify_type=$notify_type;
        $this->match_id= $match_id;
        $this->match_type=$match_type;
        $this->version_name=$version_name;
        // dd($this->notify_type);
    }

    //getting the push notification
    public function getPush()
    {
        $res = [];
        $res['data']['title'] = $this->title;
        $res['data']['message'] = $this->message;
        $res['data']['url_update'] = $this->url_update;
        $res['data']['notify_type'] = $this->notify_type;
        $res['data']['match_id'] = $this->match_id;
        $res['data']['match_type'] = $this->match_type;
        $res['data']['version_name'] = $this->version_name;
        
        return $res;
    }
}