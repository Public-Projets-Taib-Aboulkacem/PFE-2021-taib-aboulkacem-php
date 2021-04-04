DROP DATABASE glsb;
#-- Base de données: `glsb`
CREATE DATABASE IF NOT EXISTS glsb;
#-------------création des table 
#-------------création des table system :
#--table des langue :
CREATE TABLE glsb.langue(
langue varchar(255) NOT NULL
)ENGINE=MyISAM;
INSERT INTO glsb.langue VALUES ("Arabe"),("Français"),("Anglais"),("Amazigh"),("Espagnol");
#--table des Domaine :
CREATE TABLE glsb.type_domaine(
domaine varchar(255) NOT NULL
)ENGINE=MyISAM;
INSERT INTO glsb.type_domaine VALUES ("Oeuvres_Anglais"),("Oeuvres_Français"),("Oeuvres_Arabes"), ("Histoires"),("Littérature"),("Roman"),("Educatif"),("Politique"),("Economie"),("Citoyenneté"),("Scientifique"),("Lexique"),("Religieux");
#--table des Domaine :
CREATE TABLE glsb.niveaus(
niveau varchar(255) NOT NULL
)ENGINE=MyISAM;
#--table des etui_livre :
CREATE TABLE glsb.etui_livre(
etui_livre varchar(255) NOT NULL
)ENGINE=MyISAM;
INSERT INTO glsb.etui_livre VALUES 
("telle_qu'elle_est"),
("imparfait"),
("ruiné");
#--table des faisable :
CREATE TABLE glsb.faisable(
faisable varchar(255) NOT NULL
)ENGINE=MyISAM;
INSERT INTO glsb.faisable VALUES 
("a_été_livré"),
("n'existe_pas"),
("présent");
#-------------création des table des service:
#--table livre :
CREATE TABLE glsb.livre(
codelivre varchar(100) PRIMARY KEY NOT NULL,
titre varchar(30) NOT NULL,
date_publication date NOT NULL,
langue varchar(255) NOT NULL,
auteur varchar(255) NOT NULL,
prix varchar(20) NOT NULL,
domaine varchar(255) NOT NULL,
faisable varchar(255) NOT NULL,
date_insertion Timestamp NOT NULL
)ENGINE=MyISAM;
#--table recevoir
CREATE TABLE glsb.livraison(
id_livraison INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
codelivre varchar(255) NOT NULL,
cne varchar(255) NOT NULL,
date_livraison Timestamp NOT NULL,
date_recuperation date NOT NULL,
Foreign key (codelivre) references livre (codelivre)
)ENGINE=MyISAM;
#--table recevoir
CREATE TABLE glsb.recevoir(
id_recu INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
id_livraison int(10) NOT NULL,
codelivre varchar(255) NOT NULL,
cne varchar(255) NOT NULL,
date_recu Timestamp NOT NULL,
date_livraison date NOT NULL,
etui_livre varchar(255) NOT NULL,
evalaition int(20) NOT NULL,
Foreign key (codelivre) references  livraison (codelivre),
Foreign key (id_livraison) references  livraison (id_livraison),
Foreign key (cne) references recevoir (cne)
)ENGINE=MyISAM;
#--table user pour les utilisateur
CREATE TABLE glsb.users( 
id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
pseudo varchar(255) NOT NULL,
pass varchar(255) NOT NULL,
email varchar(255) NOT NULL,
date_inscription Timestamp NOT NULL
)ENGINE=MyISAM;

#--table
CREATE TABLE glsb . eleve( 
id int(10) AUTO_INCREMENT NOT NULL,
cne varchar(100)  NOT NULL,
num int(11) NOT NULL,
prenom varchar(255) NOT NULL,
nom varchar(255) NOT NULL,
sex varchar(255) NOT NULL,
niveau varchar(255) NOT NULL,
annees varchar(255) NOT NULL,
PRIMARY KEY(id,cne)
)ENGINE=MyISAM;


#-- Statistique d'eleve :
CREATE TABLE glsb . stat_eleve( 
cne varchar(100) PRIMARY KEY NOT NULL,
sex varchar(255) NOT NULL,
niveau varchar(255) NOT NULL,
annees varchar(255) NOT NULL,
nb_livre_lue int(11) NOT NULL,
note_total int(11) NOT NULL,
Foreign key (cne) references  eleve (cne),
Foreign key (sex) references  eleve (sex),
Foreign key (niveau) references  eleve (niveau),
Foreign key (annees) references  eleve (annees)
)ENGINE=MyISAM;
#-- Statistique d'livre :
CREATE TABLE glsb. stat_livre(
codelivre varchar(100) PRIMARY KEY NOT NULL,
langue varchar(255) NOT NULL,
domaine varchar(255) NOT NULL,
nb_eleve_lue int(11) NOT NULL,
Foreign key (codelivre) references  livre (codelivre),
Foreign key (langue) references  livre (langue),
Foreign key (domaine) references  livre (domaine),
)ENGINE=MyISAM;