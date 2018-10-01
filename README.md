![tlsify](:hero)

# tlsify

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-circleci]][link-circleci]
[![StyleCI][ico-styleci]][link-styleci]

Find all URLs in a directory that start with `https://`, and replace them with 
`https://` (if supported) in one fell swoop.

> :hero

## Index
- [Installation](#installation)
  - [Downloading](#downloading)
- [Usage](#usage)
  - [Search](#search)
  - [Fix](#fix)
  - [Options](#options)
- [Contributing](#contributing)
- [License](#license)

## Installation
You'll have to follow a simple step to install this package.

### Downloading
Via [composer](http://getcomposer.org):

```bash
$ composer global require sven/tlsify
```

You should now be able to run the `tlsify` command from anywhere on your system. 

## Usage
Using the package is outlined below.

### Search
You can use the `search` command to search for all insecure URLs in the `src/` directory:

```bash
$ tlsify search src/
```

This will output a table like the one below:

```
+-----------------+---------------------+--------------+
| Domain Name     | Insecure References | Supports TLS |
+-----------------+---------------------+--------------+
| google.com      | 17                  | ✔            |
| httpforever.com | 39                  | ✔            |
| zombo.com       | 4                   | ✘            |
+-----------------+---------------------+--------------+
```

You may optionally specify the `--quiet` option to easily integrate this tool into some
automation. This will make `tlsify` exit with exit code `0` if no (fixable) insecure URLs
could be found, and exit with code `1` if one or more violations were found.

```bash
$ tlsify search src/ --quiet
```

### Fix
You may not just want to search for references, but also fix them immediately. To do so,
use the `fix` command:

```bash
$ tlsify fix src/
    Fixing 56 insecure URLs...
    Successfully fixed 56 insecure URLs
```

### Options
There are several options that work for both the `search` and the `fix` commands:

#### `--exclude`
The `--exclude` option is an array of domains / PCRE patterns that should be ignored when 
searching or replacing insecure URLs. Default: `localhost`, `(.+)\.test`, `(.+)\.localhost`, 
`(.+)\.invalid`, and `(.+)\.example` (per [RFC 2606](https://tools.ietf.org/html/rfc2606#section-2)).

```bash
$ tlsify search src/ --exclude=localhost --exclude=httpforever.com
```

#### `--timeout`
This option determines the timeout to use when checking if a domain supports HTTPS in
milliseconds. Default: `2000` (2 seconds).

```bash
# Wait for a response from HTTPS for 10 seconds before moving on.
$ tlsify fix src/ --timeout=10000
```

## Contributing
All contributions (pull requests, issues and feature requests) are
welcome. Make sure to read through the [CONTRIBUTING.md](CONTRIBUTING.md) first,
though. See the [contributors page](../../graphs/contributors) for all contributors.

## License
`sven/tlsify` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/tlsify.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/tlsify.svg?style=flat-square
[ico-circleci]: https://img.shields.io/circleci/project/github/svenluijten/tlsify.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/151132159/shield

[link-packagist]: https://packagist.org/packages/sven/tlsify
[link-downloads]: https://packagist.org/packages/sven/tlsify
[link-circleci]: https://circleci.com/gh/svenluijten/tlsify
[link-styleci]: https://styleci.io/repos/151132159
