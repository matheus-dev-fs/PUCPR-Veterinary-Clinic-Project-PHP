# My PHP MVC Application

This is a simple PHP MVC (Model-View-Controller) application structure designed for easy development and organization of code.

## Project Structure

```
my-php-mvc-app
├── app
│   └── controllers
│       └── HomeController.php
├── public
│   ├── index.php
│   ├── js
│   ├── css
│   ├── images
│   └── icons
├── .htaccess
└── README.md
```

## Description of Files and Directories

- **.htaccess**: Contains rules for URL rewriting. It redirects all requests that do not point to the `public` directory to the `public/index.php` file.

- **app/controllers/HomeController.php**: This file exports a class `HomeController` which contains methods for handling requests related to the home page of the application.

- **public/index.php**: The entry point for the application. It captures the incoming request URL and passes it to the router for processing.

- **public/js**: Directory for JavaScript files used in the application.

- **public/css**: Directory for CSS files that style the application.

- **public/images**: Directory for image files used in the application.

- **public/icons**: Directory for icon files used in the application.

## Installation

1. Clone the repository or download the files.
2. Place the project in your web server's root directory.
3. Ensure that your server is configured to allow `.htaccess` overrides.
4. Access the application through your web browser.

## Usage

Navigate to the application URL in your browser. The application will handle routing through the `public/index.php` file. You can extend the functionality by adding more controllers and views as needed.

## Contributing

Feel free to fork the repository and submit pull requests for any improvements or features you would like to add.