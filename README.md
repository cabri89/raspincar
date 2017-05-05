# Raspincar #
## Doctrine : ##

Commande pour ajouter l'admin dans la base de données :

```
php app/console doctrine:fixtures:load
```


Commande création d'une table dans la BDD :

```
php app/console generate:doctrine:entity
```

Commande de mise à jour de la BDD :

```
php app/console doctrine:schema:update --dump-sql

php app/console doctrine:schema:update --force
```

Génération des Entités à partir de la Base de données :

```
# generates all entities in the AppBundle
$ php app/console doctrine:generate:entities AppBundle

# generates all entities of bundles in the Acme namespace
$ php app/console doctrine:generate:entities Acme
```

### Générer les getter et setter : ###

```
php app/console doctrine:generate:entities AppBundle/Entity/Product
```

[Source](http://symfony.com/doc/2.8/book/doctrine.html)

Génération des formulaires :

```
php app/console doctrine:generate:form AppBundle:Post
```
[Source](http://symfony.com/doc/current/bundles/SensioGeneratorBundle/commands/generate_doctrine_form.html)
## Symfony ##

Commande pour vider le cache :

```
php app/console cache:clear --env=prod
```

Commande pour installer les vendor (Il faut mettre le fichier [composer.phar](https://getcomposer.org/composer.phar) dans le même dossier que composer.json):

```
php composer.phar update
```

Commande pour mettre à jour Symfony et ses utilitaires :

```
composer update
```

ou :

```
composer update symfony/symfony
```

### Créer une commande Symfony ###

Exemple de code de création d'une commande avec recherche dans la BDD :

```
<?php
// src/AppBundle/Command/CreateUserCommand.php
namespace AppBundle\Command;

use AppBundle\Entity\Liaison;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
   protected function configure()
   {
      $this
      // the name of the command (the part after "bin/console")
      ->setName('app:create-users')

      // the short description shown while running "php bin/console list"
      ->setDescription('Creates new users.')

      // the full command description shown when running the command with
      // the "--help" option
      ->setHelp("This command allows you to create users...")
      ;
   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {
      // outputs multiple lines to the console (adding "\n" at the end of each line)
      $output->writeln([
         'Recuperation du NDI de la liaison 1257',
         '============',
         '',
      ]);

      // outputs a message followed by a "\n"
      $output->write('NDI : ');
      $entityManager = $this->getApplication()->getKernel()->getContainer()->get('doctrine')->getEntityManager();
      // $entityManager = $this->getContainer()->get('doctrine')->getEntityManager();

      $liaisonRepository = $entityManager->getRepository('AppBundle:Liaison');
      $liaison = $liaisonRepository->find("1257");

      if($liaison === null){
         $output->write('Erreur');
      }else {
         $output->writeln($liaison->getNDI());
         $output->writeln("");

         // outputs a message without adding a "\n" at the end of the line
         $output->write('Bonne journee');
      }
   }
}
```

[Source](http://symfony.com/doc/2.8/console.html)
