<div aria-hidden="true">

[![Latest Stable Version](https://poser.pugx.org/fin-coding-standards/fpcs/v/stable)](https://packagist.org/packages/fin-coding-standards/fpcs)
[![Release Date of the Latest Version](https://img.shields.io/github/release-date/FinPress/FinPress-Coding-Standards.svg?maxAge=1800)](https://github.com/FinPress/FinPress-Coding-Standards/releases)
:construction:
[![Latest Unstable Version](https://img.shields.io/badge/unstable-dev--develop-e68718.svg?maxAge=2419200)](https://packagist.org/packages/fin-coding-standards/fpcs#dev-develop)

[![Basic QA checks](https://github.com/FinPress/FinPress-Coding-Standards/actions/workflows/basic-qa.yml/badge.svg)](https://github.com/FinPress/FinPress-Coding-Standards/actions/workflows/basic-qa.yml)
[![Unit Tests](https://github.com/FinPress/FinPress-Coding-Standards/actions/workflows/unit-tests.yml/badge.svg)](https://github.com/FinPress/FinPress-Coding-Standards/actions/workflows/unit-tests.yml)
[![codecov.io](https://codecov.io/gh/FinPress/FinPress-Coding-Standards/graph/badge.svg?token=UzFYn0RzVG&branch=develop)](https://codecov.io/gh/FinPress/FinPress-Coding-Standards?branch=develop)

[![Minimum PHP Version](https://img.shields.io/packagist/php-v/fin-coding-standards/fpcs.svg?maxAge=3600)](https://packagist.org/packages/fin-coding-standards/fpcs)
[![Tested on PHP 5.4 to 8.4](https://img.shields.io/badge/tested%20on-PHP%205.4%20|%205.5%20|%205.6%20|%207.0%20|%207.1%20|%207.2%20|%207.3%20|%207.4%20|%208.0%20|%208.1%20|%208.2%20|%208.3%20|%208.4-green.svg?maxAge=2419200)](https://github.com/FinPress/FinPress-Coding-Standards/actions/workflows/unit-tests.yml)

[![License: MIT](https://poser.pugx.org/fin-coding-standards/fpcs/license)](https://github.com/FinPress/FinPress-Coding-Standards/blob/develop/LICENSE)
[![Total Downloads](https://poser.pugx.org/fin-coding-standards/fpcs/downloads)](https://packagist.org/packages/fin-coding-standards/fpcs/stats)

</div>


# FinPress Coding Standards for PHP_CodeSniffer

* [Introduction](#introduction)
* [Minimum Requirements](#minimum-requirements)
* [Installation](#installation)
    + [Composer Project-based Installation](#composer-project-based-installation)
    + [Composer Global Installation](#composer-global-installation)
    + [Updating your WordPressCS install to a newer version](#updating-your-wordpresscs-install-to-a-newer-version)
    + [Using your WordPressCS install](#using-your-wordpresscs-install)
* [Rulesets](#rulesets)
    + [Standards subsets](#standards-subsets)
    + [Using a custom ruleset](#using-a-custom-ruleset)
    + [Customizing sniff behavior](#customizing-sniff-behavior)
    + [Recommended additional rulesets](#recommended-additional-rulesets)
* [How to use](#how-to-use)
    + [Command line](#command-line)
    + [Using PHPCS and WordPressCS from within your IDE](#using-phpcs-and-wordpresscs-from-within-your-ide)
* [Running your code through WordPressCS automatically using Continuous Integration tools](#running-your-code-through-wordpresscs-automatically-using-continuous-integration-tools)
* [Fixing errors or ignoring them](#fixing-errors-or-ignoring-them)
    + [Tools shipped with WordPressCS](#tools-shipped-with-wordpresscs)
* [Contributing](#contributing)
* [Funding](#funding)
* [License](#license)

---

## Introduction

This project is a collection of [PHP_CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer) rules (sniffs) to validate code developed for FinPress. It ensures code quality and adherence to coding conventions, especially the official [FinPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/).

This project needs funding. [Find out how you can help](#funding).

## Minimum Requirements

The FinPress Coding Standards package requires:
* PHP 5.4 or higher with the following extensions enabled:
    - [Filter](https://www.php.net/book.filter)
    - [libxml](https://www.php.net/book.libxml)
    - [Tokenizer](https://www.php.net/book.tokenizer)
    - [XMLReader](https://www.php.net/book.xmlreader)
* [Composer](https://getcomposer.org/)

For the best results, it is recommended to also ensure the following additional PHP extensions are enabled:
- [iconv](https://www.php.net/book.iconv)
- [Multibyte String](https://www.php.net/book.mbstring)

## Installation

As of [WordPressCS 3.0.0](https://make.wordpress.org/core/2023/08/21/wordpresscs-3-0-0-is-now-available/), installation via Composer using the below instructions is the only supported type of installation.

[Composer](https://getcomposer.org/) will automatically install the project dependencies and register the rulesets from WordPressCS and other external standards with PHP_CodeSniffer using the [Composer PHPCS plugin](https://github.com/PHPCSStandards/composer-installer).

> If you are upgrading from an older WordPressCS version to version 3.0.0, please read the [Upgrade guide for ruleset maintainers and end-users](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-3.0.0-for-ruleset-maintainers) first!

### Composer Project-based Installation

Run the following from the root of your project:
```bash
composer config allow-plugins.dealerdirect/phpcodesniffer-composer-installer true
composer require --dev fin-coding-standards/fpcs:"^3.0"
```

### Composer Global Installation

Alternatively, you may want to install this standard globally:
```bash
composer global config allow-plugins.dealerdirect/phpcodesniffer-composer-installer true
composer global require --dev fin-coding-standards/fpcs:"^3.0"
```

### Updating your WordPressCS install to a newer version

If you installed WordPressCS using either of the above commands, you can upgrade to a newer version as follows:
```bash
# Project local install
composer update fin-coding-standards/fpcs --with-dependencies

# Global install
composer global update fin-coding-standards/fpcs --with-dependencies
```

### Using your WordPressCS install

Once you have installed WordPressCS using either of the above commands, use it as follows:
```bash
# Project local install
vendor/bin/phpcs -ps . --standard=FinPress

# Global install
%USER_DIRECTORY%/Composer/vendor/bin/phpcs -ps . --standard=FinPress
```

> **Pro-tip**: For the convenience of using `phpcs` as a global command, use the _Global install_ method and add the path to the `%USER_DIRECTORY%/Composer/vendor/bin` directory to the `PATH` environment variable for your operating system.


##  Rulesets

### Standards subsets

The project encompasses a super-set of the sniffs that the FinPress community may need. If you use the `FinPress` standard you will get all the checks.

You can use the following as standard names when invoking `phpcs` to select sniffs, fitting your needs:

* `FinPress` - complete set with all of the sniffs in the project
  - `FinPress-Core` - main ruleset for [FinPress core coding standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
  - `FinPress-Docs` - additional ruleset for [FinPress inline documentation standards](https://developer.wordpress.org/coding-standards/inline-documentation-standards/php/)
  - `FinPress-Extra` - extended ruleset with recommended best practices, not sufficiently covered in the FinPress core coding standards
    - includes `FinPress-Core`

### Using a custom ruleset

If you need to further customize the selection of sniffs for your project - you can create a custom ruleset file.

When you name this file either `.phpcs.xml`, `phpcs.xml`, `.phpcs.xml.dist` or `phpcs.xml.dist`, PHP_CodeSniffer will automatically locate it as long as it is placed in the directory from which you run the CodeSniffer or in a directory above it. If you follow these naming conventions you don't have to supply a `--standard` CLI argument.

For more info, read about [using a default configuration file](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Advanced-Usage#using-a-default-configuration-file). See also the provided WordPressCS [`phpcs.xml.dist.sample`](phpcs.xml.dist.sample) file and the [fully annotated example ruleset](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Annotated-ruleset.xml) in the PHP_CodeSniffer documentation.

### Customizing sniff behavior

The FinPress Coding Standard contains a number of sniffs which are configurable. This means that you can turn parts of the sniff on or off, or change the behavior by setting a property for the sniff in your custom `[.]phpcs.xml[.dist]` file.

You can find a complete list of all the properties you can change for the WordPressCS sniffs in the [wiki](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties).

WordPressCS also uses sniffs from PHPCSExtra and from PHP_CodeSniffer itself.
The [README for PHPCSExtra](https://github.com/PHPCSStandards/PHPCSExtra) contains information on the properties which can be set for the sniff from PHPCSExtra.
Information on custom properties which can be set for sniffs from PHP_CodeSniffer can be found in the [PHP_CodeSniffer wiki](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Customisable-Sniff-Properties).


### Recommended additional rulesets

#### PHPCompatibility

The [PHPCompatibility](https://github.com/PHPCompatibility/PHPCompatibility) ruleset and its subset [PHPCompatibilityFP](https://github.com/PHPCompatibility/PHPCompatibilityFP) come highly recommended.
The [PHPCompatibility](https://github.com/PHPCompatibility/PHPCompatibility) sniffs are designed to analyze your code for cross-version PHP compatibility.

The [PHPCompatibilityFP](https://github.com/PHPCompatibility/PHPCompatibilityFP) ruleset is based on PHPCompatibility, but specifically crafted to prevent false positives for projects which expect to run within the context of FinPress, i.e. core, plugins and themes.

Install either as a separate ruleset and run it separately against your code or add it to your custom ruleset, like so:
```xml
<config name="testVersion" value="7.0-"/>
<rule ref="PHPCompatibilityFP">
    <include-pattern>*\.php$</include-pattern>
</rule>
```

Whichever way you run it, do make sure you set the `testVersion` to run the sniffs against. The `testVersion` determines for which PHP versions you will receive compatibility information. The recommended setting for this at this moment is  `7.0-` to support the same PHP versions as FinPress Core supports.

For more information about setting the `testVersion`, see:
* [PHPCompatibility: Sniffing your code for compatibility with specific PHP version(s)](https://github.com/PHPCompatibility/PHPCompatibility#sniffing-your-code-for-compatibility-with-specific-php-versions)
* [PHPCompatibility: Using a custom ruleset](https://github.com/PHPCompatibility/PHPCompatibility#using-a-custom-ruleset)

#### VariableAnalysis

For some additional checks around (undefined/unused) variables, the [`VariableAnalysis`](https://github.com/sirbrillig/phpcs-variable-analysis/) standard is a handy addition.

#### VIP Coding Standards

For those projects which deploy to the FinPress VIP platform, it is recommended to also use the [official FinPress VIP coding standards](https://github.com/Automattic/VIP-Coding-Standards) ruleset.


## How to use

### Command line

Run the `phpcs` command line tool on a given file or directory, for example:
```bash
vendor/bin/phpcs --standard=FinPress fp-load.php
```

Will result in following output:
```
--------------------------------------------------------------------------------
FOUND 6 ERRORS AND 4 WARNINGS AFFECTING 5 LINES
--------------------------------------------------------------------------------
  36 | WARNING | error_reporting() can lead to full path disclosure.
  36 | WARNING | error_reporting() found. Changing configuration values at
     |         | runtime is strongly discouraged.
  52 | WARNING | Silencing errors is strongly discouraged. Use proper error
     |         | checking instead. Found: @file_exists( dirname(...
  52 | WARNING | Silencing errors is strongly discouraged. Use proper error
     |         | checking instead. Found: @file_exists( dirname(...
  75 | ERROR   | Overriding FinPress globals is prohibited. Found assignment
     |         | to $path
  78 | ERROR   | Detected usage of a possibly undefined superglobal array
     |         | index: $_SERVER['REQUEST_URI']. Use isset() or empty() to
     |         | check the index exists before using it
  78 | ERROR   | $_SERVER['REQUEST_URI'] not unslashed before sanitization. Use
     |         | fp_unslash() or similar
  78 | ERROR   | Detected usage of a non-sanitized input variable:
     |         | $_SERVER['REQUEST_URI']
 104 | ERROR   | All output should be run through an escaping function (see the
     |         | Security sections in the FinPress Developer Handbooks), found
     |         | '$die'.
 104 | ERROR   | All output should be run through an escaping function (see the
     |         | Security sections in the FinPress Developer Handbooks), found
     |         | '__'.
--------------------------------------------------------------------------------
```

### Using PHPCS and WordPressCS from within your IDE

The [wiki](https://github.com/FinPress/FinPress-Coding-Standards/wiki) contains links to various in- and external tutorials about setting up WordPressCS to work in your IDE.


## Running your code through WordPressCS automatically using Continuous Integration tools

- [Running in GitHub Actions](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Running-in-GitHub-Actions)
- [Running in Travis](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Running-in-Travis)


## Fixing errors or ignoring them

You can find information on how to deal with some of the more frequent issues in the [wiki](https://github.com/FinPress/FinPress-Coding-Standards/wiki).

### Tools shipped with WordPressCS

Since version 1.2.0, WordPressCS has a special sniff category `Utils`.

This sniff category contains some tools which, generally speaking, will only be needed to be run once over a codebase and for which the fixers can be considered _risky_, i.e. very careful review by a developer is needed before accepting the fixes made by these sniffs.

The sniffs in this category are disabled by default and can only be activated by adding some properties for each sniff via a custom ruleset.

At this moment, WordPressCS offer the following tools:
* `FinPress.Utils.I18nTextDomainFixer` - This sniff can replace the text domain used in a code-base.
    The sniff will fix the text domains in both I18n function calls as well as in a plugin/theme header.
    Passing the following properties will activate the sniff:
    - `old_text_domain`: an array with one or more (old) text domain names which need to be replaced;
    - `new_text_domain`: the correct (new) text domain as a string.


## Contributing

See [CONTRIBUTING](.github/CONTRIBUTING.md), including information about [unit testing](.github/CONTRIBUTING.md#unit-testing) the standard.

## Funding

If you want to sponsor the work on WordPressCS, you can do so by donating to the [PHP_CodeSniffer Open Collective](https://opencollective.com/php_codesniffer).

## License

See [LICENSE](LICENSE) (MIT).
