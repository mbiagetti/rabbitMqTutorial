Rabbitmq Bundle Tutorial
========================

Questo tutorial ha lo scopo di guidare per esempi nell'utilizzo pratico
di RattitMQ, broker di messaggi asincroni, con il bundle in questione basato su framework Symfony 2.1.

In pratica illustra le possibilità di comunicazione asincrona fra processi, illustrandone le varie casisitiche,
il tutto sfruttando le potenzialità del bundle che mascherano l'interazione con le API del protocollo  AMQP
(Advanced Message Queuing Protocol) per interagire con il Message Broker.

Nei vari branch sono presenti esempi in base alle tipologie di comunicazione.

1) Installare RabbitMQ
-------------------------------------
Installare il server di messaggistica seguendo le istruzioni per il proprio SO:

http://www.rabbitmq.com/download.html


Concetti base:

http://www.rabbitmq.com/tutorials/amqp-concepts.html


Plugin:

http://www.rabbitmq.com/plugins.html


Approfondimenti:


RabbitMQ in Action - Distributed messaging for everyone

http://manning.com/videla/


Verifica dell'installazione del web server, come da manuale symfony, occhio ai folder log e cache:

http://symfony.com/doc/current/book/installation.html

nel tutorial il virtual host del web server è configurato con il nome

 http://rabbitmq-tutorial.localhost/

La console è raggiungibile all'url:

 http://localhost:15672/#/


2) Branch queue
-------------------------------------




3) Branch rpc
-------------------------------------

Remote Procedure Call


4) Branch pub-sub
-------------------------------------

Modello Pubblicatore/Sottoscrittore

