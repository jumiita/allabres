# Resultados electorales
En este caso vais a tener que desarrollar una aplicación orientada a objetos que reciba un conjunto de resultados
y devuelva esos resultados estructurados a través de los diferentes objetos posibles, en una primera versión 
simplemente debeis mostrar los resultados por provincia tal como se muestra en el siguiente enlace:

https://dawsonferrer.com/allabres/oop/elections/index.php

El resultado final debe poder ser filtrado tanto por partidos como por distritos asi como
permitir ver un resultado general de las elecciones en el conjunto del estado. Puede comprobarse el resultado final esperado en el siguiente enlace:

https://dawsonferrer.com/allabres/oop/elections/map.php

El conjunto de resultados que vais a recibir va a seguir la siguiente estructura:

https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=results

Como ayuda podeis crear los partidos a través de la llamada al siguiente recurso:

https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=parties

Mientras que para las circumscripciones podeis hacer uso de:

https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=districts

Para realizar un reparto de escaños debeis tener en cuenta el funcionamiento del sistema d'hondt que podeis ver aqui:

https://es.wikipedia.org/wiki/Sistema_D%27Hondt 

Así mismo, si quereis que el resultado sea un fiel reflejo de los resultados reales, debeis tener en cuenta
que los partidos cuyo porcentaje de votos en una circumscripcion sea inferior al 3% seran desestimados y por lo 
tanto no serán tenidos en cuenta en el reparto d'hondt.