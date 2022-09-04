<?php

namespace App\Service;

use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;

class MessageLogService {

    private Client $twilio;

    public function __construct(
        string $twilioAccountSid,
        string $twilioAuthToken,
    ) {

        $this->twilio = new Client($twilioAccountSid, $twilioAuthToken);
    }

    public function getMessages()
    : array {

        return array_map(
            fn(MessageInstance $message) => $message->toArray() + ['id' => $message->sid],
            $this->twilio->messages->read()
        );
    }

    public function getMessage(string $messageSid)
    : array {

        return $this->twilio->messages($messageSid)->fetch()->toArray();
    }

    public function deleteMessage(string $messageSid)
    : void {

        $this->twilio->messages($messageSid)->delete();
    }
}