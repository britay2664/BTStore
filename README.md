# BTStore
Techstore web page for SDC310L
a# BTStore

BTStore is a PHP web application developed for the SDC310L Server-Side Scripting with PHP course. The project demonstrates server-side development using PHP, MySQL/MariaDB, PHP sessions, and the Model-View-Controller (MVC) design pattern.

## Features

BTStore allows users to:

- View a catalog of products stored in a MySQL/MariaDB database
- View Product ID, Product Name, Product Description, Product Cost, and current cart quantity
- Add products to the shopping cart
- Increase product quantities
- Decrease product quantities
- Remove products completely from the cart
- Prevent product quantities from falling below zero
- Maintain cart contents using PHP sessions
- View only ordered products in the shopping cart
- View individual product totals
- Calculate 5% sales tax
- Calculate 10% shipping and handling
- Calculate the final order total
- Continue shopping without losing cart contents
- Check out and clear the shopping cart

## Technologies Used

- PHP
- MySQL / MariaDB
- HTML
- CSS
- PHP Sessions
- XAMPP
- phpMyAdmin
- Visual Studio Code
- Git
- GitHub

## Application Architecture

The final version of BTStore uses the Model-View-Controller (MVC) design pattern.

### Model

The Model handles database access, shopping cart operations, and order calculations.

Key files include:

- `model/product_db.php`
- `model/cart.php`

### View

The View contains the presentation layer displayed to the user.

Key files include:

- `view/catalog_view.php`
- `view/cart_view.php`

### Controller

The Controller processes user requests and coordinates communication between the Models and Views.

Key files include:

- `Controller/catalog_controller.php`
- `Controller/cart_controller.php`

## Database

BTStore uses a MySQL/MariaDB database named `btstore`.

The `products` table stores the product information used by the catalog.

The database can be recreated using:

`database/btstore.sql`

Database credentials are stored locally in a configuration file that is excluded from Git source control.

## Shopping Cart Calculations

BTStore calculates order totals using the following rules:

- Product Total = Product Cost × Quantity
- Tax = 5% of the subtotal
- Shipping & Handling = 10% of the pre-tax subtotal
- Order Total = Subtotal + Tax + Shipping & Handling

## Testing

The application was functionally tested throughout development and after the final MVC conversion.

Testing included:

- Database connectivity
- Product retrieval
- Catalog display
- Adding products
- Decreasing quantities
- Removing products
- Minimum quantity enforcement
- Multiple-product carts
- Product total calculations
- 5% tax calculation
- 10% shipping and handling calculation
- Final order total calculation
- Cart persistence
- Continue Shopping navigation
- Checkout
- Cart clearing
- MVC routing
- CSS styling
- PHP syntax checking

Problems discovered during testing were corrected and the affected functionality was retested.

## Security

Database credentials are stored separately from the application source code.

The local configuration file is excluded from GitHub using `.gitignore` so database credentials are not committed to the repository.

## Project Summary

BTStore was developed throughout the SDC310L Server-Side Scripting with PHP course as a multi-phase PHP web application project. Development began with project planning, database design, and a basic application framework. The application was then connected to a MySQL/MariaDB database so product information could be retrieved dynamically.

Shopping cart functionality was implemented using PHP sessions. Users can add products, decrease quantities, remove products, navigate between the catalog and cart, and maintain their selections during the session. The cart calculates individual product totals, a 5% sales tax, 10% shipping and handling, and the final order total. Checkout clears the cart and returns the user to the product catalog.

The application was later reorganized using the Model-View-Controller design pattern. Database access was separated into the Product Model, shopping cart operations and calculations were placed in the Cart Model, Controllers were used to process application requests, and Views were used for the user interface.

During development, several issues required troubleshooting, including Git synchronization, PHP and HTML structure, database credential security, MVC routing, CSS paths, and a MariaDB system-table corruption problem. These issues were corrected and the application was retested.

The completed project demonstrates PHP server-side programming, MySQL/MariaDB database integration, session management, MVC application organization, Git/GitHub source control, application testing, troubleshooting, and basic configuration security.