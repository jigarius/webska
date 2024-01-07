<?php

namespace Webska\Notifier;

final class Notification {

  public function __construct(
    readonly public string $title,
    readonly public string $body,
    readonly public string $sound = 'Sosumi',
  ) {}

}
