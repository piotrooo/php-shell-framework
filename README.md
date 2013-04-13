PHP Shell Framework by Piotr Olaszewski
================================

This framework can be used to creating fully shell scripts.

Creating new application
-------------------------------
To create new application, you must create a new PHP file to __app/Console__ location, name of this should be __*<YourApplicationName>*Shell.php__.

Newly created file should have number of requirements:
* Name of class inside file should be corresponding name to file.
* Class should extends from __Shell__ and implements __ShellApplicationInterface__.
