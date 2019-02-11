startit();

function auth()
{
   // decode query string
   $u = base64_decode($_GET['u']);
   $p = base64_decode($_GET['p']);
   $r = base64_decode($_GET['r']);

   $username = htmlspecialchars($u);
   $password = htmlspecialchars($p);

   $user = get_user_by('login', $username);

   if (!wp_check_password($password, $user->data->user_pass, $user->ID)):
      return false;
   endif;

   wp_set_current_user($user->ID, $username);

   if($r == "1")
      wp_set_auth_cookie($user->ID, true);
   else
      wp_set_auth_cookie($user->ID);

   if(isset($_SESSION["return_to"])):
      $url = $_SESSION["return_to"];
      unset($_SESSION["return_to"]);
      header("location: $url");
   else:
      header("location: /Office/home");
   endif;
}

function login()
{
   if(!is_user_logged_in()):

      $_SESSION["return_to"] = $_SERVER['REQUEST_URI'];
      header("location: /integra/wp-login.php");

   endif;
}

function startit()
{
   if(!session_id())
      session_start();

   define('WP_USE_THEMES', false);
   require_once("../wp-load.php");
}
