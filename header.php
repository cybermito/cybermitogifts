<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head() ?>
</head>
<body>

<header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4">
               <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri()?>/assets/img/logo.png" alt="logo"></a>
            </div>
            <div class="col-8">
                <nav>
                    <?php wp_nav_menu(
                        array(
                            'theme_location' => 'top_menu',
                            'menu_class'    => 'menu-principal',
                            'container_class' => 'container-menu',
                        )
                    ); 
                    ?>
                </nav>
            </div>
        </div>
    </div>
</header>
    
