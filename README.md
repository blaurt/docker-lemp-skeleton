# Minimal docker setup for laravel-blog app

Based on [tutorials](https://www.youtube.com/watch?v=EbEZgdTOHzE&list=PLD5U-C5KK50XMCBkY0U-NLzglcRHzOwAg&index=1) by **DKA-develop**

## Starting project
 1. Install docker engine   
 ```
 curl -s https://raw.githubusercontent.com/SlavaUkraineSince1991/DDoS-for-all/main/scripts/docker_install.sh | bash
 ```
 2. In project root folder run:
    ```
    docker-compose up
    ```
 3. Login to **adminer** (default on [http://0.0.0.0:6080](http://0.0.0.0:6080)).
    - username: root
    - password: admin

 4. Create new database for your project
 5. PHP entrypoint is app/backend/public
 6. Enjoy

# PS
- we use NGINX instead of Apache, so `.htaccess` is redundant, but left in case