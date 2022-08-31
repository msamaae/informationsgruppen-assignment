## How to use

1. Clone the repo

    ```sh
    git clone https://github.com/your_username_/Project-Name.git
    ```

2. To get started with the backend, cd into server folder

3. Copy **.env.example** file to **.env** and edit database credentials there

4. If you want to use sqlite, change db connection in .env to **DB_CONNECTION=sqlite** and run:

    ```sh
    touch database/database.sqlite
    ```

5. Run:

    ```sh
    composer install
    php artisan key:generate
    php artisan migrate
    ```

6. Thats's it, launch the server with:

    ```sh
    php artisan serve
    ```

7. To get started with the frontend, cd into client folder

8. Run:

    ```sh
    npm install
    ```

9. Copy **.env.example** file to **.env** and edit server connection there

    ```sh
    Example: VUE_APP_LARAVEL_API=http://127.0.0.1:8000/api
    ```

10. Thats's it, launch the client with:
    ```sh
    npm run serve
    ```
