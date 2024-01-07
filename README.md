# Webska: Web Scanner

Webska scans a URL at regular intervals for specific terms. If matches are
found, a notification is sent.  The name Webska comes from _Web Scanner_.

I created this tool for personal use, however, if enough people find it useful,
I'll document it better and maybe even add other types of notifications.

## Installation

- Clone the repository.
- Run `composer install`.

## Usage

    ./bin/webska URL term1 term2 term3...

### Example: Basic

    # Notify when the word "foo" is present on example.com
    ./bin/webska https://example.com/ foo

### Example: Advanced

    # Notify when the word "foo" is present on example.com. Additionally,
    # keep re-checking every 30 minutes. When a match is found, raise a
    # notification with the Operating System.
    ./bin/webska --interval=30 --notifier=os https://example.com/ foo
