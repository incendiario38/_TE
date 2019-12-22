create table peoples
(
	id_people integer not null
		constraint peoples_pkey
			primary key,
	fio varchar(255) not null,
	address varchar(255),
	email varchar(255),
	positionjobid integer
		constraint peoples_positionjobid_fk
			references positionjob
				on update cascade on delete set null
);

alter table peoples owner to incendiario;

