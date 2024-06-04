<?php

namespace IYUU\Notify;

use app\common\components\Curl as ICurl;

/**
 * Telegram 通知
 */
class Telegram implements INotify
{
    /**
     * @var string
     */
    private $bot_token;
    /**
     * @var string
     */
    private $chat_id;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->bot_token = $config['bot_token'];
        $this->chat_id = $config['chat_id'];
    }

    /**
     * @param string $title
     * @param string $content
     * @return false|string
     */
    public function send(string $title, string $content)
    {
        $desp = empty($content) ? date("Y-m-d H:i:s") : $content;
        $data = array(
            'chat_id' => $this->chat_id,
            'text' => $title . "\n\n" . $desp,
        );
        return ICurl::http_post('https://api.telegram.org/bot' . $this->bot_token . '/sendMessage', $data);
    }
}
