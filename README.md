# Build a module with the Stream API #

- The Stream API, what is it?
- Why is it better?
- How it works?


## The Stream API, what is it? ##

The Stream API is, like many API, an abstraction of business logic (often) long and repetitive.
It applies to the handling of the database and aims to make them simpler and shorter.

With this API, it becomes very easy to manipulate information in a persistent language PHP ONLY!
It is no longer necessary (almost in the majority of cases) to query your database in SQL format.

The API consists of several tools called by the name "drivers" that govern each of the sets of actions. We found 5:

* Streams, the manager of the tables in your database.
* Fields tool data fields for your tables.
* Entries, the device data manipulation (create, read, update and delete - CRUD).
* CP (control panel routines), a mechanical form generation in the administrative panel.
* Utilities driver for handling integration of SQL tables Stream format.

You should also know that to complement and extend to a maximum use case, the API includes its own types of fields, "fields types", which are small libraries (features). Their role is to manipulate data in their applications and verify that it is in proper form.
Thus, it ensures web applications without their good functioning addict.

Note: The field types are themselves abstractions of database fields (VARCHAR, TEXT, INT, BOOL etc. ..). And allow to remain in a specific set any PHP.


## Why is it better? ##

As tell by John Corry (http://vimeo.com/42722025), PyroCMS is a very good web content manager that runs mostly in further reducing the code to produce, and therefore human error, and therefore long hours of research to fix his mistakes, and thus get even more satisfaction.

Once again, this API inherits all tedious work that makes us think the team PyroCMS. We will soon go to practice, but imagine yourself already at the time of designing your next application. You will produce less code than usual, worry less bugs than usual and you will get an application reliable and easy to maintain, that asked more?


## How does it work? ##

So we'll put in a position to make a simple module, a small link manager, quick and easy allowing you to upload your links or youtube videos links.

To do this, you should be a little familiar with PyroCMS.

