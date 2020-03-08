ITC Compliance Task

Hi Guys,

First of all then you very much for the opportunity to complete the task.
I will share with you some information about the project below:

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
