INSERT INTO `permissions` (`role_id`, `permission`) VALUES ('1', 'admin.categories.items');
ALTER TABLE `notifications` CHANGE `action` `action` ENUM('account','collection','general') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
