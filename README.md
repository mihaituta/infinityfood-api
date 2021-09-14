<h1 align="center">
  <img src="https://user-images.githubusercontent.com/41682806/133333582-d3e7f099-2a99-4a07-8ffb-f8427ee322f2.png"/><br/>
</h1>

# Infinity Food API
**InfinityFood** is the project I made for my thesis when I graduated from college.

This is the **back-end API** part of the project.
<br>
**Front-end** github link can be found 
<a href="https://github.com/mihaituta/infinityfood" rel="noreferrer" target="_blank">here.</a>

<a href="https://infinityfood.netlify.app" rel="noreferrer" target="_blank">Live demo</a>

Administration page can be accessed
<a href="https://infinityfood.netlify.app/login" rel="noreferrer" target="_blank">here</a> 
or by adding **/login** after the url.

Demo **admin** account(to create a restaurant): email: admin@gmail.com password: 123123.
<br>
Demo **staff** account(to manage a restaurant): email: staff@gmail.com password: 123123.

# Technologies
- **PHP**
- **Laravel**
- **MySQL**
- **Cloudinary** to manage images
- It is is hosted on **Heroku** so requests may take a few seconds

# Functionalities
**InfinityFood** is a website for presenting and managing restaurants.
<br>
**Users** can search for restaurants by name, filter restaurants by city, and order food.

The website also has an administration section, which can only be accessed via the URL link, it does not exist on the main website.

There are two types of users, administrators and staff members.

**Administrators** can:
- Add, modify or delete restaurants
- Add, modify, or delete other admin or staff accounts

**Staff members** can:
- Manage the website of the restaurant they belong to, they can change everything related to the restaurant page, title, images, texts, phone numbers, emails
- Add, modify, or delete the restaurant menus
- See, change status(delivering/delivered) and delete the restaurant orders maded by users
# Installation

Project setup:
```
composer install
```
Start local server:
```
php artisan serve
```

# Images
<img src="https://user-images.githubusercontent.com/41682806/133335788-819b36fd-5e9d-423d-bb2c-7a771f1b057c.jpg"/>

<img src="https://user-images.githubusercontent.com/41682806/133335863-1cfeea41-9d65-43ac-97f2-7c6bffec48df.jpg"/>

<img src="https://user-images.githubusercontent.com/41682806/133335877-81537c1e-9dbf-420a-a853-e214b23baca5.jpg"/>

<img src="https://user-images.githubusercontent.com/41682806/133335893-4f3ac6bc-433d-4c93-bbcf-5632a3684945.jpg"/>

## Contact
tutamihai@gmail.com