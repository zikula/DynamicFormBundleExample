# DynamicFormBundle Example
### for [zikula/dynamic-form-bundle](https://github.com/zikula/DynamicFormBundle)

1. `composer install`
2. `./start.sh`

Stop with `./stop.sh`

This is a _very basic_ Symfony application to show how to use [zikula/dynamic-form-bundle](https://github.com/zikula/DynamicFormBundle).

This application is a *SurveyBuilder*. It allows the site admin to create N surveys and then allows users to
complete the created surveys and store the responses. Please be advised that this is intentionally a _very_ bare-bones
application with minimal modification from generated code.

Some features
 - Translation is enabled
 - Custom FormType (HairColorType) is added to the formType list via EventSubscriber
    - CurrencyType is removed via same listener
 - Supported Locales provided via EventSubscriber
 - Form label groups are used and displayed in response and result templates
