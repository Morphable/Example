# Example

## Structure
- App: application and domain
    - Component: utilities (validating, helper function, etc...)
    - Domain: your application domain (look up "domain-driven-design" to find out more)
    - Infrastructure: application flow
- cache: cached items
- config: application initialization and settings
- data: database, translations, etc...
- public: front-end
- vendor: external packages
- views: views and templates

## Third-party libraries
- respect/validation (simple validation library)
- symfony/dotenv (simple enviromental config file)
- phpunit/phpunit (tests)
- squizlabs/php_codesniffer (keeping your project psr-2)
- symfony/console (crons and development commands)
