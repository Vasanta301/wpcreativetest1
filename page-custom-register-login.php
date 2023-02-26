<?php
/**
* Template Name: Login Or Register
*/
get_header();

if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    echo 'Welcome, ' . esc_html( $current_user->display_name ) . '!';
    echo '<p>Your email: ' . esc_html( $current_user->user_email ) . '</p>';
    echo '<a href="'.site_url().'/wp-login.php?action=logout">'.__('Logout','WordPress').'</a>';
} else {
?>
  <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
  <input type="hidden" name="action" value="custom_user_registration">
  <label for="username"><?php _e('Username','wordpress'); ?></label>
  <input type="text" name="username" id="username" required>
  <label for="email"><?php _e('Email','wordpress'); ?></label>
  <input type="email" name="email" id="email" required>
  <label for="password"><?php _e('Password','wordpress'); ?></label>
  <input type="password" name="password" id="password" required>
  <input type="submit" value="Register">
</form>
<?php }

if ( isset( $_GET['message'] ) ) {
    switch($_GET['message']){
        case '1':
            $message = 'Invalid username';
        break;
        case '2':
            $message = 'Invalid email address';
        break;
        case '3':
            $message = 'Username already exists';
        break;
        case '4':
            $message = 'Email address already exists';
        break;
        default:
        break;
    }
    echo '<p class="error-message">' . $message . '</p>';
}

get_footer();