<p align="center"><img src="https://go.customer-alliance.com/build/images/logo.png?75938931" width="250"></p>

# Customer Alliance PHP Technical

Test to demonstrate skills and mastery in PHP. 

[API Documentation](https://jvarona05.github.io/customer-alliance-test/public/api.html).

## Requirements

1. We need to improve the code quality by adopting the SOLID principles and/or other best practices.
2. Chain hotels are not defined currently. We need to implement that.
3. Registered Hotels should be able to embed an html/javascript widget in their website.
  The widget should show an average score of all their review scores.
  The widget could consume the average API, that we are providing. The Hotel can potentially have thousands of reviews, so keep that in mind for performance considerations.
4. Currently the average API is using hotelId, but Hotel entity should be identified by a UUID and have a relation to its Reviews.
5. The visual design of the widget is not important. It can be just a centered bold white number on blue background. The size should be 100x100px and it should be positioned fixed on the bottom right corner of the screen.
6. The hotelier should be able to embed their widget by simply pasting a snippet like this before the closing </body> tag of their website:`<script src="http://host-of-the-app/widget/{{UUID}}.js"></script>`Where {{UUID}} is the uuid of the Hotel. To keep this task simple we are not generating other hashes or access keys for using this widget but simply stick to the UUID.
7. The response can be cached by clients for up to 1 hour.

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
```

### Open the proyect

```
http://localhost/
```
