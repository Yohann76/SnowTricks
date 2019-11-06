# Symfony - Yohann Durand - SnowTricks

Welcome to Symfony SnowTricks by Yohann Durand !

This project is a student project for openclassrooms,
This website is a open-source blog/SnowTricks with a Symfony architecture.
The website have a administration zone where you can manage a Tricks.

<a href="https://codeclimate.com/github/Yohann76/SnowTricks/maintainability"><img src="https://api.codeclimate.com/v1/badges/8bd6079c9cf3a62a6c86/maintainability" /></a>
## Technology 

This site is developed with PHP and the symfony framework. 
This architecture proposes a reutilisable code and easy to maintain. It also provides good practice like MVC layout and object oriented

### For use this project...

##### clone this project with github
```
git clone
```

change your environment variables

##### install dependence
```
Composer install
```
##### Create database
```
php bin/console doctrine:database:create
```
##### database migration
```

php bin/console doctrine:migrations:migrate
```

##### load fixtures
```
php bin/console doctrine:fixture:load
```

## Deployment

##### For Ansible, create your ansible/hosts.ini and ansible/templates/.env and run:
```
ansible-playbook ansible/playbook.yml -i ansible/hosts.ini --ask-vault-pass
```

##### For Docker run :
run this project with docker containers (docker-compose included in this repository )
```
docker-compose up -d
```
##### This website is available in "yohanndurand.fr" 

## Testing 
For generate a coverage-html
```
php bin/phpunit --coverage-html public/data 
```
Testing Symfony Website
```
php bin/phpunit
```

If you use the project on a local server, 
Please check if your server is configured to send mail.

if you want to modify this project,
the following links you may be useful

1. https://symfony.com/doc/current/index.html#gsc.tab=0
2. https://swiftmailer.symfony.com/docs/introduction.html#installation
3. https://getbootstrap.com/
4. https://docs.ansible.com/ansible/latest/index.html

## Other information 

The graphical data model is accessible in the SQL file. You can also find the UML shema in the respective file
License : Free

Standard :

1. PSR2 ( https://www.php-fig.org/psr/psr-2/ )






