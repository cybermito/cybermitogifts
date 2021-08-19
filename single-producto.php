<?php get_header(); ?>

<main class='container my-3'>
    <h1><?php the_title() ?></h1>
    <!-- Loop principal de los productos -->
    <?php if(have_posts()){
            while(have_posts()){
                the_post();
            ?>                
                <div class="row my-5">
                    <div class="col-md-6 col-12">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                    <div class="col-md-6 col-12">
                        <?php the_content(); ?>
                    </div> 
                </div>
                <!-- Creamos el apartado de productos relacionados -->
                <?php $ID_producto_actual = get_the_ID(); //Obtenemos el ID del post actual?> 
                <!-- creamos un array de argumentos con el contenido que vamos a obtener de productos. -->
                <?php $args = array(
                    'post_type' => 'producto',
                    'post_per_page' => 6,
                    'order' => 'ASC',
                    'orderby' => 'title',
                    'post__not_in' => array($ID_producto_actual), //Con esto indicamos que en el loop no nos saque el post actual.
                );
                /* En la siguiente variable se define el contenido
                que vamos a solicitar a la base de datos a través del array
                de argumentos previamente definidos.
                Ahora la variable productos es un objeto con la configuración
                necesaria para solicitar contenido.
                */
                $productos = new WP_Query($args); ?>

                <!-- Ahora ejecutamos el loop con el objeto productos que nos sacará los productos relacionados. --> 
                <?php if ($productos->have_posts()){ ?>
                    <div class="row justify-content-center productos-relacionados text-center">
                        <div class="col-12">
                            <h3>Productos Relacionados</h3>
                        </div>                        
                        <?php while($productos->have_posts()){
                            $productos->the_post(); ?>
                            <div class="col-2 my-3 text-center">
                                <?php the_post_thumbnail('thumbnail'); ?>
                                <h4>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                
            <?php
            } 
    } ?>

</main>
<?php get_footer(); ?>