create table nostaja
(
hnro serial primary key,
nimi varchar(100) not null,
syntymapaiva date,
seura varchar(50),
kansalaisuus varchar(20),
sukupuoli varchar(6) not null
);

create table kilpailu
(
kilnro serial primary key,
nimi varchar(30) not null,
paivamaara date,
taso varchar(50) not null,
paikka varchar(25)
);

create table kilpailu_nostaja
(
kilnro bigint not null,
hnro bigint not null
);

create table nosto
(
hnro bigint references nostaja(hnro) on delete cascade,
laji varchar(50) not null,
tulos integer,
kilnro integer references kilpailu(kilnro) on delete cascade,
painoluokka varchar(20) not null,
jarjestysnumero int
);

create table seura
(
nimi varchar(50) not null,
kotipaikka varchar(50)
);


