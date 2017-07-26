Yii 2 Advanced Project Template (Тестовый проект)
===============================

Тестовый проект. 

## Установка

```bash
git clone https://github.com/savenko/prhol.git .
php composer.phar self-update
php composer.phar update
php init

vagrant up
vagrant ssh
```
Создайте Базу Данных и выполните миграции

```bash
cd /var/www/public
php yii migrate/up
```


## Первый запуск сайта

Перейдите в раздел http://prhol.local/admin/ , 
система попросит Вас установить логин и пароль 
администратора. После чего Вы сможете авторизироваться 
в административной части сайта