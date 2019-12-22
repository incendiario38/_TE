create table phones
(
	id_phone integer not null
		constraint phones_pkey
			primary key,
	peopleid integer not null
		constraint phones_peopleid_fk
			references peoples
				on update cascade on delete cascade,
	phone varchar(255) not null
);

alter table phones owner to incendiario;

create unique index phones_phone_uindex
	on phones (phone);

