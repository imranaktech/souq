UPDATE `general_settings` SET `value` = '2.0' WHERE `general_settings`.`type` = 'version';

INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES (NULL, 'affiliation_validity', '30');
INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES (NULL, 'affiliation_point_to_currency_rate', '0.25');
INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES (NULL, 'product_affiliation_set', 'no');

ALTER TABLE `sub_category` ADD `affiliation` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `sub_category` ADD `affiliation_points` DECIMAL(10,0) NOT NULL DEFAULT '0';

	CREATE TABLE `product_affiliation` (
	  `product_affiliation_id` bigint(20) NOT NULL,
	  `product_affiliator_id` int(11) NOT NULL,
	  `product_affiliator_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `product_affiliation_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
	  `product_id` int(11) NOT NULL,
	  `generated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


	CREATE TABLE `product_affiliation_code_use` (
	  `product_affiliation_code_use_id` bigint(20) NOT NULL,
	  `affiliator_id` int(11) NOT NULL,
	  `product_id` int(11) NOT NULL,
	  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `affiliation_user_id` int(11) NOT NULL,
	  `points` decimal(20,2) NOT NULL DEFAULT '0.00',
	  `currency` decimal(20,2) NOT NULL DEFAULT '0.00',
	  `used_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

		CREATE TABLE `product_affiliation_points_total` (
	  `product_affiliation_points_total_id` bigint(20) NOT NULL,
	  `affiliator_id` int(11) NOT NULL,
	  `points` decimal(20,2) NOT NULL DEFAULT '0.00',
	  `currency` decimal(20,2) NOT NULL DEFAULT '0.00',
	  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `product_affiliation`
  ADD PRIMARY KEY (`product_affiliation_id`);

ALTER TABLE `product_affiliation_code_use`
  ADD PRIMARY KEY (`product_affiliation_code_use_id`);

ALTER TABLE `product_affiliation_points_total`
  ADD PRIMARY KEY (`product_affiliation_points_total_id`);

ALTER TABLE `product_affiliation`
  MODIFY `product_affiliation_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `product_affiliation_code_use`
  MODIFY `product_affiliation_code_use_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `product_affiliation_points_total`
  MODIFY `product_affiliation_points_total_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;