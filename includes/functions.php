<?php

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}

	function find_user($username) {
		global $connection;
		
		$safe_username = mysqli_real_escape_string($connection, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM tbl_users ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}

	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 		// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($username, $password) {
		$user = find_user($username);
		if ($user) {
			// found user, now check password
			if (password_check($password, $user["password"])) {
				// password matches
				return $user;
			} else {
				// password does not match
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}

	function attempt_admin_login($username, $password) {
		$user = find_user($username);
		if ($user) {
			// found user, now check password
			if (password_check($password, $user["password"]) && ($user["user_type_id"]==2)) {
				// password matches, and user type is admin
				return $user;
			} else {
				// password does not match
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}
	
	function confirm_logged_in() {
		if (!isset($_SESSION['username'])) {
			redirect_to("login_form.php");
		}
	}	

	function confirm_admin_logged_in() {
		if (isset($_SESSION['user_type_id'])){
			if (!($_SESSION['user_type_id'] == 2)) {
				redirect_to("index.php");
			}
		}else{
			redirect_to("index.php");
		}
	}

	function find_inventory($id) {
		global $connection;
		
		// Sanitize the id to prevent injection attacks
		$safe_id = mysqli_real_escape_string($connection, $id);
		
		$query  = 'SELECT tbl_inventory.*, tbl_titles.title, tbl_comics.number, tbl_comics.variation_text FROM tbl_inventory ';
        $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
        $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
        $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
		$query .= "WHERE inventory_id = '{$safe_id}' ";
		$item_set = mysqli_query($connection, $query);
		confirm_query($item_set);
		if($item = mysqli_fetch_assoc($item_set)) {
			return $item;
		} else {
			return null;
		}
	}

	function search($search_term) {
		global $connection;

		// Sanitize the search term to prevent injection attacks
    	$sanitized = mysqli_real_escape_string($connection, $search_term);
    
	    // Run the query
	    $query  = "SELECT tbl_inventory.*, tbl_titles.title, tbl_comics.number, tbl_comics.description, tbl_comics.creators, tbl_comics.variation_text, tbl_series.series, tbl_publishers.publisher, tbl_grades.grade_text, tbl_grades.grade_number FROM tbl_inventory ";
        $query .= "JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ";
        $query .= 'JOIN tbl_grades ON tbl_inventory.grade=tbl_grades.grade ';
        $query .= "JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ";
        $query .= "JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ";
        $query .= "JOIN tbl_publishers ON tbl_series.publisher_id=tbl_publishers.publisher_id ";
	    $query .= "WHERE tbl_titles.title LIKE '%{$sanitized}%' ";
	    $query .= "OR tbl_comics.description LIKE '%{$sanitized}%' ";
	    $query .= "OR tbl_comics.creators LIKE '%{$sanitized}%' ";
	    $query .= "OR tbl_comics.variation_text LIKE '%{$sanitized}%' ";
	    $query .= "OR tbl_publishers.publisher LIKE '%{$sanitized}%'";
	    
	    $search_results = mysqli_query($connection, $query);
	    confirm_query($search_results);
    
    	// Check results
	    if (!mysqli_num_rows($search_results)){
	      return false;
	    }

    	return $search_results;
	}
?>