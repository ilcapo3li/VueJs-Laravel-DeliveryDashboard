<?php

namespace App\Notification;

class Firebase
{
    public function send($registration_ids, $message, $apk)
    {
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );
        return $this->sendPushNotification($fields, $apk);
    }

    /*
    * This function will make the actuall curl request to firebase server
    * and then the message is sent
    */
    private function sendPushNotification($fields, $apk)
    {
        //firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';
              
        switch ($apk) {
                case 1:
               //building headers for the request "RED APP"
            $headers = array(
            'Authorization: key=' . env('ALMATCH_RED_FIREBASE'),
            'Content-Type: application/json'
             );
                break;
                //building headers for the request "GOLDEN APP"
            $headers = array(
            'Authorization: key=' . env('ALMATCH_GOLD_FIREBASE'),
            'Content-Type: application/json'
             );
                break;
                case 3:
                 //building headers for the request "APP STORE"
            $headers = array(
            'Authorization: key=' . env('ALMATCH_STORE_FIREBASE'),
            'Content-Type: application/json'
        );
                break;
            }

        //Initializing curl to open a connection
        $ch = curl_init();

        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);

        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);

        //adding headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //adding the fields in json format
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        //finally executing the curl request
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }

        //Now close the connection
        curl_close($ch);

        //and return the result
        return $result;
    }
}
