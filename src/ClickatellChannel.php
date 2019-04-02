<?php

namespace Submtd\LaravelClickatellNotification;

use Illuminate\Notifications\Notification;
use Clickatell\Rest;

class ClickatellChannel
{
    /**
     * @var $token - clickatell api token
     */
    protected $token;

    /**
     * @var $from - clickatell "from" phone number
     */
    protected $from;

    /**
     * class constructor
     * @param array $config - clickatell config in services.php
     */
    public function __construct(array $config = null)
    {
        if (!$config) {
            $config = config('services.clickatell', []);
        }
        if (!isset($config['token'])) {
            throw new \Exception('Required parameter `token` is missing.', 400);
        }
        $this->token = $config['token'];
        $this->from = isset($config['from']) ? $config['from'] : null;
    }

    /**
     * send method
     * @param mixed $notifiable
     * @param Notification $notification
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('clickatell')) {
            return;
        }
        $message = $notification->toClickatell($notifiable);
        $messageParameters = [
            'to' => [$to],
            'content' => $message,
        ];
        if ($this->from) {
            $messageParameters['from'] = $this->from;
        }
        $clickatellApi = new Rest($this->token);
        $clickatellApi->sendMessage($messageParameters);
    }
}
