# Streply for Magento
Streply SDK for Magento e-commerce software

## Install

Install the `streply/streply-magento` package:

```bash
composer require streply/streply-magento
```

Enable module and run migration:
```bash
bin/magento module:enable Streply_StreplyMagento
```
```bash
bin/magento setup:upgrade
```

## Config
Add default `Streply DSN` key configuration and set module output in `Config > Streply > General`.

You can find the DSN code of the project in the `Projects` tab in your Streply account.
