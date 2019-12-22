create table phonering
(
	id_phonering integer not null
		constraint phonering_pkey
			primary key,
	callerphone varchar(255) not null,
	datetime timestamp not null
);

alter table phonering owner to incendiario;

