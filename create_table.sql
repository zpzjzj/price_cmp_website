create table if not exists product_item(
	id bigint(20) unsigned not null auto_increment,
	name varchar(255) not null,
	url varchar(255) not null,
	price real not null,
	primary key (id)
);

create table if not exists user(
	id bigint(20) unsigned not null auto_increment,
	username varchar(255) not null,
	email varchar(255) not null,
	password char(32) not null, # stroing md5 value
	primary key (id)
);

create table if not exists user_favor(
	user_id bigint(20) unsigned not null,
	product_id bigint(20) unsigned not null,
	foreign key (user_id) references user(id) on update cascade on delete cascade,
	foreign key (product_id) references product_item(id) on update cascade on delete cascade
);