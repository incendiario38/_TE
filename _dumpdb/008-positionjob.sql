create table positionjob
(
	id_positionjob integer not null
		constraint positionjob_pkey
			primary key,
	name_positionjob varchar(255) not null
);

alter table positionjob owner to incendiario;

