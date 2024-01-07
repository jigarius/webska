<?php

namespace Webska\Notifier;

abstract class NotifierFactory {

  public static function create(NotifierType $type): NotifierInterface {
    return match ($type) {
      NotifierType::OperatingSystem => new OperatingSystemNotifier(),
      default => new DefaultNotifier(),
    };
  }

}
