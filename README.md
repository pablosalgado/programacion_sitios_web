Requerimientos
==============
  * PHP 5
  * Symfony Standard Edition
  
Iniciar
=======

`git clone https://github.com/pablosalgado/programacion_sitios_web.git psw`

`cd pws`

`bin/console server:run`

Solución de problemas
=====================

  * En Windows se necesita un emulador de BASH. Se sugiere usar el de Git que se puede instalar desde: https://git-scm.com/download/win
  * Una vez instalado se ejecuta con el ícono Git Bash y ya es posible iniciar la aplicación  con la instrucción: `bin/console server:run`
  * Si se usa Windows y AppServ, es posible que se genere un error al intentar ejecutar `bin/console server:run` debido a la zona horaria.
  * Esto se corrige en el archivo php.ini. En este caso en la carpeta php5 de AppServ.
  * Se supone que se ha configurado AppServ para usar PHP 5.
  * Buscar `date.timezone` en el archivo php.ini. La línea puede estar comentada con “;” o puede tener UTC cómo valor. Se debe modificar de modo que esa línea sea: `date.timezone = America/Bogota`
  * En este punto ya se debería poder cargar la página desde un navegador con la dirección http://127.0.0.1:8000

