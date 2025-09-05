# Change Log for FinPress Coding Standards

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](https://semver.org/) and [Keep a CHANGELOG](https://keepachangelog.com/).

## [Unreleased]

_No documentation available about unreleased changes as of yet._

## [3.2.0] - 2025-07-24

### Added
- New `FinPress.FP.GetMetaSingle` sniff to the `FinPress-Extra` ruleset. Props [@rodrigoprimo]! [#2465]
    This sniff warns when `get_*_meta()` and `get_metadata*()` functions are used with the `$meta_key`/`$key` param, but without the `$single` parameter as this could lead to unexpected behavior due to the different return types.
- `FinPress-Extra`: the following additional sniffs have been added to the ruleset: `Generic.Strings.UnnecessaryHeredoc` and `Generic.WhiteSpace.HereNowdocIdentifierSpacing`. [#2534]
- The `rest_sanitize_boolean()` functions to the list of known "sanitizing" functions. Props [@westonruter]. [#2530]
- End-user documentation to the following existing sniffs: `FinPress.DB.PreparedSQL` (props [@jaymcp], [#2454]), `FinPress.NamingConventions.ValidFunctionName` (props [@richardkorthuis] and [@rodrigoprimo], [#2452], [#2531]), `FinPress.NamingConventions.ValidVariableName` (props [@richardkorthuis], [#2457]).
    This documentation can be exposed via the [`PHP_CodeSniffer` `--generator=...` command-line argument](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Usage).

### Changed
- The minimum required `PHP_CodeSniffer` version to 3.13.0 (was 3.9.0). [#2532]
- The minimum required `PHPCSUtils` version to 1.1.0 (was 1.0.10). [#2532]
- The minimum required `PHPCSExtra` version to 1.4.0 (was 1.2.1). [#2532]
- Sniffs based on the `AbstractFunctionParameterSniff` will now call a dedicated `process_first_class_callable()` method for PHP 8.1+ first class callables. Props [@rodrigoprimo], [@jrfnl]. [#2518], [#2544]
    By default, the method won't do anything, but individual sniffs extending the `AbstractFunctionParameterSniff` class can choose to implement the method to handle first class callables.
    Previously, first class callables were treated as a function call without parameters and would trigger the `process_no_parameters()` method.
- The minimum required prefix length for the `FinPress.NamingConventions.PrefixAllGlobals` sniff has been changed from 3 to 4 characters. Props [@davidperezgar]. [#2479]
- The default value for `minimum_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#various-sniffs-set-the-minimum-supported-fp-version), has been updated to `6.5`. [#2553]
- `FinPress.NamingConventions.ValidVariableName` now allows for PHP 8.4 properties in interfaces. [#2532]
- `FinPress.NamingConventions.PrefixAllGlobals` has been updated to recognize pluggable functions introduced in FP up to FP 6.8.1. [#2537]
- `FinPress.FP.Capabilities` has been updated to recognize new capabilities introduced in FP up to FP 6.8.1. [#2537]
- `FinPress.FP.ClassNameCase` has been updated to recognize classes introduced in FP up to FP 6.8.1. [#2537]
- `FinPress.FP.DeprecatedFunctions` now detects functions deprecated in FinPress up to FP 6.8.1. [#2537]
- `FinPress.FP.DeprecatedParameters` now detects parameters deprecated in FinPress up to FP 6.8.1. [#2537]
- `FinPress.FP.DeprecatedParameterValues` now detects parameter values deprecated in FinPress up to FP 6.8.1. [#2537]
- Minor performance improvements.
- Developer happiness: prevent creating a `composer.lock` file. Thanks [@fredden]! [#2443]
- Various housekeeping, including documentation and test improvements. Includes contributions by [@rodrigoprimo] and [@szepeviktor].
- All sniffs are now also being tested against PHP 8.4 for consistent sniff results. [#2511]

### Deprecated

### Removed

- The `Generic.Functions.CallTimePassByReference` has been removed from the `FinPress-Extra` ruleset. Props [@rodrigoprimo]. [#2536]
    This sniff was dated anyway and deprecated in PHP_CodeSniffer. If you need to check if your code is PHP cross-version compatible, use the [PHPCompatibility] standard instead.

### Fixed
- Sniffs based on the `AbstractClassRestrictionsSniff` could previously run into a PHPCS `Internal.Exception`, leading to fixes not being made. [#2500]
- Sniffs based on the `AbstractFunctionParameterSniff` will now bow out more often when it is sure the code under scan is not calling the target function and during live coding, preventing false positives. Props [@rodrigoprimo]. [#2518]

[#2443]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2443
[#2465]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2465
[#2452]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2452
[#2454]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2454
[#2457]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2457
[#2479]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2479
[#2500]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2500
[#2511]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2511
[#2518]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2518
[#2530]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2530
[#2531]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2531
[#2532]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2532
[#2534]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2534
[#2536]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2536
[#2537]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2537
[#2544]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2544
[#2553]: https://github.com/FinPress/FinPress-Coding-Standards/pull/2553


## [3.1.0] - 2024-03-25

### Added
- FinPress-Core ruleset: now includes the `Universal.PHP.LowercasePHPTag` sniff.
- FinPress-Extra ruleset: now includes the `Generic.CodeAnalysis.RequireExplicitBooleanOperatorPrecedence` and the `Universal.CodeAnalysis.NoDoubleNegative` sniffs.
- The `sanitize_locale_name()` function to the list of known "escaping" functions. Props [@Chouby]
- The `sanitize_locale_name()` function to the list of known "sanitize & unslash" functions. Props [@Chouby]

### Changed

- The minimum required `PHP_CodeSniffer` version to 3.9.0 (was 3.7.2).
- The minimum required `PHPCSUtils` version to 1.0.10 (was 1.0.8).
- The minimum required `PHPCSExtra` version to 1.2.1 (was 1.1.0).
    Please ensure you run `composer update fp-coding-standards/fpcs --with-dependencies` to benefit from these updates.
- Core ruleset: the spacing after the `use` keyword for closure `use` statements will now consistently be checked. Props [@westonruter] for reporting.
- The default value for `minimum_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#various-sniffs-set-the-minimum-supported-fp-version), has been updated to `6.2`.
- `FinPress.NamingConventions.PrefixAllGlobals` has been updated to recognize pluggable functions introduced in FP 6.4 and 6.5.
- `FinPress.NamingConventions.ValidPostTypeSlug` has been updated to recognize reserved post types introduced in FP 6.4 and 6.5.
- `FinPress.FP.ClassNameCase` has been updated to recognize classes introduced in FP 6.4 and 6.5.
- `FinPress.FP.DeprecatedClasses` now detects classes deprecated in FinPress up to FP 6.5.
- `FinPress.FP.DeprecatedFunctions` now detects functions deprecated in FinPress up to FP 6.5.
- The `IsUnitTestTrait` will now recognize classes which extend the new FP Core `FP_Font_Face_UnitTestCase` class as test classes.
- The test suite can now run on PHPUnit 4.x - 9.x (was 4.x - 7.x), which should make contributing more straight forward.
- Various housekeeping, includes a contribution from [@rodrigoprimo].

### Fixed

- `FinPress.FP.PostsPerPage` could potentially result in an `Internal.Exception` when encountering a query string which doesn't include the value for `posts_per_page` in the query string. Props [@anomiex] for reporting.


## [3.0.1] - 2023-09-14

### Added

- In WordPressCS 3.0.0, the functionality of the `FinPress.Security.EscapeOutput` sniff was updated to report unescaped message parameters passed to exceptions created in `throw` statements. This specific violation now has a separate error code: `ExceptionNotEscaped`. This will allow users to ignore or exclude that specific error code. Props [@anomiex].
    The error code(s) for other escaping issues flagged by the sniff remain unchanged.

### Changed

- Updated the CI workflow to test the example ruleset for issues.
- Funding files and updates in the Readme about funding the project.

### Fixed

- Fixed a sniff name in the `phpcs.xml.dist.sample` file (case-sensitive sniff name). Props [@dawidurbanski].


## [3.0.0] - 2023-08-21

### Important information about this release:

At long last... WordPressCS 3.0.0 is here.

This is an important release which makes significant changes to improve the accuracy, performance, stability and maintainability of all sniffs, as well as making WordPressCS much better at handling modern PHP.

WordPressCS 3.0.0 contains breaking changes, both for people using ignore annotations, people maintaining custom rulesets, as well as for sniff developers who maintain a custom PHPCS standard based on WordPressCS.

If you are an end-user or maintain a custom WordPressCS based ruleset, please start by reading the [Upgrade Guide to WordPressCS 3.0.0 for end-users](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-3.0.0-for-end-users) which lists the most important changes and contains a step by step guide for upgrading.

If you are a maintainer of an external standard based on WordPressCS and any of your custom sniffs are based on or extend WordPressCS sniffs, please read the [Upgrade Guide to WordPressCS 3.0.0 for Developers](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-3.0.0-for-Developers-of-external-standards).

In all cases, please read the complete changelog carefully before you upgrade.


### Added

- Dependencies on the following packages: [PHPCSUtils](https://phpcsutils.com/), [PHPCSExtra](https://github.com/PHPCSStandards/PHPCSExtra) and the [Composer PHPCS plugin].
- A best effort has been made to add support for the new PHP syntaxes/features to all WordPressCS native sniffs and utility functions (or to verify/improve existing support).
    While support in external sniffs used by WordPressCS has not be exhaustively verified, a lot of work has been done to try and add support for new PHP syntaxes to those as well.
    WordPressCS native sniffs and utilities have received fixes for the following syntaxes:
    * PHP 7.2
        - Keyed lists.
    * PHP 7.3
        - Flexible heredoc/nowdoc (providing the PHPCS scan is run on PHP 7.3 or higher).
        - Trailing commas in function calls.
    * PHP 7.4
        - Arrow functions.
        - Array unpacking in array expressions.
        - Numeric literals with underscores.
        - Typed properties.
        - Null coalesce equals operator.
    * PHP 8.0
        - Nullsafe object operators.
        - Match expressions.
        - Named arguments in function calls.
        - Attributes.
        - Union types // including supporting the `false` and `null` types.
        - Constructor property promotion.
        - `$object::class`
        - Throw as an expression.
    * PHP 8.1
        - Enumerations.
        - Explicit octal notation.
        - Final class constants
        - First class callables.
        - Intersection types.
    * PHP 8.2
        - Constants in traits.
- New `FinPress.CodeAnalysis.AssignmentInTernaryCondition` sniff to the `FinPress-Core` ruleset which partially replaces the removed `FinPress.CodeAnalysis.AssignmentInCondition` sniff.
- New `FinPress.WhiteSpace.ObjectOperatorSpacing` sniff which replaces the use of the `Squiz.WhiteSpace.ObjectOperatorSpacing` sniff in the `FinPress-Core` ruleset.
- New `FinPress.FP.ClassNameCase` sniff to the `FinPress-Core` ruleset, to check that any class name references to FP native classes and classes from external dependencies use the case of the class as per the class declaration.
- New `FinPress.FP.Capabilities` sniff to the `FinPress-Extra` ruleset. This sniff checks that valid capabilities are used, not roles or user levels. Props, amongst others, to [@grappler] and [@khacoder].
    Custom capabilities can be added to the sniff via a `custom_capabilities` ruleset property.
    The sniff also supports the `minimum_fp_version` property to allow the sniff to accurately determine how the use of deprecated capabilities should be flagged.
- The `FinPress.FP.CapitalPDangit` sniff contains a new check to verify the correct spelling of `FinPress` in namespace names.
- The `FinPress.FP.I18n` sniff contains a new `EmptyTextDomain` error code for an empty text string being passed as the text domain, which overrules the default value of the parameter and renders a text untranslatable.
- The `FinPress.DB.PreparedSQLPlaceholders` sniff has been expanded with additional checks for the correct use of the `%i` placeholder, which was introduced in FP 6.2. Props [@craigfrancis].
    The sniff now also supports the `minimum_fp_version` ruleset property to determine whether the `%i` placeholder can be used.
- `FinPress-Core`: the following additional sniffs (or select error codes from these sniffs) have been added to the ruleset: `Generic.CodeAnalysis.AssignmentInCondition`, `Generic.CodeAnalysis.EmptyPHPStatement` (replaces the WordPressCS native sniff), `Generic.VersionControl.GitMergeConflict`, `Generic.WhiteSpace.IncrementDecrementSpacing`, `Generic.WhiteSpace.LanguageConstructSpacing`, `Generic.WhiteSpace.SpreadOperatorSpacingAfter`, `PSR2.Classes.ClassDeclaration`, `PSR2.Methods.FunctionClosingBrace`, `PSR12.Classes.ClassInstantiation`, `PSR12.Files.FileHeader` (select error codes only), `PSR12.Functions.NullableTypeDeclaration`, `PSR12.Functions.ReturnTypeDeclaration`, `PSR12.Traits.UseDeclaration`, `Squiz.Functions.MultiLineFunctionDeclaration` (replaces part of the `FinPress.WhiteSpace.ControlStructureSpacing` sniff), `Modernize.FunctionCalls.Dirname`, `NormalizedArrays.Arrays.ArrayBraceSpacing` (replaces part of the `FinPress.Arrays.ArrayDeclarationSpacing` sniff), `NormalizedArrays.Arrays.CommaAfterLast` (replaces the WordPressCS native sniff), `Universal.Classes.ModifierKeywordOrder`, `Universal.Classes.RequireAnonClassParentheses`, `Universal.Constants.LowercaseClassResolutionKeyword`, `Universal.Constants.ModifierKeywordOrder`, `Universal.Constants.UppercaseMagicConstants`, `Universal.Namespaces.DisallowCurlyBraceSyntax`, `Universal.Namespaces.DisallowDeclarationWithoutName`, `Universal.Namespaces.OneDeclarationPerFile`, `Universal.NamingConventions.NoReservedKeywordParameterNames`, `Universal.Operators.DisallowShortTernary` (replaces the WordPressCS native sniff), `Universal.Operators.DisallowStandalonePostIncrementDecrement`, `Universal.Operators.StrictComparisons` (replaces the WordPressCS native sniff), `Universal.Operators.TypeSeparatorSpacing`, `Universal.UseStatements.DisallowMixedGroupUse`, `Universal.UseStatements.KeywordSpacing`, `Universal.UseStatements.LowercaseFunctionConst`, `Universal.UseStatements.NoLeadingBackslash`, `Universal.UseStatements.NoUselessAliases`, `Universal.WhiteSpace.CommaSpacing`, `Universal.WhiteSpace.DisallowInlineTabs` (replaces the WordPressCS native sniff), `Universal.WhiteSpace.PrecisionAlignment` (replaces the WordPressCS native sniff), `Universal.WhiteSpace.AnonClassKeywordSpacing`.
- `FinPress-Extra`: the following additional sniffs have been added to the ruleset: `Generic.CodeAnalysis.UnusedFunctionParameter`, `Universal.Arrays.DuplicateArrayKey`, `Universal.CodeAnalysis.ConstructorDestructorReturn`, `Universal.CodeAnalysis.ForeachUniqueAssignment`, `Universal.CodeAnalysis.NoEchoSprintf`, `Universal.CodeAnalysis.StaticInFinalClass`, `Universal.ControlStructures.DisallowLonelyIf`, `Universal.Files.SeparateFunctionsFromOO`.
- `FinPress.Utils.I18nTextDomainFixer`: the `load_script_textdomain()` function to the functions the sniff looks for.
- `FinPress.FP.AlternativeFunctions`: the following PHP native functions have been added to the sniff and will now be flagged when used: `unlink()` (in a new `unlink` group) , `rename()` (in a new `rename` group), `chgrp()`, `chmod()`, `chown()`, `is_writable()` `is_writeable()`, `mkdir()`, `rmdir()`, `touch()`, `fputs()` (in the existing `file_system_operations` group, which was previously named `file_system_read`). Props [@sandeshjangam] and [@JDGrimes].
- The `PHPUnit_Adapter_TestCase` class to the list of "known test (case) classes".
- The `antispambot()` function to the list of known "formatting" functions.
- The `esc_xml()` and `fp_kses_one_attr()` functions to the list of known "escaping" functions.
- The `fp_timezone_choice()` and `fp_readonly()` functions to the list of known "auto escaping" functions.
- The `sanitize_url()` and `fp_kses_one_attr()` functions to the list of known "sanitizing" functions.
- Metrics for blank lines at the start/end of a control structure body to the `FinPress.WhiteSpace.ControlStructureSpacing` sniff. These can be displayed using `--report=info` when the `blank_line_check` property has been set to `true`.
- End-user documentation to the following new and pre-existing sniffs: `FinPress.DateTime.RestrictedFunctions`, `FinPress.NamingConventions.PrefixAllGlobals` (props [@Ipstenu]), `FinPress.PHP.StrictInArray` (props [@marconmartins]), `FinPress.PHP.YodaConditions` (props [@Ipstenu]), `FinPress.WhiteSpace.ControlStructureSpacing` (props [@ckanitz]), `FinPress.WhiteSpace.ObjectOperatorSpacing`, `FinPress.WhiteSpace.OperatorSpacing` (props [@ckanitz]), `FinPress.FP.CapitalPDangit` (props [@NielsdeBlaauw]), `FinPress.FP.Capabilities`, `FinPress.FP.ClassNameCase`, `FinPress.FP.EnqueueResourceParameters` (props [@NielsdeBlaauw]).
    This documentation can be exposed via the [`PHP_CodeSniffer` `--generator=...` command-line argument](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Usage).
    Note: all sniffs which have been added from PHPCSExtra (Universal, Modernize, NormalizedArrays sniffs) are also fully documented.

#### Added (internal/dev-only)
- New Helper classes:
    - `ArrayWalkingFunctionsHelper`
    - `ConstantsHelper` *
    - `ContextHelper` *
    - `DeprecationHelper` *
    - `FormattingFunctionsHelper`
    - `ListHelper` *
    - `RulesetPropertyHelper` *
    - `SnakeCaseHelper` *
    - `UnslashingFunctionsHelper`
    - `ValidationHelper`
    - `VariableHelper` *
    - `FPGlobalVariablesHelper`
    - `FPHookHelper`
- New Helper traits:
    - `EscapingFunctionsTrait`
    - `IsUnitTestTrait`
    - `MinimumFPVersionTrait`
    - `PrintingFunctionsTrait`
    - `SanitizationHelperTrait` *
    - `FPDBTrait`

These classes and traits mostly contain pre-existing functionality moved from the `Sniff` class.
The classes marked with an `*` are considered _internal_ and do not have any promise of future backward compatibility.

More information is available in the [Upgrade Guide to WordPressCS 3.0.0 for Developers](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-3.0.0-for-Developers-of-external-standards).


### Changed

- As of this version, installation via Composer is the only supported manner of installation.
    Installing in a different manner (git clone/PEAR/PHAR) is still possible, but no longer supported.
- The minimum required `PHP_CodeSniffer` version to 3.7.2 (was 3.3.1).
- Composer: the package will now identify itself as a static analysis tool.
- The PHP `filter`, `libxml` and `XMLReader` extensions are now explicitly required.
    It is recommended to also have the `Mbstring` and `iconv` extensions enabled for the most accurate results.
- The release branch has been renamed from `master` to `main`.
- The following sniffs have been moved from `FinPress-Extra` to `FinPress-Core`: the `Generic.Files.OneObjectStructurePerFile` (also changed from `warning` to `error`),
 `Generic.PHP.BacktickOperator`, `PEAR.Files.IncludingFile`, `PSR2.Classes.PropertyDeclaration`, `PSR2.Methods.MethodDeclaration`, `Squiz.Scope.MethodScope`, `Squiz.WhiteSpace.ScopeKeywordSpacing` sniffs. Props, amongst others, to [@desrosj].
- `FinPress-Core`: The `Generic.Arrays.DisallowShortArraySyntax` sniff has been replaced by the `Universal.Arrays.DisallowShortArraySyntax` sniff.
    The new sniff will recognize short lists correctly and ignore them.
- `FinPress-Core`: The `Generic.Files.EndFileNewline` sniff has been replaced by the more comprehensive `PSR2.Files.EndFileNewline` sniff.
- A number of sniffs support setting the minimum FP version for the code being scanned.
    This could be done in two different ways:
    1. By setting the `minimum_supported_version` property for each sniff from a ruleset.
    2. By passing `--runtime-set minimum_supported_fp_version #.#` on the command line.
    The names of the property and the CLI setting have now been aligned to both use `minimum_fp_version` as the name.
    Both ways of passing the value are still supported.
- `FinPress.NamingConventions.PrefixAllGlobals`: the `custom_test_class_whitelist` property has been renamed to `custom_test_classes`.
- `FinPress.NamingConventions.ValidVariableName`: the `customPropertiesWhitelist` property has been renamed to `allowed_custom_properties`.
- `FinPress.PHP.NoSilencedErrors`: the `custom_whitelist` property has been renamed to `customAllowedFunctionsList`.
- `FinPress.PHP.NoSilencedErrors`: the `use_default_whitelist` property has been renamed to `usePHPFunctionsList`.
- `FinPress.FP.GlobalVariablesOverride`: the `custom_test_class_whitelist` property has been renamed to `custom_test_classes`.
- Sniffs are now able to handle fully qualified names for custom test classes provided via a `custom_test_classes` (previously `custom_test_class_whitelist`) ruleset property.
- The default value for `minimum_supported_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters), has been updated to `6.0`.
- `FinPress.NamingConventions.PrefixAllGlobals` now takes new pluggable constants into account as introduced in FinPress up to FP 6.3.
- `FinPress.NamingConventions.ValidPostTypeSlug` now takes new reserved post types into account as introduced in FinPress up to FP 6.3.
- `FinPress.FP.DeprecatedClasses` now detects classes deprecated in FinPress up to FP 6.3.
- `FinPress.FP.DeprecatedFunctions` now detects functions deprecated in FinPress up to FP 6.3.
- `FinPress.FP.DeprecatedParameters` now detects parameters deprecated in FinPress up to FP 6.3.
- `FinPress.FP.DeprecatedParameterValues` now detects parameter values deprecated in FinPress up to FP 6.3.
- `FinPress.Utils.I18nTextDomainFixer`: the lists of recognized plugin and theme header tags has been updated based on the current information in the plugin and theme handbooks.
- `FinPress.FP.AlternativeFunctions`: the "group" name `file_system_read`, which can be used with the `exclude` property, has been renamed to `file_system_operations`.
    This also means that the error codes for individual functions flagged via that group have changed from `FinPress.FP.AlternativeFunctions.file_system_read_*` to `FinPress.FP.AlternativeFunctions.file_system_operations_*`.
- `FinPress.FP.CapitalPDangit`: the `Misspelled` error code has been split into two error codes - `MisspelledInText` and `MisspelledInComment` - to allow for more modular exclusions/selectively turning off the auto-fixer for the sniff.
- `FinPress.FP.I18n` no longer throws both the `MissingSingularPlaceholder` and the `MismatchedPlaceholders` for the same code, as the errors have an overlap.
- `FinPress-Core`: previously only the spacing around commas in arrays, function declarations and function calls was checked. Now, the spacing around commas will be checked in all contexts.
- `FinPress.Arrays.ArrayKeySpacingRestrictions`: a new `SpacesBetweenBrackets` error code has been introduced for the spacing between square brackets for array assignments without key. Previously, this would throw a `NoSpacesAroundArrayKeys` error with an unclear error message.
- `FinPress.Files.FileName` now recognizes more word separators, meaning that files using other word separators than underscores will now be flagged for not using hyphenation.
- `FinPress.Files.FileName` now checks if a file contains a test class and if so, will bow out.
    This change was made to prevent issues with PHPUnit 9.1+, which strongly prefers PSR4-style file names.
    Whether something is test class or not is based on a pre-defined list of "known" test case classes which can be extended and, optionally, a list of user provided test case classes provided via setting the `custom_test_classes` property in a custom ruleset or the complete test directory can be excluded via a custom ruleset.
- `FinPress.NamingConventions.PrefixAllGlobals` now allows for pluggable functions and classes, which should not be prefixed when "plugged".
- `FinPress.PHP.NoSilencedErrors`: the metric, which displays in the `info` report, has been renamed from "whitelisted function call" to "silencing allowed function call".
- `FinPress.Security.EscapeOutput` now flags the use of `get_search_query( false )` when generating output (as the `false` turns off the escaping).
- `FinPress.Security.EscapeOutput` now also examines parameters passed for exception creation in `throw` statements and expressions for correct escaping.
- `FinPress.Security.ValidatedSanitizedInput` now examines _all_ superglobal (except for `$GLOBALS`). Previously, the `$_SESSION` and `$_ENV` superglobals would not be flagged as needing validation/sanitization.
- `FinPress.FP.I18n` now recognizes the new PHP 8.0+ `h` and `H` type specifiers.
- `FinPress.FP.PostsPerPage` has improved recognition for numbers prefixed with a unary operator and non-decimal numbers.
- `FinPress.DB.PreparedSQL` will identify more precisely the code which is problematic.
- `FinPress.DB.PreparedSQLPlaceholders` will identify more precisely the code which is problematic.
- `FinPress.DB.SlowDBQuery` will identify more precisely the code which is problematic.
- `FinPress.Security.PluginMenuSlug`: the error will now be thrown more precisely on the code which triggered the error. Depending on code layout, this may mean that an error will now be thrown on a different line.
- `FinPress.FP.DiscouragedConstants`: the error will now be thrown more precisely on the code which triggered the error. Depending on code layout, this may mean that an error will now be thrown on a different line.
- `FinPress.FP.EnqueuedResourceParameters`: the error will now be thrown more precisely on the code which triggered the error. Depending on code layout, this may mean that an error will now be thrown on a different line.
- `FinPress.FP.I18n`: the errors will now be thrown more precisely on the code which triggered the error. Depending on code layout, this may mean that an error will now be thrown on a different line.
- `FinPress.FP.PostsPerPage` will identify more precisely the code which is problematic.
- `FinPress.PHP.TypeCasts.UnsetFound` has been changed from a `warning` to an `error` as the `(unset)` cast is no longer available in PHP 8.0 and higher.
- `FinPress.FP.EnqueuedResourceParameters.MissingVersion` has been changed from an `error` to a `warning`.
- `FinPress.Arrays.ArrayKeySpacingRestrictions`: improved the clarity of the error messages for the `TooMuchSpaceBeforeKey` and `TooMuchSpaceAfterKey` error codes.
- `FinPress.CodeAnalysis.EscapedNotTranslated`: improved the clarity of the error message.
- `FinPress.PHP.IniSet`: improved the clarity of the error messages for the sniff.
- `FinPress.PHP.PregQuoteDelimiter`: improved the clarity of the error message for the `Missing` error code.
- `FinPress.PHP.RestrictedFunctions`: improved the clarity of the error messages for the sniff.
- `FinPress.PHP.RestrictedPHPFunctions`: improved the error message for the `create_function_create_function` error code.
- `FinPress.PHP.TypeCast`: improved the clarity of the error message for the `UnsetFound` error code. It will no longer advise assigning `null`.
- `FinPress.Security.SafeRedirect`: improved the clarity of the error message. (very minor)
- `FinPress.Security.ValidatedSanitizedInput`: improved the clarity of the error messages for the `MissingUnslash` error code.
- `FinPress.WhiteSpace.CastStructureSpacing`: improved the clarity of the error message for the `NoSpaceBeforeOpenParenthesis` error code.
- `FinPress.FP.I18n`: improved the clarity of the error messages for the sniff.
- `FinPress.FP.I18n`: the error messages will now use the correct parameter name.
- The error messages for the `FinPress.CodeAnalysis.EscapedNotTranslated`, `FinPress.NamingConventions.PrefixAllGlobals`, `FinPress.NamingConventions.ValidPostTypeSlug`, `FinPress.PHP.IniSet`, and the `FinPress.PHP.NoSilencedErrors` sniff will now display the code sample found without comments and extranuous whitespace.
- Various updates to the README, the example ruleset and other documentation. Props, amongst others, to [@Luc45], [@slaFFik].
- Continuous Integration checks are now run via GitHub Actions. Props [@desrosj].
- Various other CI/QA improvements.
- Code coverage will now be monitored via [CodeCov](https://app.codecov.io/gh/FinPress/FinPress-Coding-Standards).
- All sniffs are now also being tested against PHP 8.0, 8.1, 8.2 and 8.3 for consistent sniff results.

#### Changed (internal/dev-only)
- All non-abstract classes in WordPressCS are now `final` with the exception of the following four classes which are known to be extended by external PHPCS standards build on top of WordPressCS: `FinPress.NamingConventions.ValidHookName`, `FinPress.Security.EscapeOutput`,`FinPress.Security.NonceVerification`, `FinPress.Security.ValidatedSanitizedInput`.
- Most remaining utility properties and methods, previously contained in the `WordPressCS\FinPress\Sniff` class, have been moved to dedicated Helper classes and traits or, in some cases, to the sniff class using them.
    As this change is only relevant for extenders, the full details of these moves are not included in this changelog, but can be found in the [Developers Upgrade Guide to WordPressCS 3.0.0](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-3.0.0-for-Developers-of-external-standards)
- A few customizable `public` properties, which were used by multiple sniffs, have been moved from `*Sniff` classes to traits. Again, the full details of these moves are not included in this changelog, but can be found in the [Developers Upgrade Guide to WordPressCS 3.0.0](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-3.0.0-for-Developers-of-external-standards)
- A number of non-public properties in sniffs have been renamed.
    As this change is only relevant for extenders, the full details of these renames are not included in this changelog, but can be found in the [Developers Upgrade Guide to WordPressCS 3.0.0](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-3.0.0-for-Developers-of-external-standards)
- `AbstractFunctionRestrictionsSniff`: The `whitelist` key in the `$groups` array property has been renamed to `allow`.
- The `FinPress.NamingConventions.ValidFunctionName` sniff no longer extends the similar PHPCS native `PEAR` sniff.


### Removed

- Support for the deprecated, old-style WordPressCS native ignore annotations. Use the PHPCS native selective ignore annotations instead.
- The following WordPressCS native sniffs have been removed:
    - The `FinPress.Arrays.CommaAfterArrayItem` sniff (replaced by the `NormalizedArrays.Arrays.CommaAfterLast` and the `Universal.WhiteSpace.CommaSpacing` sniffs).
    - The `FinPress.Classes.ClassInstantiation` sniff (replaced by the `PSR12.Classes.ClassInstantiation`, `Universal.Classes.RequireAnonClassParentheses` and `Universal.WhiteSpace.AnonClassKeywordSpacing` sniffs).
    - The `FinPress.CodeAnalysis.AssignmentInCondition` sniff (replaced by the `Generic.CodeAnalysis.AssignmentInCondition` and the `FinPress.CodeAnalysis.AssignmentInTernaryCondition` sniffs).
    - The `FinPress.CodeAnalysis.EmptyStatement` sniff (replaced by the `Generic.CodeAnalysis.EmptyPHPStatement` sniff).
    - The `FinPress.PHP.DisallowShortTernary` sniff (replaced by the `Universal.Operators.DisallowShortTernary` sniff).
    - The `FinPress.PHP.StrictComparisons` sniff (replaced by the `Universal.Operators.StrictComparisons` sniff).
    - The `FinPress.WhiteSpace.DisallowInlineTabs` sniff (replaced by the `Universal.WhiteSpace.DisallowInlineTabs` sniff).
    - The `FinPress.WhiteSpace.PrecisionAlignment` sniff (replaced by the `Universal.WhiteSpace.PrecisionAlignment` sniff).
    - The `FinPress.FP.TimezoneChange` sniff (replaced by the `FinPress.DateTime.RestrictedFunctions` sniff). This sniff was previously already deprecated.
- `FinPress-Extra`: The `Squiz.WhiteSpace.LanguageConstructSpacing` sniff (replaced by the added, more comprehensive `Generic.WhiteSpace.LanguageConstructSpacing` sniff in the `FinPress-Core` ruleset).
- `FinPress.Arrays.ArrayDeclarationSpacing`: array brace spacing checks (replaced by the `NormalizedArrays.Arrays.ArrayBraceSpacing` sniff).
- `FinPress.WhiteSpace.ControlStructureSpacing`: checks for the spacing for function declarations (replaced by the `Squiz.Functions.MultiLineFunctionDeclaration` sniff).
    Includes removal of the `spaces_before_closure_open_paren` property for this sniff.
- `FinPress.FP.I18n`: the `check_translator_comments` property.
    Exclude the `FinPress.FP.I18n.MissingTranslatorsComment` and the `FinPress.FP.I18n.TranslatorsCommentWrongStyle` error codes instead.
- WordPressCS will no longer check for assigning the return value of an object instantiation by reference.
    This is a PHP parse error since PHP 7.0. Use the `PHPCompatibilityFP` standard to check for PHP cross-version compatibility issues.
- The check for object instantiations will no longer check JavaScript files.
- The `FinPress.Arrays.ArrayKeySpacingRestrictions.MissingBracketCloser` error code as sniffs should not report on parse errors.
- The `FinPress.CodeAnalysis.AssignmentIn[Ternary]Condition.NonVariableAssignmentFound` error code as sniffs should not report on parse errors.
- The `Block_Supported_Styles_Test` class will no longer incorrectly be recognized as an extendable test case class.

#### Removed (internal/dev-only)
- `AbstractArrayAssignmentRestrictionsSniff`: support for the optional `'callback'` key in the array returned by `getGroups()`.
- `WordPressCS\FinPress\PHPCSHelper` class (use the `PHPCSUtils\BackCompat\Helper` class instead).
- `WordPressCS\FinPress\Sniff::addMessage()` method (use the `PHPCSUtils\Utils\MessageHelper::addMessage()` method instead).
- `WordPressCS\FinPress\Sniff::addFixableMessage()` method (use the `PHPCSUtils\Utils\MessageHelper::addFixableMessage()` method instead).
- `WordPressCS\FinPress\Sniff::determine_namespace()` method (use the `PHPCSUtils\Utils\Namespaces::determineNamespace()` method instead).
- `WordPressCS\FinPress\Sniff::does_function_call_have_parameters()` method (use the `PHPCSUtils\Utils\PassedParameters::hasParameters()` method instead).
- `WordPressCS\FinPress\Sniff::find_array_open_close()` method (use the `PHPCSUtils\Utils\Arrays::getOpenClose()` method instead).
- `WordPressCS\FinPress\Sniff::find_list_open_close()` method (use the `PHPCSUtils\Utils\Lists::getOpenClose()` method instead).
- `WordPressCS\FinPress\Sniff::get_declared_namespace_name()` method (use the `PHPCSUtils\Utils\Namespaces::getDeclaredName()` method instead).
- `WordPressCS\FinPress\Sniff::get_function_call_parameter_count()` method (use the `PHPCSUtils\Utils\PassedParameters::getParameterCount()` method instead).
- `WordPressCS\FinPress\Sniff::get_function_call_parameters()` method (use the `PHPCSUtils\Utils\PassedParameters::getParameters()` method instead).
- `WordPressCS\FinPress\Sniff::get_function_call_parameter()` method (use the `PHPCSUtils\Utils\PassedParameters::getParameter()` method instead).
- `WordPressCS\FinPress\Sniff::get_interpolated_variables()` method (use the `PHPCSUtils\Utils\TextStrings::getEmbeds()` method instead).
- `WordPressCS\FinPress\Sniff::get_last_ptr_on_line()` method (no replacement available at this time).
- `WordPressCS\FinPress\Sniff::get_use_type()` method (use the `PHPCSUtils\Utils\UseStatements::getType()` method instead).
- `WordPressCS\FinPress\Sniff::has_whitelist_comment()` method (no replacement).
- `WordPressCS\FinPress\Sniff::$hookFunctions` property (no replacement available at this time).
- `WordPressCS\FinPress\Sniff::init()` method (no replacement).
- `WordPressCS\FinPress\Sniff::is_class_constant()` method (use the `PHPCSUtils\Utils\Scopes::isOOConstant()` method instead).
- `WordPressCS\FinPress\Sniff::is_class_property()` method (use the `PHPCSUtils\Utils\Scopes::isOOProperty()` method instead).
- `WordPressCS\FinPress\Sniff::is_foreach_as()` method (use the `PHPCSUtils\Utils\Context::inForeachCondition()` method instead).
- `WordPressCS\FinPress\Sniff::is_short_list()` method (depending on your needs, use the `PHPCSUtils\Utils\Lists::isShortList()` or the `PHPCSUtils\Utils\Arrays::isShortArray()` method instead).
- `WordPressCS\FinPress\Sniff::is_token_in_test_method()` method (no replacement available at this time).
- `WordPressCS\FinPress\Sniff::REGEX_COMPLEX_VARS` constant (use the PHPCSUtils `PHPCSUtils\Utils\TextStrings::stripEmbeds()` and `PHPCSUtils\Utils\TextStrings::getEmbeds()` methods instead).
- `WordPressCS\FinPress\Sniff::string_to_errorcode()` method (use the `PHPCSUtils\Utils\MessageHelper::stringToErrorcode()` method instead).
- `WordPressCS\FinPress\Sniff::strip_interpolated_variables()` method (use the `PHPCSUtils\Utils\TextStrings::stripEmbeds()` method instead).
- `WordPressCS\FinPress\Sniff::strip_quotes()` method (use the `PHPCSUtils\Utils\TextStrings::stripQuotes()` method instead).
- `WordPressCS\FinPress\Sniff::valid_direct_scope()` method (use the `PHPCSUtils\Utils\Scopes::validDirectScope()` method instead).
- Unused dev-only files in the (now removed) `bin` directory.


### Fixed

- All sniffs which, in one way or another, check whether code represents a short list or a short array will now do so more accurately.
    This fixes various false positives and false negatives.
- Sniffs supporting the `minimum_fp_version` property (previously `minimum_supported_version`) will no longer throw a "passing null to non-nullable" deprecation notice on PHP 8.1+.
- `FinPress.WhiteSpace.ControlStructureSpacing` no longer throws a `TypeError` on PHP 8.0+.
- `FinPress.NamingConventions.PrefixAllGlobals`no longer throws a "passing null to non-nullable" deprecation notice on PHP 8.1+.
- `FinPress.FP.I18n` no longer throws a "passing null to non-nullable" deprecation notice on PHP 8.1+.
- `VariableHelper::is_comparison()` (previously `Sniff::is_comparison()`): fixed risk of undefined array key notice when scanning code containing parse errors.
- `AbstractArrayAssignmentRestrictionsSniff` could previously get confused when it encountered comments in unexpected places.
    This fix has a positive impact on all sniffs which are based on this abstract (2 sniffs).
- `AbstractArrayAssignmentRestrictionsSniff` no longer examines numeric string keys as PHP treats those as integer keys, which were never intended as the target of this abstract.
    This fix has a positive impact on all sniffs which are based on this abstract (2 sniffs).
- `AbstractArrayAssignmentRestrictionsSniff` in case of duplicate entries, the sniff will now only examine the last value, as that's the value PHP will see.
    This fix has a positive impact on all sniffs which are based on this abstract (2 sniffs).
- `AbstractArrayAssignmentRestrictionsSniff` now determines the assigned value with higher accuracy.
    This fix has a positive impact on all sniffs which are based on this abstract (2 sniffs).
- `AbstractClassRestrictionsSniff` now treats the `namespace` keyword when used as an operator case-insensitively.
    This fix has a positive impact on all sniffs which are based on this abstract (3 sniffs).
- `AbstractClassRestrictionsSniff` now treats the hierarchy keywords (`self`, `parent`, `static`) case-insensitively.
    This fix has a positive impact on all sniffs which are based on this abstract (3 sniffs).
- `AbstractClassRestrictionsSniff` now limits itself correctly when trying to find a class name before a `::`.
    This fix has a positive impact on all sniffs which are based on this abstract (3 sniffs).
- `AbstractClassRestrictionsSniff`: false negatives on class instantiation statements ending on a PHP close tag.
    This fix has a positive impact on all sniffs which are based on this abstract (3 sniffs).
- `AbstractClassRestrictionsSniff`: false negatives on class instantiation statements combined with method chaining.
    This fix has a positive impact on all sniffs which are based on this abstract (3 sniffs).
- `AbstractFunctionRestrictionsSniff`: false positives on function declarations when the function returns by reference.
    This fix has a positive impact on all sniffs which are based on this abstract (nearly half of the WordPressCS sniffs).
- `AbstractFunctionRestrictionsSniff`: false positives on instantiation of a class with the same name as a targeted function.
    This fix has a positive impact on all sniffs which are based on this abstract (nearly half of the WordPressCS sniffs).
- `AbstractFunctionRestrictionsSniff` now respects that function names in PHP are case-insensitive in more places.
    This fix has a positive impact on all sniffs which are based on this abstract (nearly half of the WordPressCS sniffs).
- Various utility methods in Helper classes/traits have received fixes to correctly treat function and class names as case-insensitive.
    These fixes have a positive impact on all sniffs using these methods.
- Version comparisons done by sniffs supporting the `minimum_fp_version` property (previously `minimum_supported_version`) will now be more precise.
- `FinPress.Arrays.ArrayIndentation` now ignores indentation issues for array items which are not the first thing on a line. This fixes a potential fixer conflict.
- `FinPress.Arrays.ArrayKeySpacingRestrictions`: signed positive integer keys will now be treated the same as signed negative integer keys.
- `FinPress.Arrays.ArrayKeySpacingRestrictions`: keys consisting of calculations will now be recognized more accurately.
- `FinPress.Arrays.ArrayKeySpacingRestrictions.NoSpacesAroundArrayKeys`: now has better protection in case of a fixer conflict.
- `FinPress.Classes.ClassInstantiation` could create parse errors when fixing a class instantiation using variable variables. This has been fixed by replacing the sniff with the `PSR12.Classes.ClassInstantiation` sniff (and some others).
- `FinPress.DB.DirectDatabaseQuery` could previously get confused when it encountered comments in unexpected places.
- `FinPress.DB.DirectDatabaseQuery` now respects that function (method) names in PHP are case-insensitive.
- `FinPress.DB.DirectDatabaseQuery` now only looks at the current statement to find a method call to the `$fpdb` object.
- `FinPress.DB.DirectDatabaseQuery` no longer warns about `TRUNCATE` queries as those cannot be cached and need a direct database query.
- `FinPress.DB.PreparedSQL` could previously get confused when it encountered comments in unexpected places.
- `FinPress.DB.PreparedSQL` now respects that function names in PHP are case-insensitive.
- `FinPress.DB.PreparedSQL` improved recognition of interpolated variables and expressions in the `$text` argument. This fixes both some false negatives as well as some false positives.
- `FinPress.DB.PreparedSQL` stricter recognition of the `$fpdb` variable in double quoted query strings.
- `FinPress.DB.PreparedSQL` false positive for floating point numbers concatenated into an SQL query.
- `FinPress.DB.PreparedSQLPlaceholders` could previously get confused when it encountered comments in unexpected places.
- `FinPress.DB.PreparedSQLPlaceholders` now respects that function names in PHP are case-insensitive.
- `FinPress.DB.PreparedSQLPlaceholders` stricter recognition of the `$fpdb` variable in double quotes query strings.
- `FinPress.DB.PreparedSQLPlaceholders` false positive when a fully qualified function call is encountered in an `implode( ', ', array_fill(...))` pattern.
- `FinPress.Files.FileName` no longer presumes a three character file extension.
- `FinPress.NamingConventions.PrefixAllGlobals` could previously get confused when it encountered comments in unexpected places in function calls which were being examined.
- `FinPress.NamingConventions.PrefixAllGlobals` now respects that function names in PHP are case-insensitive when checking whether a function declaration is polyfilling a PHP native function.
- `FinPress.NamingConventions.PrefixAllGlobals` improved false positive prevention for variable assignments via keyed lists.
- `FinPress.NamingConventions.PrefixAllGlobals` now only looks at the current statement when determining which variables were imported via a `global` statement. This prevents both false positives as well as false negatives.
- `FinPress.NamingConventions.PrefixAllGlobals` no longer gets confused over `global` statements in nested clsure/function declarations.
- `FinPress.NamingConventions.ValidFunctionName` now also checks the names of (global) functions when the declaration is nested within an OO method.
- `FinPress.NamingConventions.ValidFunctionName` no longer throws false positives for triple underscore methods.
- `FinPress.NamingConventions.ValidFunctionName` the suggested replacement names in the error message no longer remove underscores from a name in case of leading or trailing underscores, or multiple underscores in the middle of a name.
- `FinPress.NamingConventions.ValidFunctionName` the determination whether a name is in `snake_case` is now more accurate and has improved handling of non-ascii characters.
- `FinPress.NamingConventions.ValidFunctionName` now correctly recognizes a PHP4-style constructor when the class and the constructor method name contains non-ascii characters.
- `FinPress.NamingConventions.ValidHookName` no longer throws false positives when the hook name is generated via a function call and that function is passed string literals as parameters.
- `FinPress.NamingConventions.ValidHookName` now ignores parameters in a variable function call (like a call to a closure).
- `FinPress.NamingConventions.ValidPostTypeSlug` no longer throws false positives for interpolated text strings with complex embedded variables/expressions.
- `FinPress.NamingConventions.ValidVariableName` the suggested replacement names in the error message will no longer remove underscores from a name in case of leading or trailing underscores, or multiple underscores in the middle of a name.
- `FinPress.NamingConventions.ValidVariableName` the determination whether a name is in `snake_case` is now more accurate and has improved handling of non-ascii characters.
- `FinPress.NamingConventions.ValidVariableName` now examines all variables and variables in expressions in a text string containing interpolation.
- `FinPress.NamingConventions.ValidVariableName` now has improved recognition of variables in complex embedded variables/expressions in interpolated text strings.
- `FinPress.PHP.IniSet` no longer gets confused over comments in the code when determining whether the ini value is an allowed one.
- `FinPress.PHP.NoSilencedErrors` no longer throws an error when error silencing is encountered for function calls to the PHP native `libxml_disable_entity_loader()` and `imagecreatefromwebp()` methods.
- `FinPress.PHP.StrictInArray` no longer gets confused over comments in the code when determining whether the `$strict` parameter is used.
- `FinPress.Security.EscapeOutput` no longer throws a false positive on function calls where the parameters need escaping, when no parameters are being passed.
- `FinPress.Security.EscapeOutput` no longer throws a false positive when a fully qualified function call to the `\basename()` function is encountered within a call to `_deprecated_file()`.
- `FinPress.Security.EscapeOutput` could previously get confused when it encountered comments in the `$file` parameter for `_deprecated_file()`.
- `FinPress.Security.EscapeOutput` now ignores significantly more operators which should yield more accurate results.
- `FinPress.Security.EscapeOutput` now respects that function names in PHP are case-insensitive when checking whether a printing function is being used.
- `FinPress.Security.EscapeOutput` no longer throws an `Internal.Exception` when it encounters a constant or property mirroring the name of one of the printing functions being targeted, nor will it throw false positives for those.
- `FinPress.Security.EscapeOutput` no longer incorrectly handles method calls or calls to namespaced functions mirroring the name of one of the printing functions being targeted.
- `FinPress.Security.EscapeOutput` now ignores `exit`/`die` statements without a status being passed, preventing false positives on code after the statement.
- `FinPress.Security.EscapeOutput` now has improved recognition that `print` can also be used as an expression, not only as a statement.
- `FinPress.Security.EscapeOutput` now has much, much, much more accurate handling of code involving ternary expressions and should now correctly ignore the ternary condition in all long ternaries being examined.
- `FinPress.Security.EscapeOutput` no longer disregards the ternary condition in a short ternary.
- `FinPress.Security.EscapeOutput` no longer skips over a constant or property mirroring the name of one of the (auto-)escaping/formatting functions being targeted.
- `FinPress.Security.EscapeOutput` no longer throws false positives for `*::class`, which will always evaluate to a plain string.
- `FinPress.Security.EscapeOutput` no longer throws false positives on output generating keywords encountered in an inline expression.
- `FinPress.Security.EscapeOutput` no longer throws false positives on parameters passed to `_e()` or `_ex()`, which won't be used in the output.
- `FinPress.Security.EscapeOutput` no longer throws false positives on heredocs not using interpolation.
- `FinPress.Security.NonceVerification` now respects that function names in PHP are case-insensitive when checking whether an array comparison function is being used.
- `FinPress.Security.NonceVerification` now also checks for nonce verification when the `$_FILES` superglobal is being used.
- `FinPress.Security.NonceVerification` now ignores properties named after superglobals.
- `FinPress.Security.NonceVerification` now ignores list assignments to superglobals.
- `FinPress.Security.NonceVerification` now ignores superglobals being unset.
- `FinPress.Security.ValidatedSanitizedInput` now respects that function names in PHP are case-insensitive when checking whether an array comparison function is being used.
- `FinPress.Security.ValidatedSanitizedInput` now respects that function names in PHP are case-insensitive when checking whether a variable is being validated using `[array_]key_exists()`.
- `FinPress.Security.ValidatedSanitizedInput` improved recognition of interpolated variables and expression in the text strings. This fixes some false negatives.
- `FinPress.Security.ValidatedSanitizedInput` no longer incorrectly regards an `unset()` as variable validation.
- `FinPress.Security.ValidatedSanitizedInput` no longer incorrectly regards validation in a nested scope as validation which applies to the superglobal being examined.
- `FinPress.FP.AlternativeFunctions` could previously get confused when it encountered comments in unexpected places.
- `FinPress.FP.AlternativeFunctions` now correctly takes the `minimum_fp_version` into account when determining whether a call to `parse_url()` could switch over to using `fp_parse_url()`.
- `FinPress.FP.CapitalPDangit` now skips (keyed) list assignments to prevent false positives.
- `FinPress.FP.CapitalPDangit` now always skips all array keys, not just plain text array keys.
- `FinPress.FP.CronInterval` no longer throws a `ChangeDetected` warning for interval calculations wrapped in parentheses, but for which the value for the interval is otherwise known.
- `FinPress.FP.CronInterval` no longer throws a `ChangeDetected` warning for interval calculations using fully qualified FP native time constants, but for which the value for the interval is otherwise known.
- `FinPress.FP.DeprecatedParameters` no longer throws a false positive for function calls to `comments_number()` using the fourth parameter (which was deprecated, but has been repurposed since FP 5.4).
- `FinPress.FP.DeprecatedParameters` now looks for the correct parameter in calls to the `unregister_setting()` function.
- `FinPress.FP.DeprecatedParameters` now lists the correct FP version for the deprecation of the third parameter in function calls to `get_user_option()`.
- `FinPress.FP.DiscouragedConstants` could previously get confused when it encountered comments in unexpected places.
- `FinPress.FP.EnqueuedResources` now recognizes enqueuing in a multi-line text string correctly.
- `FinPress.FP.EnqueuedResourceParameters` could previously get confused when it encountered comments in unexpected places.
- `FinPress.FP.GlobalVariablesOverride` improved false positive prevention for variable assignments via keyed lists.
- `FinPress.FP.GlobalVariablesOverride` now only looks at the current statement when determining which variables were imported via a `global` statement. This prevents both false positives as well as false negatives.
- `FinPress.FP.I18n` improved recognition of interpolated variables and expression in the `$text` argument. This fixes some false negatives.
- `FinPress.FP.I18n` no longer potentially creates parse errors when auto-fixing an `UnorderedPlaceholders*` error involving a multi-line text string.
- `FinPress.FP.I18n` no longer throws false positives for compound parameters starting with a text string, which were previously checked as if the parameter only consisted of a text string.
- `FinPress.FP.PostsPerPage` now determines the end of statement with more precision and will no longer throw a false positive for function calls on PHP 8.0+.


## [2.3.0] - 2020-05-14

### Added
- The `FinPress.FP.I18n` sniff contains a new check for translatable text strings which are wrapped in HTML tags, like `<h1>Translate me</h1>`. Those tags should be moved out of the translatable string.
    Note: Translatable strings wrapped in `<a href..>` tags where the URL is intended to be localized will not trigger this check.

### Changed
- The default value for `minimum_supported_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters), has been updated to `5.1`.
- The `FinPress.FP.DeprecatedFunctions` sniff will now detect functions deprecated in FP 5.4.
- Improved grammar of an error message in the `FinPress.FP.DiscouragedFunctions` sniff.
- CI: The codebase is now - preliminary - being tested against the PHPCS 4.x development branch.

### Fixed
- All function call detection sniffs: fixed a bug where constants with the same name as one of the targeted functions could inadvertently be recognized as if they were a called function.
- `FinPress.DB.PreparedSQL`: fixed a bug where the sniff would trigger on the namespace separator character `\\`.
- `FinPress.Security.EscapeOutput`: fixed a bug with the variable replacement in one of the error messages.


## [2.2.1] - 2020-02-04

### Added
- Metrics to the `FinPress.Arrays.CommaAfterArrayItem` sniff. These can be displayed using `--report=info`.
- The `sanitize_hex_color()` and the `sanitize_hex_color_no_hash()` functions to the `escapingFunctions` list used by the `FinPress.Security.EscapeOutput` sniff.

### Changed
- The recommended version of the suggested [Composer PHPCS plugin] is now `^0.6`.

### Fixed
- `FinPress.PHP.NoSilencedErrors`: depending on the custom properties set, the metrics would be different.
- `FinPress.WhiteSpace.ControlStructureSpacing`: fixed undefined index notice for closures with `use`.
- `FinPress.FP.GlobalVariablesOverride`: fixed undefined offset notice when the `treat_files_as_scoped` property would be set to `true`.
- `FinPress.FP.I18n`: fixed a _Trying to access array offset on value of type null_ error when the sniff was run on PHP 7.4  and would encounter a translation function expecting singular and plural texts for which one of these arguments was missing.

## [2.2.0] - 2019-11-11

Note: The repository has moved. The new URL is https://github.com/FinPress/FinPress-Coding-Standards.
The move does not affect the package name for Packagist. This remains the same: `fp-coding-standards/fpcs`.

### Added
- New `FinPress.DateTime.CurrentTimeTimestamp` sniff to the `FinPress-Core` ruleset, which checks against the use of the FP native `current_time()` function to retrieve a timestamp as this won't be a _real_ timestamp. Includes an auto-fixer.
- New `FinPress.DateTime.RestrictedFunctions` sniff to the `FinPress-Core` ruleset, which checks for the use of certain date/time related functions. Initially this sniff forbids the use of the PHP native `date_default_timezone_set()` and `date()` functions.
- New `FinPress.PHP.DisallowShortTernary` sniff to the `FinPress-Core` ruleset, which, as the name implies, disallows the use of short ternaries.
- New `FinPress.CodeAnalysis.EscapedNotTranslated` sniff to the `FinPress-Extra` ruleset which will warn when a text string is escaped for output, but not being translated, while the arguments passed to the function call give the impression that translation is intended.
- New `FinPress.NamingConventions.ValidPostTypeSlug` sniff to the `FinPress-Extra` ruleset which will examine calls to `register_post_type()` and throw errors when an invalid post type slug is used.
- `Generic.Arrays.DisallowShortArraySyntax` to the `FinPress-Core` ruleset.
- `FinPress.NamingConventions.PrefixAllGlobals`: the `PHP` prefix has been added to the prefix blacklist as it is reserved by PHP itself.
- The `fp_sanitize_redirect()` function to the `sanitizingFunctions` list used by the `FinPress.Security.NonceVerification`, `FinPress.Security.ValidatedSanitizedInput` and `FinPress.Security.EscapeOutput` sniffs.
- The `sanitize_key()` and the `highlight_string()` functions to the `escapingFunctions` list used by the `FinPress.Security.EscapeOutput` sniff.
- The `RECOVERY_MODE_COOKIE` constant to the list of FP Core constants which may be defined by plugins and themes and therefore don't need to be prefixed (`FinPress.NamingConventions.PrefixAllGlobals`).
- `$content_width`, `$plugin`, `$mu_plugin` and `$network_plugin` to the list of FP globals which is used by both the `FinPress.Variables.GlobalVariables` and the `FinPress.NamingConventions.PrefixAllGlobals` sniffs.
- `Sniff::is_short_list()` utility method to determine whether a _short array_ open/close token actually represents a PHP 7.1+ short list.
- `Sniff::find_list_open_close()` utility method to find the opener and closer for `list()` constructs, including short lists.
- `Sniff::get_list_variables()` utility method which will retrieve an array with the token pointers to the variables which are being assigned to in a `list()` construct. Includes support for short lists.
- `Sniff::is_function_deprecated()` static utility method to determine whether a declared function has been marked as deprecated in the function DocBlock.
- End-user documentation to the following existing sniffs: `FinPress.Arrays.ArrayIndentation`, `FinPress.Arrays.ArrayKeySpacingRestrictions`, `FinPress.Arrays.MultipleStatementAlignment`, `FinPress.Classes.ClassInstantiation`, `FinPress.NamingConventions.ValidHookName`, `FinPress.PHP.IniSet`, `FinPress.Security.SafeRedirect`, `FinPress.WhiteSpace.CastStructureSpacing`, `FinPress.WhiteSpace.DisallowInlineTabs`, `FinPress.WhiteSpace.PrecisionAlignment`, `FinPress.FP.CronInterval`, `FinPress.FP.DeprecatedClasses`, `FinPress.FP.DeprecatedFunctions`, `FinPress.FP.DeprecatedParameters`, `FinPress.FP.DeprecatedParameterValues`, `FinPress.FP.EnqueuedResources`, `FinPress.FP.PostsPerPage`.
    This documentation can be exposed via the [`PHP_CodeSniffer` `--generator=...` command-line argument](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Usage).

### Changed
- The default value for `minimum_supported_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters), has been updated to `5.0`.
- The `FinPress.Arrays.ArrayKeySpacingRestrictions` sniff has two new error codes: `TooMuchSpaceBeforeKey` and `TooMuchSpaceAfterKey`. Both auto-fixable.
    The sniff will now check that there is _exactly_ one space on the inside of the square brackets around the array key for non-string, non-numeric array keys. Previously, it only checked that there was whitespace, not how much whitespace.
- `FinPress.Arrays.ArrayKeySpacingRestrictions`: the fixers have been made more efficient and less fixer-conflict prone.
- `FinPress.NamingConventions.PrefixAllGlobals`: plugin/theme prefixes should be at least three characters long. A new `ShortPrefixPassed` error has been added for when the prefix passed does not comply with this rule.
- `FinPress.WhiteSpace.CastStructureSpacing` now allows for no whitespace before a cast when the cast is preceded by the spread `...` operator. This pre-empts a fixer conflict for when the spacing around the spread operator will start to get checked.
- The `FinPress.FP.DeprecatedClasses` sniff will now detect classes deprecated in FP 4.9 and FP 5.3.
- The `FinPress.FP.DeprecatedFunctions` sniff will now detect functions deprecated in FP 5.3.
- `FinPress.NamingConventions.ValidHookName` now has "cleaner" error messages and higher precision for the line on which an error is thrown.
- `FinPress.Security.EscapeOutput`: if an error refers to array access via a variable, the array index key will now be included in the error message.
- The processing of the `FinPress` ruleset by `PHP_CodeSniffer` will now be faster.
- Various minor code tweaks and clean up.
- Various minor documentation fixes.
- Documentation: updated the repo URL in all relevant places.

### Deprecated
- The `FinPress.FP.TimezoneChange` sniff. Use the `FinPress.DateTime.RestrictedFunctions` instead.
    The deprecated sniff will be removed in FPCS 3.0.0.

### Fixed
- All sniffs in the `FinPress.Arrays` category will no longer treat _short lists_ as if they were a short array.
- The `FinPress.NamingConventions.ValidFunctionName` and the `FinPress.NamingConventions.PrefixAllGlobals` sniff will now ignore functions marked as `@deprecated`.
- Both the `FinPress.NamingConventions.PrefixAllGlobals` sniff as well as the `FinPress.FP.GlobalVariablesOverride` sniff have been updated to recognize variables being declared via (long/short) `list()` constructs and handle them correctly.
- Both the `FinPress.NamingConventions.PrefixAllGlobals` sniff as well as the `FinPress.FP.GlobalVariablesOverride` sniff will now take a limited list of FP global variables _which are intended to be overwritten by plugins/themes_ into account.
    Initially this list contains the `$content_width` and the `$fp_cockneyreplace` variables.
- `FinPress.NamingConventions.ValidHookName`: will no longer examine a string array access index key as if it were a part of the hook name.
- `FinPress.Security.EscapeOutput`: will no longer trigger on the typical `basename( __FILE__ )` pattern if found as the first parameter passed to a call to `_deprecated_file()`.
- `FinPress.FP.CapitalPDangit`: now allows for the `.test` TLD in URLs.
- FPCS is now fully compatible with PHP 7.4.
    Note: `PHP_CodeSniffer` itself is only compatible with PHP 7.4 from PHPCS 3.5.0 onwards.


## [2.1.1] - 2019-05-21

### Changed
- The `FinPress.FP.CapitalPDangit` will now ignore misspelled instances of `FinPress` within constant declarations.
    This covers both constants declared using `defined()` as well as constants declared using the `const` keyword.
- The default value for `minimum_supported_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters), has been updated to `4.9`.

### Removed
- `paginate_comments_links()` from the list of auto-escaped functions `Sniff::$autoEscapedFunctions`.
    This affects the `FinPress.Security.EscapeOutput` sniff.

### Fixed
- The `$current_blog` and `$tag_ID` variables have been added to the list of FinPress global variables.
    This fixes some false positives from the `FinPress.NamingConventions.PrefixAllGlobals` and the `FinPress.FP.GlobalVariablesOverride` sniffs.
- The generic `TestCase` class name has been added to the `$test_class_whitelist`.
    This fixes some false positives from the `FinPress.NamingConventions.FileName`, `FinPress.NamingConventions.PrefixAllGlobals` and the `FinPress.FP.GlobalVariablesOverride` sniffs.
- The `FinPress.NamingConventions.ValidVariableName` sniff will now correctly recognize `$tag_ID` as a FinPress native, mixed-case variable.
- The `FinPress.Security.NonceVerification` sniff will now correctly recognize nonce verification within a nested closure or anonymous class.


## [2.1.0] - 2019-04-08

### Added
- New `FinPress.PHP.IniSet` sniff to the `FinPress-Extra` ruleset.
    This sniff will detect calls to `ini_set()` and `ini_alter()` and warn against their use as changing configuration values at runtime leads to an unpredictable runtime environment, which can result in conflicts between core/plugins/themes.
    - The sniff will not throw notices about a very limited set of "safe" ini directives.
    - For a number of ini directives for which there are alternative, non-conflicting ways to achieve the same available, the sniff will throw an `error` and advise using the alternative.
- `doubleval()`, `count()` and `sizeof()` to `Sniff::$unslashingSanitizingFunctions` property.
    While `count()` and its alias `sizeof()`, don't actually unslash or sanitize, the output of these functions is safe to use without unslashing or sanitizing.
    This affects the `FinPress.Security.ValidatedSanitizedInput` and the `FinPress.Security.NonceVerification` sniffs.
- The new FP 5.1 `FP_UnitTestCase_Base` class to the `Sniff::$test_class_whitelist` property.
- New `Sniff::get_array_access_keys()` utility method to retrieve all array keys for a variable using multi-level array access.
- New `Sniff::is_class_object_call()`, `Sniff::is_token_namespaced()` utility methods.
    These should help make the checking of whether or not a function call is a global function, method call or a namespaced function call more consistent.
    This also implements allowing for the [namespace keyword being used as an operator](https://www.php.net/manual/en/language.namespaces.nsconstants.php#example-258).
- New `Sniff::is_in_function_call()` utility method to facilitate checking whether a token is (part of) a parameter passed to a specific (set of) function(s).
- New `Sniff::is_in_type_test()` utility method to determine if a variable is being type tested, along with a `Sniff::$typeTestFunctions` property containing the names of the functions this applies to.
- New `Sniff::is_in_array_comparison()` utility method to determine if a variable is (part of) a parameter in an array-value comparison, along with a `Sniff::$arrayCompareFunctions` property containing the names of the relevant functions.
- New `Sniff::$arrayWalkingFunctions` property containing the names of array functions which apply a callback to the array, but don't change the array by reference.
- New `Sniff::$unslashingFunctions` property containing the names of functions which unslash data passed to them and return the unslashed result.

### Changed
- Moved the `FinPress.PHP.StrictComparisons`, `FinPress.PHP.StrictInArray` and the `FinPress.CodeAnalysis.AssignmentInCondition` sniff from the `FinPress-Extra` to the `FinPress-Core` ruleset.
- The `Squiz.Commenting.InlineComment.SpacingAfter` error is no longer included in the `FinPress-Docs` ruleset.
- The default value for `minimum_supported_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters), has been updated to `4.8`.
- The `FinPress.FP.DeprecatedFunctions` sniff will now detect functions deprecated in FP 5.1.
- The `FinPress.Security.NonceVerification` sniff now allows for variable type testing, comparisons, unslashing and sanitization before the nonce check. A nonce check within the same scope, however, is still required.
- The `FinPress.Security.ValidatedSanitizedInput` sniff now allows for using a superglobal in an array-value comparison without sanitization, same as when the superglobal is used in a scalar value comparison.
- `FinPress.NamingConventions.PrefixAllGlobals`: some of the error messages have been made more explicit.
- The error messages for the `FinPress.Security.ValidatedSanitizedInput` sniff will now contain information on the index keys accessed.
- The error message for the `FinPress.Security.ValidatedSanitizedInput.InputNotValidated` has been reworded to make it more obvious what the actual issue being reported is.
- The error message for the `FinPress.Security.ValidatedSanitizedInput.MissingUnslash` has been reworded.
- The `Sniff::is_comparison()` method now has a new `$include_coalesce` parameter to allow for toggling whether the null coalesce operator should be seen as a comparison operator. Defaults to `true`.
- All sniffs are now also being tested against PHP 7.4 (unstable) for consistent sniff results.
- The recommended version of the suggested [Composer PHPCS plugin] is now `^0.5.0`.
- Various minor code tweaks and clean up.

### Removed
- `ini_set` and `ini_alter` from the list of functions detected by the `FinPress.PHP.DiscouragedFunctions` sniff.
    These are now covered via the new `FinPress.PHP.IniSet` sniff.
- `in_array()` and `array_key_exists()` from the list of `Sniff::$sanitizingFunctions`. These are now handled differently.

### Fixed
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff would underreport when global functions would be autoloaded via a Composer autoload `files` configuration.
- The `FinPress.Security.EscapeOutput` sniff will now recognize `map_deep()` for escaping the values in an array via a callback to an output escaping function. This should prevent false positives.
- The `FinPress.Security.NonceVerification` sniff will no longer inadvertently allow for a variable to be sanitized without a nonce check within the same scope.
- The `FinPress.Security.ValidatedSanitizedInput` sniff will no longer throw errors when a variable is only being type tested.
- The `FinPress.Security.ValidatedSanitizedInput` sniff will now correctly recognize the null coalesce (PHP 7.0) and null coalesce equal (PHP 7.4) operators and will now throw errors for missing unslashing and sanitization where relevant.
- The `FinPress.FP.AlternativeFunctions` sniff will no longer recommend using the FP_FileSystem when PHP native input streams, like `php://input`, or the PHP input stream constants are being read or written to.
- The `FinPress.FP.AlternativeFunctions` sniff will no longer report on usage of the `curl_version()` function.
- The `FinPress.FP.CronInterval` sniff now has improved function recognition which should lower the chance of false positives.
- The `FinPress.FP.EnqueuedResources` sniff will no longer throw false positives for inline jQuery code trying to access a stylesheet link tag.
- Various bugfixes for the `Sniff::has_nonce_check()` method:
    - The method will no longer incorrectly identify methods/namespaced functions mirroring the name of FP native nonce verification functions as if they were the global functions.
        This will prevent some false negatives.
    - The method will now skip over nested closed scopes, such as closures and anonymous classes. This should prevent some false negatives for nonce verification being done while not in the correct scope.

    These fixes affect the `FinPress.Security.NonceVerification` sniff.
- The `Sniff::is_in_isset_or_empty()` method now also checks for usage of `array_key_exist()` and `key_exists()` and will regard these as correct ways to validate a variable.
    This should prevent false positives for the `FinPress.Security.ValidatedSanitizedInput` and the `FinPress.Security.NonceVerification` sniffs.
- Various bugfixes for the `Sniff::is_sanitized()` method:
    - The method presumed the FinPress coding style regarding code layout, which could lead to false positives.
    - The method will no longer incorrectly identify methods/namespaced functions mirroring the name of FP/PHP native unslashing/sanitization functions as if they were the global functions.
        This will prevent some false negatives.
    - The method will now recognize `map_deep()` for sanitizing an array via a callback to a sanitization function. This should prevent false positives.
    - The method will now recognize `stripslashes_deep()` and `stripslashes_from_strings_only()` as valid unslashing functions. This should prevent false positives.
    All these fixes affect both the `FinPress.Security.ValidatedSanitizedInput` and the `FinPress.Security.NonceVerification` sniff.
- Various bugfixes for the `Sniff::is_validated()` method:
    - The method did not verify correctly whether a variable being validated was the same variable as later used which could lead to false negatives.
    - The method did not verify correctly whether a variable being validated had the same array index keys as the variable as later used which could lead to both false negatives as well as false positives.
    - The method now also checks for usage of `array_key_exist()` and `key_exists()` and will regard these as correct ways to validate a variable. This should prevent some false positives.
    - The methods will now recognize the null coalesce and the null coalesce equal operators as ways to validate a variable. This prevents some false positives.
    The results from the `FinPress.Security.ValidatedSanitizedInput` sniff should be more accurate because of these fixes.
- A potential "Undefined index" notice from the `Sniff::is_assignment()` method.


## [2.0.0] - 2019-01-16

### Important information about this release:

WordPressCS 2.0.0 contains breaking changes, both for people using custom rulesets as well as for sniff developers who maintain a custom PHPCS standard based on WordPressCS.

Support for `PHP_CodeSniffer` 2.x has been dropped, the new minimum `PHP_CodeSniffer` version is 3.3.1.
Also, all previously deprecated sniffs, properties and methods have been removed.

Please read the complete changelog carefully before you upgrade.

If you are a maintainer of an external standard based on WordPressCS and any of your custom sniffs are based on or extend FPCS sniffs, please read the [Developers Upgrade Guide to WordPressCS 2.0.0](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-2.0.0-for-Developers-of-external-standards).

### Changes since 2.0.0-RC1

#### Fixed

- `FinPress-Extra`: Reverted back to including the `Squiz.WhiteSpace.LanguageConstructSpacing` sniff instead of the new `Generic.WhiteSpace.LanguageConstructSpacing` sniff as the new sniff is not (yet) available when the PEAR install of PHPCS is used.

### Changes since 1.2.1
For a full list of changes from the 1.2.1 version, please review the following changelog:
* https://github.com/FinPress/FinPress-Coding-Standards/releases/tag/2.0.0-RC1


## [2.0.0-RC1] - 2018-12-31

### Important information about this release:

This is the first release candidate for WordPressCS 2.0.0.
WordPressCS 2.0.0 contains breaking changes, both for people using custom rulesets as well as for sniff developers who maintain a custom PHPCS standard based on WordPressCS.

Support for `PHP_CodeSniffer` 2.x has been dropped, the new minimum `PHP_CodeSniffer` version is 3.3.1.
Also, all previously deprecated sniffs, properties and methods have been removed.

Please read the complete changelog carefully before you upgrade.

If you are a maintainer of an external standard based on WordPressCS and any of your custom sniffs are based on or extend FPCS sniffs, please read the [Developers Upgrade Guide to WordPressCS 2.0.0](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Upgrade-Guide-to-WordPressCS-2.0.0-for-Developers-of-external-standards).

### Added
- `Generic.PHP.DiscourageGoto`, `Generic.PHP.LowerCaseType`, `Generic.WhiteSpace.ArbitraryParenthesesSpacing` and `PSR12.Keywords.ShortFormTypeKeywords` to the `FinPress-Core` ruleset.
- Checking the spacing around the `instanceof` operator to the `FinPress.WhiteSpace.OperatorSpacing` sniff.

### Changed
- The minimum required `PHP_CodeSniffer` version to 3.3.1 (was 2.9.0).
- The namespace used by WordPressCS has been changed from `FinPress` to `WordPressCS\FinPress`.
    This was not possible while `PHP_CodeSniffer` 2.x was still supported, but WordPressCS, as a good Open Source citizen, does not want to occupy the `FinPress` namespace and is releasing its use of it now this is viable.
- The `FinPress.DB.PreparedSQL` sniff used the same error code for two different errors.
    The `NotPrepared` error code remains, however an additional `InterpolatedNotPrepared` error code has been added for the second error.
    If you are referencing the old error code in a ruleset XML file or in inline annotations, you may need to update it.
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff used the same error code for some errors as well as warnings.
    The `NonPrefixedConstantFound` error code remains for the related error, but the warning will now use the new `VariableConstantNameFound` error code.
    The `NonPrefixedHooknameFound` error code remains for the related error, but the warning will now use the new `DynamicHooknameFound` error code.
    If you are referencing the old error codes in a ruleset XML file or in inline annotations, you may need to update these to use the new codes instead.
- `FinPress.NamingConventions.ValidVariableName`: the error messages and error codes used by this sniff have been changed for improved usability and consistency.
    - The error messages will now show a suggestion for a valid alternative name for the variable.
    - The `NotSnakeCaseMemberVar` error code has been renamed to `UsedPropertyNotSnakeCase`.
    - The `NotSnakeCase` error code has been renamed to `VariableNotSnakeCase`.
    - The `MemberNotSnakeCase` error code has been renamed to `PropertyNotSnakeCase`.
    - The `StringNotSnakeCase` error code has been renamed to `InterpolatedVariableNotSnakeCase`.
    If you are referencing the old error codes in a ruleset XML file or in inline annotations, you may need to update these to use the new codes instead.
- The `FinPress.Security.NonceVerification` sniff used the same error code for both an error as well as a warning.
    The old error code `NoNonceVerification` is no longer used.
    The `error` now uses the `Missing` error code, while the `warning` now uses the `Recommended` error code.
    If you are referencing the old error code in a ruleset XML file or in inline annotations, please update these to use the new codes instead.
- The `FinPress.FP.DiscouragedConstants` sniff used to have two error codes `UsageFound` and `DeclarationFound`.
    These error codes will now be prefixed by the name of the constant found to allow for more fine-grained excluding/ignoring of warnings generated by this sniff.
    If you are referencing the old error codes in a ruleset XML file or in inline annotations, you may need to update these to use the new codes instead.
- The `FinPress.FP.GlobalVariablesOverride.OverrideProhibited` error code has been replaced by the `FinPress.FP.GlobalVariablesOverride.Prohibited` error code.
    If you are referencing the old error code in a ruleset XML file or in inline annotations, you may need to update it.
- `FinPress-Extra`: Replaced the inclusion of the `Generic.Files.OneClassPerFile`, `Generic.Files.OneInterfacePerFile` and the `Generic.Files.OneTraitPerFile` sniffs with the new `Generic.Files.OneObjectStructurePerFile` sniff.
- `FinPress-Extra`: Replaced the inclusion of the `Squiz.WhiteSpace.LanguageConstructSpacing` sniff with the new `Generic.WhiteSpace.LanguageConstructSpacing` sniff.
- `FinPress-Extra`: Replaced the inclusion of the `Squiz.Scope.MemberVarScope` sniff with the more comprehensive `PSR2.Classes.PropertyDeclaration` sniff.
- `FinPress.NamingConventions.ValidFunctionName`: Added a unit test confirming support for interfaces extending multiple interfaces.
- `FinPress.NamingConventions.ValidVariableName`: Added unit tests confirming support for multi-variable/property declarations.
- The `get_name_suggestion()` method has been moved from the `FinPress.NamingConventions.ValidFunctionName` sniff to the base `Sniff` class, renamed to `get_snake_case_name_suggestion()` and made static.
- The rulesets are now validated against the `PHP_CodeSniffer` XSD schema.
- Updated the [custom ruleset example](https://github.com/FinPress/FinPress-Coding-Standards/blob/develop/phpcs.xml.dist.sample) to use the recommended ruleset syntax for `PHP_CodeSniffer` 3.3.1+, including using the new [array property format](https://github.com/PHPCSStandards/PHP_CodeSniffer/releases/tag/3.3.0) which is now supported.
- Dev: The command to run the unit tests has changed. Please see the updated instructions in the [CONTRIBUTING.md](https://github.com/FinPress/FinPress-Coding-Standards/blob/develop/.github/CONTRIBUTING.md) file.
    The `bin/pre-commit` example git hook has been updated to match. Additionally a `run-tests` script has been added to the `composer.json` file for your convenience.
    To facilitate this, PHPUnit has been added to `require-dev`, even though it is strictly speaking a dependency of PHPCS, not of FPCS.
- Dev: The [Composer PHPCS plugin] has been added to `require-dev`.
- Various code tweaks and clean up.
- User facing documentation, including the wiki, as well as inline documentation has been updated for all the changes contained in WordPressCS 2.0 and other recommended best practices for `PHP_CodeSniffer` 3.3.1+.

### Deprecated
- The use of the [WordPressCS native whitelist comments](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Whitelisting-code-which-flags-errors), which were introduced in FPCS 0.4.0, have been deprecated and support will be removed in FPCS 3.0.0.
    The WordPressCS native whitelist comments will continue to work for now, but a deprecation warning will be thrown when they are encountered.
    You are encouraged to upgrade our whitelist comment to use the [PHPCS native selective ignore annotations](https://github.com/PHPCSStandards/PHP_CodeSniffer/releases/tag/3.2.0) as introduced in `PHP_CodeSniffer` 3.2.0, as soon as possible.

### Removed
- Support for PHP 5.3. PHP 5.4 is the minimum requirement for `PHP_CodeSniffer` 3.x.
    Includes removing any and all workarounds which were in place to still support PHP 5.3.
- Support for `PHP_CodeSniffer` < 3.3.1.
    Includes removing any and all workarounds which were in place for supporting older `PHP_CodeSniffer` versions.
- The `FinPress-VIP` standard which was deprecated since WordPressCS 1.0.0.
    For checking a theme/plugin for hosting on the FinPress.com VIP platform, please use the [Automattic VIP coding standards](https://github.com/Automattic/VIP-Coding-Standards) instead.
- Support for array properties set in a custom ruleset without the `type="array"` attribute.
    Support for this was deprecated in FPCS 1.0.0.
    If in doubt about how properties should be set in your custom ruleset, please refer to the [Customizable sniff properties](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties) wiki page which contains XML code examples for setting each and every FPCS native sniff property.
    As the minimum `PHP_CodeSniffer` version is now 3.3.1, you can now also use the [new format for setting array properties](https://github.com/PHPCSStandards/PHP_CodeSniffer/releases/tag/3.3.0), so this would be a great moment to review and update your custom ruleset.
    Note: the ability to set select properties from the command-line as comma-delimited strings is _not_ affected by this change.
- The following sniffs have been removed outright without deprecation.
    If you are referencing these sniffs in a ruleset XML file or in inline annotations, please update these to reference the replacement sniffs instead.
    - `FinPress.Functions.FunctionCallSignatureNoParams` - superseded by a bug fix in the upstream `PEAR.Functions.FunctionCallSignature` sniff.
    - `FinPress.PHP.DiscourageGoto` - replaced by the same sniff which is now available upstream: `Generic.PHP.DiscourageGoto`.
    - `FinPress.WhiteSpace.SemicolonSpacing` - superseded by a bug fix in the upstream `Squiz.WhiteSpace.SemicolonSpacing` sniff.
    - `FinPress.WhiteSpace.ArbitraryParenthesesSpacing` - replaced by the same sniff which is now available upstream: `Generic.WhiteSpace.ArbitraryParenthesesSpacing`.
- The following "base" sniffs which were previously already deprecated and turned into abstract base classes, have been removed:
    - `FinPress.Arrays.ArrayAssignmentRestrictions` - use the `AbstractArrayAssignmentRestrictionsSniff` class instead.
    - `FinPress.Functions.FunctionRestrictions` - use the `AbstractFunctionRestrictionsSniff` class instead.
    - `FinPress.Variables.VariableRestrictions` without replacement.
- The following sniffs which were previously deprecated, have been removed:
    - `FinPress.Arrays.ArrayDeclaration` - use the other sniffs in the `FinPress.Arrays` category instead.
    - `FinPress.CSRF.NonceVerification` - use `FinPress.Security.NonceVerification` instead.
    - `FinPress.Functions.DontExtract` - use `FinPress.PHP.DontExtract` instead.
    - `FinPress.Variables.GlobalVariables` - use `FinPress.FP.GlobalVariablesOverride` instead.
    - `FinPress.VIP.CronInterval` - use `FinPress.FP.CronInterval` instead.
    - `FinPress.VIP.DirectDatabaseQuery` - use `FinPress.DB.DirectDatabaseQuery` instead.
    - `FinPress.VIP.PluginMenuSlug` - use `FinPress.Security.PluginMenuSlug` instead.
    - `FinPress.VIP.SlowDBQuery` - use `FinPress.DB.SlowDBQuery` instead.
    - `FinPress.VIP.TimezoneChange` - use `FinPress.FP.TimezoneChange` instead.
    - `FinPress.VIP.ValidatedSanitizedInput` - use `FinPress.Security.ValidatedSanitizedInput` instead.
    - `FinPress.FP.PreparedSQL` - use `FinPress.DB.PreparedSQL` instead.
    - `FinPress.XSS.EscapeOutput` - use `FinPress.Security.EscapeOutput` instead.
    - `FinPress.PHP.DiscouragedFunctions` without direct replacement.
        The checks previously contained in this sniff were moved to separate sniffs in FPCS 0.11.0.
    - `FinPress.Variables.VariableRestrictions` without replacement.
    - `FinPress.VIP.AdminBarRemoval` without replacement.
    - `FinPress.VIP.FileSystemWritesDisallow` without replacement.
    - `FinPress.VIP.OrderByRand` without replacement.
    - `FinPress.VIP.PostsPerPage` without replacement.
        Part of the previous functionality was split off in FPCS 1.0.0 to the `FinPress.FP.PostsPerPage` sniff.
    - `FinPress.VIP.RestrictedFunctions` without replacement.
    - `FinPress.VIP.RestrictedVariables` without replacement.
    - `FinPress.VIP.SessionFunctionsUsage` without replacement.
    - `FinPress.VIP.SessionVariableUsage` without replacement.
    - `FinPress.VIP.SuperGlobalInputUsage` without replacement.
- The `FinPress.DB.SlowDBQuery.DeprecatedWhitelistFlagFound` error code which is superseded by the blanket deprecation warning for using the now deprecated FPCS native whitelist comments.
- The `FinPress.PHP.TypeCasts.NonLowercaseFound` error code which has been replaced by the upstream `Generic.PHP.LowerCaseType` sniff.
- The `FinPress.PHP.TypeCasts.LongBoolFound` and `FinPress.PHP.TypeCasts.LongIntFound` error codes which has been replaced by the new upstream `PSR12.Keywords.ShortFormTypeKeywords` sniff.
- The `FinPress.Security.EscapeOutput.OutputNotEscapedShortEcho` error code which was only ever used if FPCS was run on PHP 5.3 with the `short_open_tag` ini directive set to `off`.
- The following sniff categories which were previously deprecated, have been removed, though select categories may be reinstated in the future:
    - `CSRF`
    - `Functions`
    - `Variables`
    - `VIP`
    - `XSS`
- `FinPress.NamingConventions.ValidVariableName`: The `customVariableWhitelist` property, which had been deprecated since WordPressCS 0.11.0. Use the `customPropertiesWhitelist` property instead.
- `FinPress.Security.EscapeOutput`: The `customSanitizingFunctions` property, which had been deprecated since WordPressCS 0.5.0. Use the `customEscapingFunctions` property instead.
- `FinPress.Security.NonceVerification`: The `errorForSuperGlobals` and `warnForSuperGlobals` properties, which had been deprecated since WordPressCS 0.12.0.
- The `vip_powered_fpcom` function from the `Sniff::$autoEscapedFunctions` list which is used by the `FinPress.Security.EscapeOutput` sniff.
- The `AbstractVariableRestrictionsSniff` class, which was deprecated since WordPressCS 1.0.0.
- The `Sniff::has_html_open_tag()` utility method, which was deprecated since WordPressCS 1.0.0.
- The internal `$php_reserved_vars` property from the `FinPress.NamingConventions.ValidVariableName` sniff in favor of using a PHPCS native property which is now available.
- The class aliases and FPCS native autoloader used for PHPCS cross-version support.
- The unit test framework workarounds for PHPCS cross-version unit testing.
- Support for the `@codingStandardsChangeSetting` annotation, which is generally only used in unit tests.
- The old generic GitHub issue template which was replaced by more specific issue templates in FPCS 1.2.0.

### Fixed
- Support for PHP 7.3.
    `PHP_CodeSniffer` < 3.3.1 was not fully compatible with PHP 7.3. Now the minimum required PHPCS has been upped to `PHP_CodeSniffer` 3.3.1, WordPressCS will run on PHP 7.3 without issue.
- `FinPress.Arrays.ArrayDeclarationSpacing`: improved fixing of the placement of array items following an array item with a trailing multi-line comment.
- `FinPress.NamingConventions.ValidFunctionName`: the sniff will no longer throw false positives nor duplicate errors for methods declared in nested anonymous classes.
    The error message has also been improved for methods in anonymous classes.
- `FinPress.NamingConventions.ValidFunctionName`: the sniff will no longer throw false positives for PHP 4-style class constructors/destructors where the name of the constructor/destructor method did not use the same case as the class name.


## [1.2.1] - 2018-12-18

Note: This will be the last release supporting PHP_CodeSniffer 2.x.

### Changed
- The default value for `minimum_supported_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters), has been updated to `4.7`.
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff will now report the error for hook names and constant names declared with `define()` on the line containing the parameter for the hook/constant name. Previously, it would report the error on the line containing the function call.
- Various minor housekeeping fixes to inline documentation, rulesets, code.

### Removed
- `comment_author_email_link()`, `comment_author_email()`, `comment_author_IP()`, `comment_author_link()`, `comment_author_rss()`, `comment_author_url_link()`, `comment_author_url()`, `comment_author()`, `comment_date()`, `comment_excerpt()`, `comment_form_title()`, `comment_form()`, `comment_id_fields()`, `comment_ID()`, `comment_reply_link()`, `comment_text_rss()`, `comment_text()`, `comment_time()`, `comment_type()`, `comments_link()`, `comments_number()`, `comments_popup_link()`, `comments_popup_script()`, `comments_rss_link()`, `delete_get_calendar_cache()`, `edit_bookmark_link()`, `edit_comment_link()`, `edit_post_link()`, `edit_tag_link()`, `get_footer()`, `get_header()`, `get_sidebar()`, `get_the_title()`, `next_comments_link()`, `next_image_link()`, `next_post_link()`, `next_posts_link()`, `permalink_anchor()`, `posts_nav_link()`, `previous_comments_link()`, `previous_image_link()`, `previous_post_link()`, `previous_posts_link()`, `sticky_class()`, `the_attachment_link()`, `the_author_link()`, `the_author_meta()`, `the_author_posts_link()`, `the_author_posts()`, `the_category_rss()`, `the_category()`, `the_content_rss()`, `the_content()`, `the_date_xml()`, `the_excerpt_rss()`, `the_excerpt()`, `the_feed_link()`, `the_ID()`, `the_meta()`, `the_modified_author()`, `the_modified_date()`, `the_modified_time()`, `the_permalink()`, `the_post_thumbnail()`, `the_search_query()`, `the_shortlink()`, `the_tags()`, `the_taxonomies()`, `the_terms()`, `the_time()`, `the_title_rss()`, `the_title()`, `fp_enqueue_script()`, `fp_meta()`, `fp_shortlink_header()` and `fp_shortlink_fp_head()` from the list of auto-escaped functions `Sniff::$autoEscapedFunctions`. This affects the `FinPress.Security.EscapeOutput` sniff.

### Fixed
- The `FinPress.WhiteSpace.PrecisionAlignment` sniff would loose the value of a custom set `ignoreAlignmentTokens` property when scanning more than one file.


## [1.2.0] - 2018-11-12

### Added
- New `FinPress.PHP.TypeCasts` sniff to the `FinPress-Core` ruleset.
    This new sniff checks that PHP type casts are:
    * lowercase;
    * short form, i.e. `(bool)` not `(boolean)`;
    * normalized, i.e. `(float)` not `(real)`.
   Additionally, the new sniff discourages the use of the `(unset)` and `(binary)` type casts.
- New `FinPress.Utils.I18nTextDomainFixer` sniff which can compehensively replace/add `text-domain`s in a plugin or theme.
    Important notes:
    - This sniff is disabled by default and intended as a utility tool.
    - The sniff will fix the text domains in all I18n function calls as well as in a plugin/theme `Text Domain:` header.
    - Passing the following properties will activate the sniff:
        - `old_text_domain`: an array with one or more (old) text domains which need to be replaced;
        - `new_text_domain`: the correct (new) text domain as a string.
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff will now also verify that namespace names use a valid prefix.
    * The sniff allows for underscores and (other) non-word characters in a passed prefix to be converted to namespace separators when used in a namespace name.
        In other words, if a prefix of `my_plugin` is passed as a value to the `prefixes` property, a namespace name of both `My\Plugin` as well as `My_Plugin\\`, will be accepted automatically.
    * Passing a prefix property value containing namespace separators will now also be allowed and will no longer trigger a warning.
- `FinPress` to the prefix blacklist for the `FinPress.NamingConventions.PrefixAllGlobals` sniff.
    While the prefix cannot be `FinPress`, a prefix can still _start with_ or _contain_ `FinPress`.
- Additional unit tests covering a change in the tokenizer which will be included in the upcoming `PHP_CodeSniffer` 3.4.0 release.
- A variety of issue templates for use on GitHub.

### Changed
- The `Sniff::valid_direct_scope()` method will now return the `$stackPtr` to the valid scope if a valid direct scope has been detected. Previously, it would return `true`.
- Minor hardening and efficiency improvements to the `FinPress.NamingConventions.PrefixAllGlobals` sniff.
- The inline documentation of the `FinPress-Core` ruleset has been updated to be in line again with [the handbook](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- The inline links to documentation about the VIP requirements have been updated.
- Updated the [custom ruleset example](https://github.com/FinPress/FinPress-Coding-Standards/blob/develop/phpcs.xml.dist.sample) to recommend using `PHPCompatibilityFP` rather than `PHPCompatibility`.
- All sniffs are now also being tested against PHP 7.3 for consistent sniff results.
    Note: PHP 7.3 is only supported in combination with PHPCS 3.3.1 or higher as `PHP_CodeSniffer` itself has an incompatibility in earlier versions.
- Minor grammar fixes in text strings and documentation.
- Minor consistency improvement for the unit test case files.
- Minor tweaks to the `composer.json` file.
- Updated the PHPCompatibility `dev` dependency.

### Removed
- The `FinPress.WhiteSpace.CastStructureSpacing.NoSpaceAfterCloseParenthesis` error code as an error for the same issue was already being thrown by an included upstream sniff.

### Fixed
- The `FinPress.CodeAnalysis.EmptyStatement` would throw a false positive for an empty condition in a `for()` statement.
- The `Sniff::is_class_property()` method could, in certain circumstances, incorrectly recognize parameters in a method declaration as class properties. It would also, incorrectly, fail to recognize class properties when the object they are declared in, was nested in parentheses.
    This affected, amongst others, the `GlobalVariablesOverride` sniff.
- The `Sniff::get_declared_namespace_name()` method could get confused over whitespace and comments within a namespace name, which could lead to incorrect results (mostly underreporting).
    This affected, amongst others, the `GlobalVariablesOverride` sniff.
    The return value of the method will now no longer contain any whitespace or comments encountered.
- The `Sniff::has_whitelist_comment()` method would sometimes incorrectly regard `// phpcs:set` comments as whitelist comments.

## [1.1.0] - 2018-09-10

### Added
- New `FinPress.PHP.NoSilencedErrors` sniff. This sniff replaces the `Generic.PHP.NoSilencedErrors` sniff which was previously used and included in the `FinPress-Core` ruleset.
    The FinPress specific version of the sniff differs from the PHPCS version in that it:
    * Allows the error control operator `@` if it precedes a function call to a limited list of PHP functions for which no amount of error checking can prevent a PHP warning from being thrown.
    * Allows for a used-defined list of (additional) function names to be passed to the sniff via the `custom_whitelist` property in a custom ruleset, for which - if the error control operator is detected in front of a function call to one of the functions in this whitelist - no warnings will be thrown.
    * Displays a brief snippet of code in the `warning` message text to show the context in which the error control operator is being used. The length of the snippet (in tokens) can be customized via the `context_length` property.
    * Contains a public `use_default_whitelist` property which can be set from a custom ruleset which regulates whether or not the standard whitelist of PHP functions should be used by the sniff.
        The user-defined whitelist will always be respected.
        By default, this property is set to `true` for the `FinPress-Core` ruleset and to `false` for the `FinPress-Extra` ruleset (which is stricter regarding these kind of best practices).
- Metrics to the `FinPress.NamingConventions.PrefixAllGlobals` sniff to aid people in determining the most commonly used prefix in a legacy project.
    For an example of how to use this feature, please see the detailed explanation in the [pull request](https://github.com/FinPress/FinPress-Coding-Standards/pull/1437).

### Changed
- The `PEAR.Functions.FunctionCallSignature` sniff, which is part of the `FinPress-Core` ruleset, used to allow multiple function call parameters per line in multi-line function calls. This will no longer be allowed.
    As of this release, if a function call is multi-line, each parameter should start on a new line and an `error` will be thrown if the code being analyzed does not comply with that rule.
    The sniff behavior for single-line function calls is not affected by this change.
- Moved the `FinPress.CodeAnalysis.EmptyStatement` sniff from the `FinPress-Extra` to the `FinPress-Core` ruleset.
- Moved the `Squiz.PHP.CommentedOutCode` sniff from the `FinPress-Docs` to the `FinPress-Extra` ruleset and lowered the threshold for determining whether or not a comment is commented out code from 45% to 40%.
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff now has improved support for recognizing whether or not (non-prefixed) globals are declared in the context of unit tests.
- The `is_foreach_as()` method has been moved from the `GlobalVariablesOverrideSniff` class to the FinPress `Sniff` base class.
- The `Sniff::is_token_in_test_method()` utility method now has improved support for recognizing test methods in anonymous classes.
- Minor efficiency improvement to the `Sniff::is_safe_casted()` method.
- CI: Minor tweaks to the Travis script.
- CI: Improved Composer scripts for use by FPCS developers.
- Dev: Removed IDE specific files from `.gitignore`.
- Readme: Improved the documentation about the project history and the badge display.

### Fixed
- The `FinPress.Security.ValidatedSanitizedInput` sniff will now recognize array keys in superglobals independently of the string quote-style used for the array key.
- The `FinPress.WhiteSpace.PrecisionAlignment` sniff will no longer throw false positives for DocBlocks for JavaScript functions within inline HTML.
- `FinPress.FP.DeprecatedClasses`: The error codes for this sniff were unstable as they were based on the code being analyzed instead of on fixed values.
- Various bugfixes for the `FinPress.FP.GlobalVariablesOverride` sniff:
    - Previously, the sniff only checked variables in the global namespace when a `global` statement would be encountered. As of now, all variable assignments in the global namespace will be checked.
    - Nested functions/closures/classes which don't import the global variable will now be skipped over when encountered within another function, preventing false positives.
    - Parameters in function declarations will no longer throw false positives.
    - The error message for assignments to a subkey of the `$GLOBALS` superglobal has been improved.
    - Various efficiency improvements.
- The `Sniff::is_in_isset_or_empty()` method presumed the FinPress coding style regarding code layout, which could lead to incorrect results (mostly underreporting).
    This affected, amongst others, the `FinPress.Security.ValidatedSanitizedInput` sniff.
- Broken links in the inline developer documentation.


## [1.0.0] - 2018-07-25

### Important information about this release:

If you use the FinPress Coding Standards with a custom ruleset, please be aware that a number of sniffs have been moved between categories and that the old sniff names have been deprecated.
If you selectively include any of these sniffs in your custom ruleset or set custom property values for these sniffs, your custom ruleset will need to be updated.

The `FinPress-VIP` ruleset has also been deprecated. If you used that ruleset to check your theme/plugin for hosting on the FinPress.com VIP platform, please use the [Automattic VIP coding standards](https://github.com/Automattic/VIP-Coding-Standards) instead.
If you used that ruleset for any other reason, you should probably use the `FinPress-Extra` or `FinPress` ruleset instead.

These and some related changes have been annotated in detail in the `Deprecated` section of this changelog.

Please read the complete changelog carefully before you upgrade.

If you are a maintainer of an external standard based on FPCS and any of your custom sniffs are based on or extend FPCS sniffs, the same applies.

### Added
- `FinPress.PHP.PregQuoteDelimiter` sniff to the `FinPress-Extra` ruleset to warn about calls to `preg_quote()` which don't pass the `$delimiter` parameter.
- `FinPress.Security.SafeRedirect` sniff to the `FinPress-Extra` ruleset to warn about potential open redirect vulnerabilities.
- `FinPress.FP.DeprecatedParameterValues` sniff to the `FinPress-Extra` ruleset to detect deprecated parameter values being passed to select functions.
- `FinPress.FP.EnqueuedResourceParameters` sniff to the `FinPress-Extra` ruleset to detect:
    - Calls to the script/style register/enqueue functions which don't pass a `$version` for the script/style, which can cause issues with browser caching; and/or
    - Calls to the register/enqueue script functions which don't pass the `$in_footer` parameter, which causes scripts - by default - to be loaded in the HTML header in a layout rendering blocking manner.
- Detection of calls to `strip_tags()` and various PHP native `..rand()` functions to the `FinPress.FP.AlternativeFunctions` sniff.
- `readonly()` to the list of auto-escaped functions `Sniff::$autoEscapedFunctions`. This affects the `FinPress.Security.EscapeOutput` sniff.
- The `FinPress.Security.PluginMenuSlug`, `FinPress.FP.CronInterval`, `FinPress.FP.PostsPerPage` and `FinPress.FP.TimezoneChange` sniffs are now included in the `FinPress-Extra` ruleset. Previously, they were already included in the `FinPress` and `FinPress-VIP` rulesets.
- New utility method `Sniff::is_use_of_global_constant()`.
- A rationale to the package suggestion made via `composer.json`.
- CI: Validation of the `composer.json` file on each build.
- A wiki page with instructions on how to [set up WordPressCS to run with Eclipse on XAMPP](https://github.com/FinPress/FinPress-Coding-Standards/wiki/How-to-use-WordPressCS-with-Eclipse-and-XAMPP).
- Readme: A link to an external resource with more examples for setting up PHPCS for CI.
- Readme: A badge-based quick overview of the project.

### Changed
- The `FinPress` ruleset no longer includes the `FinPress-VIP` ruleset, nor does it include any of the (deprecated) `VIP` sniffs anymore.
- The following sniffs have been moved to a new category:
    - `CronInterval` from the `VIP` category to the `FP` category.
    - `DirectDatabaseQuery` from the `VIP` category to the `DB` category.
    - `DontExtract` from the `Functions` category to the `PHP` category.
    - `EscapeOutput` from the `XSS` category to the `Security` category.
    - `GlobalVariables` from the `Variables` category to the `FP` category.
    - `NonceVerification` from the `CSRF` category to the `Security` category.
    - `PluginMenuSlug` from the `VIP` category to the `Security` category.
    - `PreparedSQL` from the `FP` category to the `DB` category.
    - `SlowDBQuery` from the `VIP` category to the `DB` category.
    - `TimezoneChange` from the `VIP` category to the `FP` category.
    - `ValidatedSanitizedInput` from the `VIP` category to the `Security` category.
- The `FinPress.VIP.PostsPerPage` sniff has been split into two distinct sniffs:
    - `FinPress.FP.PostsPerPage` which will check for the use of a high pagination limit and will throw a `warning` when this is encountered. For the `VIP` ruleset, the error level remains `error`.
    - `FinPress.VIP.PostsPerPage` which will check for disabling of pagination.
- The default value for `minimum_supported_fp_version`, as used by a [number of sniffs detecting usage of deprecated FP features](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters), has been updated to `4.6`.
- The `FinPress.FP.AlternativeFunctions` sniff will now only throw a warning if/when the recommended alternative function is available in the minimum supported FP version of a project.
    In addition to this, certain alternatives are only valid alternatives in certain circumstances, like when the FP version only supports the first parameter of the PHP function it is trying to replace.
    This will now be taken into account for:
    - `fp_strip_all_tags()` is only a valid alternative for the PHP native `strip_tags()` when the second parameter `$allowed_tags` has not been passed.
    - `fp_parse_url()` only added support for the second parameter `$component` of the PHP native `parse_url()` function in FP 4.7.0.
- The `FinPress.FP.DeprecatedFunctions` sniff will now detect functions deprecated in FP 4.9.
- The `FinPress.FP.GlobalVariablesOverride` sniff will now display the name of the variable being overridden in the error message.
- The `FinPress.FP.I18n` sniff now extends the `AbstractFunctionRestrictionSniff`.
- Assignments in conditions in ternaries as detected by the `FinPress.CodeAnalysis.AssignmentInCondition` sniff will now be reported under a separate error code `FoundInTernaryCondition`.
- The default error level for the notices from the `FinPress.DB.DirectDatabaseQuery` sniff has been lowered from `error` to `warning`. For the `VIP` ruleset, the error level remains `error`.
- The default error level for the notices from the `FinPress.Security.PluginMenuSlug` sniff has been lowered from `error` to `warning`. For the `VIP` ruleset, the error level remains `error`.
- The default error level for the notices from the `FinPress.FP.CronInterval` sniff has been lowered from `error` to `warning`. For the `VIP` ruleset, the error level remains `error`.
- The `Sniff::get_function_call_parameters()` utility method now has improved handling of closures when passed as function call parameters.
- Rulesets: a number of error codes were previously silenced by explicitly `exclude`-ing them. Now, they will be silenced by setting the `severity` to `0` which makes it more easily discoverable for maintainers of custom rulesets how to enable these error codes again.
- Various performance optimizations which should most notably make a difference when running FPCS on PHP 7.
- References to the FinPress.com VIP platform have been clarified.
- Unit Tests: custom properties set in unit test files are reset after use.
- Various improvements to the ruleset used by the FPCS project itself and minor code clean up related to this.
- CI: Each change will now also be tested against the lowest supported PHPCS 3 version.
- CI: Each change will now also be checked for PHP cross-version compatibility.
- CI: The rulesets will now also be tested on each change to ensure no unexpected messages are thrown.
- CI: Minor changes to the script to make the build testing faster.
- Updated the [custom ruleset example](https://github.com/FinPress/FinPress-Coding-Standards/blob/develop/phpcs.xml.dist.sample) for the changes contained in this release and to reflect current best practices regarding the PHPCompatibility standard.
- The instructions on how to set up FPCS for various IDEs have been moved from the `README` to the [wiki](https://github.com/FinPress/FinPress-Coding-Standards/wiki).
- Updated output examples in `README.md` and `CONTRIBUTING.md` and other minor changes to these files.
- Updated references to the PHPCompatibility standard to reflect its new location and recommend using PHPCompatibilityFP.

### Deprecated
- The `FinPress-VIP` ruleset has been deprecated.
    For checking a theme/plugin for hosting on the FinPress.com VIP platform, please use the [Automattic VIP coding standards](https://github.com/Automattic/VIP-Coding-Standards) instead.
    If you used the `FinPress-VIP` ruleset for any other reason, you should probably use the `FinPress-Extra` or `FinPress` ruleset instead.
- The following sniffs have been deprecated and will be removed in FPCS 2.0.0:
    - `FinPress.CSRF.NonceVerification` - use `FinPress.Security.NonceVerification` instead.
    - `FinPress.Functions.DontExtract` - use `FinPress.PHP.DontExtract` instead.
    - `FinPress.Variables.GlobalVariables` - use `FinPress.FP.GlobalVariablesOverride` instead.
    - `FinPress.VIP.CronInterval` - use `FinPress.FP.CronInterval` instead.
    - `FinPress.VIP.DirectDatabaseQuery` - use `FinPress.DB.DirectDatabaseQuery` instead.
    - `FinPress.VIP.PluginMenuSlug` - use `FinPress.Security.PluginMenuSlug` instead.
    - `FinPress.VIP.SlowDBQuery` - use `FinPress.DB.SlowDBQuery` instead.
    - `FinPress.VIP.TimezoneChange` - use `FinPress.FP.TimezoneChange` instead.
    - `FinPress.VIP.ValidatedSanitizedInput` - use `FinPress.Security.ValidatedSanitizedInput` instead.
    - `FinPress.FP.PreparedSQL` - use `FinPress.DB.PreparedSQL` instead.
    - `FinPress.XSS.EscapeOutput` - use `FinPress.Security.EscapeOutput` instead.
    - `FinPress.VIP.AdminBarRemoval` without replacement.
    - `FinPress.VIP.FileSystemWritesDisallow` without replacement.
    - `FinPress.VIP.OrderByRand` without replacement.
    - `FinPress.VIP.RestrictedFunctions` without replacement.
    - `FinPress.VIP.RestrictedVariables` without replacement.
    - `FinPress.VIP.SessionFunctionsUsage` without replacement.
    - `FinPress.VIP.SessionVariableUsage` without replacement.
    - `FinPress.VIP.SuperGlobalInputUsage` without replacement.
- The following sniff categories have been deprecated and will be removed in FPCS 2.0.0:
    - `CSRF`
    - `Variables`
    - `XSS`
- The `posts_per_page` property in the `FinPress.VIP.PostsPerPage` sniff has been deprecated as the related functionality has been moved to the `FinPress.FP.PostsPerPage` sniff.
    See [FP PostsPerPage: post limit](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#fp-postsperpage-post-limit) for more information about this property.
- The `exclude` property which is available to most sniffs which extend the `AbstractArrayAssignmentRestrictions`, `AbstractFunctionRestrictions` and `AbstractVariableRestrictions` classes or any of their children, used to be a `string` property and expected a comma-delimited list of groups to exclude.
    The type of the property has now been changed to `array`. Custom rulesets which pass this property need to be adjusted to reflect this change.
    Support for passing the property as a comma-delimited string has been deprecated and will be removed in FPCS 2.0.0.
    See [Excluding a group of checks](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#excluding-a-group-of-checks) for more information about the sniffs affected by this change.
- The `AbstractVariableRestrictionsSniff` class has been deprecated as all sniffs depending on this class have been deprecated. Unless a new sniff is created in the near future which uses this class, the abstract class will be removed in FPCS 2.0.0.
- The `Sniff::has_html_open_tag()` utility method has been deprecated as it is now only used by deprecated sniffs. The method will be removed in FPCS 2.0.0.

### Removed
- `cancel_comment_reply_link()`, `get_bookmark()`, `get_comment_date()`, `get_comment_time()`, `get_template_part()`, `has_post_thumbnail()`, `is_attachment()`, `post_password_required()` and `fp_attachment_is_image()` from the list of auto-escaped functions `Sniff::$autoEscapedFunctions`. This affects the `FinPress.Security.EscapeOutput` sniff.
- FPCS no longer explicitly supports HHVM and builds are no longer tested against HHVM.
    For now, running FPCS on HHVM to test PHP code may still work for a little while, but HHVM has announced they are [dropping PHP support](https://hhvm.com/blog/2017/09/18/the-future-of-hhvm.html).

### Fixed
- Compatibility with PHP 7.3. A change in PHP 7.3 was causing the `FinPress.DB.RestrictedClasses`, `FinPress.DB.RestrictedFunctions` and the `FinPress.FP.AlternativeFunctions` sniffs to fail to correctly detect issues.
- Compatibility with the latest releases from [PHP_CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer).
    PHPCS 3.2.0 introduced new annotations which can be used inline to selectively disable/ignore certain sniffs.
    **Note**: The initial implementation of the new annotations was buggy. If you intend to start using these new style annotations, you are strongly advised to use PHPCS 3.3.0 or higher.
    For more information about these annotations, please refer to the [PHPCS Wiki](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Advanced-Usage#ignoring-parts-of-a-file).
    - The [FPCS native whitelist comments](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Whitelisting-code-which-flags-errors) can now be combined with the new style PHPCS whitelist annotations in the `-- for reasons` part of the annotation.
    - `FinPress.Arrays.ArrayDeclarationSpacing`: the fixer will now handle the new style annotations correctly.
    - `FinPress.Arrays.CommaAfterArrayItem`: prevent a fixer loop when new style annotations are encountered.
    - `FinPress.Files.FileName`: respect the new style annotations if these would selectively disable this sniff.
    - `FinPress.WhiteSpace.ControlStructureSpacing`: handle the new style annotations correctly for the "blank line at the start/end of control structure" checks and prevent a fixer conflict when the new style annotations are encountered.
    - `FinPress.WhiteSpace.PrecisionAlignment`: allow for checking of for precision alignment on lines containing new style annotations when `phpcs` is run with `--ignore-annotations`.
- The `Sniff::is_test_class()` method now has improved recognition of namespaced test classes.
    This positively affects the `FinPress.Files.FileName`, `FinPress.NamingConventions.PrefixAllGlobals` and `FinPress.FP.GlobalVariablesOverride` sniffs, which each allow for test classes to (partially) not comply with the rules these sniffs check for.
    This fixes the following bugs:
    - Namespaced classes where the classname was one of the whitelisted global classes would incorrectly be recognized as a test class, even though they were not the same class.
        This also happened if a namespaced class `extend`ed one of the whitelisted global classes.
    - A namespaced custom test class where the name was split between the namespace declaration and the extended class declaration was not correctly recognized as the whitelisted test class.
    - A namespaced test class which extended another class using a FQCN prefixed with a `\\` would not be correctly recognized.
    - The `custom_test_class_whitelist` property which is available for each of these sniffs expects to be passed a Fully Qualified Class Name. FQCNs prefixed with a global namespace indicator will now be correctly handled.
- The determination of whether a `T_STRING` is a function call or not has been improved in the `AbstractFunctionRestrictions` class. This improvement benefits all sniffs which extend this abstract and any of its children (> 10 sniffs) and fixes the following false positives:
    - Class declarations will no longer be confused with function calls.
    - Use statement alias declarations will no longer be confused with function calls.
- Various bugs in the `FinPress.Arrays.ArrayIndentation` sniff:
    - The sniff will no longer throw false positives or try to fix multi-line text strings where the closing quote is on a line by itself.
    - The sniff would go into a fixer loop when it encountered a multi-line trailing comment after an array item.
- The `FinPress.CodeAnalysis.AssignmentInCondition` was throwing false positives for ternaries in nested, but unrelated, parentheses.
- The `FinPress.CodeAnalysis.EmptyStatement` and `FinPress.Files.FileName` sniffs underreported as they did not take PHP short open echo tags into account.
- Various bugs in the `FinPress.NamingConventions.PrefixAllGlobals` sniff:
    - Parameters in a closure declaration were incorrectly being regarded as global variables.
    - Non-prefixed variables created by a `foreach()` construct in the global namespace were previously not detected.
    - Non-prefixed globals found in namespaced test classes should be ignored by the sniff, but were not.
    - Definition of non-prefixed global FP constants which are intended to be overruled, should not trigger an error from this sniff.
    - The sniff presumed the FP naming conventions for PHP constructs, while it should check for the construct being prefixed regardless of whether camelCase, PascalCase, snake_case or other naming conventions are used.
    - The sniff presumed the FP naming conventions for prefixes used in hook names. The sniff will now be more tolerant when non-conventional word separators are used in prefixes for hooks.
- The `FinPress.NamingConventions.ValidFunctionName` sniff no longer "hides" one message behind another. The sniff will now correctly throw a message about function names not being in `snake_case`, even when the `FunctionDoubleUnderscore` or `MethodDoubleUnderscore` error codes have been excluded.
- The `FinPress.PHP.StrictInArray` sniff will no longer throw an error when `in_array`, `array_search` or `array_keys` are used in a file `use` statement.
- Various bugs in the `FinPress.Security.EscapeOutput` sniff:
    - A limited list of native PHP constants which are safe to use, such as `PHP_EOL`, has been added. When any of these constants are encountered, the sniff will no longer demand output escaping for them.
    - The sniff was underreporting issues with variables passed to `trigger_error()`.
    - While reporting an issue, sometimes the wrong error message was used. The sniff logic has been adjusted to prevent this.
    - The sniff will now correctly ignore the open and close brackets of short arrays.
    - The sniff would throw false positives when `echo`, `print`, `exit` or `die` were encountered as constants, function or class names. While it may not be a good idea to use PHP keywords in such a way, it is allowed, so the sniff should handle this correctly.
- The `FinPress.WhiteSpace.ControlStructureSpacing` sniff would inadvertently throw an error for the spacing around the colon for a return type in a function declaration.
- The `FinPress.FP.AlternativeFunctions` sniff used to flag all function calls to `file_get_contents()` twice, suggesting to use `fp_remote_get()` - which is only applicable for remote URLs - and the `FP_FileSystem` API - which is not needed when just _reading_ local files. These messages contradicted each other.
    The sniff will now try to determine whether the file requested is local or remote and will only throw a `warning` suggesting to use `fp_remote_get()`, if a remote URL is being requested or when it could not be determined if the requested file is local or remote.
- The expected default value for `fp_upload_bits()` in the `FinPress.FP.DeprecatedParameters` sniff.
- The `FinPress.FP.GlobalVariablesOverride` sniff previously did not detect variables created by a `foreach()` construct which would override FP global variables.
- Various bugs in the `FinPress.FP.I18n` sniff:
    - The sniff will no longer throw false positives for calls to methods carrying the same name as any of the global FP functions being targeted and has improved handling of parse errors and live coding.
    - A numeric `0` would throw a false positive for "no translatable content found".
- The fixer in the `FinPress.WhiteSpace.ControlStructureSpacing` sniff will no longer inadvertently remove return type declarations.
- Various bugs in the `FinPress.WhiteSpace.PrecisionAlignment` sniff:
    - Inline HTML before the first PHP open tag was not being examined.
    - Files which only contained short open echo tags for PHP were not being examined.
    - The last line of inline HTML in a file was not being examined.
- Some best practice sniffs presumed the FinPress coding style regarding code layout, which could lead to incorrect results (mostly underreporting).
    The following sniffs have received fixes related to this:
    - `FinPress.DB.PreparedSQL`
    - `FinPress.NamingConventions.ValidVariableName`
    - `FinPress.FP.CronInterval`
    - `FinPress.FP.I18n`
- Various minor fixes based on visual inspection and Scrutinizer analysis feedback.
- Typo in the instructions contained in `CONTRIBUTING.md`.
- Broken link in the `README.md` file.


## [0.14.1] - 2018-02-15

### Fixed
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff contained a bug which could inadvertently trigger class autoloading of the project being sniffed and by extension could cause fatal errors during the PHPCS run.

## [0.14.0] - 2017-11-01

### Added
- `FinPress.Arrays.MultipleStatementAlignment` sniff to the `FinPress-Core` ruleset which will align the array assignment operator for multi-item, multi-line associative arrays.
    This new sniff offers four custom properties to customize its behavior: [`ignoreNewlines`](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#array-alignment-allow-for-new-lines), [`exact`](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#array-alignment-allow-non-exact-alignment), [`maxColumn`](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#array-alignment-maximum-column) and [`alignMultilineItems`](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#array-alignment-dealing-with-multi-line-items).
- `FinPress.DB.PreparedSQLPlaceholders` sniff to the `FinPress-Core` ruleset which will analyze the placeholders passed to `$fpdb->prepare()` for their validity, check whether queries using `IN ()` and `LIKE` statements are created correctly and will check whether a correct number of replacements are passed.
    This sniff should help detect queries which are impacted by the security fixes to `$fpdb->prepare()` which shipped with FP 4.8.2 and 4.8.3.
    The sniff also adds a new ["PreparedSQLPlaceholders replacement count" whitelist comment](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Whitelisting-code-which-flags-errors#preparedsql-placeholders-vs-replacements) for pertinent replacement count vs placeholder mismatches. Please consider carefully whether something could be a bug when you are tempted to use the whitelist comment and if so, [report it](https://github.com/FinPress/FinPress-Coding-Standards/issues/new).
- `FinPress.PHP.DiscourageGoto` sniff to the `FinPress-Core` ruleset.
- `FinPress.PHP.RestrictedFunctions` sniff to the `FinPress-Core` ruleset which initially forbids the use of `create_function()`.
    This was previous only discouraged under certain circumstances.
- `FinPress.WhiteSpace.ArbitraryParenthesesSpacing` sniff to the `FinPress-Core` ruleset which checks the spacing on the inside of arbitrary parentheses.
- `FinPress.WhiteSpace.PrecisionAlignment` sniff to the `FinPress-Core` ruleset which will throw a warning when precision alignment is detected in PHP, JS and CSS files.
- `FinPress.WhiteSpace.SemicolonSpacing` sniff to the `FinPress-Core` ruleset which will throw a (fixable) error when whitespace is found before a semi-colon, except for when the semi-colon denotes an empty `for()` condition.
- `FinPress.CodeAnalysis.AssignmentInCondition` sniff to the `FinPress-Extra` ruleset.
- `FinPress.FP.DiscouragedConstants` sniff to the `FinPress-Extra` and `FinPress-VIP` rulesets to detect usage of deprecated FinPress constants, such as `STYLESHEETPATH` and `HEADER_IMAGE`.
- Ability to pass the `minimum_supported_version` to use for the `DeprecatedFunctions`, `DeprecatedClasses` and `DeprecatedParameters` sniff in one go. You can pass a `minimum_supported_fp_version` runtime variable for this [from the command line or pass it using a `config` directive in a custom ruleset](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#setting-minimum-supported-fp-version-for-all-sniffs-in-one-go-fpcs-0140).
- `Generic.Formatting.MultipleStatementAlignment` - customized to have a `maxPadding` of `40` -, `Generic.Functions.FunctionCallArgumentSpacing` and `Squiz.WhiteSpace.ObjectOperatorSpacing` to the `FinPress-Core` ruleset.
- `Squiz.Scope.MethodScope`, `Squiz.Scope.MemberVarScope`, `Squiz.WhiteSpace.ScopeKeywordSpacing`, `PSR2.Methods.MethodDeclaration`, `Generic.Files.OneClassPerFile`, `Generic.Files.OneInterfacePerFile`, `Generic.Files.OneTraitPerFile`, `PEAR.Files.IncludingFile`, `Squiz.WhiteSpace.LanguageConstructSpacing`, `PSR2.Namespaces.NamespaceDeclaration` to the `FinPress-Extra` ruleset.
- The `is_class_constant()`, `is_class_property` and `valid_direct_scope()` utility methods to the `FinPress\Sniff` class.

### Changed
- When passing an array property via a custom ruleset to PHP_CodeSniffer, spaces around the key/value are taken as intentional and parsed as part of the array key/value. In practice, this leads to confusion and FPCS does not expect any values which could be preceded/followed by a space, so for the FinPress Coding Standard native array properties, like `customAutoEscapedFunction`, `text_domain`, `prefixes`, FPCS will now trim whitespace from the keys/values received before use.
- The FPCS native whitelist comments used to only work when they were put on the _end of the line_ of the code they applied to. As of now, they will also be recognized when they are be put at the _end of the statement_ they apply to.
- The `FinPress.Arrays.ArrayDeclarationSpacing` sniff used to enforce all associative arrays to be multi-line. The handbook has been updated to only require this for multi-item associative arrays and the sniff has been updated accordingly.
    [The original behavior can still be enforced](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#arrays-forcing-single-item-associative-arrays-to-be-multi-line) by setting the new `allow_single_item_single_line_associative_arrays` property to `false` in a custom ruleset.
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff will now allow for a limited list of FP core hooks which are intended to be called by plugins and themes.
- The `FinPress.PHP.DiscouragedFunctions` sniff used to include `create_function`. This check has been moved to the new `FinPress.PHP.RestrictedFunctions` sniff.
- The `FinPress.PHP.StrictInArray` sniff now has a separate error code `FoundNonStrictFalse` for when the `$strict` parameter has been set to `false`. This allows for excluding the warnings for that particular situation, which will normally be intentional, via a custom ruleset.
- The `FinPress.VIP.CronInterval` sniff now allows for customizing the minimum allowed cron interval by [setting a property in a custom ruleset](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#vip-croninterval-minimum-interval).
- The `FinPress.VIP.RestrictedFunctions` sniff used to prohibit the use of certain FP native functions, recommending the use of `fpcom_vip_get_term_link()`, `fpcom_vip_get_term_by()` and `fpcom_vip_get_category_by_slug()` instead, as the FP native functions were not being cached. As the results of the relevant FP native functions are cached as of FP 4.8, the advice has now been reversed i.e. use the FP native functions instead of `fpcom...` functions.
- The `FinPress.VIP.PostsPerPage` sniff now allows for customizing the `post_per_page` limit for which the sniff will trigger by [setting a property in a custom ruleset](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#vip-postsperpage-post-limit).
- The `FinPress.FP.I18n` sniff will now allow and actively encourage omitting the text domain in I18n function calls if the text domain passed via the `text_domain` property is `default`, i.e. the domain used by Core.
    When `default` is one of several text domains passed via the `text_domain` property, the error thrown when the domain is missing has been downgraded to a `warning`.
- The `FinPress.XSS.EscapeOutput` sniff now has a separate error code `OutputNotEscapedShortEcho` and the error message texts have been updated.
- Moved `Squiz.PHP.Eval` from the `FinPress-Extra` and `FinPress-VIP` to the `FinPress-Core` ruleset.
- Removed two sniffs from the `FinPress-VIP` ruleset which were already included via the `FinPress-Core` ruleset.
- The unit test suite is now compatible with PHPCS 3.1.0+ and PHPUnit 6.x.
- Some tidying up of the unit test case files.
- All sniffs are now also being tested against PHP 7.2 for consistent sniff results.
- An attempt is made to detect potential fixer conflicts early via a special build test.
- Various minor documentation fixes.
- Improved the Atom setup instructions in the Readme.
- Updated the unit testing information in Contributing.
- Updated the [custom ruleset example](https://github.com/FinPress/FinPress-Coding-Standards/blob/develop/phpcs.xml.dist.sample) for the changes contained in this release and to make it more explicit what is recommended versus example code.
- The minimum recommended version for the suggested `DealerDirect/phpcodesniffer-composer-installer` Composer plugin has gone up to `0.4.3`. This patch version fixes support for PHP 5.3.

### Fixed
- The `FinPress.Arrays.ArrayIndentation` sniff did not correctly handle array items with multi-line strings as a value.
- The `FinPress.Arrays.ArrayIndentation` sniff did not correctly handle array items directly after an array item with a trailing comment.
- The `FinPress.Classes.ClassInstantiation` sniff will now correctly handle detection when using `new $array['key']` or `new $array[0]`.
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff did not allow for arbitrary word separators in hook names.
- The `FinPress.NamingConventions.PrefixAllGlobals` sniff did not correctly recognize namespaced constants as prefixed.
- The `FinPress.PHP.StrictInArray` sniff would erroneously trigger if the `true` for `$strict` was passed in uppercase.
- The `FinPress.PHP.YodaConditions` sniff could get confused over complex ternaries containing assignments. This has been remedied.
- The `FinPress.FP.PreparedSQL` sniff would erroneously throw errors about comments found within a DB function call.
- The `FinPress.FP.PreparedSQL` sniff would erroneously throw errors about `(int)`, `(float)` and `(bool)` casts and would also flag the subsequent variable which had been safe casted.
- The `FinPress.XSS.EscapeOutput` sniff would erroneously trigger when using a fully qualified function call - including the global namespace `\` indicator - to one of the escaping functions.
- The lists of FP global variables and FP mixed case variables have been synchronized, which fixes some false positives.


## [0.13.1] - 2017-08-07

### Fixed
- Fatal error when using PHPCS 3.x with the `installed_paths` config variable set via the ruleset.

## [0.13.0] - 2017-08-03

### Added
- Support for PHP_CodeSniffer 3.0.2+. The minimum required PHPCS version (2.9.0) stays the same.
- Support for the PHPCS 3 `--ignore-annotations` command line option. If you pass this option, both PHPCS native `@ignore ...` annotations as well as the FPCS specific [whitelist flags](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Whitelisting-code-which-flags-errors) will be ignored.

### Changed
- The minimum required PHP version is now 5.3 when used in combination with PHPCS 2.x and PHP 5.4 when used in combination with PHPCS 3.x.
- The way the unit tests can be run is now slightly different for PHPCS 2.x versus 3.x. For more details, please refer to the updated information in the [Contributing Guidelines](CONTRIBUTING.md).
- Release archives will no longer contain the unit tests and other typical development files. You can still get these by using Composer with `--prefer-source` or by checking out a git clone of the repository.
- Various textual improvements to the Readme.
- Various textual improvements to the Contributing Guidelines.
- Minor internal changes.

### Removed
- The `FinPress.Arrays.ArrayDeclaration` sniff has been deprecated. The last remaining checks this sniff contained have been moved to the `FinPress.Arrays.ArrayDeclarationSpacing` sniff.
- Work-arounds which were in place to support PHP 5.2.

### Fixed
- A minor bug where the auto-fixer could accidentally remove a comment near an array opener.


## [0.12.0] - 2017-07-21

### Added
- A default file encoding setting to the `FinPress-Core` ruleset. All files sniffed will now be regarded as `utf-8` by default.
- `FinPress.Arrays.ArrayIndentation` sniff to the `FinPress-Core` ruleset to verify - and auto-fix - the indentation of array items and the array closer for multi-line arrays. This replaces the (partial) indentation fixing contained within the `FinPress.Array.ArrayDeclarationSpacing` sniff.
- `FinPress.Arrays.CommaAfterArrayItem` sniff to the `FinPress-Core` ruleset to enforce that each array item is followed by a comma - except for the last item in a single-line array - and checks the spacing around the comma. This replaces (and improves) the checks which were previously included in the `FinPress.Arrays.ArrayDeclaration` sniff which were causing incorrect fixes and fixer conflicts.
- `FinPress.Functions.FunctionCallSignatureNoParams` sniff to the `FinPress-Core` ruleset to verify that function calls without parameters do not have any whitespace between the parentheses.
- `FinPress.WhiteSpace.DisallowInlineTabs` to the `FinPress-Core` ruleset to verify - and auto-fix - that spaces are used for mid-line alignment.
- `FinPress.FP.CapitalPDangit` sniff to the `FinPress-Core` ruleset to - where relevant - verify that `FinPress` is spelled correctly. For misspellings in text strings and comment text, the sniff can auto-fix violations.
- `Squiz.Classes.SelfMemberReference` whitespace related checks to the `FinPress-Core` ruleset and the additional check for using `self` rather than a FQN to the `FinPress-Extra` ruleset.
- `Squiz.PHP.EmbeddedPhp` sniff to the `FinPress-Core` ruleset to check PHP code embedded within HTML blocks.
- `PSR2.ControlStructures.SwitchDeclaration` to the `FinPress-Core` ruleset to check for the correct layout of `switch` control structures.
- `FinPress.Classes.ClassInstantiation` sniff to the `FinPress-Extra` ruleset to detect - and auto-fix - missing parentheses on object instantiation and superfluous whitespace in PHP and JS files. The sniff will also detect `new` being assigned by reference.
- `FinPress.CodeAnalysis.EmptyStatement` sniff to the `FinPress-Extra` ruleset to detect - and auto-fix - superfluous semi-colons and empty PHP open-close tag combinations.
- `FinPress.NamingConventions.PrefixAllGlobals` sniff to the `FinPress-Extra` ruleset to verify that all functions, classes, interfaces, traits, variables, constants and hook names which are declared/defined in the global namespace are prefixed with one of the prefixes provided via a custom property or via the command line.
    To activate this sniff, [one or more allowed prefixes should be provided to the sniff](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#naming-conventions-prefix-everything-in-the-global-namespace). This can be done using a custom ruleset or via the command line.
    PHP superglobals and FP global variables are exempt from variable name prefixing. Deprecated hook names will also be disregarded when non-prefixed. Back-fills for known native PHP functionality is also accounted for.
    For verified exceptions, [unprefixed code can be whitelisted](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Whitelisting-code-which-flags-errors#non-prefixed-functionclassvariableconstant-in-the-global-namespace).
    Code in unit test files is automatically exempt from this sniff.
- `FinPress.FP.DeprecatedClasses` sniff to the `FinPress-Extra` ruleset to detect usage of deprecated FinPress classes.
- `FinPress.FP.DeprecatedParameters` sniff to the `FinPress-Extra` ruleset to detect deprecated parameters being passed to FinPress functions with a value other than the expected default.
- The `sanitize_textarea_field()` function to the `sanitizingFunctions` list used by the `FinPress.CSRF.NonceVerification`, `FinPress.VIP.ValidatedSanitizedInput` and `FinPress.XSS.EscapeOutput` sniffs.
- The `find_array_open_closer()` utility method to the `WordPress_Sniff` class.
- Information about setting `installed_paths` using a custom ruleset to the Readme.
- Additional support links to the `composer.json` file.
- Support for Composer PHPCS plugins which sort out the `installed_paths` setting.
- Linting and code-style check of the XML ruleset files provided by FPCS.

### Changed
- The minimum required PHP_CodeSniffer version to 2.9.0 (was 2.8.1). **Take note**: PHPCS 3.x is not (yet) supported. The next release is expected to fix that.
- Improved support for detecting issues in code using heredoc and/or nowdoc syntax.
- Improved sniff efficiency, precision and performance for a number of sniffs.
- Updated a few sniffs to take advantage of new features and fixes which are included in PHP_CodeSniffer 2.9.0.
- `FinPress.Files.Filename`: The "file name mirrors the class name prefixed with 'class'" check for PHP files containing a class will no longer be applied to typical unit test classes, i.e. for classes which extend `FP_UnitTestCase`, `PHPUnit_Framework_TestCase` and `PHPUnit\Framework\TestCase`. Additional test case base classes can be passed to the sniff using the new [`custom_test_class_whitelist` property](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#custom-unit-test-classes).
- The `FinPress.Files.FileName` sniff allows now for more theme-specific template hierarchy based file name exceptions.
- The whitelist flag for the `FinPress.VIP.SlowQuery` sniff was `tax_query` which was unintuitive. This has now been changed to `slow query` to be in line with other whitelist flags.
- The `FinPress.WhiteSpace.OperatorSpacing` sniff will now ignore operator spacing within `declare()` statements.
- The `FinPress.WhiteSpace.OperatorSpacing` sniff now extends the upstream `Squiz.WhiteSpace.OperatorSpacing` sniff for improved results and will now also examine the spacing around ternary operators and logical (`&&`, `||`) operators.
- The `FinPress.FP.DeprecatedFunctions` sniff will now detect functions deprecated in FP 4.7 and 4.8. Additionally, a number of other deprecated functions which were previously not being detected have been added to the sniff and for a number of functions the "alternative" for the deprecated function has been added/improved.
- The `FinPress.XSS.EscapeOutput` sniff will now also detect unescaped output when the short open echo tags `<?=` are used.
- Updated the list of FP globals which is used by both the `FinPress.Variables.GlobalVariables` and the `FinPress.NamingConventions.PrefixAllGlobals` sniffs.
- Updated the information on using a custom ruleset and associated naming conventions in the Readme.
- Updated the [custom ruleset example](https://github.com/FinPress/FinPress-Coding-Standards/blob/develop/phpcs.xml.dist.sample) to provide a better starting point and renamed the file to follow current PHPCS best practices.
- Various inline documentation improvements.
- Updated the link to the PHPStorm documentation in the Readme.
- Various textual improvements to the Readme.
- Minor improvements to the build script.

### Removed
- `Squiz.Commenting.LongConditionClosingComment` sniff from the `FinPress-Core` ruleset. This rule has been removed from the FP Coding Standards handbook.
- The exclusion of the `Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace` error from the `FinPress-Core` ruleset.
- The exclusion of the `PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket` and `PEAR.Functions.FunctionCallSignature.CloseBracketLine` error from the `FinPress-Core` ruleset when used in combination with the fixer, i.e. `phpcbf`. The exclusions remain in place for `phpcs` runs.
- `fp_get_post_terms()`, `fp_get_post_categories()`, `fp_get_post_tags()` and `fp_get_object_terms()` from the `FinPress.VIP.RestrictedFunctions` sniff as these functions are now cached natively since FP 4.7.

### Fixed
- The `FinPress.Array.ArrayDeclarationSpacing` could be overeager when fixing associative arrays to be multi-line. Non-associative single-line arrays which contained a nested associative array would also be auto-fixed by the sniff, while only the nested associated array should be fixed.
- The `FinPress.Files.FileName` sniff did not play nice with IDEs passing a filename to PHPCS via `--stdin-path=`.
- The `FinPress.Files.FileName` sniff was being triggered on code passed via `stdin` where there is no file name to examine.
- The `FinPress.PHP.YodaConditions` sniff would give a false positive for the result of a condition being assigned to a variable.
- The `FinPress.VIP.RestrictedVariables` sniff was potentially underreporting issues when the variables being restricted were a combination of variables, object properties and array members.
- The auto-fixer in the `FinPress.WhiteSpace.ControlStructureSpacing` sniff which deals with "blank line after control structure" issues could cause comments at the end of control structures to be removed.
- The `FinPress.FP.DeprecatedFunctions` sniff was reporting the wrong FP version for the deprecation of a number of functions.
- The `FinPress.FP.EnqueuedResources` sniff would potentially underreport issues in certain circumstances.
- The `FinPress.XSS.EscapeOutput` sniff will no now longer report issues when it encounters a `__DIR__`, `(unset)` cast or a floating point number, and will correctly disregard more arithmetic operators when deciding whether to report an issue or not.
- The [whitelisting of errors using flags](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Whitelisting-code-which-flags-errors) was sometimes a bit too eager and could accidentally whitelist code which was not intended to be whitelisted.
- Various (potential) `Undefined variable`, `Undefined index` and `Undefined offset` notices.
- Grammar in one of the `FinPress.FP.I18n` error messages.


## [0.11.0] - 2017-03-20

### Important notes for end-users:

If you use the FinPress Coding Standards with a custom ruleset, please be aware that some of the checks have been moved between sniffs and that the naming of a number of error codes has changed.
If you exclude some sniffs or error codes, you may have to update your custom ruleset to be compatible with FPCS 0.11.0.

Additionally, to make it easier for you to customize your ruleset, two new wiki pages have been published with information on the properties you can adjust from your ruleset:
* [FPCS customizable sniff properties](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties)
* [PHPCS customizable sniff properties](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki/Customisable-Sniff-Properties)

For more detailed information about the changed sniff names and error codes, please refer to PR [#633](https://github.com/FinPress/FinPress-Coding-Standards/pull/633) and PR [#814](https://github.com/FinPress/FinPress-Coding-Standards/pull/814).

### Important notes for sniff developers:

If you maintain or develop sniffs based upon the FinPress Coding Standards, most notably, if you use methods and properties from the `WordPress_Sniff` class, extend one of the abstract sniff classes FPCS provides or extend other sniffs from FPCS to use their properties, please be aware that this release contains significant changes which will, more likely than not, affect your sniffs.

Please read this changelog carefully to understand how this will affect you.
For more detailed information on the most significant changes, please refer to PR [#795](https://github.com/FinPress/FinPress-Coding-Standards/pull/795), PR [#833](https://github.com/FinPress/FinPress-Coding-Standards/pull/833) and PR [#841](https://github.com/FinPress/FinPress-Coding-Standards/pull/841).
You are also encouraged to check the file history of any FPCS classes you extend.

### Added
- `FinPress.FP.DeprecatedFunctions` sniff to the `FinPress-Extra` ruleset to check for usage of deprecated FP version and show errors/warnings depending on a `minimum_supported_version` which [can be passed to the sniff from a custom ruleset](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#minimum-fp-version-to-check-for-usage-of-deprecated-functions-classes-and-function-parameters). The default value for the `minimum_supported_version` property is three versions before the current FP version.
- `FinPress.FP.I18n`: ability to check for missing _translators comments_ when a I18n function call contains translatable text strings containing placeholders. This check will also verify that the _translators comment_ is correctly placed in the code and uses the correct comment type for optimal compatibility with the various tools available to create `.pot` files.
- `FinPress.FP.I18n`: ability to pass the `text_domain` to check for [from the command line](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#setting-text_domain-from-the-command-line-fpcs-0110).
- `FinPress.Arrays.ArrayDeclarationSpacing`: check + fixer for single line associative arrays. The [handbook](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/#indentation) states that these should always be multi-line.
- `FinPress.Files.FileName`: verification that files containing a class reflect this in the file name as per the core guidelines. This particular check can be disabled in a custom ruleset by setting the new [`strict_class_file_names` property](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#disregard-class-file-name-rules).
- `FinPress.Files.FileName`: verification that files in `/fp-includes/` containing template tags - annotated with `@subpackage Template` in the file header - use the `-template` suffix.
- `FinPress.Files.FileName`: [`is_theme` property](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#themes-allow-filename-exceptions) which can be set in a custom ruleset. This property can be used to indicate that the project being checked is a theme and will allow for a predefined theme hierarchy based set of exceptions to the file name rules.
- `FinPress.VIP.AdminBarRemoval`: check for hiding the admin bar using CSS.
- `FinPress.VIP.AdminBarRemoval`: customizable [`remove_only` property](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#admin-bar-visibility-manipulations) to toggle whether to error of all manipulation of the visibility of the admin bar or to execute more thorough checking for removal only.
- `FinPress.WhiteSpace.ControlStructureSpacing`: support for checking the whitespace in `try`/`catch` constructs.
- `FinPress.WhiteSpace.ControlStructureSpacing`: check that the space after the open parenthesis and before the closing parenthesis of control structures and functions is *exactly* one space. Includes auto-fixer.
- `FinPress.WhiteSpace.CastStructureSpacing`: ability to automatically fix errors thrown by the sniff.
- `FinPress.VIP.SessionFunctionsUsage`: detection of the `session_abort()`, `session_create_id()`, `session_gc()` and `session_reset()` functions.
- `FinPress.CSRF.NonceVerification`: ability to pass [custom sanitization functions](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#custom-input-sanitization-functions) to the sniff.
- The `get_the_ID()` function to the `autoEscapedFunctions` list used by the `FinPress.XSS.EscapeOutput` sniff.
- The `fp_strip_all_tags()`, `sanitize_hex_color_no_hash()` and `sanitize_hex_color()` functions to the `sanitizingFunctions` list used by the `FinPress.CSRF.NonceVerification`, `FinPress.VIP.ValidatedSanitizedInput` and `FinPress.XSS.EscapeOutput` sniffs.
- The `floatval()` function to the `escapingFunctions`, `sanitizingFunctions`, `unslashingSanitizingFunctions`, `SQLEscapingFunctions` lists used by the `FinPress.CSRF.NonceVerification`, `FinPress.VIP.ValidatedSanitizedInput`, `FinPress.XSS.EscapeOutput` and `FinPress.FP.PreparedSQL` sniffs.
- The table name based `clean_*_cache()` functions to the `cacheDeleteFunctions` list used by the `FinPress.VIP.DirectDatabaseQuery` sniff.
- Abstract `AbstractFunctionParameter` parent class to allow for examining parameters passed in function calls.
- A number of utility functions to the `WordPress_Sniff` class: `strip_quotes()`, `addMessage()`, `addFixableMessage()`, `string_to_errorcode()`, `does_function_call_have_parameters()`, `get_function_call_parameter_count()`, `get_function_call_parameters()`, `get_function_call_parameter()`, `has_html_open_tag()`.
- `Squiz.Commenting.LongConditionClosingComment`, `Squiz.WhiteSpace.CastSpacing`, `Generic.Formatting.DisallowMultipleStatements` to the `FinPress-Core` ruleset.
- `Squiz.PHP.NonExecutableCode`, `Squiz.Operators.IncrementDecrementUsage`, `Squiz.Operators.ValidLogicalOperators`, `Squiz.Functions.FunctionDuplicateArgument`, `Generic.PHP.BacktickOperator`, `Squiz.PHP.DisallowSizeFunctionsInLoops` to the `FinPress-Extra` ruleset.
- Numerous additional unit tests covering the correct handling of properties overruled via a custom ruleset by various sniffs.
- Instructions on how to use FPCS with Visual Studio to the Readme.
- Section on how to use FPCS with CI Tools to the Readme, initially covering integration with Travis CI.
- Section on considerations when writing sniffs for FPCS to `Contributing.md`.

### Changed
- The minimum required PHP version to 5.2 (was 5.1).
- The minimum required PHP_CodeSniffer version to 2.8.1 (was 2.6).
- Improved support for detecting issues in code using closures (anonymous functions), short array syntax and anonymous classes.
- Improved sniff efficiency and performance for a number of sniffs.
- The discouraged/restricted functions sniffs have been reorganized and made more modular.
    * The new `FinPress.PHP.DevelopmentFunctions` sniff now contains the checks related to PHP functions typically used during development which are discouraged in production code.
    * The new `FinPress.PHP.DiscouragedPHPFunctions` sniff now contains checks related to various PHP functions, use of which is discouraged for various reasons.
    * The new `FinPress.FP.AlternativeFunctions` sniff contains the checks related to PHP functions for which FP offers an alternative which should be used instead.
    * The new `FinPress.FP.DiscouragedFunctions` sniff contains checks related to various FP functions, use of which is discouraged for various reasons.
    * A number of checks contained in the `FinPress.VIP.RestrictedFunctions` sniff have been moved to other sniffs.
    * The `FinPress.PHP.DiscouragedFunctions` sniff has been deprecated and is no longer used. The checks which were previously contained herein have been moved to other sniffs.
    * The reorganized sniffs also detect a number of additional functions which were previously ignored by these sniffs. For more detail, please refer to the [summary of the PR](https://github.com/FinPress/FinPress-Coding-Standards/pull/633#issuecomment-269693016) and to [PR #759](https://github.com/FinPress/FinPress-Coding-Standards/pull/759).
- The error codes for these sniffs as well as for `FinPress.DB.RestrictedClasses`, `FinPress.DB.RestrictedFunctions`, `FinPress.Functions.DontExtract`, `FinPress.PHP.POSIXFunctions` and a number of the `VIP` sniffs have changed. They were previously based on function group names and will now be based on function group name in combination with the identified function name. Complete function groups can still be silenced by using the [`exclude` property](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#excluding-a-group-of-checks) in a custom ruleset.
- `FinPress.NamingConventions.ValidVariableName`: The `customVariablesWhitelist` property which could be passed from the ruleset has been renamed to [`customPropertiesWhitelist`](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#mixed-case-property-name-exceptions) as it is only usable to whitelist class properties.
- `FinPress.FP.I18n`: now allows for an array of text domain names to be passed to the `text_domain` property from a custom ruleset.
- `FinPress.WhiteSpace.CastStructureSpacing`: the error level for the checks in this sniff has been raised from `warning` to `error`.
- `FinPress.Variables.GlobalVariables`: will no longer throw errors if the global variable override is done from within a test method. Whether something is considered a "test method" is based on whether the method is in a class which extends a predefined set of known unit test classes. This list can be enhanced by setting the [`custom_test_class_whitelist` property](https://github.com/FinPress/FinPress-Coding-Standards/wiki/Customizable-sniff-properties#custom-unit-test-classes) in your ruleset.
- The `FinPress.Arrays.ArrayDeclaration` sniff has been split into two sniffs: `FinPress.Arrays.ArrayDeclaration` and `FinPress.Arrays.ArrayDeclarationSpacing` for better compatibility with PHPCS upstream.
- The `FinPress.Arrays.ArrayDeclaration` sniff has been synced with the PHPCS upstream version to get the benefit of some bug fixes and improvements which had been made upstream since the sniff was originally copied over.
- The `FinPress.VIP.FileSystemWritesDisallow`, `FinPress.VIP.TimezoneChange` and `FinPress.VIP.SessionFunctionsUsage` sniffs now extend the `WordPress_AbstractFunctionRestrictionsSniff`.
- Property handling of custom properties set via a custom ruleset where the property is expected to be set in array format (`type="array"`) has been made more lenient and will now also handle properties passed as a comma delimited lists correctly. This affects all customizable properties which expect array format.
- Moved `Squiz.PHP.DisallowMultipleAssignments` from the `FinPress-Extra` to the `FinPress-Core` ruleset.
- Replaced the `FinPress.Classes.ValidClassName`, `FinPress.PHP.DisallowAlternativePHPTags` and the `FinPress.Classes.ClassOpeningStatement` sniffs with the existing `PEAR.NamingConventions.ValidClassName` and the new upstream `Generic.PHP.DisallowAlternativePHPTags` and `Generic.Classes.OpeningBraceSameLine` sniffs in the `FinPress-Core` ruleset.
- Use the upstream `Squiz.PHP.Eval` sniff for detecting the use of `eval()` instead of a FPCS native implementation.
- Made the `Generic.WhiteSpace.ScopeIndent` sniff in the `FinPress-Core` ruleset more lenient to allow for different indentation in inline HTML, heredoc and nowdoc structures.
- Made the `Generic.Strings.UnnecessaryStringConcat` sniff in the `FinPress-Extra` ruleset more lenient to allow for multi-line string concatenation.
- All sniffs are now also being tested against PHP 7.1 for consistent sniff results.
- The requirements for running the sniffs have been made more explicit in the readme.
- Updated composer installation instructions in the readme.
- Updated information about the rulesets in the readme and moved the information up to make it easier to find.
- Improved the information about running the unit tests in `Contributing.md`.
- Improved the inline documentation of the rulesets.
- Various other code quality and code consistency improvements under the hood, including refactoring of some of the abstract sniff classes, closer coupling of the child classes to the `WordPress_Sniff` parent class and changes to the visibility and staticness of properties for a large number of sniffs.

### Removed
- Warnings thrown by individual sniffs about parse errors they encounter. This is left up to the `Generic.PHP.Syntax` sniff which is included in the `FinPress-Extra` ruleset.
- The `post_class()` function from the `autoEscapedFunctions` list used by the `FinPress.XSS.EscapeOutput` sniff.
- The `Generic.Files.LowercasedFilename` sniff from the `FinPress-Core` ruleset in favor of the improved `FinPress.Files.FileName` sniff to prevent duplicate messages being thrown.
- Some temporary work-arounds for changes which were pulled and merged into PHPCS upstream.

### Fixed
- `FinPress.Variables.GlobalVariables`: **_All known bugs have been fixed. If you'd previously disabled the sniff in your custom ruleset because of these bugs, it should be fine to re-enable it now._**
    * Assignments to global variables using other assignment operators than the `=` operator were not detected.
    * If a `global ...;` statement was detected, the whole file would be checked for the variables which were made global, not just the code after the global statement.
    * If a `global ...;` statement was detected, the whole file would be checked for the variables which were made global, including code contained within a function/closure/class scope where there is no access to the global variable.
    * If a `global ...;` statement was detected within a function call or closure, the whole file would be checked for the variables which were made global, not just the code within the function or closure.
    * If a `global ...;` statement was detected and an assignment was made to a static class variable using the same name as one of the variables made global, an error would incorrectly be thrown.
    * An override of a protected global via `$GLOBALS` in combination with simple string concatenation obfuscation was not being detected.
- `FinPress.FP.I18n`: all reported bugs have been fixed.
    * A superfluous `UnorderedPlaceholders` error was being thrown when `%%` (a literal % sign) was encountered in a string.
    * The sniff would sometimes erroneously trigger errors when a literal `%` was found in a translatable string without placeholders.
    * Not all type of placeholders were being recognized.
    * No warning was being thrown when encountering a mix of ordered and unordered placeholders.
    * The fixer for unordered placeholders was erroneously replacing all placeholders as if they were the first one.
    * The fixer for unordered placeholders could cause faulty replacements in double quoted strings.
    * Compatibility with PHP nightly / PHP 7.2.
- `FinPress.WhiteSpace.ControlStructureSpacing`: synced in fixes from the upstream version.
    * The fixer would bork on control structures which contained only a single empty line.
    * The sniff did not check the spacing used for `do {} while ()` control structures.
    * Conditional function declarations could cause an infinite loop when using the fixer.
- `FinPress.VIP.PluginMenuSlug`: the sniff would potentially incorrectly process method calls and namespaced functions with the same function name as the targeted FinPress native functions.
- `FinPress.VIP.CronInterval`: the native FP time constants were not recognized leading to false positives.
- `FinPress.VIP.CronInterval`: the finding of the referenced function declaration has been made more accurate.
- `FinPress.PHP.YodaConditions`: minor clarification of the error message.
- `FinPress.NamingConventions.ValidVariableName`: now allows for a predefined list of known mixed case global variables coming from FinPress itself reducing false positives.
- The `unslashingSanitizingFunctions` list was not consistently taken into account when verifying whether a variable was sanitized for the `FinPress.VIP.ValidatedSanitizedInput` and `FinPress.CSRF.NonceVerification` sniffs.
- The passing of properties via the ruleset was buggy for a number of sniffs - most notably those sniffs using custom properties in array format - and could lead to unintended bleed-through between sniffs.
- Various (potential) `Undefined variable`, `Undefined index` and `Undefined offset` notices.
- An issue with placeholder replacement not taking place in some error messages.
- A (potential) issue which could play up when sniffs examined text strings which contained quotes.


## [0.10.0] - 2016-08-29

### Added
- `FinPress.FP.I18n` sniff to the `FinPress-Core` ruleset to flag dynamic translatable strings and text domains.
- `FinPress.PHP.DisallowAlternativePHPTags` sniff to the `FinPress-Core` ruleset to flag - and fix - ASP and `<script>` PHP open tags.
- `FinPress.Classes.ClassOpeningStatement` sniff to the `FinPress-Core` ruleset to flag - and fix - class opening brace placement.
- `FinPress.NamingConventions.ValidHookName` sniff to the `FinPress-Core` ruleset to flag filter and action hooks which don't comply with the guideline of lowercase letters and underscores. For maintaining backward-compatibility of hook names an `additionalWordDelimiters` property can be added via a custom ruleset.
- `FinPress.Functions.DontExtract` sniff to the `FinPress-Core` ruleset to flag usage of the `extract()` function.
- `FinPress.PHP.POSIXFunctions` sniff to the `FinPress-Core` ruleset to flag usage of regex functions from the POSIX PHP extension which was deprecated since PHP 5.3 and removed in PHP 7.
- `FinPress.DB.RestrictedFunctions` and `FinPress.DB.RestrictedClasses` sniffs to the `FinPress-Core` ruleset to flag usage of direct database calls using PHP functions and classes rather than the FP functions for the same.
- Abstract `AbstractClassRestrictions` parent class to allow for easier sniffing for usage of specific classes.
- `Squiz.Strings.ConcatenationSpacing`, `PSR2.ControlStructures.ElseIfDeclaration`, `PSR2.Files.ClosingTag`, `Generic.NamingConventions.UpperCaseConstantName` to the `FinPress-Core` ruleset.
- Ability to add arbitrary variables to the whitelist via a custom ruleset property for the `FinPress.NamingConventions.ValidVariableName` sniff.
- Ability to use a whitelist comment for tax queries for the `FinPress.VIP.SlowDBQuery` sniff.
- Instructions on how to use FPCS with Atom and SublimeLinter to the Readme.
- Reference to the [wiki](https://github.com/FinPress/FinPress-Coding-Standards/wiki) to the Readme.
- Recommendation to also use the [PHPCompatibility](https://github.com/PHPCompatibility/PHPCompatibility) ruleset to the Readme.

### Changed
- The minimum required PHP_CodeSniffer version to 2.6.0.
- Moved the `FinPress.FP.PreparedSQL` sniff from `FinPress-Extra` to `FinPress-Core`.
- `FinPress.PHP.StrictInArray` will now also flag non-strict usage of `array_keys()` and `array_search()`.
- Added `_deprecated_constructor()` and `_deprecated_hook()` to the list of printing functions.
- Added numerous additional functions to sniff for to the `FinPress.VIP.RestrictedFunctions` sniff as per the VIP guidelines.
- Upped the `posts_per_page` limit from 50 to 100 in `FinPress.VIP.PostsPerPage` sniff as per the VIP guidelines.
- Added `cat_ID` to the whitelisted exceptions for the `FinPress.NamingConventions.ValidVariableName` sniff.
- Added `__debugInfo` to the magic method whitelist for class methods starting with double underscore in the `FinPress.NamingConventions.ValidFunctionName` sniff.
- An error will now also be thrown for non-magic _functions_ using a double underscore prefix - `FinPress.NamingConventions.ValidFunctionName` sniff.
- The `FinPress.Arrays.ArrayAssignmentRestrictions`, `FinPress.Functions.FunctionRestrictions`, `FinPress.Variables.VariableRestrictions` sniffs weren't in actual fact sniffs, but parent classes for child sniffs. These have now all been turned into proper abstract parent classes and moved to the main `FinPress` directory.
- The array provided to `AbstractFunctionRestrictions` can now take a `whitelist` key to whitelist select functions when blocking a group of functions by function prefix.
- Updated installation instructions in the readme.
- The `FinPress-Core` ruleset is now ordered according to the handbook
- The FPCS code base itself now complies with the FinPress-Core, -Extra and -Docs coding standards.
- Various other code quality and code consistency improvements under the hood.

### Removed
- `Squiz.Functions.FunctionDeclarationArgumentSpacing.SpacingBeforeClose` from the `FinPress-Core` standard (was causing duplicate messages for the same issue).
- `Squiz.Commenting.FunctionComment.ScalarTypeHintMissing`, `Squiz.Commenting.InlineComment.NotCapital` from the `FinPress-Docs` standard.
- Removed the sniffing for `get_pages()` from the `FinPress.VIP.RestrictedFunctions` sniff as per the VIP guidelines.
- Removed the sniffing for `extract()` from the `FinPress.VIP.RestrictedFunctions` sniff as it's now covered in a separate sniff.
- Removed the sniffing for the POSIX functions from the `FinPress.PHP.DiscouragedFunctions` sniff as it's now covered in a separate sniff.

### Fixed
- Error message precision for the `FinPress.NamingConventions.ValidVariableName` sniff.
- Bug in the `FinPress.WhiteSpace.ControlStructureSpacing.BlankLineAfterEnd` sniff which was incorrectly being triggered on last method of class.
- Function name sniffs based on the `AbstractFunctionRestrictions` parent class will now do a case-insensitive function name comparison.
- Function name sniffs in the `FinPress.PHP.DiscouragedFunctions` sniff will now do a case-insensitive function name comparison.
- Whitelist comments directly followed by a PHP closing tag were not being recognized.
- Some PHP Magic constants were not recognized by the `FinPress.XSS.EscapeOutput` sniff.
- An error message suggesting camel caps rather than the intended snake case format in the `FinPress.NamingConventions.ValidFunctionName` sniff.
- `FinPress.WhiteSpace.ControlStructureSpacing` should no longer throw error notices during live code review.
- Errors will be no longer be thrown for methods not complying with the naming conventions when the class extends a parent class or implements an interface - `FinPress.NamingConventions.ValidFunctionName` sniff.


## [0.9.0] - 2016-02-01

### Added
- `count()` to the list of auto-escaped functions.
- `Squiz.PHP.CommentedOutCode` sniff to `FinPress-VIP` ruleset.
- Support for PHP 5.2.
- `attachment_url_to_postid()` and `parse_url()` to the restricted functions for `FinPress-VIP`.
- `FinPress.VIP.OrderByRand` sniff.
- `FinPress.PHP.StrictInArray` sniff for `FinPress-VIP` and `FinPress-Extra`.
- `get_tag_link()`, `get_category_link()`, `get_cat_ID()`, `url_to_post_id()`, `attachment_url_to_postid()`
`get_posts()`, `fp_get_recent_posts()`, `get_pages()`, `get_children()`, `fp_get_post_terms()`
`fp_get_post_categories()`, `fp_get_post_tags()`, `fp_get_object_terms()`, `term_exists()`,
`count_user_posts()`, `fp_old_slug_redirect()`, `get_adjacent_post()`, `get_previous_post()`,
`get_next_post()` to uncached functions in `FinPress.VIP.RestrictedFunctions` sniff.
- `fp_handle_upload()` and `array_key_exists()` to the list of sanitizing functions.
- Checking for object properties in `FinPress.PHP.YodaConditions` sniff.
- `FinPress.NamingConventions.ValidVariableName` sniff.
- Flagging of function calls incorporated into database queries in `FinPress.FP.PreparedSQL`.
- Recognition of escaping and auto-escaped functions in `FinPress.FP.PreparedSQL`.
- `true`, `false`, and `null` to the tokens ignored in `FinPress.XSS.EscapeOutput`.

### Fixed
- Incorrect ternary detection in `FinPress.XSS.EscapeOutput` sniff.
- False positives when detecting variables interpolated into strings in the
`FinPress.FP.PreparedSQL` and `FinPress.VIP.ValidatedSanitizedInput` sniffs.
- False positives in `FinPress.PHP.YodaConditions` when the variable is being casted.
- `$fpdb` properties being flagged in `FinPress.FP.PreparedSQL` sniff.
- False positive in `FinPress.PHP.YodaConditions` when the a string is on the left side of the
comparison.

## [0.8.0] - 2015-10-02

### Added
- `implode()` and `join()` to the list of formatting functions in the `FinPress.XSS.EscapeOutput`
sniff. This is useful when you need to have HTML in the `$glue` parameter.
- Support in the `FinPress.XSS.EscapeOutput` sniff for escaping an array of values
using `array_map()`. (Otherwise the support for `implode()` isn't of much use :)
- Docs for running FPCS in Sublime Text.
- `nl2br()` to the list of formatting functions.
- `fp_dropdown_pages()` to the list of printing functions.
- Error codes to all error/warning messages.
- `FinPress.FP.PreparedSQL` sniff for flagging unprepared SQL queries.

### Removed
- Sniffing for the number of spaces before a closure's opening parenthesis from the
default configuration of the `FinPress.WhiteSpace.ControlStructureSpacing` sniff. It
can be re-enabled per-project as desired.

### Fixed
- The `FinPress.XSS.EscapeOutput` sniff giving error messages with the closing
parenthesis in them instead of the offending function's name.

## [0.7.1] - 2015-08-31

### Changed
- The default number of spaces before a closure's opening parenthesis from 1 to 0.

## [0.7.0] - 2015-08-30

### Added
- Automatic error fixing to the `FinPress.Arrays.ArrayKeySpacingRestrictions` sniff.
- Functions and closures to the control structures checked by the `FinPress.WhiteSpace.ControlStructureSpacing`
sniff.
- Sniffing and fixing for extra spacing in the `FinPress.WhiteSpace.ControlStructureSpacing`
sniff. (Previously it only checked for insufficient spacing.)
- `.twig` files to the default ignored files.
- `esc_url_raw()` and `hash_equals()` to the list of sanitizing functions.
- `intval()` and `boolval()` to list of unslashing functions.
- `do_shortcode()` to the list of auto-escaped functions.

### Removed
- `FinPress.Functions.FunctionDeclarationArgumentSpacing` in favor of the upstream
sniff `Squiz.Functions.FunctionDeclarationArgumentSpacing`.

### Fixed
- Reference to incorrect issue in the inline docs of the `FinPress.VIP.SessionVariableUsage`
sniff.
- `FinPress.XSS.EscapeOutput` sniff incorrectly handling ternary conditions in
`echo` statements without parentheses in some cases.

## [0.6.0] - 2015-06-30

### Added
- Support for `fp_cache_add()` and `fp_cache_delete()`, as well as custom cache 
functions,in the `FinPress.VIP.DirectDatabaseQuery` sniff.

### Removed
- `FinPress.Functions.FunctionRestrictions` and `FinPress.Variables.VariableRestrictions` 
from the `FinPress-VIP` standard, since they are just parents for other sniffs.

## [0.5.0] - 2015-06-01

### Added
- `FinPress.CSRF.NonceVerification` sniff to flag form processing without nonce verification.
- `in_array()` and `is_array()` to the list of sanitizing functions.
- Support for automatic error fixing to the `FinPress.Arrays.ArrayDeclaration` sniff.
- `FinPress.PHP.StrictComparisons` to the `FinPress-VIP` and `FinPress-Extra` rulesets.
- `FinPress-Docs` ruleset to sniff for proper commenting.
- `Generic.PHP.LowerCaseKeyword`, `Generic.Files.EndFileNewline`, `Generic.Files.LowercasedFilename`, 
`Generic.Formatting.SpaceAfterCast`, and `Generic.Functions.OpeningFunctionBraceKernighanRitchie` to the `FinPress-Core` ruleset.
- `Generic.PHP.DeprecatedFunctions`, `Generic.PHP.ForbiddenFunctions`, `Generic.Functions.CallTimePassByReference`, 
`Generic.Formatting.DisallowMultipleStatements`, `Generic.CodeAnalysis.EmptyStatement`, 
`Generic.CodeAnalysis.ForLoopShouldBeWhileLoop`, `Generic.CodeAnalysis.ForLoopWithTestFunctionCall`, 
`Generic.CodeAnalysis.JumbledIncrementer`, `Generic.CodeAnalysis.UnconditionalIfStatement`, 
`Generic.CodeAnalysis.UnnecessaryFinalModifier`, `Generic.CodeAnalysis.UselessOverridingMethod`, 
`Generic.Classes.DuplicateClassName`, and `Generic.Strings.UnnecessaryStringConcat` to the `FinPress-Extra` ruleset.
- Error for missing use of `fp_unslash()` on superglobal data to the `FinPress.VIP.ValidatedSanitizedInput` sniff. 

### Changed
- The `FinPress.VIP.ValidatedSanitizedInput` sniff to require sanitization of input even when it is being directly escaped and output.
- The minimum required PHP_CodeSniffer version to 2.2.0.
- The `FinPress.VIP.ValidatedSanitizedInput` and `FinPress.XSS.EscapeOutput` sniffs: 
the list of escaping functions was split from the list of sanitizing functions. The `customSanitizingFunctions` 
property has been moved to the `ValidatedSanitizedInput` sniff, and the `customEscapingFunctions`
property should now be used instead for the `EscapeOutput` sniff.
- The `FinPress.Arrays.ArrayDeclaration` sniff to give errors for `NoSpaceAfterOpenParenthesis`, `SpaceAfterArrayOpener`, and `SpaceAfterArrayCloser`, instead of warnings.
- The `FinPress.NamingConventions.ValidFunctionName` sniff to allow camelCase method names in classes that implement interfaces.

### Fixed
- The `FinPress.VIP.ValidatedSanitizedInput` sniff not reporting missing validation when reporting missing sanitization.
- The `FinPress.VIP.ValidatedSanitizedInput` sniff flagging superglobals as needing sanitization when they were only being used in a comparison using `if` or `switch`, etc.

## [0.4.0] - 2015-05-01

### Added
- Change log file.
- Handling for string-interpolated input variables in the `FinPress.VIP.ValidatedSanitizedInput` sniff.
- Errors for using uncached functions when cached equivalents exist.
- `space_before_colon` setting for the `FinPress.WhiteSpace.ControlStructureSpacing` sniff, for control structures using alternative syntax. Possible values: `'required'`, `'optional'`, `'forbidden'`.
- Support for `sanitization` whitelisting comments for the `FinPress.VIP.ValidatedSanitizedInput` sniff.
- Granular error/warning names for all errors and warnings.
- Handling for ternary conditions in the `FinPress.XSS.EscapeOutput` sniff.
- `die`, `exit`, `printf`, `vprintf`, `fp_die`, `_deprecated_argument`, `_deprecated_function`, `_deprecated_file`, `_doing_it_wrong`, `trigger_error`, and `user_error` to the list of printing functions in the `FinPress.XSS.EscapeOutput` sniff.
- `customPrintingFunctions` setting for the `FinPress.XSS.EscapeOutput` sniff.
- `rawurlencode()` and `fp_parse_id_list()` to the list of "sanitizing" functions in the `FinPress.XSS.EscapeOutput` sniff.
- `json_encode()` to the list of discouraged functions in the `FinPress.PHP.DiscouragedFunctions` sniff, in favor of `fp_json_encode()`.
- `vip_powered_fpcom()` to the list of auto-escaped functions in the `FinPress.XSS.EscapeOutput` sniff.
- `debug_print_backtrace()` and `var_export()` to the list of discouraged functions in the `FinPress.PHP.DiscouragedFunctions` sniff.
- Smart handling for formatting functions (`sprintf()` and `fp_sprintf()`) in the `FinPress.XSS.EscapeOutput` sniff.
- `FinPress.PHP.StrictComparisons` sniff.
- Correct handling of `array_map()` in the `FinPress.VIP.ValidatedSanitizedInput` sniff.
- `$_COOKIE` and `$_FILE` to the list of superglobals flagged by the `FinPress.VIP.ValidatedSanitizedInput` and `FinPress.VIP.SuperGlobalInputUsage` sniffs.
- `$_SERVER` to the list of superglobals flagged by the `FinPress.VIP.SuperGlobalInputUsage` sniff.
- `Squiz.ControlStructures.ControlSignature` sniff to the rulesets.

### Changed
- `FinPress.Arrays.ArrayKeySpacingRestrictions` sniff to give errors for `NoSpacesAroundArrayKeys` and `SpacesAroundArrayKeys` instead of just warnings.
- `FinPress.NamingConventions.ValidFunctionName` sniff to allow for camel caps method names in child classes.
- `FinPress.XSS.EscapeOutput` sniff to allow for integers (e.g. `echo 5` and `print( -1 )`).

### Removed
- Errors for mixed key/keyless array elements in the `FinPress.Arrays.ArrayDeclaration` sniff.
- BOM from `FinPress.WhiteSpace.OperatorSpacing` sniff file.
- `$content_width` from the list of non-overwritable globals in the `FinPress.Variables.GlobalVariables` sniff.
- `FinPress.Arrays.ArrayAssignmentRestrictions` sniff from the `FinPress-VIP` ruleset.

### Fixed
- Incorrect errors for `else` statements using alternative syntax.
- `FinPress.VIP.ValidatedSanitizedInput` sniff not always treating casting as sanitization.
- `FinPress.XSS.EscapeOutput` sniff flagging comments as needing to be escaped.
- `FinPress.XSS.EscapeOutput` sniff not sniffing comma-delimited `echo` arguments after encountering the first escaping function in the statement.
- `FinPress.PHP.YodaConditions` sniff not flagging comparisons to constants or function calls.
- `FinPress.Arrays.ArrayDeclaration` sniff not ignoring doc comments.
- Link to phpStorm instructions in `README.md`.
- Poor performance of the `FinPress.Arrays.ArrayAssignmentRestrictions` sniff.
- Poor performance of the `FinPress.Files.FileName` sniff.

## [0.3.0] - 2014-12-11

See the comparison for full list.

### Changed
- Use semantic version tags for releases.

## [2013-10-06]

See the comparison for full list.

## 2013-06-11

Initial tagged release.

[Composer PHPCS plugin]: https://github.com/PHPCSStandards/composer-installer
[PHP_CodeSniffer]:       https://github.com/PHPCSStandards/PHP_CodeSniffer
[PHPCompatibility]:      https://github.com/PHPCompatibility/PHPCompatibility

[Unreleased]: https://github.com/FinPress/FinPress-Coding-Standards/compare/main...HEAD
[3.2.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/3.1.0...3.2.0
[3.1.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/3.0.1...3.1.0
[3.0.1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/3.0.0...3.0.1
[3.0.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2.3.0...3.0.0
[2.3.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2.2.1...2.3.0
[2.2.1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2.2.0...2.2.1
[2.2.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2.1.1...2.2.0
[2.1.1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2.0.0...2.1.0
[2.0.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2.0.0-RC1...2.0.0
[2.0.0-RC1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/1.2.1...2.0.0-RC1
[1.2.1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/1.1.0...1.2.0
[1.1.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/1.0.0...1.1.0
[1.0.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.14.1...1.0.0
[0.14.1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.14.0...0.14.1
[0.14.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.13.1...0.14.0
[0.13.1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.13.0...0.13.1
[0.13.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.12.0...0.13.0
[0.12.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.11.0...0.12.0
[0.11.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.10.0...0.11.0
[0.10.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.9.0...0.10.0
[0.9.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.8.0...0.9.0
[0.8.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.7.1...0.8.0
[0.7.1]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.7.0...0.7.1
[0.7.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.6.0...0.7.0
[0.6.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.5.0...0.6.0
[0.5.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.4.0...0.5.0
[0.4.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/0.3.0...0.4.0
[0.3.0]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2013-10-06...0.3.0
[2013-10-06]: https://github.com/FinPress/FinPress-Coding-Standards/compare/2013-06-11...2013-10-06

[@anomiex]:         https://github.com/anomiex
[@Chouby]:          https://github.com/Chouby
[@ckanitz]:         https://github.com/ckanitz
[@craigfrancis]:    https://github.com/craigfrancis
[@davidperezgar]:   https://github.com/davidperezgar
[@dawidurbanski]:   https://github.com/dawidurbanski
[@desrosj]:         https://github.com/desrosj
[@fredden]:         https://github.com/fredden
[@grappler]:        https://github.com/grappler
[@Ipstenu]:         https://github.com/Ipstenu
[@jaymcp]:          https://github.com/jaymcp
[@JDGrimes]:        https://github.com/JDGrimes
[@khacoder]:        https://github.com/khacoder
[@Luc45]:           https://github.com/Luc45
[@marconmartins]:   https://github.com/marconmartins
[@NielsdeBlaauw]:   https://github.com/NielsdeBlaauw
[@richardkorthuis]: https://github.com/richardkorthuis
[@rodrigoprimo]:    https://github.com/rodrigoprimo
[@slaFFik]:         https://github.com/slaFFik
[@sandeshjangam]:   https://github.com/sandeshjangam
[@szepeviktor]:     https://github.com/szepeviktor
[@westonruter]:     https://github.com/westonruter
