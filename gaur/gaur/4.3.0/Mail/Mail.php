<?php

declare(strict_types=1);

namespace Gaur\Mail;

use Config\Services;

class Mail
{
    /**
     * Send email
     *
     * @param string  $path view path
     * @param mixed[] $data email data
     *
     * @return bool
     */
    public static function send(string $path, array $data): bool
    {
        $msg   = view($path, $data);
        $email = Services::email();

        $email->setTo($data['to']);

        if (isset($data['cc'])) {
            $email->setCC($data['cc']);
        }

        if (isset($data['bcc'])) {
            $email->setBCC($data['bcc']);
        }

        $email->setSubject($data['subject']);
        $email->setMessage($msg);

        // Never report success when an environment skipped actual delivery.
        $env = config('Config\\App')->siteEnvironment ?? '';
        if ($env !== 'production') {
            log_message('warning', 'Email delivery skipped outside production.');
            return false;
        }

        return $email->send();
    }
}
