# Rabbitmq Bundle Tutorial
========================

Questo tutorial ha lo scopo di guidare per esempi nell'utilizzo pratico
di RabbitMQ, broker di messaggi asincroni, con il bundle in questione basato su framework Symfony 2.1.

https://github.com/videlalvaro/RabbitMqBundle

In pratica illustra le possibilità di comunicazione asincrona fra processi, illustrandone le varie casisitiche,
il tutto sfruttando le potenzialità del bundle che mascherano l'interazione con le API del protocollo  [** Advanced Message Queuing Protocol **][2] per interagire con il Message Broker.

Nei vari branch sono presenti esempi in base alle tipologie di comunicazione.

1) Installare RabbitMQ
-------------------------------------
Installare il server di messaggistica seguendo le istruzioni per il proprio SO dal [**sito ufficiale**] [1]

Altre info:

* [** Concetti base **] [3]
* [** Plugin **] [4]
* [** RabbitMQ in Action - Distributed messaging for everyone **] [5]

attivare il server:

    >sudo service rabbitmq-server start

La console è raggiungibile all'url:

[http://localhost:15672/#/](http://localhost:15672/#/)

Verifica dell'installazione del web server, come da manuale symfony, occhio ai folder log e cache:

[http://symfony.com/doc/current/book/installation.html](http://symfony.com/doc/current/book/installation.html)

nel tutorial il virtual host del web server è configurato con il nome

[http://rabbitmq-tutorial.localhost/](http://rabbitmq-tutorial.localhost/)

In ogni branch puoi verificare le funzionalità esposte dalla homepage:

[http://rabbitmq-tutorial.localhost/app_dev.php](http://rabbitmq-tutorial.localhost/app_dev.php)

2) Branch queue
-------------------------------------

### un producer, un consumer [scenario 1](http://www.rabbitmq.com/tutorials/tutorial-one-java.html) ###

attiva consumer da shell

    >php app/console rabbitmq:consumer custom_message

attiva il producer

[http://rabbitmq-tutorial.localhost/app_dev.php/produce/ciao/mondo](http://rabbitmq-tutorial.localhost/app_dev.php/produce/ciao/mondo)

### un producer, due consumer [scenario 2](http://www.rabbitmq.com/tutorials/tutorial-two-java.html) ###

attiva altro consumer con un'altra shell

     >php app/console rabbitmq:consumer custom_message

attiva il producer per inviare due messaggi

[http://rabbitmq-tutorial.localhost/app_dev.php/produce/ciao/mondo/2](http://rabbitmq-tutorial.localhost/app_dev.php/produce/ciao/mondo/2)

### Publish/Subscribe [scenario 3](http://www.rabbitmq.com/tutorials/tutorial-three-java.html) ###

attiviamo due distinti consumer via shell

     >php app/console rabbitmq:consumer custom_message
     >php app/console rabbitmq:consumer another_custom_message

attiva il producer per inviare un solo messaggio

[http://rabbitmq-tutorial.localhost/app_dev.php/produce/ciao/mondo](http://rabbitmq-tutorial.localhost/app_dev.php/produce/ciao/mondo)



2) Branch queue con routing key
-------------------------------------

### producer con consumer selettivi [scenario 4](http://www.rabbitmq.com/tutorials/tutorial-four-java.html) ###

attiva consumer per messaggi di tipo sms da shell

     >php app/console rabbitmq:consumer rk_sms_custom_message

attiva consumer per messaggi di tipo mail da shell

     >php app/console rabbitmq:consumer rk_mail_custom_message

attiva il producer con routing key mail

[http://rabbitmq-tutorial.localhost/app_dev.php/rouningKey/ciao/mondo/delivery.mail](http://rabbitmq-tutorial.localhost/app_dev.php/rouningKey/ciao/mondo/delivery.mail)

    attiva il producer con routing key mail

[http://rabbitmq-tutorial.localhost/app_dev.php/rouningKey/ciao/mondo/delivery.sms](http://rabbitmq-tutorial.localhost/app_dev.php/rouningKey/ciao/mondo/delivery.sms)

puoi specificare il routing key come parametro al consumer da command line

     >php app/console rabbitmq:consumer --route "delivery.sms" rk_custom_message



3) Branch Remote Procedure Call (RPC)
-------------------------------------
### Simple RPC (Request/reply) [scenario 6](http://www.rabbitmq.com/tutorials/tutorial-six-java.html) ###

attiva server rpc da shell

     > php app/console rabbitmq:rpc-server random_int

attiva la request

[http://rabbitmq-tutorial.localhost/app_dev.php/simpleRpc](http://rabbitmq-tutorial.localhost/app_dev.php/simpleRpc)


### Parallel RPC  ###

attiva server RPC da shell, service A

     > php app/console rabbitmq:rpc-server service_a

attiva server RPC da shell, service B

     > php app/console rabbitmq:rpc-server service_b

attiva la request

[http://rabbitmq-tutorial.localhost/app_dev.php/parallelRpc](http://rabbitmq-tutorial.localhost/app_dev.php/parallelRpc)



4) Branch Topic
-------------------------------------

### Topic (Publish/Subscribe) [scenario 5](http://www.rabbitmq.com/tutorials/tutorial-five-java.html) ###

attiva consumer su tutti i messaggi del topic da shell

     > php app/console rabbitmq:anon-consumer -m 10 logs_watcher

attiva consumer dei soli messaggi error del topic da shell

     > php app/console rabbitmq:anon-consumer -m 10 -r "#.error" logs_watcher


Invia messaggio di info, consumato solo dal generico consumer

[http://rabbitmq-tutorial.localhost/app_dev.php/log/message.info/registration.ok/1](http://rabbitmq-tutorial.localhost/app_dev.php/log/message.info/registration.ok/1)

Invia messaggio di error, consumato da entrambi i consumer

[http://rabbitmq-tutorial.localhost/app_dev.php/log/message.error/registration.ko/1](http://rabbitmq-tutorial.localhost/app_dev.php/log/message.error/registration.ko/1)


5) Branch STDIN PRoducer
-------------------------------------

attiva consumer da shell

     > php app/console rabbitmq:consumer stdin_message

attiva producer da shell che invia il contenuto di un files

     > php app/console rabbitmq:stdin-producer words < message.txt



[1]: http://www.rabbitmq.com/download.html
[2]: http://www.amqp.org
[3]: http://www.rabbitmq.com/tutorials/amqp-concepts.html
[4]: http://www.rabbitmq.com/plugins.html
[5]: http://manning.com/videla/ 