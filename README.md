ITC Compliance Task

Description of the test:
This coding exercise is an opportunity for you to showcase your abilities, specifically relating
to PHP and object oriented programming.
You should submit code that you would expect to pass code review.
How much time you spend on this is up to you - but there’s no benefit in rushing.
Some pointers:    
● Object oriented code    
● SOLID    
● Composition over inheritance    
● PHP7 (we use PHP7.2)    
● No singletons    
● Follow a coding standard, e.g. PSR-2 (or other, please specify)    
● Separate backend and frontend code    
● Demonstrate unit testing knowledge (or give it your best shot)    
Webservice Documentation 
This is brief documentation for the recruitment webservice. Anything not listed here you are expected to diagnose or reverse engineer yourself.

Your Aim
Using the webservice list the products that are available.
Handle any errors
For each insurance product returned, get more infomration and display
Basics
The webservice can be accessed at https://www.itccompliance.co.uk/recruitment-webservice/api/ and provides 2 methods list and info. Append the method names to the URL to use them.

List
Returns a list of insurance products as a json array in the form {"products": {"id": "name", "id": "name"}}

Info
Gets information about a specific insurance product as a json array in the form {"id": {"name": "...", "description": "...", "type": "...", "suppliers": ["name", "name"]}}. Add the product ID as a query string like ?id=...

Known Issues
Unfortunately this data is retrieved from an unreliable source and the webservice may return an error. When this occurs, simply re-try the request until it succeeds.
Data is provided directly from a third-party and should be sanitised.

My implementation:

General:

My PHP version is 7.4, and I used composer, so you will need to issue composer install 
after you downloaded the source code.
Also, please rename the dotenv file to .env.

I used few PHP 7 features, such as the parameter type declaration, return type declaration, 
the null coalescing operator, and the new USE syntax (see the ProductsManagerTest class).
I used the PSR4 coding standards, and autoloading.
The Logger class has no implementation, the class has the sole purpose to demonstrate how a "Dummy" works in the unit tests.

All the unit tests can be found in the test library, and the tests can be run by issuing vendor/bin/phpunit from the 
project home directory.

SOLID:

I tried to apply SOLID principles in my code, and also the source code favours composition over inheritance.

SRP: All Classes I created should have one responsibility/task or in other words one reason to change. 
A potential breach of SRP would be, if the product manager class would call the api, 
or validate the API return data itself.

OCP: Because I use Dependency Injection, and I inject interfaces, there is no need to touch the source code 
in order to extend the functionality. So for example, if you want a different data validating algorithm, you can 
just create a new class implement the DataValidator interface, and then inject it to the Client Code.

LSP: I did not find a way to showcase the Liskov Substitution Principle, this principle says, 
that if B inherits from A,  then B should be interchangeable with A. 
(signature must match, pre-conditions can't be greater, post conditions at least equal, exception types should match)

ISP: There is no code which shows the Interface Segregation Principle, which says, 
that a class should not implement an interface it does not use.
This principle promotes "skinny interfaces"

DIP: Dependency Inversion Principle says, that high-level modules should not depend on low-level modules. 
Both should depend on abstractions. Abstractions should not depend on details. Details should depend on abstractions.

To follow the above principle the class methods always expect interfaces instead of concrete classes.

Testing:
My unit tests should satisfy the FIRST (Fast, Independent/Isolated, Repeatable, Self-Validating, Thorough) principle, 
and I also demonstrate the use of different type of test doubles (Mock, Stub, Fake, Dummy, Spy).

Composition over inheritance:
My design favours composition when classes communicate. So for example, The Product Manager class 
has-a (composition, instead of inheritance -> is-a) relationship with the data validator class, and the API helper class. 
Composition has advantages, such as:
1, code is duplicated across subclasses
2, runtime behaviour changes are difficult
3, hard to gain knowledge of class behaviours
4, changes can unintentionally change other classes

Singleton pattern:
My design avoids (evil! :) ) mutable global state, such as static variables and functions, global variables, singletons, 
which makes the code unpredictable, prone to bugs and also very difficult to test.  
There are constants I use for the API endpoints, but those are immutable, so those should be OK in my opinion.
