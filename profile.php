<?php include("./inc/header.inc.php"); ?>
<?php
$first_name = "Default";
        $last_name = "User";
if (isset($_GET['u'])) {
  $username = mysqli_real_escape_string($conn,$_GET['u']);

  if(ctype_alnum($username)){
    $check = mysqli_query($conn, "SELECT first_name, last_name, bio, profile_pic FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check)===1) {
        $get=mysqli_fetch_assoc($check);
        $first_name = $get['first_name'];
        $last_name = $get['last_name'];
        $bio = $get['bio'];
        
    }
    else{
        header("location: index.php");
        }
    }
  } 

  $post = @$_POST['newpost'];
if($post != ""){
    $date_added = date("d-m-y");
    $added_by = $user; 
    $user_posted_to = $username;

$query = mysqli_query($conn, "INSERT INTO posts (body,date_added,added_by,user_posted_to) VALUES('$post','$date_added','$added_by','$user_posted_to')");

if (!$query) {
    die("QUERY ERROR");
}
else{
}
}

$check_pic = mysqli_query($conn,"SELECT profile_pic FROM users WHERE username='$username'");
  $get_pic_row = mysqli_fetch_assoc($check_pic);
  $profile_pic_db = $get_pic_row['profile_pic'];
        if ($profile_pic_db == "") {
            $profile_pic =  "img/kid.jpg";
        }
        else{
            $profile_pic = "userdata/profile_pics/".$profile_pic_db; 
        }
?>






    <title><?php echo "$first_name"." $last_name"; ?></title>
    <link rel="stylesheet" href="css/newstyle.css" type="text/css">

</head>


<body id="personal">

    <!--Header with Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top flex-md-nowrap p-0 shwadow">

      <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" style="font-size: 30px;" href="#">SOClAl</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <form class="form-inline my-2 mr-auto my-lg-0 search">
          <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav mr-5">


          <li class="nav-item active">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <div class="second-icon menu-icon">
                <?php echo '<span><a class = "nav-link "href="'.$username.'" title="Profile"><span class="hidden-xs hidden-sm">'.$first_name.'</span> </a>
                </span>' ; ?>
            </div>
          </li>

           <li class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Notifications <span class="badge">2</span>
            </span>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Not 1</a>
              <a class="dropdown-item" href="#">Not 2</a>
              <a class="dropdown-item" href="#">Not 3</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Al Notifications</a>
            </div>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              More
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="account_settings.php">Accounts Settings</a>
              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">LogOut!</a>
            </div>
          </li>

         

        </ul>
      </div>  


    </nav>

    <!--Left Sidebar with info Profile -->
    <nav class="sidebar col-md-2 d-none d-md-block bg-light">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item text-center p-5">
                    <img src=<?php echo "$profile_pic";?> alt=<?php echo "$first_name"; ?> class="rounded-circle" width = "150">
                </li>
                <li class="nav-item ">
                    <h2 class="text-center hidden-xs"><a href="personal-profile.html" title="Profile"><?php echo "$first_name"." $last_name"; ?></a></h2>
                </li>
                <li class="nav-item"><p class="text-center user-description hidden-xs">
                        <?php echo "$bio"; ?>
                    </p>
                </li>
            </ul>
        </div>
        
    </nav>


    <div class="container">
        <div class="col-md-9 ml-sm-auto col-lg-10 p-4 mt-5">
        <div class="banner-profile">
        </div>
        <!-- Tab Panel -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#posts" role="tab" id="postsTab" data-toggle="tab" aria-controls="posts" aria-expanded="true">Last posts</a></li>
            <li><a href="#profile" role="tab" id="profileTab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Profile</a></li>
            <li><a href="#chat" role="tab" id="chatTab" data-toggle="tab" aria-controls="chat" aria-expanded="true">Chat</a></li>
        </ul>

        <!--Start Tab Content-->
        <div class="tab-content">
            

            <!-- Add Posts -->
            <div class="tab-pane active" role="tabpanel" id="posts" aria-labelledby="postsTab">
                <div id="posts-container" class="container-fluid container-posts">
                    <div class="card-post">
                        <div class="row">
                            <form id="post_form" action="<?php echo $username; ?>"  method="post" class="col-sm-12">
                                    <!-- <div style="background-color: #efefef99; color: #0000048f; max-height: 30px; font-weight: bold; padding: 2px 10px; border-radius-top: 3px; max-width: 90%;"> Add a Post <span id="post_submit_info" style="float: right;"> </span></div>
                                     --><textarea id="post_body" name="newpost" style="width: 90%;" rows="4"></textarea>

                                    <input type="submit" id="submit_post" value="POST" style="float: right; background-color: #EEFFGG; max-width: 10%;">

                            </form>
                        </div>
                    </div>

            <!-- Tab Posts -->
            

            <?php
            $getposts = mysqli_query($conn, "SELECT * FROM posts WHERE user_posted_to = '$username' ORDER BY id DESC LIMIT 10" ) or die("Error getting posts");
            while ($row = mysqli_fetch_assoc($getposts)) {
                $id = $row['id'];
                $body = $row['body'];
                $date_added = $row['date_added'];
                $added_by = $row['added_by'];
                $poster_query = mysqli_query($conn, "SELECT first_name, last_name, profile_pic FROM users WHERE username = '$added_by'");
                $get_poster = mysqli_fetch_assoc($poster_query);
                $poster_fname = $get_poster['first_name'];
                $poster_lname = $get_poster['last_name'];
                $poster_profile_pic = "userdata/profile_pics/".$get_poster['profile_pic'];
                $user_posted_to = $row['user_posted_to'];
                echo '
                <form action= "" method = "POST" id="delete_form">
                <div class="card mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class=col-md-2>
                                <a href="'.$added_by.'" title="Profile">
                                    <img src="'.$poster_profile_pic.'" alt="User name" class="rounded-circle" width="100">
                                </a>
                                </div>
                                <div class="col-md-10 col-sm-10 ">
                                <h3 class="mb-0"><a href="'.$added_by.'" title="Profile">'.$poster_fname.' '.$poster_lname.'</a></h3>
                                <p class="text-muted mb-0" style="font-size: 1rem;"><i>'.$date_added.'</i></p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 offset-sm-2 card-text">
                                <p>'.$body.'</p>
                            </div>
                        </div><div class="container ">
                                    &#x2764; 156 &#x1F603; 54
                            </div>
                        <div class="card-footer">
                            <div class="text-muted">View more comments</div>
                            <ul>
                                <li><b>Roli</b> Nice Work.</li>
                                <li><b>Somya</b> I am here too. &#x1F602;</li>
                            </ul>
                            <form>
                                <input type="text" class="form-control" placeholder="Add a comment">
                            </form>
                        </div>        
                    </div>
                    </form>
                
                    ';

                    
            }
            ?>
                    

                </div>
                <!-- Preloader -- >
                <div id="loading">
                    <img src="img/load.gif" alt="loader">
                </div>
            </div><!-- end Tab Posts -->

            <!--Start Tab Profile-->
            <div class="tab-pane " role="tabpanel" id="#profile" aria-labelledby="profileTab" display="block">
                <div class="container-fluid container-posts">
                    <div class="card-post">
                        <ul class="profile-data">
                            <li><b>Username:</b> User</li>
                            <li><b>Age:</b> 26</li>
                            <li><b>Hobbies:</b> trecking and cooking</li>
                            <li><b>Studies:</b> University of World</li>
                            <li><b>Job:</b> Full stack Developer</li>
                            <li><b>Description:</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                        </ul>
                        <p><a href="" title="edit profile"><i class="fa fa-pencil" aria-hidden="true"></i> Edit profile</a></p>
                    </div>
                </div>
            </div><!-- end tab Profile -->

            <!-- Start Tab chat-->
            <div class="tb-apane " role="tabpanel" id="chat" aria-labelledby="chatTab">
                <div class="container-fluid container-posts">
                    <div class="card-post">
                        <div class="scrollbar-container">
                            <div class="row row-user-list">
                                <div class="col-sm-2 col-xs-3">

                                </div>
                                <div class="col-sm-7 col-xs-9">
                                    <p><b>User Name</b> <span class="badge">1</span></p>
                                    <p class="chat-time">An hour ago</p>
                                    <p>Lorem ipsum</p>
                                </div>
                                <div class="col-sm-3 hidden-xs">
                                    <p><a href="" title="Replay"><span class="badge badge-replay">Replay ></span></a></p>
                                </div>
                            </div>
                            <div class="row row-user-list">
                                <div class="col-sm-2 col-xs-3">
                                    <img src="img/user3.jpg" alt="User name" class="rounded-circle ">
                                </div>
                                <div class="col-sm-7 col-xs-9">
                                    <p><b>User Name</b></p>
                                    <p class="chat-time">Yesterday</p>
                                    <p>Lorem ipsum</p>
                                </div>
                                <div class="col-sm-3 hidden-xs">
                                    <p><a href="" title="Start chat"><span class="badge badge-message">Start chat ></span></a></p>
                                </div>
                            </div>
                            <div class="row row-user-list">
                                <div class="col-sm-2 col-xs-3">
                                    <img src="img/user4.jpg" alt="User name" class="rounded-circle  ">
                                </div>
                                <div class="col-sm-7 col-xs-9">
                                    <p><b>User Name</b></p>
                                    <p class="chat-time">2 days ago</p>
                                    <p>Lorem ipsum</p>
                                </div>
                                <div class="col-sm-3 hidden-xs">
                                    <p><a href="" title="Start chat"><span class="badge badge-message">Start chat ></span></a></p>
                                </div>
                            </div>
                            <div class="row row-user-list">
                                <div class="col-sm-2 col-xs-3">
                                    <img src="img/user5.jpg" alt="User name" class="rounded-circle">
                                </div>
                                <div class="col-sm-7 col-xs-9">
                                    <p><b>User Name</b></p>
                                    <p class="chat-time">2 days ago</p>
                                    <p>Lorem ipsum</p>
                                </div>
                                <div class="col-sm-3 hidden-xs">
                                    <p><a href="" title="Start chat"><span class="badge badge-message">Start chat ></span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Tab chat-->

        </div><!-- Close Tab Content-->

    </div>
    </div><!--Close content posts-->

    <!-- Modal container for settings--->
    <div id="settingsmodal" class="modal fade text-center">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

</div>
    <?php include("./inc/footer.inc.php"); ?>

