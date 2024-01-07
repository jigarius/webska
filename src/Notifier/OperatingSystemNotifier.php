<?php

namespace Webska\Notifier;

class OperatingSystemNotifier implements NotifierInterface {

  public function notify(Notification $notification): bool {
    // @todo Escape special characters in command body.
    return match (PHP_OS) {
      'Darwin' => $this->notifyDarwin($notification),
      default => throw new \RuntimeException('Unsupported OS: ' . PHP_OS),
    };
  }

  protected function notifyDarwin(Notification $notification): bool {
    $command = 'display notification "' . $notification->body . '"'
      . ' with title "' . $notification->title . '"'
      . ' sound name "' . $notification->sound . '"';

    return (bool) passthru("osascript -e '$command'");
  }

}
