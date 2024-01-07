<?php

namespace Webska\Notifier;

class DefaultNotifier implements NotifierInterface {

  public function notify(Notification $notification): bool {
    echo $notification->title . PHP_EOL;
    echo $notification->body . PHP_EOL;

    return TRUE;
  }

}
