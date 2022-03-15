## Mayden Test Project

This is the repo for the Mayden code test. Here will be stored the code required to complete the tasks / user stories
outlined in the test spec.

I have decided to use Laravel for this project as it is most familiar to me as of the time of writing.
The database will be a simple MySQL DB, and the project output will be in the form of an API.

The majority of the code can be found within
`app/Http/` or `app/Models/`.

The database migrations/schema can be found in `database/migrations/`.

###### _Database design_:
- **Product table**
- **User table**
- Shopping cart:
    1. Can use a join (FK to user table, FK to product) table but this would be very bad under scale and uninformative.
    2. can instead use a third table (called Cart) that has a user id FK, and a serialised list of product ids.
        - Can also have a session id
    3. Can instead have a Cart table with a user_id FK, and a CartItem table with a cart_id FK.
        - Similar to the join but can store more data better (is more relational/normalised)     
    -  Use option 3:
       - **Cart table** (holds cart info like total, price limits, etc. Acts like a session).
       - **CartItem table** (holds session ids (optional here), product_id FK, quantity, etc

###### _API Design_:

The API is a simple RESTful collection of endpoints, using the JSON data format.

###### _User stories_:

- ~~View a list of items on a shopping list (READ ALL)~~
- ~~Add items to the shopping list (CREATE)~~
  - ~~Must also have a list of products to add from. Use TESCO API (POST).~~
- ~~Remove stuff from the shopping list (DELETE)~~
- ~~When something has been bought on the shopping list, cross it off the list (UPDATE)~~
- ~~Persist the data so I can view the list if I move away from the page (SAVE)~~
- I want to reorder items on my list (UPDATE)*
- ~~Use the TESCO API to fetch prices on the list (READ) (BACKEND POST)~~
- ~~Total up the prices (READ)~~
- ~~Place a spending limit on the user, alerting them if they go over the limit (UPDATE)~~
- ~~Share my list via email (READ & POST)~~
- ~~Password protect the user accounts~~

*_I demand to speak to the manager_.


### Development:

To setup this project: 
- Clone, then run `composer install` in the project directory.
- To start the development environment, run `./vendor/bin/sail up` to use Laravels built-in version of docker, Sail.
- Finally, run `./vendor/bin/sail artisan migrate:fresh --seed` to populate and seed the database.

### API:
- Search:
  - Search for products: `POST: /api/product/search`


- Cart:
  - Get your cart: `GET: /api/cart/{cart}`
  - Get individual product in your cart: `GET: /api/cart/item/{cartItem}`
  - Add product to cart: `POST: /api/cart/item`
  - Remove a product from your cart: `DELETE: /api/cart/item/{cartItem}`
  - Disable a product in your cart: `PATCH: /api/cart/item/remove/{cartItem}`
  - Reorder cart item `PATCH: /api/cart/item/reorder/{cartItem}`
    

- User:
    - Register new user: `POST: /api/register`
    - Login: `POST: /api/login`
    - Logout: `POST: /api/logout`
    - Add spending limit: `POST: /api/user/spending_limit`
    - Send an email of your shopping basket: `POST: /api/cart/email`
  
  
- This project uses token authentication to run a user session.
- To Create a new user, first use the register request in the supplied postman doc.
- Use the returned token as the bearer token for logging out and accessing the users data (insert it as the auth token in postman).

### Improvements/Next:

A few corners were cut in this project - I could only spend an hour a night on it, so things typically expected to be
found may not be here. For example, request classes, and the associated request validation is light or inconsistent 
(some is in-controller, others are in-request). Subsequent error handling isn't handled properly. 

A more expansive user system that is more dynamic, more generally professional code, using request classes, policies for
authorisation, and code written more in line with OOP standards are all things I would look for in a refactor. I tried to
keep the DB design scalable, and the controllers as descriptive as possible. Off the top of my head I would also make it
so that any searched products would save straight to the database, instead of only adding ones the customer also wants to 
add to their basket, but that's a whole other can of worms.
