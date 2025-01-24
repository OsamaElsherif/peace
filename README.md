# Peace Framework

Peace is a minimal, extensible PHP framework designed for developers who value simplicity and flexibility. It provides a lightweight core and allows you to assemble your application using only the components you need, offering full control over your architecture and data access.

## Core Principles

*   **Minimalism:** Peace provides a core framework with only the essential features, avoiding unnecessary bloat.
*   **Flexibility:** You have the freedom to choose the components and libraries that best suit your needs.
*   **Extensibility:** You can easily extend Peace by creating your own components, bridges, and modules.
*   **Control:** Peace allows you to have full control over your application's architecture, routing, database access, and templating.
*   **Compatibility:** The framework aims to be compatible with PHP 7.4 and higher.

## Getting Started

### Prerequisites

*   PHP **7.4 or higher**

### Installation (Cloning from GitHub)

1.  Clone the repository:

    ```bash
    git clone https://github.com/OsamaElsherif/peace.git your-project-name
    cd your-project-name
    ```

2.  Configure your database settings in `configs/database.php`.

3. Create a basic project, with a basic controller and a view

```php
// /Peace/Pages/Default/Home.php

<?php
namespace Peace\Pages\Default;

// Import layouts
use Peace\Layouts\MainLayout;

// Import components
use Peace\Components\Div;
use Peace\Components\Heading;

class Home
{
    public static function render()
    {
        MainLayout::render(function () {
            return (
                Heading::render(['class' => 'text-center'], null, 'Hello, World', '1') .
                Div::render('container text-center', null, function () {
                    return (
                       'Welcome to peace framework.'
                    );
                 })
            );
        }, [], [], []);
    }
}
```

```php
// /Peace/router.php
<?php
require_once __DIR__ . '/libs/autoload.php';

// Import the Router class
use Peace\Libs\Config;
use Peace\libs\Router;
use Peace\Pages\Default\Home;

$router = new Router();

$paths = [
    __DIR__ . '\\Config\\database.php',
    // other config files
    // ex. \\Config\\user.config.php
];
$config = new Config($paths);
$config->load();

global $peaceConfig;
$peaceConfig = $config;

// -------------------------------------- ROUTES --------------------------------------------------

$router->get('/', function () {
    Home::render();
});

$router->dispatch();
```
4. run it
```bash
php -S localhost:8000 Peace\router.php
```
### Directory Structure

```
Peace/
├── assets/                     (Static assets: CSS, JS, images, etc.)
├── Bridges/                    (Bridges for external components or libraries)
│   ├── ORM/                   (Bridges for ORMs)
│   │   └── PeaceORM/             (Example Bridge for PeaceORM)
│   │       └── PeaceORM.php
│   ├── PDO/                   (Bridges for PDO connection)
│   │   ├── PDOConnection.php
│   │   └── PDOQueryBuilder.php
│   └── ...
├── Components/                (Reusable UI components for rendering)
├── configs/                   (Configuration files)
├── Layouts/                   (Layouts for view)
├── Factories/                   (Factories for controlling options)
│   └── ConnectionFactory.php   (Factory class for creating connection and entity managers)
├── libs/                      (Core framework functionality)
│   ├── Database/             (Database abstraction layer)
│   │   ├── Abstract/         (Abstract Classes)
│   │   │   ├── AbstractConnection.php
│   │   │   ├── AbstractEntityManager.php
│   │   │   ├── AbstractQueryBuilder.php
│   │   ├── Interface/         (Interfaces for Database Layer)
│   │   │   ├── ConnectionInterface.php
│   │   │   ├── EntityManagerInterface.php
│   │   │   ├── QueryBuilderInterface.php
│   │   └── ...
│   ├── CoreORM/Abstract       (Custom ORM implementation)
│   │   └── AbstractCoreORM.php
│   ├── Repository/        (Generic and specific repositories)
│   │   ├── Abstract/AbstractRepository.php
│   │   └── Interface/RepositoryInterface.php
│   ├── Config.php           (Handles framework and user configurations)
│   ├── autoload.php         (Autoloading mechanism)
│   ├── CookieHandler.php    (Cookie management utilities)
│   ├── Router.php           (Routing system)
│   ├── StaticFilesHandler.php (Static Files Controller)
│   └── ...
├── Pages/                    (Controllers and View Handling)
│   └── ...
├── router.php                (Entry point for the application)
└── ...
```

### Configuration

The framework uses PHP files in `configs` directory to store configuration settings. Each module can have their own configuration. The user can specify a `user.config.php` to overwrite the defaults configurations, and add it to paths variable in routes.

### Usage
NOTE: That is one of the `Peace Ways` for best practices :

1.  **Create a Controller** Create your controller inside `Pages`.
2.  **Create a View** Create your view with the layout that can be implemented in `layouts` folder.
3.  **Define Routes:** Add your routes in `router.php`

### Database Access

Peace uses a powerful abstraction layer, allowing developers to choose multiple connection types, all with their specific functionalities. Peace by default uses the PDO to connect to any database.

The Framework uses interfaces and abstract classes to abstract the different parts of the system

### Adding New Functionalities

You can expand Peace features by adding new functionality to the main project, just by 

1. Installing the dependency
2. Write the Bridge class in Bridges directory

suppoerted bridges by CORE Peace (Databse connection, ORMs)
ongoing (template engines, routing systems)

## Contributing

We welcome contributions from the community! If you'd like to contribute to Peace, please follow these steps:

1.  Fork the repository on GitHub.
2.  Create a new branch for your feature or bug fix.
3.  Write clear, well-commented code.
4.  Write tests for your changes.
5.  Submit a pull request with a clear description of your changes.

**Important guidelines:**

*   Follow the coding standards used in the project.
*   Write descriptive commit messages.
*   Be respectful to other contributors.

### Bug Reporting

If you find any bugs or issues, please create an issue in the GitHub repository.

## License

Peace is licensed under the MIT License.

## Community

*   GitHub: https://github.com/OsamaElsherif/peace
*   Medium: under creation
*   YouTube: under creation

We hope you enjoy using Peace!
