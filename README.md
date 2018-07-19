# What is this?

Client library to interact with Membership Number service.

# Usage

To add this library to an existing application, 

* Add the following repository to the app's composer.json,
```javascript
"repositories": [
    {
        "type": "vcs",
        "url": "https://git@bitbucket.org/tastecard/dcg-lib-membership-number-state-client.git"
    }, {
        "type": "vcs",
        "url": "https://git@bitbucket.org/tastecard/dcg-lib-config.git"
    }

]
```   
            
* Add the following to the _require_ section, 
```javascript
"dcg/dcg-lib-membership-number-state-client": "dev-master",
"dcg/dcg-lib-config": "dev-master"
```    

* Add this to the scripts section: 
```json
"scripts": {
    "post-update-cmd": [
        "Dcg\\Client\\MembershipNumberState\\Config\\FileCreator::createConfigFile",        
    ]
}
```

* Run composer install