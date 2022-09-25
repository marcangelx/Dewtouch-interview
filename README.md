# Dewtouch-interview

Requirements :
- 1.) I have used the XAMPP as a web server.
- 2.) The php_pdo_mysql.dll extension must be enabled for version compatibility.
- 3.) Kindly use the PHP5 version.

[REF: CakePHP  2](https://book.cakephp.org/2/en/contents.html)


## Installation
Clone the repository
```python
git clone https://github.com/marcangelx/Dewtouch-interview.git
```

Pull the branches and check out to develop branch
```python
# git fetch -all / git pull origin
git pull origin master

# go to develop branch
git checkout develop
```
Database connection
- Kindly create your database at the XAMPP admin
- And configure the database connection at app > config > database.php directory
```python
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' 		 => 'localhost', 
		'login'      => 'root',
		'password'   => '',
		'database'   => '', 
		'prefix'     => '',
		'encoding'   => 'utf8',
	);
```

## Credits
Credits to the people who developed the technologies I used in this project. There's no copyright intended and the links to the real owner of the techs are listed above.


