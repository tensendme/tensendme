<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.02.2020
 * Time: 20:11
 */

namespace App\Queues;


class QueueConstants
{
    public const NOTIFICATIONS_QUEUE = "notifications";
    public const VIDEO_COMPRESS_QUEUE = "compressions";
    public const MASS_PUSH_QUEUE = "bulk-push-notifications";
}
