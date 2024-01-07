<?php

namespace Webska;

use GuzzleHttp\Client as GuzzleClient;
use Webska\Notifier\NotifierFactory;
use Webska\Notifier\Notification;

class Application {

  public function __construct(
    readonly protected Configuration $conf,
  ) {}

  public function execute(): void {
    while (TRUE) {
      if ($matches = $this->search()) {
        break;
      }

      // If no interval is set, we do not keep looking.
      if (!$this->conf->interval) {
        echo 'No matches.'. PHP_EOL;
        return;
      }

      $retryAt = new \DateTime('+' . $this->conf->interval . ' minutes');
      echo 'No matches. Next scan at ' . $retryAt->format('j M, Y @ Hi\h') . '.' . PHP_EOL;
      sleep($this->conf->interval * 60);
    }

    $sMatches = implode(', ', $matches);

    $notification = new Notification(
      'Webska matched',
      "Matches found: $sMatches.",
    );

    $notifier = NotifierFactory::create($this->conf->notifierType);
    $notifier->notify($notification);
  }

  protected function search(): array {
    $guzzle = new GuzzleClient(['verify' => FALSE]);
    $response = $guzzle->get($this->conf->url);
    if ($response->getStatusCode() !== 200) {
      return [];
    }

    $body = $response->getBody()->getContents();
    $body = strip_tags($body);

    $matches = [];
    foreach ($this->conf->needles as $needle) {
      if (str_contains($body, $needle)) {
        $matches[] = $needle;
      }
    }

    return $matches;
  }

}
