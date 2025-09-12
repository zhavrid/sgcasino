# ___Project_name___

Setup instructions for copying this template [here](https://smartapptech.by/projects/guidelines/wiki/WordPress_Project_initial_setup_from_template?parent=Wiki) 

## Project Init

### Local development installation guide for ____project_name____ 
> This manual is suitable for any operating system and implies that you configured the http server (apache/nginx) yourself, according to the standard WordPress setup.

#### Requirements

* MySQL: `^5.6`
* PHP: `^7.4`
* Node.js mac (optimal): `12.22.12`
* Node.js widows (optimal): `14.20.0`

### Git repository:

Command for initialize project (for clone you can use your GitLab account password or add your local [ssh key](https://docs.gitlab.com/ee/ssh/) in [GitLab settings](https://gitlab.com/profile/keys)):

```
git clone git@gitlab.com:SmartAppTech/bootstrap-wp-theme.git project_name
```

(where `"project_name"` your new folder name for project)


### Starting the server:

Before you start the server, you'll need to create the wp-config file and `set you'r site domain to 'project_name'` (**it is important!** also in the database (project_name initially) you need to change the lines "home" and "siteurl" in the table wp_options to "project_name") by using your local server settings (Apache or Nginx). Also if you using Apache, create [basic wordpress .htaccess file](https://wordpress.org/support/article/htaccess/#basic-wp) in the project root

Create file wp-config.php from wp-config-sample.php file in project root, write your database credentials (`"DB_NAME"`, `"DB_USER"`, `"DB_PASSWORD"`) and put it in the project root (by default wp-config set for database with username 'root' and empty password).

## 1. Database import:

Ask BE developer for a database dump, open CLI in this file directory and run the following commands (The example uses MySQL database with username 'root' and empty password):

```
mysql -uroot -p
```

```
CREATE DATABASE project_db;
exit;
```

```
mysql -uroot -p project_user < "your_db_dump".sql
```

*If you know what to do or it doesn’t work for you, then you can perform the import differently, for example, through phpMyAdmin*

**Note:** It’s normal if after DB import the site does not look complete

## 2. Install composer

To install composer you just need to run this command in the root directory of your theme:

```
composer install
```

## 3. JS and CSS location:
All source js and scss files are stored in the following directories:

```
wp-content/themes/project_name/webpack/src/js
wp-content/themes/project_name/webpack/src/styles
```

## Compile JS and CSS

Go to webpack directory with your terminal and run:

```
npm install
```

To Build js and scss for production run:

```
npm run build
```

To start watch function, which will update your js and css files in the background when you change your js and scss files in webpack/src directory run:

```
npm run watch
```


*This step is needed to hook up all your classes in App directory.*


