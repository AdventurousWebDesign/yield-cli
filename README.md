[![Build Status](https://travis-ci.org/AdventurousWebDesign/yield-cli.svg?branch=master)](https://travis-ci.org/AdventurousWebDesign/yield-cli)
[![Coverage Status](https://coveralls.io/repos/github/AdventurousWebDesign/yield-cli/badge.svg?branch=master)](https://coveralls.io/github/AdventurousWebDesign/yield-cli?branch=master)


Yield CLI
---------

Yield CLI is a command line tool to track, and analyze one's time.

Why should we account for our time? Time is the resource that underwrites all of
one's creative output. If time is misspent or unexamined, opportunities for
growth and progress pass us by.

To that end:

```
$ yield start "Clear Email Inbox"
> Starting a timer for "Clear Email Inbox"
  [w] to stop, [q] to abort

```

```
$ yield log "9:15" "Clear Inbox" 25m
> Logged "Clear Inbox" to ~/.yield/logs/$(date "+%Y-%m-%d")
  [09:15] 25m "Clear Inbox"
```

```
$ yield analyze today
>
  # 2017-06-21 Has yielded the following:

  Unassociated tasks           2 tasks, 1 hour 13 minutes logged.
  ---------------------------------------------------------------
  [9:15 -  9:40]  25m     clear inbox
  [9:52 - 10:40]  48m     outline today's agenda for self + team


  Foo Project                 3 tasks, 2 hours 30 minutes logged.
  ---------------------------------------------------------------
  [10:45 - 11:00] 15m     minor fixes to vm
  [11:00 - 12:02] 1h2m    working on behat context for chunked dl
  [16:11 - 17:09] 58m     creating ajax handler for building zip


  Barbaz Inc. Site Design       1 task, 1 hour 48 minutes logged.
  ---------------------------------------------------------------
  [13:13 - 15:01] 1h48m    creating mockups in sketch
```

Roadmap
-------
* [ ] Parser to read timelogs
* [ ] Models for `Day`, `Task`, `Project`
* [ ] Filesystem in `~/.yield`
* [ ] `analyze` subcommand
* [ ] `log` subcommand
* [ ] `start` interactive-timer subcommand
* [ ] Configurable defaults `.yieldrc`
