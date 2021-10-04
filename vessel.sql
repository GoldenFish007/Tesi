

CREATE TABLE vessel (
   id INT(8) UNSIGNED PRIMARY KEY,
   v_name VARCHAR(50) NOT NULL
)

CREATE TABLE v_sources (
   id INT(8) UNSIGNED PRIMARY KEY,
   nome VARCHAR(50) NOT NULL
)


CREATE TABLE v_status (
   id INT(8) UNSIGNED PRIMARY KEY,
   status_value VARCHAR(50) NOT NULL
)

CREATE TABLE v_historical (
   
   id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   vessel_id INT(8) UNSIGNED,
   timestmp TIMESTAMP NOT NULL,
   lat FLOAT NOT NULL,
   long_v FLOAT NOT NULL,	
   cog FLOAT NOT NULL,	   
   sog FLOAT NOT NULL,	   
   hdg INT(8) NOT NULL,
   rot FLOAT NOT NULL,	   
   status_id INT(8) UNSIGNED,
   sources_id INT(8) UNSIGNED NOT NULL,
   FOREIGN KEY (vessel_id) REFERENCES vessel(id),
   FOREIGN KEY (status_id) REFERENCES v_status(id),
   FOREIGN KEY (sources_id) REFERENCES v_sources(id)
)


