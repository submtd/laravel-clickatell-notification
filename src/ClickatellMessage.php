<?php

namespace Submtd\LaravelClickatellNotification;

class ClickatellMessage
{
    /**
     * @var string $content - message content
     */
    public $content;

    /**
     * static create method
     * @param string $content - message content
     * @return ClickatellMessage
     */
    public static function create(string $content = '')
    {
        return new static($content);
    }

    /**
     * class constructor
     * @param string $content - message content
     */
    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    /**
     * set content
     * @param string $content - message content
     * @return ClickatellMessage
     */
    public function content(string $content = '')
    {
        $this->content = $content;
        return $this;
    }

    /**
     * get content
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
