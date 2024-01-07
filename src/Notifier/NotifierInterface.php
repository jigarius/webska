<?php

namespace Webska\Notifier;

interface NotifierInterface {

  public function notify(Notification $notification): bool;

}
