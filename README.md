# Public REST API and GraphQL for Goomento Page Builder Extension

## 1. Install

Run the following command in Magento 2 root folder to install this repository

```bash
composer require goomento/module-page-builder-api
php bin/magento module:enable Goomento_PageBuilderApi
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## 2. REST API request

Get JSON data of particular Goomento page builder base on `identifier` via REST API

Request:
```http request
GET <domain>/rest/V1/<store_code>/pagebuilder/identifier/<identifier>
```

Example response:
```json
{
    "settings": {},
    "elements": [],
    "title": "Goomento page builder response",
    "type": "page",
    "status": "publish",
    "update_time": "2022-09-02 08:50:59",
    "creation_time": "2022-09-02 08:50:59",
    "html": "<div>Page Builder HTML.</div>",
    "styles": [
        {
            "href": "https://example.com/pub/style.css",
            "content": "body {background: red};"
        }
    ]
}
```

## 3. GraphQL request

Get JSON data of particular Goomento page builder base on `identifier` via GraphQL

Request:
```graphql
query {
    pagebuilder(identifier: "<identifier>") {
        title
        status
        type
        html
        elements_content
        settings_content
        creation_time
        update_time
        styles {
            content
            href
        }
    }
}
```

Example response:
```json
{
    "data": {
        "pagebuilder": {
            "title": "Goomento page builder response",
            "status": "publish",
            "type": "page",
            "html": "<div>Page Builder HTML.</div>",
            "elements_content": "[]",
            "settings_content": "{}",
            "creation_time": "2022-09-02 08:50:59",
            "update_time": "2022-09-02 08:50:59",
            "styles": [
                {
                    "href": "https://example.com/pub/style.css",
                    "content": "body {background: red};"
                }
            ]
        }
    }
}
```

### Note:

- `Publish` status must be `Yes`
- `Enable` config must be `Yes` 
- `elements_content` and `settings_content` were encoded JSON data of page builder
