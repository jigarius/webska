<?php

namespace Webska;

use Webska\Notifier\NotifierType;

class Configuration {

  public function __construct(
    /**
     * The target URL to analyze.
     *
     * @var string
     */
    readonly public string $url,
    /**
     * Terms to search for in the URL.
     *
     * @var array
     */
    readonly public array $needles,
    /**
     * Type of notifier to use.
     *
     * @var NotifierType
     */
    readonly public NotifierType $notifierType,
    /**
     * The number of minutes after which to analyze the URL.
     *
     * @var int
     */
    readonly public int $interval = 30,
  ) {}

  public static function fromArgv(): static {
    global $argv;

    if (count($argv) < 3) {
      throw new \RuntimeException('Missing required arguments: URL needle1 needle2 needle3...');
    }

    $options = getopt('', [
        'notifier::',
        'interval::'
      ],
    );

    $args = array_values(array_filter(
      // Ignore the script name, which is at index zero.
      array_slice($argv, 1),
      // Ignore arguments that represent options.
      fn ($a) => !str_starts_with($a, '-'),
    ));

    return new static(
      $args[0],
      array_slice($args, 1),
      NotifierType::from($options['notifier'] ?? 'default'),
      $options['interval'] ?? 0,
    );
  }

}
