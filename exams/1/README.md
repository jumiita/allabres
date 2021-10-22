# Ricksy Business Multiversal
Mientras Jerry y Beth salen para participar en un evento que pretende recrear el hundimiento del Titanic, Summer organiza una fiesta en casa bajo el consentimiento de Rick que se integra a la fiesta e incluso invita a varios de sus amigos.

No obstante, esta fiesta va a tener la particularidad de existir en múltiples dimensiones a la vez con invitados de diferentes universos (¡e incluso los muertos revivirán!). En primer lugar, para saber que dimensión te corresponde debes editar la variable <strong>$seed</strong> con las 4 últimas cifras (solo números) de tu DNI.

Una vez te encuentres en tu dimensión, tendrás <strong>3 listas diferentes</strong> que se corresponden con los <ins>arrays</ins> <strong>$characters</strong>, <strong>$episodes</strong> y <strong>$locations</strong>. En <strong>$characters</strong> vas a tener todos los invitados a la fiesta, en <strong>$episodes</strong> dispondrás de los episodios de la serie, y en <strong>$locations</strong> vas a disponer de las diferentes ubicaciones conocidas y registradas del multiverso.

La ciudadela de los Ricks ha puesto a disposición de todas las dimensiones que celebren una fiesta a un Rick portero que será el encargado de dejar pasar a los invitados que estén en la lista. No obstante, se encuentra con serias dificultades puesto que <ins>la lista de invitados contiene información confusa y no presenta ningún orden lógico</ins>.

Para poder facilitar la información al Rick portero de tu dimensión, vas a desarrollar una aplicación que muestre los invitados atendiendo a las siguientes instrucciones.

Configuración previa:
- En primer lugar se debe crear un <ins>nuevo proyecto en tu entorno de desarrollo</ins>, de tal modo que durante el desarrollo de la aplicación no vas a poder acceder a ningún proyecto que no sea el que se está llevando a cabo.
- Se debe <ins>crear un repositorio <strong>privado</strong> en github que compartiremos con el profesor</ins>, en este caso <strong>allabresdawsf</strong>.
- Crear un entorno de despliegue en el servidor FTP facilitado por el profesor.
- Crear el archivo rickandmorty.php en la raiz de tu proyecto y pegar el contenido del mismo archivo que encontraremos en la raiz de este repositorio.

Requisitos de aplicación:
- Se deberá poder seleccionar el orden en que se presenten los candidatos en el formulario superior, los criterios de ordenación seran por <strong>"id"</strong> por <strong>"origin"</strong> y por <strong>"status"</strong> (Vivo o no).
- Los listados de episodios y ubicaciones pueden ser <strong><ins>opcionalmente</ins></strong> ordenados para una mayor comodidad del programador a la hora de proceder al mapeo de los invitados.
- Una vez <strong><ins>la lista de invitados</ins></strong> se encuentre ordenada según el criterio seleccionado por el usuario, debe ser mapeada de la siguiente forma:
  - En la clave <strong>"origin"</strong>, debemos substituir el valor entero por el correspondiente nombre de dicha ubicación (el valor entero se corresponde con el valor de <strong>"id"</strong> en el <ins>listado de ubicaciones</ins> (<strong>$locations)</strong>) mientras que el nombre de dicha ubicación se corresponde con el valor de <strong>"name"</strong> en el <ins>listado de ubicaciones</ins> (<strong>$locations)</strong>).
  - En la clave <strong>"location"</strong>, debemos substituir el valor entero por el correspondiente nombre de dicha ubicación (el valor entero se corresponde con el valor de <strong>"id"</strong> en el <ins>listado de ubicaciones</ins> (<strong>$locations)</strong>) mientras que el nombre de dicha ubicación se corresponde con el valor de <strong>"name"</strong> en el <ins>listado de ubicaciones</ins> (<strong>$locations)</strong>).
  - En la clave <strong>"episodes"</strong>, debemos substituir los valores enteros por los correspondientes nombres de dichos episodios (los valores enteros se corresponden con los valores de <strong>"id"</strong> en el <ins>listado de episodios</ins>).
  - En algunos casos, las claves <strong>"origin"</strong>, <strong>"location"</strong> o <strong>"episodes"</strong> pueden contener un valor 0 que no existe en su correspondiente listado, en estos casos debe substituirse por el valor "unknown" en forma de string.
- Cuando toda la información se encuentre ordenada y debidamente mapeada debe mostrarse por pantalla, para ello llamaremos <ins>de forma iterativa</ins> a la función <strong>renderCard</strong> pasándole como parámetro un invitado (<strong>$character</strong>) diferente en cada iteración. Esta función nos devolverá un html renderizado en forma de string que podremos mostrar directamente.
- Si algún invitado (<strong>$character</strong>) no ha sido correctamente mapeado, nos saldrá un listado de sus errores en su tarjeta (<strong><ins>Debemos resolverlos</ins></strong>).

Una vez finalizada la aplicación, esta debe subirse al repositorio privado (Github) y desplegarse en el entorno habilitado para ello para cada alumno (FTP).

Únicamente pueden usarse las funciones predefinidas de PHP siguientes:
- intval()
- isset()
- count()

En caso de considerar necesario el uso de una función predefinida de PHP que no se encuentre en el listado anterior debera consultarse con el profesor.

La correcta ejecución de esta aplicación puede consultarse en https://dawsonferrer.com/allabres/arrays_solutions/rickandmorty.php
