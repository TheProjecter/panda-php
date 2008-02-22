CREATE DATABASE ActiveRecord;
CREATE TABLE ActiveRecord.Test (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	foo VARCHAR(55) NOT NULL,
	bar VARCHAR(55) NOT NULL,
	baz VARCHAR(55) NOT NULL
);

INSERT INTO ActiveRecord.Test (foo,bar,baz)
	VALUES ('one','two','three');
INSERT INTO ActiveRecord.Test (foo,bar,baz)
	VALUES ('four','five','six');