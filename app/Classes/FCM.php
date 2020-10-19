<?php

namespace App\Classes;

use App\DeviceToken;
use App\Notification;
use App\NotificationReceiver;
use App\User;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;


class FCM
{
    #API access key from Google API's Console
    private $key = 'AAAA3PZSqLQ:APA91bFMvteUjfd7d5yFJ1tLmq2D6xAwOWkDijw9jX93ezpQTwvtFQ95f-291DJwfSneKqgMa2gJpQDgsIIyM8DEySESGM9mguWu6e3UDISuHS8J_dvF8w3gS8To8ueIYcVkrViHB_xd';

    public function send($title, $body)
    {
        $msg = [
            'body' => $body,
            'title' => $title,
            'icon' => 'myicon',
            'sound' => 'mySound'
        ];

        $fields = [
            'to' => '/topics/BadeelyNotifications',
            'notification' => $msg,
        ];



//        $fields = [
//            'registration_ids' => $registrationIds,
//            'notification' => $msg,
//            'data' => $data
//        ];

        $headers = [
            'Authorization: key=' . $this->key,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    private $devices_id;


    public function sendNotification($receiver_id, $title, $content) //$object
    {
        $user = User::find($receiver_id);
        $this->FCM('Badeely', $title, $content, $user);
    }

    public function FCM($title, $body, $data, $user)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($body);
        $notificationBuilder->setBody($data)
            ->setSound('default')->setBadge(1);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = \LaravelFCM\Facades\FCM::sendTo([$user->device_token], $option, $notification, $data);


        //return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

        //return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $object = [
            'numberSuccess' => $downstreamResponse->numberSuccess(),
            'numberFailure' => $downstreamResponse->numberFailure(),
            'numberModification' => $downstreamResponse->numberModification(),
        ];

        return $object;
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $notification = new Notification();
        $notification->title = $attributes['title'];
        $notification->content = $attributes['content'];
        if ($notification->save()) {

            return $notification;
        }

        return null;
    }

    public function getCountUnseen($receiver_id)
    {
        $notifications_id = NotificationReceiver::where('receiver_id', $receiver_id)->pluck('notification_id');
        return Notification::whereIn('id', $notifications_id)->where('seen', 0)->count();
    }

}