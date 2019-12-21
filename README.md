# Garante

Este es un modulo sencillo que consiste en la creacion de una caracteristicas y dependiendo de esta subir una seria de imagenes las cuales se correlacionan segun el producto al cual esta caracteristica se haya aplicado.

Debe correlacionar el id de la caracteristica con el id que se encuentra en el archivo principal del controlador como se muestra

https://github.com/D2YM/Garante/blob/master/data/id_carac.JPG
https://github.com/D2YM/Garante/blob/master/data/idmodificar.JPG

Luego de realizar esta modificacion debera colocar el hook en su archivo de product.tpl (Debera verificar cual es segun su tema) y pasarle la variable $product.

{hook h="displayGaranteProduct" product=$product}

La carpeta data es meramente informativa no la deberia copiar a su prestashop.

Cualquier duda, comentario o bug, estoy para ayudar.
