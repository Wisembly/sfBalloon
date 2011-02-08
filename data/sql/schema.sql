CREATE TABLE answer (id BIGINT AUTO_INCREMENT, quote_id BIGINT, user_id BIGINT, answer text NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, INDEX quote_id_idx (quote_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE auth (id BIGINT AUTO_INCREMENT, user_id BIGINT, event_id BIGINT, group_id BIGINT, INDEX user_id_idx (user_id), INDEX event_id_idx (event_id), INDEX group_id_idx (group_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE auth_group (id BIGINT AUTO_INCREMENT, name VARCHAR(100), short VARCHAR(10), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE event (id BIGINT AUTO_INCREMENT, name VARCHAR(150) NOT NULL, short VARCHAR(20) NOT NULL UNIQUE, short_description VARCHAR(255), landing_html VARCHAR(255), logo VARCHAR(255) NOT NULL, password VARCHAR(255), redirect TINYINT(1) DEFAULT '0', has_custom_css TINYINT(1) DEFAULT '0', wall_count BIGINT DEFAULT 0, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE offer (id BIGINT AUTO_INCREMENT, name VARCHAR(150) NOT NULL, price FLOAT(18, 2), sms_allowed TINYINT(1) DEFAULT '0', tw_allowed TINYINT(1) DEFAULT '0', widget_allowed TINYINT(1) DEFAULT '0', email_allowed TINYINT(1) DEFAULT '0', moderation_allowed TINYINT(1) DEFAULT '0', polls_allowed TINYINT(1) DEFAULT '0', duration_time TEXT, forms_allowed TINYINT(1) DEFAULT '0', export_allowed TINYINT(1) DEFAULT '0', PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE poll_answer (id BIGINT AUTO_INCREMENT, choice_id BIGINT NOT NULL, quote_id BIGINT NOT NULL, source_id BIGINT, user_id BIGINT, token VARCHAR(40) NOT NULL, INDEX choice_id_idx (choice_id), INDEX quote_id_idx (quote_id), INDEX source_id_idx (source_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE poll_choice (id BIGINT AUTO_INCREMENT, quote_id BIGINT NOT NULL, choice_value VARCHAR(150) NOT NULL, votes_count BIGINT DEFAULT 0, deleted_at DATETIME, INDEX quote_id_idx (quote_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE quote (id BIGINT AUTO_INCREMENT, wall_id BIGINT, user_id BIGINT, source_id BIGINT, tw_username VARCHAR(30), quote VARCHAR(255) NOT NULL, votes_count BIGINT DEFAULT 0, has_answer TINYINT(1) DEFAULT '0', is_validated TINYINT(1) DEFAULT '0', is_poll TINYINT(1) DEFAULT '0', token VARCHAR(40), tweet_id VARCHAR(50), is_favori TINYINT(1) DEFAULT '0', poll_duration SMALLINT DEFAULT 1, is_poll_active TINYINT(1) DEFAULT '1', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, INDEX wall_id_idx (wall_id), INDEX user_id_idx (user_id), INDEX source_id_idx (source_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE source (id BIGINT AUTO_INCREMENT, title VARCHAR(25) NOT NULL, small_title VARCHAR(255), UNIQUE INDEX source_sluggable_idx (small_title), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE stat_user (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, total_quotes BIGINT DEFAULT 0 NOT NULL, validated_quotes BIGINT DEFAULT 0 NOT NULL, total_votes BIGINT DEFAULT 0 NOT NULL, votes_for_quotes BIGINT DEFAULT 0 NOT NULL, answered_questions BIGINT DEFAULT 0 NOT NULL, events_used BIGINT DEFAULT 0 NOT NULL, walls_used BIGINT DEFAULT 0 NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE stat_wall (id BIGINT AUTO_INCREMENT, wall_id BIGINT NOT NULL, total_questions BIGINT DEFAULT 0 NOT NULL, validated_questions BIGINT DEFAULT 0 NOT NULL, total_votes BIGINT DEFAULT 0 NOT NULL, max_connceted_users BIGINT DEFAULT 0 NOT NULL, INDEX wall_id_idx (wall_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE subscription (id BIGINT AUTO_INCREMENT, user_id BIGINT, wall_id BIGINT, event_id BIGINT, voucher_id BIGINT, offer_id BIGINT, is_payed TINYINT(1), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX event_id_idx (event_id), INDEX wall_id_idx (wall_id), INDEX offer_id_idx (offer_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE vote (id BIGINT AUTO_INCREMENT, quote_id BIGINT NOT NULL, user_id BIGINT, token VARCHAR(40) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX quote_id_idx (quote_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE voucher (id BIGINT AUTO_INCREMENT, user_id BIGINT, offer_id BIGINT, type BIGINT, value FLOAT(18, 2), expired_at DATETIME, max_uses BIGINT, uses_count BIGINT, active TINYINT(1) DEFAULT '0', INDEX user_id_idx (user_id), INDEX offer_id_idx (offer_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE wall (id BIGINT AUTO_INCREMENT, event_id BIGINT, name VARCHAR(150) NOT NULL, tw_hashtag VARCHAR(100), sms_hashtag VARCHAR(20), last_tweet_id VARCHAR(50), lang VARCHAR(5), short_description text, start DATETIME NOT NULL, stop DATETIME NOT NULL, real_start_date DATETIME NOT NULL, is_moderated TINYINT(1) DEFAULT '0', alaune_quote_id BIGINT, survey BIGINT, feedback VARCHAR(255), has_custom_css TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, short VARCHAR(255), UNIQUE INDEX wall_sluggable_idx (short), INDEX event_id_idx (event_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, is_root TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE answer ADD CONSTRAINT answer_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE answer ADD CONSTRAINT answer_quote_id_quote_id FOREIGN KEY (quote_id) REFERENCES quote(id);
ALTER TABLE auth ADD CONSTRAINT auth_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE auth ADD CONSTRAINT auth_group_id_auth_group_id FOREIGN KEY (group_id) REFERENCES auth_group(id) ON DELETE CASCADE;
ALTER TABLE auth ADD CONSTRAINT auth_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE CASCADE;
ALTER TABLE poll_answer ADD CONSTRAINT poll_answer_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE poll_answer ADD CONSTRAINT poll_answer_source_id_source_id FOREIGN KEY (source_id) REFERENCES source(id) ON DELETE SET NULL;
ALTER TABLE poll_answer ADD CONSTRAINT poll_answer_quote_id_quote_id FOREIGN KEY (quote_id) REFERENCES quote(id) ON DELETE CASCADE;
ALTER TABLE poll_answer ADD CONSTRAINT poll_answer_choice_id_poll_choice_id FOREIGN KEY (choice_id) REFERENCES poll_choice(id) ON DELETE CASCADE;
ALTER TABLE poll_choice ADD CONSTRAINT poll_choice_quote_id_quote_id FOREIGN KEY (quote_id) REFERENCES quote(id);
ALTER TABLE quote ADD CONSTRAINT quote_wall_id_wall_id FOREIGN KEY (wall_id) REFERENCES wall(id);
ALTER TABLE quote ADD CONSTRAINT quote_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE quote ADD CONSTRAINT quote_source_id_source_id FOREIGN KEY (source_id) REFERENCES source(id) ON DELETE SET NULL;
ALTER TABLE stat_user ADD CONSTRAINT stat_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE stat_wall ADD CONSTRAINT stat_wall_wall_id_wall_id FOREIGN KEY (wall_id) REFERENCES wall(id);
ALTER TABLE subscription ADD CONSTRAINT subscription_wall_id_wall_id FOREIGN KEY (wall_id) REFERENCES wall(id) ON DELETE SET NULL;
ALTER TABLE subscription ADD CONSTRAINT subscription_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE subscription ADD CONSTRAINT subscription_offer_id_offer_id FOREIGN KEY (offer_id) REFERENCES offer(id) ON DELETE SET NULL;
ALTER TABLE subscription ADD CONSTRAINT subscription_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE SET NULL;
ALTER TABLE vote ADD CONSTRAINT vote_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE vote ADD CONSTRAINT vote_quote_id_quote_id FOREIGN KEY (quote_id) REFERENCES quote(id) ON DELETE CASCADE;
ALTER TABLE voucher ADD CONSTRAINT voucher_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE voucher ADD CONSTRAINT voucher_offer_id_offer_id FOREIGN KEY (offer_id) REFERENCES offer(id) ON DELETE SET NULL;
ALTER TABLE wall ADD CONSTRAINT wall_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
