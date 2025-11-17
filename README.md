# Matomo Analytics integration for Thelia E-Commerce

[![Project Status: Active - The project has reached a stable, usable state and is being actively developed.](http://www.repostatus.org/badges/latest/active.svg)](http://www.repostatus.org/#active)

This module implements [Matomo](http://matomo.org) user and e-commerce tracking into [Thelia](http://thelia.net).
It reports the following tracking events using Matomo Tag Manager (MTM):

## User Tracking

This module uses the `main.body-bottom` hook to include the matomo javascript bug into the frontend of a Thelia installation. Most user activities can therefor be tracked. All tracking is done via MTM, allowing the use of custom events and Data Layer variables for more flexible reporting.

## E-commerce Tracking

In addition to user tracking, these e-commerce events are tracked through MTM Data Layer events:

- Product page views (view_item)
- Category page views (view_item_list)

The Data Layer is compatible with GA4-style structures, exposing product and category information dynamically to MTM.

Have a look at the [Matomo e-commerce analytics docs](http://piwik.org/docs/ecommerce-analytics) for more information.

Note that the cart and order tracking uses the [PHP Client for Matomo Analytics Tracking API](https://github.com/matomo-org/matomo-php-tracker) to communicate with
Matomo. This events are still tracked, even if the Matomo JavaScript tracker is blocked by an ad or privacy blocker.

## Installation

Before installing this module, make sure, that [e-commerce tracking is enabled](http://piwik.org/docs/ecommerce-analytics/#enable-ecommerce-tracking) in Matomo for the site you want to use.
Then configure [tag, triggers, Data Layer](https://ronan-hello.fr/series/matomo/ecommerce-matomo-tag-manager) (for product & category tracking)

### Manual Installation

- Copy the module into <thelia_root>/local/modules/ directory and be sure that the name of the folder is `HookMatomoAnalytics` **or**
- use the `Install or update a module` functionality in the modules section of the Thelia back office

### Composer

`composer require vz777/hook-matomo-analytics`

After finishing the installation, activate the module in the modules section of the back office and fill in `Piwik URL` and `Website ID`.

## About

This module is a fork of the original work https://github.com/AnimalDesign/thelia-piwik-analytics by [ANIMAL](http://animal.at).  
We thank them for the original implementation and inspiration.
