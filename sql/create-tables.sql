create table nostaja
(
hnro serial primary key,
nimi varchar(100) not null,
syntymapaiva date,
seura varchar(50),
kansalaisuus varchar(20),
sukupuoli varchar(6)
;
)

create table kilpailu
(
kilnro serial primary key,
nimi varchar(30) not null,
paivamaara date,
taso varchar(10) not null,
paikka varchar(25)
;
)

create table kilpailu_nostaja
(
kilnro bigint not null,
hnro bigint not null
;
)


