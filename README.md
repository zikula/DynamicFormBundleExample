# Proof Of Concept (POC) Application
### for [zikula/dynamic-form-property-bundle](https://github.com/zikula/DynamicFormPropertyBundle)

1. `composer install`
2. `./start.sh`

Stop with `./stop.sh`

This is a _very basic_ Symfony application to show how to use [zikula/dynamic-form-property-bundle](https://github.com/zikula/DynamicFormPropertyBundle).

This POC creates a *SurveyBuilder*. This application allows the site admin to create N surveys and then allows users to
complete the created surveys and store the responses. Please be advised that this is a _very_ bare-bones application
with no css or form styling of any kind (it's very ugly).

Some features
 - Translation is enabled
 - Custom FormType (HairColorType) is added to the formType list via EventSubscriber
    - CurrencyType is removed via same listener
 - Supported Locales provided via EventSubscriber
