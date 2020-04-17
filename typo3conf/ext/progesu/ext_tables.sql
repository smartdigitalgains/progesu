#
# Add SQL definition of database tables
#
CREATE TABLE tt_content (
    children int(11) unsigned DEFAULT '0' NOT NULL,
    parent int(11) unsigned DEFAULT '0',
    cta_text varchar(255) DEFAULT '' NOT NULL,
    text_left text DEFAULT '' NOT NULL,
    text_right text DEFAULT '' NOT NULL,
    bg_position text,
    box_grid text,
);

