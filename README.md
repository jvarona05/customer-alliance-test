<p align="center"><img src="https://go.customer-alliance.com/build/images/logo.png?75938931" width="250"></p>

# Customer Alliance PHP Technical

Test to demonstrate skills and mastery in PHP. 

[API Documentation](https://jvarona05.github.io/customer-alliance-test/public/api.html).

## Requirements

-We need to improve the code quality by adopting the SOLID principles and/or other best practices.
-Chain hotels are not defined currently. We need to implement that.
-Registered Hotels should be able to embed an html/javascript widget in their website.
  The widget should show an average score of all their review scores.
  The widget could consume the average API, that we are providing. The Hotel can potentially have thousands of reviews, so keep that in mind for performance considerations.
-Currently the average API is using hotelId, but Hotel entity should be identified by a UUID and have a relation to its Reviews.
-The visual design of the widget is not important. It can be just a centered bold white number on blue background. The size should be 100x100px and it should be positioned fixed on the bottom right corner of the screen.
-The hotelier should be able to embed their widget by simply pasting a snippet like this before the closing </body> tag of their website:`<script src="http://host-of-the-app/widget/{{UUID}}.js"></script>`Where {{UUID}} is the uuid of the Hotel. To keep this task simple we are not generating other hashes or access keys for using this widget but simply stick to the UUID.
  
The script which is served as the response should inject an iframe into the DOM of the hotel's website with size & position described above that will contain the widget's html with the styles mentioned above. For best compatibility with other scripts on the website & minimal size it should use Vanilla JS (plain JS) to inject the iframe and not rely on jQuery or any framework. 
-The response can be cached by clients for up to 1 hour.

## Installation

### Clone the project

```
git clone https://github.com/jvarona05/customer-alliance-test.git

cd customer-alliance-test
```

### Create .env file

```
cp .env.example .env
```

### Run Docker

```
git clone https://github.com/Laradock/laradock.git

cd laradock

cp env-example .env

docker-compose up -d nginx mysql workspace 
```

Note: The containers use the ports 80 and 3306. Please,
don't have any programs running on these ports in your machine.

### Configure the project

```
docker exec -ti laradock_workspace_1 composer install

docker exec -ti laradock_workspace_1 php bin/console d:s:u --force

docker exec -ti laradock_workspace_1 php bin/console doctrine:fixtures:load

docker exec -ti laradock_workspace_1 php bin/phpunit
```

### Open the proyect

```
http://localhost/
```
