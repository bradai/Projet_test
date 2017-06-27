projet_test
===========

A Symfony project created on June 21, 2017, 11:10 am.



Clone project :
---------------

      git clone https://github.com/bradai/projet_test.git
      cd projet_test
      composer install or composer update

Step for install Project :
--------------------------

     php app/console doctrine:database:create
     php app/console doctrine:schema:create




Url de test de Api :
-----------------------------------------
Methode         url                                      Description

GET             /api/fiouls/{id}/{date1}/{date2}         Liste des fiouls


Command :
-----------------------------------------

php app/console import:csv