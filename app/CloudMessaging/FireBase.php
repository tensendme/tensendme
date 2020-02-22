<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.01.2020
 * Time: 03:38
 */

namespace App\CloudMessaging;


use App\Models\Profiles\User;

class FireBase
{
    protected const API_KEY = 'AIzaSyDzT2OUavEaZhZZjuIT2ZmxvQqbNnYJLZE';

    public static function sendPush(Pushable $push, User $user)
    {
        if (!$user->device_token) {
            return null;
        }
        $url = 'https://fcm.googleapis.com/fcm/send';
        $info = [
            'to' => $user->device_token
        ];
        if ($user->platform == User::PLATFORM_IOS) {
            $message = $push->toIOS();
        } else if ($user->platform == User::PLATFORM_ANDROID) {
            $message = $push->toAndroid();
        }

        $info = array_merge($info, $message);

        $fields = json_encode($info);

        $request_headers = [
            'Content-Type: application/json',
            'Authorization: key=' . self::API_KEY,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}