<?php 
//Template Name: Página Institucional
get_header(); 
$fields = get_fields(); //Obtenemos en un array todos los campos personalizados de la plantilla. 
?>

<main class='container my-5'>
    <h1 class='my-3'><?php echo $fields['titulo']; ?></h1> <!-- Vamos llamando a cada campo personalizado y poniéndolo donde nos interese --> 
    <?php if(have_posts()){
            while(have_posts()){
                the_post();?>
                <img src="<?php echo $fields['imagen']; ?>" alt="Logo representativo sobre nosotros"> 
                <hr> <!-- Esto dibuja una línea de separación entre contenedores, en este caso genera una línea de 
                sepaación entre el banner y el texto -->     
                <?php the_content(); ?>

         <?php }
    }?>
</main>

<?php get_footer(); ?>