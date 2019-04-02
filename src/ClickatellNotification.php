<?php

namespace Submtd\LaravelClickatellNotification;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class ClickatellNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var $message - text message to send
     */
    protected $message;

    /**
     * class constructor
     * @param string $message - text message to send
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * get the notification channel
     */
    public function via()
    {
        return ClickatellChannel::class;
    }

    /**
     * return the message
     */
    public function toClickatell()
    {
        return $this->message;
    }
}
