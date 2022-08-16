<?php
/*
Template Name: Formulario de contacto
*/

get_header();
global $wpdb;
?>

<?php do_action('ocean_before_content_wrap'); ?>

<div id="content-wrap" class="container clr">

    <?php do_action('ocean_before_primary'); ?>

    <div id="primary" class="content-area clr">

        <?php do_action('ocean_before_content'); ?>

        <div id="content" class="site-content clr">

            <?php do_action('ocean_before_content_inner'); ?>

            <?php
            if (isset($_GET["sent"])) {
                if ($_GET["sent"] == '1') {
                    echo "<p>El mensaje se envió correctamente</p>";
                } else {
                    echo "<p>Hubo un error al enviar el mensaje por favor vuelva a intentarlo</p>";
                }
            }


            $resultados = $wpdb->get_results("SELECT * FROM wp_paises");

            ?>

            <div class="form_container">
                <h2>Formulario de contacto</h2>
                <span class="form_subtitle">Por favor introduce tus datos para contactarte</span>

                <form class="formulario_contacto" action="<?php echo admin_url('admin-post.php'); ?>" method="POST">
                    <div class="form_group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="form_group">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="apellido" required>
                    </div>
                    <div class="form_group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form_group">
                        <label for="pais">Pais</label>
                        <select name="pais" id="pais">
                            <?php foreach ($resultados as $key) {
                                $pattern = '/"/i';
                                $new_name = preg_replace($pattern, '', $key->name);
                            ?>
                                <option value=<?php echo $new_name; ?>><?php echo $new_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form_group phone_section">
                        <div>
                            <label for="telefono">Telefono</label>
                            <div class="phone_field">
                                <select name=" coutry_pref_tel" id="pref_tel">
                                    <?php foreach ($resultados as $key) {
                                        $new_phone_code = preg_replace($pattern, '', $key->phone_code);
                                        $new_country = preg_replace($pattern, '', $key->name);
                                    ?>
                                        <option value=<?php echo "+" . $new_phone_code ?>>+(<?php echo $new_phone_code; ?>)
                                            <?php echo " $new_country"; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <input type="tel" name="telefono" id="telefono" required>
                            </div>
                        </div>
                    </div>
                    <div class="form_group postal_section">
                        <label for="codigo_postal">Codigo postal</label>
                        <input type="text" name="codigo_postal" id="postal" required>
                    </div>
                    <input type="hidden" name="action" value="process_form">
                    <button type="submit" name="submit" class="form_btn">Enviar</button>
                </form>
            </div>

            <?php do_action('ocean_after_content_inner'); ?>

        </div><!-- #content -->

        <?php do_action('ocean_after_content'); ?>

    </div><!-- #primary -->

    <?php do_action('ocean_after_primary'); ?>

</div><!-- #content-wrap -->

<?php do_action('ocean_after_content_wrap'); ?>

<?php get_footer(); ?>