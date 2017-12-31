#  Contributing To Widget Live Editor

Clone the repository:
``` bash
$ git clone --recursive git@github.com:kienstra/widget-live-editor.git
```

## Installing The Pre-Commit Hook
The submodule [wp-dev-lib](https://github.com/xwp/wp-dev-lib#install-as-submodule) has a pre-commit hook that will check compliance with PHPCS, and run the unit tests. As its [repo recommends](https://github.com/xwp/wp-dev-lib#install-as-submodule), run:
``` bash
$ ./dev-lib/install-pre-commit-hook.sh
```

## Running PHPUnit Tests

This requires an environment with WordPress unit tests, such as [VVV](https://github.com/Varying-Vagrant-Vagrants/VVV).

Run tests:

``` bash
$ phpunit
```

Run tests with coverage:

``` bash
$ phpunit --coverage-html /tmp/report
```
