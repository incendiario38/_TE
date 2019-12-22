create table groups
(
	id_group integer not null
		constraint groups_pkey
			primary key,
	name_group varchar(255) not null
);

alter table groups owner to incendiario;

