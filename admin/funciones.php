<?php

function Cabecera($titulo)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>.:: Madamia - <?php echo $titulo; ?>::.</title>
        <link type="text/css" rel="stylesheet" href="../resources/css/madamiaAdminStyle.css">
        <link type="text/css" href="../resources/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />
        <link type="text/css" rel="stylesheet" href="../resources/css/ui-lightness/jquery-ui-1.8.16.custom.css.css">
        
        <script src="../resources/js/jquery-1.6.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="../resources/js/jquery-ui-1.8.15.custom.min.js" type="text/javascript" ></script>
	<!-- JQuery WYSIWYG plugin script -->
        <script type="text/javascript" src="../resources/js/jquery.wysiwyg.js" ></script>
        <!-- JQuery tablesorter plugin script-->
        <script type="text/javascript" src="../resources/js/jquery.tablesorter.min.js" ></script>
        <!-- JQuery pager plugin script for tablesorter tables -->
        <script type="text/javascript" src="../resources/js/jquery.tablesorter.pager.js" ></script>
        <!-- JQuery password strength plugin script -->
	<script type="text/javascript" src="../resources/js/jquery.pstrength-min.1.2.js" ></script>
        <!-- JQuery thickbox plugin script -->
	<script type="text/javascript" src="../resources/js/thickbox.js" ></script>
        <script type="text/javascript" src="../resources/js/jquery.bpopup-0.5.1.min.js" ></script>
        <script type="text/javascript" src="../resources/js/jquery.validate.js" ></script>
        <script type="text/javascript" src="../resources/plugins/FileManager/jscripts/tiny_mce/tiny_mce.js" ></script>
        <script type="text/javascript" src="../resources/js/functions.ajax.js"></script>
        <script type="text/javascript" src="../resources/js/jquery-ui-1.8.16.custom.min.js"></script>
        
        <!--
        <script type="text/javascript" src="../resources/js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="../resources/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="../resources/js/jquery.ui.accordion.js"></script>
        -->
        
        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.css" media="screen" />

        <script src="../resources/js/datetimepicker_css.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
            
        $(function(){
                $('#menu li a').click(function(event){
                        var elem = $(this).next();
                        if(elem.is('ul')){
                                event.preventDefault();
                                $('#menu ul:visible').not(elem).slideUp();
                                elem.slideToggle();
                        }
                });

               
        });
        </script>

        <!-- Initiate tablesorter script -->
        <script type="text/javascript">
			$(document).ready(function() {
				$("#myTable")
				.tablesorter({
					// zebra coloring
					widgets: ['zebra'],
					// pass the headers argument and assing a object
					headers: {
						// assign the sixth column (we start counting zero)
						6: {
							// disable it by setting the property sorter to false
							sorter: false
						}
					}
				})
			.tablesorterPager({container: $("#pager")});
		});
	</script>

        <!-- POP UP-->
        <script>
	
	$(document).ready(function(){	
	
		 $('.fancybox').fancybox({"padding"     : 2,
			 		"width"         : 900,
                                        "height"        : 550,
                                        "autoScale"     : false,
                                        "transitionIn"  : "elastic",
                                        "transitionOut" : "none", 
                                        "type"          : "iframe",
                                        "afterClose"    : function() {
                                                            window.location.reload();;
                                                        }
                              });
                              
		 		 		 
	 });
	 

     </script> 
        
    </head>
    <body>
        
<?php
}

function pie()
{
   ?>
            </div>
            </div>
            <div id="pie">
                &copy; 2013 Carlos Andrés Ramírez | car1984@gmail.com
            </div>
        </div>
    </body>
</html>
<?php
}

function MENU_APLICACION()
{
  ?>
    <div id="lateral">
        <ul id="menu">
        <li><a href="Seccion.php">Secciones</a></li>
        <li><a href="Albums.php">Albunes</a></li>
        <li><a href="Fotos.php">Fotos</a></li>
        <li><a href="productos.php">Productos</a></li>
        
<!--        <li><a href="Evento.php">Calendario</a></li>-->
<!--        <li><a href="Promocion.php">Promociones</a></li>-->
        <li><a href="ListaContenido.php">Lista De Contenidos</a></li>
        <li><a href="Contenido.php">Contenidos</a></li>
        <li><a href="Enlaces.php">Enlaces</a></li>
        <li><a href="Usuarios.php">Usuarios</a></li>
        <li><a href="javascript:void(0);" id="sessionKiller">Salir</a></li>
        </ul>
        
    </div>
<?php
}

function CabeceraPopup($titulo)
{
?>
     <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>.:: Madamia - <?php echo $titulo; ?> ::.</title>
        <link type="text/css" rel="stylesheet" href="../resources/css/styles.css">
        <link type="text/css" href="../resources/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="../resources/js/jquery-1.4.3.min.js" ></script>
        <script type="text/javascript" src="../resources/js/jquery.bpopup-0.5.1.min.js" ></script>
        <script type="text/javascript" src="../resources/js/jquery.validate.js" ></script>
        <script type="text/javascript" src="../resources/FileManager/jscripts/tiny_mce/tiny_mce.js" ></script>
    </head>
    <body>
    

<?php
    return "";
}

function PiePopup()
{
?>
    </body>
</html>
<?php
    return "";
}

function CabeceraLogin($titulo)
{
?>
     <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>.::Madamia - <?php echo $titulo; ?>::.</title>
        <link type="text/css" rel="stylesheet" href="../resources/css/login.css">
        <script type="text/javascript" src="../resources/js/jquery-1.4.3.min.js" ></script>
        <script type="text/javascript" src="../resources/js/jquery.bpopup-0.5.1.min.js" ></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
            $("a#em4a").bind("click", function () {
                            //$("#popup2").bPopup({ content: 'iframe', contentContainer: '#pContent', loadUrl: "http://dinbror.dk/search" });
                            $("#popup").bPopup();
                            return false
                        });
            });
        </script>
    </head>
    <body>

<?php
    return "";
}

function PieLogin()
{
?>
    </body>
</html>
<?php
    return "";
}



function quitar_caracteres_raros($cadena){
   $caracteres = 'À Á Â Ã Ä Å Æ Ç È É Ê Ë Ì Í Î Ï Ð Ñ Ò Ó Ô Õ Ö Ø Ù Ú Û Ü Ý Þ ß à á â ã ä å æ ç è é ê ë ì í î ï ð ñ ò ó ô õ ö ø ù ú û ü ý þ ÿ ¡ ¢ £ ¤ ¥ ¦ § ¨ © ª { } « ¬  ® ¯ ° ± ² ³´ µ ¶ · ¸ ¹ º » ¼ ½ ¾ ¿ × ÷ " \' & < >';
   $caracteres = explode(' ',$caracteres);
   $nchar      = count($caracteres);
   $base       = 0;
   while($base<$nchar){
      $cadena = str_replace($caracteres[$base],'_',$cadena);
      $base++;
   }
   return $cadena;
}
?>
