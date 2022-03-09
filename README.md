## Mayden Test Project

This is the repo for the Mayden code test. Here will be stored the code required to complete the tasks / user stories
outlined in the test spec.

I have decided to use Laravel for this project as it is most familiar to me as of the time of writing.
The database will be a simple MySQL DB, and the project output will be in the form of an API.

_Database design_:
- **Product table**
- **User table**
- Shopping cart:
    1. Can use a join (FK to user table, FK to product) table but this would be very bad under scale and uninformative.
    2. can instead use a third table (called Cart) that has a user id FK, and a serialised list of product ids.
        - Can also have a session id
    3. Can instead have a Cart table with a user_id FK, and a CartItem table with a cart_id FK.
        - Similar to the join but can store more data better (is more relational/normalised)     
    -  Use option 3:
       - **Cart table** (holds cart info like total, price limits, etc)
       - **CartItem table** (holds session ids (optional here), product_id FK, quantity, etc

_API Design_:

The API is a simple RESTful collection of endpoints, using the JSON data format.
