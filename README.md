# Minimal docker setup for laravel-blog app

Based on [tutorials](https://www.youtube.com/watch?v=EbEZgdTOHzE&list=PLD5U-C5KK50XMCBkY0U-NLzglcRHzOwAg&index=1) by **DKA-develop**

## Starting project
 1. Install docker engine   
 2. Install docker-compose   
 3. In project root folder run:
    ```
    docker-compose up
    ```
 4. Login to **adminer** (default on [http://0.0.0.0:6080](http://0.0.0.0:6080))
 5. Create new database
 6. Connect to **web** container
 7. Create new .env file for laravel, copy content from .env.example
 8. Generate new key:
    ```
    php artisan key:generate
    ```
 9. Update laravel`s .env file with your DB credentials
 10. Visit project on [http://0.0.0.0:8070](http://0.0.0.0:8070)

### Planned todos:
- replace apache with nginx
- add cache service
  # freecodecamp-symfony-docker
# freecodecamp-symfony-docker
# freecodecamp-symfony-docker
