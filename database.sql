CREATE SCHEMA trans;
SET SCHEMA 'trans';

CREATE TABLE trans.pays(
       nom varchar(50) not null,
       id serial not null constraint pays_pk primary key
);

CREATE TABLE trans.elements(
       nom varchar(60) not null,
       id serial not null constraint elements_pk primary key
);

CREATE TABLE trans.role(
       nom varchar(30) not null,
       id serial not null constraint role_pk primary key
);

CREATE TABLE trans.parent(
       nom varchar(50) not null,
       id serial not null constraint parent_pk primary key
);

CREATE TABLE trans.compte(
       login varchar(20) not null constraint compte_pk primary key,
       password varchar(30) not null,
       valide boolean not null
);

CREATE TABLE trans.atm(
       login varchar(20) not null constraint atm_pk primary key,
       constraint atm_fk1 foreign key (login) references trans.compte(login)
);

CREATE TABLE trans.artiste(
       login varchar(20) not null constraint artiste_pk primary key,
       nom varchar(50) not null,
       mail varchar(50) not null,
       debut integer not null,
       genre varchar(30) not null,
       siteweb varchar(30) not null,
       constraint artiste_fk1 foreign key (login) references trans.compte(login)
);

CREATE TABLE trans.media(
       url varchar(200) not null constraint media_pk primary key,
       id_artiste varchar(20) not null,
       constraint media_fk1 foreign key (id_artiste) references trans.artiste(login)
);

CREATE TABLE trans.photo(
       url varchar(200) not null constraint photo_pk primary key,
       constraint photo_fk1 foreign key (url) references trans.media(url)
);

CREATE TABLE trans.video(
       url varchar(200) not null constraint video_pk primary key,
       constraint video_fk1 foreign key (url) references trans.media(url)
);

CREATE TABLE trans.disque(
       titre varchar(30) not null,
       sortie date not null,
       label varchar(30) not null,
       type varchar(10) not null,
       id_artiste varchar(20) not null,
       constraint disque_pk primary key (titre,id_artiste),
       constraint discographie foreign key (id_artiste) references trans.artiste(login)
);

CREATE TABLE trans.salle(
       id serial not null constraint salle_pk primary key,
       nom varchar(100) not null,
       adresse varchar (200) not null,
       capacite integer not null,
       accesHandicap boolean not null
);

CREATE TABLE trans.session(
       dateSession date not null,
       heureDebut integer not null,
       salle integer not null,
       constraint session_pk primary key (dateSession,heureDebut,salle),
       constraint session_fk1 foreign key (salle) references trans.salle(id)
);

CREATE TABLE trans.reservation(
       statut integer not null,
       dateSession date not null,
       heureDebut integer not null,
       salle integer not null,
       artiste varchar(20) not null,
       constraint reservation_pk primary key (dateSession,heureDebut,salle,artiste),
       constraint reservation_fk1 foreign key (dateSession,heureDebut,salle) references trans.session(dateSession,heureDebut,salle)
);

CREATE TABLE trans.elementsPonctuels(
       element integer not null,
       artiste varchar(20) not null,
       constraint ponctuel_pk primary key (element,artiste),
       constraint ponctuel_fk1 foreign key (element) references trans.elements(id),
       constraint ponctuel_fk2 foreign key (artiste) references trans.artiste(login)
);

CREATE TABLE trans.elementsPrincipaux(
       element integer not null,
       artiste varchar(20) not null,
       constraint principal_pk primary key (element,artiste),
       constraint principal_fk1 foreign key (element) references trans.elements(id),
       constraint principal_fk2 foreign key (artiste) references trans.artiste(login)
);

CREATE TABLE trans.formation(
       role integer not null,
       artiste varchar(20) not null,
       constraint formation_pk primary key (role,artiste),
       constraint formation_fk1 foreign key (role) references trans.role(id),
       constraint formation_fk2 foreign key (artiste) references trans.artiste(login)
);

CREATE TABLE trans.origine(
       pays integer not null,
       artiste varchar(20) not null,
       constraint origine_pk primary key (pays,artiste),
       constraint origine_fk1 foreign key (pays) references trans.pays(id),
       constraint origine_fk2 foreign key (artiste) references trans.artiste(login)
);

CREATE TABLE trans.parente(
       parent integer not null,
       artiste varchar(20) not null,
       constraint parente_pk primary key (parent,artiste),
       constraint parente_fk1 foreign key (parent) references trans.parent(id),
       constraint parente_fk2 foreign key (artiste) references trans.artiste(login)
);






/*PAYS*/
COPY trans.pays(nom,id) FROM STDIN DELIMITER AS ',';
Afghanistan,1
Albanie,2
Antarctique,3
Algérie,4
Samoa Américaines,5
Andorre,6
Angola,7
Antigua-et-Barbuda,8
Azerbaïdjan,9
Argentine,10
Australie,11
Autriche,12
Bahamas,13
Bahreïn,14
Bangladesh,15
Arménie,16
Barbade,17
Belgique,18
Bermudes,19
Bhoutan,20
Bolivie,21
Bosnie-Herzégovine,22
Botswana,23
Ile Bouvet,24
Brésil,25
Belize,26
Territoire Britannique de lOcéan Indien,27
Iles Salomon,28
Iles Vierges Britanniques,29
Brunéi Darussalam,30
Bulgarie,31
Myanmar,32
Burundi,33
Bélarus,34
Cambodge,35
Cameroun,36
Canada,37
Cap-vert,38
Iles Caïmanes,39
République Centrafricaine,40
Sri Lanka,41
Tchad,42
Chili,43
Chine,44
Taïwan,45
Ile Christmas,46
Iles Cocos (Keeling),47
Colombie,48
Comores,49
Mayotte,50
République du Congo,51
République Démocratique du Congo,52
Iles Cook,53
Costa Rica,54
Croatie,55
Cuba,56
Chypre,57
République Tchèque,58
Bénin,59
Danemark,60
Dominique,61
République Dominicaine,62
Équateur,63
El Salvador,64
Guinée Équatoriale,65
Éthiopie,66
Érythrée,67
Estonie,68
Iles Féroé,69
Iles (malvinas) Falkland,70
Géorgie du Sud et les Iles Sandwich du Sud,71
Fidji,72
Finlande,73
Iles Åland,74
France,75
Guyane Française,76
Polynésie Française,77
Terres Australes Françaises,78
Djibouti,79
Gabon,80
Géorgie,81
Gambie,82
Territoire Palestinien Occupé,83
Allemagne,84
Ghana,85
Gibraltar,86
Kiribati,87
Grèce,88
Groenland,89
Grenade,90
Guadeloupe,91
Guam,92
Guatemala,93
Guinée,94
Guyana,95
Haïti,96
Iles Heard et Mcdonald,97
Saint-Siège (état de la Cité du Vatican),98
Honduras,99
Hong-Kong,100
Hongrie,101
Islande,102
Inde,103
Indonésie,104
République Islamique dIran,105
Iraq,106
Irlande,107
Israël,108
Italie,109
Côte dIvoire,110
Jamaïque,111
Japon,112
Kazakhstan,113
Jordanie,114
Kenya,115
République Populaire Démocratique de Corée,116
République de Corée,117
Koweït,118
Kirghizistan,119
République Démocratique Populaire Lao,120
Liban,121
Lesotho,122
Lettonie,123
Libéria,124
Jamahiriya Arabe Libyenne,125
Liechtenstein,126
Lituanie,127
Luxembourg,128
Macao,129
Madagascar,130
Malawi,131
Malaisie,132
Maldives,133
Mali,134
Malte,135
Martinique,136
Mauritanie,137
Maurice,138
Mexique,139
Monaco,140
Mongolie,141
République de Moldova,142
Montserrat,143
Maroc,144
Mozambique,145
Oman,146
Namibie,147
Nauru,148
Népal,149
Pays-Bas,150
Antilles Néerlandaises,151
Aruba,152
Nouvelle-Calédonie,153
Vanuatu,154
Nouvelle-Zélande,155
Nicaragua,156
Niger,157
Nigéria,158
Niué,159
Ile Norfolk,160
Norvège,161
Iles Mariannes du Nord,162
Iles Mineures Éloignées des États-Unis,163
États Fédérés de Micronésie,164
Iles Marshall,165
Palaos,166
Pakistan,167
Panama,168
Papouasie-Nouvelle-Guinée,169
Paraguay,170
Pérou,171
Philippines,172
Pitcairn,173
Pologne,174
Portugal,175
Guinée-Bissau,176
Timor-Leste,177
Porto Rico,178
Qatar,179
Réunion,180
Roumanie,181
Fédération de Russie,182
Rwanda,183
Sainte-Hélène,184
Saint-Kitts-et-Nevis,185
Anguilla,186
Sainte-Lucie,187
Saint-Pierre-et-Miquelon,188
Saint-Vincent-et-les Grenadines,189
Saint-Marin,190
Sao Tomé-et-Principe,191
Arabie Saoudite,192
Sénégal,193
Seychelles,194
Sierra Leone,195
Singapour,196
Slovaquie,197
Viet Nam,198
Slovénie,199
Somalie,200
Afrique du Sud,201
Zimbabwe,202
Espagne,203
Sahara Occidental,204
Soudan,205
Suriname,206
Svalbard etIle Jan Mayen,207
Swaziland,208
Suède,209
Suisse,210
République Arabe Syrienne,211
Tadjikistan,212
Thaïlande,213
Togo,214
Tokelau,215
Tonga,216
Trinité-et-Tobago,217
Émirats Arabes Unis,218
Tunisie,219
Turquie,220
Turkménistan,221
Iles Turks et Caïques,222
Tuvalu,223
Ouganda,224
Ukraine,225
Ex-République Yougoslave de Macédoine,226
Égypte,227
Royaume-Uni,228
Ile de Man,229
République-Unie de Tanzanie,230
États-Unis,231
Iles Vierges des États-Unis,232
Burkina Faso,233
Uruguay,234
Ouzbékistan,235
Venezuela,236
Wallis et Futuna,237
Samoa,238
Yémen,239
Serbie-et-Monténégro,240
Zambie,241
\.





/*COMPTE ATM*/

INSERT INTO trans.compte VALUES('admin','admin',true);
INSERT INTO trans.atm VALUES('admin');

/*COMPTES ARTISTES*/
COPY trans.compte(login,password,valide) FROM STDIN DELIMITER AS ',';
a1,mdp1,true
a2,mdp2,false
a3,mdp3,true
a4,mdp4,true
a5,mdp5,true
a6,mdp6,true
a7,mdp7,true
a8,mdp8,true
a9,mdp9,true
a10,mdp10,true
a11,mdp11,true
a12,mdp12,true
a13,mdp13,true
a14,mdp14,true
a15,mdp15,true
a16,mdp16,true
a17,mdp17,true
a18,mdp18,true
a19,mdp19,true
a20,mdp20,true
a21,mdp21,true
a22,mdp22,true
a23,mdp23,false
a24,mdp24,true
a25,mdp25,true
a26,mdp26,true
a27,mdp27,true
a28,mdp28,true
a29,mdp29,true
a30,mdp30,true
a31,mdp31,true
a32,mdp32,true
a33,mdp33,true
a34,mdp34,true
a35,mdp35,true
a36,mdp36,true
a37,mdp37,false
a38,mdp38,true
a39,mdp39,true
a40,mdp40,true
a41,mdp41,true
a42,mdp42,true
a43,mdp43,true
a44,mdp44,true
a45,mdp45,true
a46,mdp46,true
a47,mdp47,false
a48,mdp48,true
a49,mdp49,true
a50,mdp50,true
\.


/*SALLES*/
COPY trans.salle(id,nom,adresse,capacite,acceshandicap) FROM STDIN DELIMITER AS ';';
1;Ubu;1 Rue Saint-Hélier, 35000 Rennes;450;0
2;LEtage;1 Espl. Charles de Gaulle, 35000 Rennes;900;0
3;Les Champs Libres;10 Cours des Alliés, 35000 Rennes;300;0
4;Le Triangle;Boulevard de Yougoslavie, 35000 Rennes;550;0
5;Centre Pénitentiaire des Femmes;18 Rue de Châtillon, 35000 Rennes;450;1
6;Le 4 Bis;4 Bis Cours des Alliés, 35000 Rennes;700;0
7;Opéra;Place de la Mairie, 35000 Rennes;1200;0
8;La Cité;10 rue Saint Louis, 35000 Rennes;1150;1
9;Antipode;Rue André Trasbot, 35000 Rennes;480;1
10;Le Tambour;Rue du Recteur Paul Henry, 35000 Rennes;650;0
11;Maison de Quartier Villejean;2 Rue de Bourgogne, 35000 Rennes;600;0
12;MJC Cleunay;Rue André Trasbot, 35000 Rennes;150;0
13;LEspace;45 Boulevard de la Tour dAuvergne, 35000 Rennes;400;1
14;La Bellangerais;5 Rue du Morbihan, 35700 Rennes;500;1
15;Le Cactus;3 Rue Pongerard, 35000 Rennes;150;0
16;Place de la Mairie;Place de la Mairie, 35000 Rennes;700;1
17;TNB;1 Rue Saint-Hélier, 35040 Rennes;100;0
18;FNAC;centre commercial colombia, Place du Colombier, 35000 Rennes;300;1
19;Le Liberté;1 Espl. Charles de Gaulle, 35000 Rennes;5300;0
20;Le Blosne;3 Boulevard de Yougoslavie, 35000 Rennes;650;0
21;Place du Colombier;Place du Colombier, 35000 Rennes;800;1
\.


/*ARTISTES*/
COPY trans.artiste(login,nom,mail,debut,genre,siteweb) FROM STDIN DELIMITER AS ';';
a1;A-Wa;mail@a1.fr;2014;rock;a1.fr
a2;Alphaat;mail@a2.fr;2013;rap;a2.fr
a3;Alsarah & The Nubatones;mail@a3.fr;2012;reggae;a3.fr
a4;Andre Bratten;mail@a4.fr;2011;Pop-rock;a4.fr
a5;Animal Chuki;mail@a5.fr;2010;metal;a5.fr
a6;Awesome Tapes From Africa;mail@a6.fr;2009;variété;a6.fr
a7;Bantam Lyons;mail@a7.fr;2008;rock;a7.fr
a8;Barnt + Aguayo;mail@a8.fr;2007;rap;a8.fr
a9;Big Buddha;mail@a9.fr;2006;reggae;a9.fr
a10;Bison Bisou;mail@a10.fr;2005;Pop-rock;a10.fr
a11;Black Commando;mail@a11.fr;2004;metal;a11.fr
a12;Blutch;mail@a12.fr;2003;variété;a12.fr
a13;Boris Brejcha;mail@a13.fr;2002;rock;a13.fr
a14;Chancha Via Circuito Feat. Miriam Garca;mail@a14.fr;2001;rap;a14.fr
a15;Cie 6ème dimension;mail@a15.fr;2000;reggae;a15.fr
a16;Cie Rêvolution;mail@a16.fr;1999;Pop-rock;a16.fr
a17;Clap! Clap!;mail@a17.fr;1998;metal;a17.fr
a18;Clarens;mail@a18.fr;1997;variété;a18.fr
a19;Compact Disk Dummies;mail@a19.fr;1996;rock;a19.fr
a20;Cosmo Sheldrake;mail@a20.fr;1995;rap;a20.fr
a21;Costello;mail@a21.fr;1994;reggae;a21.fr
a22;Courtney Barnett;mail@a22.fr;1993;Pop-rock;a22.fr
a23;Courtship Ritual;mail@a23.fr;1992;metal;a23.fr
a24;Curtis Harding;mail@a24.fr;1991;variété;a24.fr
a25;Dad Rocks!;mail@a25.fr;1990;rock;a25.fr
a26;Darjeeling Speech;mail@a26.fr;1989;rap;a26.fr
a27;DBFC;mail@a27.fr;1988;reggae;a27.fr
a28;Dead Obies;mail@a28.fr;1987;Pop-rock;a28.fr
a29;Den Sorte Skole;mail@a29.fr;1986;metal;a29.fr
a30;Dollkraut;mail@a30.fr;1985;variété;a30.fr
a31;Eagles Gift;mail@a31.fr;1984;rock;a31.fr
a32;F.E.M.;mail@a32.fr;1983;rap;a32.fr
a33;Fawl;mail@a33.fr;1982;reggae;a33.fr
a34;Fitness;mail@a34.fr;1981;Pop-rock;a34.fr
a35;Forever Pavot;mail@a35.fr;1980;metal;a35.fr
a36;Fragments;mail@a36.fr;1979;variété;a36.fr
a37;Frank McWeeny;mail@a37.fr;1978;rock;a37.fr
a38;Friend Within;mail@a38.fr;1977;rap;a38.fr
a39;Fumaça Preta;mail@a39.fr;1976;reggae;a39.fr
a40;Fuzeta;mail@a40.fr;1975;Pop-rock;a40.fr
a41;Gandi Lake;mail@a41.fr;1974;metal;a41.fr
a42;Grand Blanc;mail@a42.fr;1973;variété;a42.fr
a43;I Me Mine;mail@a43.fr;1972;rock;a43.fr
a44;Islam Chipsy;mail@a44.fr;1971;rap;a44.fr
a45;Jambinai;mail@a45.fr;1970;reggae;a45.fr
a46;Jeanne Added;mail@a46.fr;1969;Pop-rock;a46.fr
a47;Joy Squander;mail@a47.fr;1968;metal;a47.fr
a48;Joyce Muniz;mail@a48.fr;1967;variété;a48.fr
a49;Jungle By Night;mail@a49.fr;1966;rock;a49.fr
a50;Kate Tempest;mail@a50.fr;1965;rap;a50.fr
\.


/*ROLES*/
COPY trans.role(nom,id) FROM STDIN DELIMITER AS ',';
chant,1
guitare,2
clavier,3
batterie,4
trompette,5
dj,6
basse,7
\.



/*FORMATIONS ARTISTES*/
COPY trans.formation(artiste,role) FROM STDIN DELIMITER AS ',';
a1,1
a2,1
a3,1
a4,1
a5,1
a6,1
a7,1
a8,1
a9,1
a10,1
a11,1
a12,1
a13,1
a14,1
a15,1
a16,1
a17,1
a18,1
a19,1
a20,1
a21,1
a22,1
a23,1
a24,1
a25,1
a26,1
a27,1
a28,1
a29,1
a30,1
a31,1
a32,1
a33,1
a34,1
a35,1
a36,1
a37,1
a38,1
a39,1
a40,1
a41,1
a42,1
a43,1
a44,1
a45,1
a46,1
a47,1
a48,1
a49,1
a50,1
a2,7
a2,2
a2,4
a10,3
a10,4
a10,5
a10,2
a22,6
a22,4
a35,7
\.




/*SESSIONS*/
COPY trans.session(heuredebut,salle,datesession) FROM STDIN DELIMITER AS ',';
18,8,2016-05-04
20,11,2016-05-10
19,12,2016-05-22
22,3,2016-06-02
22,1,2016-05-03
21,7,2016-05-17
23,1,2016-05-03
23,7,2016-05-08
17,7,2016-05-14
18,6,2016-05-21
19,18,2016-05-26
20,20,2016-05-02
22,19,2016-06-06
21,17,2016-06-03
20,7,2016-05-26
17,6,2016-05-12
23,5,2016-06-05
22,17,2016-04-29
21,1,2016-05-03
23,18,2016-05-11
23,13,2016-05-30
\.




/*RESERVATIONS*/
COPY trans.reservation(statut,heuredebut,salle,artiste,datesession) FROM STDIN DELIMITER AS ',';
1,18,8,a36,2016-05-04
1,20,11,a12,2016-05-10
1,19,12,a24,2016-05-22
1,22,3,a12,2016-06-02
1,22,1,a12,2016-05-03
1,21,7,a23,2016-05-17
1,23,1,a7,2016-05-03
1,23,7,a38,2016-05-08
1,17,7,a16,2016-05-14
1,18,6,a15,2016-05-21
1,19,18,a13,2016-05-26
1,20,20,a6,2016-05-02
0,22,1,a8,2016-05-03
0,22,19,a45,2016-06-06
0,21,17,a3,2016-06-03
0,20,7,a18,2016-05-26
2,17,6,a11,2016-05-12
2,23,5,a22,2016-06-05
2,22,17,a45,2016-04-29
2,21,1,a10,2016-05-03
2,23,18,a8,2016-05-11
2,23,13,a39,2016-05-30
\.
