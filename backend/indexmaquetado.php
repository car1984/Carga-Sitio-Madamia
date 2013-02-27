<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>inicio</title>
        <link type="text/css" rel="stylesheet" href="../resources/css/styles.css">
        <script src="../resources/js/jquery-1.4.3.min.js" type="text/javascript" charset="utf-8"></script>
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
    </head>
    <body>
        <div id="contenedor">

	<div id="cabecera">

		Cabecera 01
	</div>
	<div id="cuerpo">
		<div id="lateral">
			<ul id="menu">
                        <li><a href="#">Menu 1</a>
                                <ul>
                                        <li><a href="#">Submenu 1</a></li>
                                        <li><a href="#">Submenu 2</a></li>
                                        <li><a href="#">Submenu 3</a></li>
                                        <li><a href="#">Submenu 4</a></li>
                                </ul>
                        </li>
                        <li><a href="#">Menu 2</a>
                                <ul>
                                        <li><a href="#">Submenu 1</a></li>
                                        <li><a href="#">Submenu 2</a></li>
                                        <li><a href="#">Submenu 3</a></li>
                                        <li><a href="#">Submenu 4</a></li>
                                </ul>
                        </li>
                        <li><a href="#">Menu 3</a>
                                <ul>
                                        <li><a href="#">Submenu 1</a></li>
                                        <li><a href="#">Submenu 2</a></li>
                                        <li><a href="#">Submenu 3</a></li>
                                        <li><a href="#">Submenu 4</a></li>
                                </ul>
                        </li>
                        <li><a href="#">Menu sin submenu</a></li>
                        </ul>
		</div>
		<div id="principal">
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla condimentum commodo orci. Nulla eget purus nec massa cursus ullamcorper. Donec quis justo. Pellentesque fermentum. Etiam pharetra, ipsum eget faucibus malesuada, ante elit tristique nibh, ut commodo sem dolor aliquam ante. Aliquam ut leo rhoncus arcu dictum sodales. Morbi viverra, dui vel mollis iaculis, urna libero tincidunt leo, nec interdum ligula lacus congue lacus. Nam porttitor, nibh quis scelerisque lobortis, neque diam consectetuer magna, sit amet mattis diam quam vitae erat. Donec wisi tortor, lacinia et, blandit nec, semper nec, urna. Aliquam erat volutpat.
			<p>

			Aliquam erat volutpat. Sed ac augue non libero commodo lacinia. Morbi molestie augue at felis. Mauris ornare, est ac imperdiet vehicula, tortor dui sagittis lacus, sed tempor lorem tellus ut turpis. Donec dui est, rhoncus sit amet, bibendum sed, rutrum sit amet, ligula. Suspendisse ac sapien ac mi posuere rutrum. Vivamus sollicitudin, mi eu vehicula convallis, sem magna blandit purus, id pellentesque augue dui vitae urna. Nam imperdiet. Curabitur libero. Suspendisse sodales sem in nunc. Proin diam augue, nonummy non, posuere in, lacinia eget, pede. Pellentesque felis sem, cursus mattis, commodo et, condimentum egestas, quam. Morbi lacinia. Praesent pulvinar elit vitae arcu. Integer sagittis metus ut justo. Etiam pharetra adipiscing nunc.
			<p>
			Etiam sodales nulla non neque. Duis porttitor faucibus leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris ipsum nunc, sodales nec, faucibus quis, euismod at, arcu. Phasellus id odio. Aenean nibh mauris, venenatis eget, commodo id, gravida ut, arcu. Pellentesque dui metus, nonummy sit amet, aliquet sed, pretium sit amet, diam. Sed dapibus rhoncus sem. Integer blandit elit at mauris. Praesent vel nunc a massa lacinia pharetra. Etiam nibh arcu, rhoncus a, ultrices et, feugiat in, ipsum. Phasellus suscipit tincidunt urna.
			<p>
			Vivamus mattis eros euismod lectus. Suspendisse potenti. Vestibulum justo odio, ullamcorper a, semper in, eleifend non, turpis. Nunc urna pede, blandit vehicula, gravida at, luctus a, leo. Nulla facilisi. Etiam vitae elit ut nisl tempor pretium. Aliquam erat volutpat. Fusce molestie commodo wisi. Proin pretium libero in eros. Donec blandit. Mauris blandit, ligula non convallis laoreet, sapien nunc elementum metus, eu accumsan sapien est sollicitudin mauris. Aliquam vulputate. Nulla eget massa quis sapien pulvinar ornare. Integer suscipit magna eget orci. Sed rutrum adipiscing tortor. Donec aliquet dapibus neque. Aliquam sed arcu non est sollicitudin lobortis.
		</div>
	</div>
	<div id="pie">
	&copy; 2011 Todos Nosotros
	</div>

</div>

        <?php
        // put your code here
        ?>
    </body>
</html>
