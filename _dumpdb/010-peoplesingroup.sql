create table peoplesingroup
(
	id_peoplesingroup integer not null
		constraint peoplesingroup_pkey
			primary key,
	peopleid integer not null
		constraint peoplesingroup_peopleid_fk
			references peoples
				on update cascade on delete cascade,
	groupid integer not null
		constraint peoplesingroup_groupid_fk
			references groups
				on update cascade on delete cascade
);

alter table peoplesingroup owner to incendiario;

