
--Wordpress Integra--


In order to integrate wordpress with any external system, you need to provide access to wordpress functions.

This works with same domain name, with a little tweak here and there probably it's possible to work with different domain names.

Let's say your wordpress installation is located here: domain.tld/wp/ and your external system is located here: domain.tld/integra/


**WordPress (domain.tld/wp/)**

You have to create a new folder under /wp/, for example I created a folder called /wp/integra/ with the same name of my external system just to keep things clear.

Now create 2 new files under /wp/integra/, /wp/integra/wp-auth.php and /wp/integra/wp-login.php

wp-login.php is responsible to call wp-auth.php functions, I just separete the files for make it a clear understand, but you 
may use only one file if you wish.

wp-auth.php is responsible to call wp-load.php a core file of wordpress, you will never touch the core files in this integration, we just make calls 
for the wordpress functions.

auth() function will call 4 other functions with the wordpress core: get_user_by(), wp_check_password(), wp_set_current_user() and wp_set_auth_cookie().

login() function will call another wordpress core function is_user_logged_in() to verify if the user is logged, otherwise send it to a login page.


**integra (domain.tld/integra/)**

In my external system I have a login page with validation for that system, and after validation passed generally I would redirect 
the user to the profile area, but in this case with the wordpress integration I redirect the user to ```/wp/integra/wp-login.php```.

from my login script:

```
$query_string = 'u=' . base64_encode($username) . '&p=' . base64_encode($password) . '&r=' . base64_encode($remember);
header('Location: ../../../wp/integra/wp-login.php?' . $query_string, TRUE, 308);
```

Since it was a POST request in my login, I just redirect with 308 code, but google chrome seems to keep the request type only 
but not the post data, in this case as you can see I used a ```$query_string``` variable to pass as an argument.

