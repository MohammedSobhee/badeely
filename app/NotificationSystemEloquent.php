<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\DeviceToken;
use App\Notification;
use App\NotificationReceiver;
use App\Reason;
use App\User;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class NotificationSystemEloquent
{

    private $devices_id;


    public function sendNotification($receiver_id, $title, $content) //$object
    {

        $tokens = DeviceToken::getReceiverToken($receiver_id);//

        $this->devices_id = DeviceToken::getDevices($receiver_id);

        if (count($tokens) > 0 || count($tokens) > 0) {

            $attributes = [
                'title' => $title,
                'content' => $content,
                'receiver_id' => $receiver_id,
            ];

            $notification = $this->create($attributes);
//                $receiver = User::find($receiver_id);

            //send fcm message according receiver language

            $receiver_notification = new NotificationReceiver();
            $receiver_notification->notification_id = $notification->id;
            $receiver_notification->receiver_id = $receiver_id;
            $receiver_notification->save();

            $object = new \stdClass();
            $object->title = $title;
            $notification->title = $object;

            $badge = $this->getCountUnseen($receiver_id);

            $notification = Notification::find($notification->id);

            try {
                if (count($tokens[0]) > 0 || count($tokens[1]) > 0 || count($this->devices_id) > 0)
                    $fcm_object = $this->FCM('Badeely', $title, $notification, $tokens, $badge);
            } catch (\Throwable $e) { // For PHP 7
                // handle $e
            } catch (\Exception $e) { // For PHP 5
                // handle $e

            }
        }

    }

    public function FCM($title, $body, $data, $tokens, $badge)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default')->setBadge($badge);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        //android
        if (count($tokens[0]) > 0) {
            // You must change it to get your tokens
            $downstreamResponse = FCM::sendTo($tokens[0], $option, null, $data);

        }
        //ios
        if (count($tokens[1]) > 0) {

            $downstreamResponse = FCM::sendTo($tokens[1], $option, $notification, $data);
        }

//        dd($tokens);
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