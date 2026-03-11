-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.6 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table svrms.applications: ~2 rows (approximately)
INSERT INTO `applications` (`application_id`, `reference_no`, `developer_id`, `tajuk`, `lokasi`, `no_fail`, `status`, `officer_id`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'SVRMS-2026-0001', 1, 'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan sebuah kilang.', 'LOT 24 Asahan Melaka', 'MPJ-JPB-35', 'FILED', 6, 1, '2026-03-10 15:42:03', '2026-03-10 16:39:53'),
	(2, 'SVRMS-2026-0002', 2, 'Permohonan membangunkan tapak pelupusan bahan kilang', 'Tanah lapang di dun ASAHAN', 'MPJ-JPB-23', 'REJECTED', 2, 1, '2026-03-10 16:45:23', '2026-03-10 17:07:37'),
	(3, 'SVRMS-2026-0003', 3, 'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan project solor', 'LOT tanah 102 LOT BEMBAN', 'MPJ-JPB-35', 'REJECTED', 6, 1, '2026-03-10 17:19:26', '2026-03-10 17:27:11');

-- Dumping data for table svrms.approvals: ~3 rows (approximately)
INSERT INTO `approvals` (`approval_id`, `application_id`, `director_id`, `decision`, `conditions`, `remarks`, `approved_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 'SVRMS-2026-0001, approved by Hafidh Bin Sulaiman, 2026-03-11 and 00:16:46 approved.', NULL, 'setuju untuk di bawa ke mesyuarat OSC', '2026-03-10 16:16:46', '2026-03-10 16:16:46', '2026-03-10 16:16:46'),
	(2, 3, 4, 'SVRMS-2026-0003, approved by Hafidh Bin Sulaiman, 2026-03-11 and 01:27:11 approved.', NULL, 'Tidak sesuai di laksanakan mohon untu permohonan baru', '2026-03-10 17:27:11', '2026-03-10 17:27:11', '2026-03-10 17:27:11');

-- Dumping data for table svrms.audit_logs: ~19 rows (approximately)
INSERT INTO `audit_logs` (`id`, `application_id`, `user_id`, `action`, `previous_status`, `new_status`, `snapshot_old`, `snapshot_new`, `remarks`, `timestamp`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, 'SITE_REGISTERED', NULL, NULL, NULL, NULL, NULL, '2026-03-10 23:44:47', '2026-03-10 15:44:47', '2026-03-10 15:44:47'),
	(2, 1, 6, 'SITE_INVESTIGATION_COMPLETED', NULL, NULL, NULL, NULL, 'Location Data: 2.29489600, 102.41063500', '2026-03-10 23:48:31', '2026-03-10 15:48:31', '2026-03-10 15:48:31'),
	(3, 1, 3, 'VERIFICATION_VERIFIED', NULL, NULL, NULL, NULL, 'Penelitian mendapati sesuai untuk di cadangkan sebuah kilang untuk dibangunkan.', '2026-03-10 23:51:56', '2026-03-10 15:51:56', '2026-03-10 15:51:56'),
	(4, 1, 4, 'APPROVAL_APPROVED', NULL, NULL, NULL, NULL, 'setuju untuk di bawa ke mesyuarat OSC', '2026-03-11 00:16:46', '2026-03-10 16:16:46', '2026-03-10 16:16:46'),
	(5, 1, 1, 'status_transition', 'APPROVED', 'FILED', '"{\\"status\\":\\"APPROVED\\",\\"updated_at\\":\\"2026-03-11T00:16:46.000000Z\\"}"', '"{\\"status\\":\\"FILED\\",\\"updated_at\\":\\"2026-03-11 00:39:53\\"}"', 'Application Dossier completely compiled and FILED by Clerk Nadia.', '2026-03-11 00:39:53', '2026-03-10 16:39:53', '2026-03-10 16:39:53'),
	(6, 2, 2, 'SITE_REGISTERED', NULL, NULL, NULL, NULL, NULL, '2026-03-11 00:56:39', '2026-03-10 16:56:39', '2026-03-10 16:56:39'),
	(7, 2, 2, 'SITE_INVESTIGATION_COMPLETED', NULL, NULL, NULL, NULL, 'Location Data: 2.29489600, 102.41063500', '2026-03-11 00:58:43', '2026-03-10 16:58:43', '2026-03-10 16:58:43'),
	(8, 2, 3, 'VERIFICATION_REJECTED', NULL, NULL, NULL, NULL, 'Setuju dengan cadangan pegawai penyiasat didapati terdapat masalah pada lokasi yang dipohon', '2026-03-11 01:07:37', '2026-03-10 17:07:37', '2026-03-10 17:07:37'),
	(9, 3, 6, 'SITE_REGISTERED', NULL, NULL, NULL, NULL, NULL, '2026-03-11 01:20:48', '2026-03-10 17:20:48', '2026-03-10 17:20:48'),
	(10, 3, 6, 'SITE_INVESTIGATION_COMPLETED', NULL, NULL, NULL, NULL, 'Location Data: 2.29489600, 102.41063500', '2026-03-11 01:23:45', '2026-03-10 17:23:45', '2026-03-10 17:23:45'),
	(11, 3, 3, 'VERIFICATION_VERIFIED', NULL, NULL, NULL, NULL, 'semakan telah dibuat dan dirujuk untuk pengesahan', '2026-03-11 01:26:17', '2026-03-10 17:26:17', '2026-03-10 17:26:17'),
	(12, 3, 4, 'APPROVAL_REJECTED', NULL, NULL, NULL, NULL, 'Tidak sesuai di laksanakan mohon untu permohonan baru', '2026-03-11 01:27:11', '2026-03-10 17:27:11', '2026-03-10 17:27:11');

-- Dumping data for table svrms.cache: ~2 rows (approximately)

-- Dumping data for table svrms.cache_locks: ~0 rows (approximately)

-- Dumping data for table svrms.developers: ~9 rows (approximately)
INSERT INTO `developers` (`developer_id`, `name`, `address1`, `address2`, `poskod`, `city`, `state`, `email`, `fax`, `tel`, `created_at`, `updated_at`) VALUES
	(1, 'bumi berkat', 'Jalan Melaka tinggal', NULL, '75214', 'Durian Tunggal', 'Melaka', 'bumi@berkat.com', NULL, '04589657', '2026-03-10 15:41:29', '2026-03-10 15:41:29'),
	(2, 'world Jaya Sdn Bhd', 'Putera jaya', NULL, '90001', 'putrajaya', 'putraya', 'world@jaya.com', NULL, '01547859', '2026-03-10 16:43:22', '2026-03-10 16:43:22'),
	(3, 'bumi utara bhd', 'Bangunan industri cheras', NULL, '90987', 'cheras', 'selangor', 'bumi@utara.com', NULL, '102548547', '2026-03-10 17:17:52', '2026-03-10 17:17:52');

-- Dumping data for table svrms.failed_jobs: ~0 rows (approximately)

-- Dumping data for table svrms.jobs: ~0 rows (approximately)

-- Dumping data for table svrms.job_batches: ~0 rows (approximately)

-- Dumping data for table svrms.migrations: ~11 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_03_04_015142_create_developers_table', 1),
	(5, '2026_03_04_015143_create_applications_table', 1),
	(6, '2026_03_04_015143_create_sites_table', 1),
	(7, '2026_03_04_015144_create_reviews_table', 1),
	(8, '2026_03_04_015144_create_site_visits_table', 1),
	(9, '2026_03_04_015144_create_verifications_table', 1),
	(10, '2026_03_04_015145_create_approvals_table', 1),
	(11, '2026_03_04_015145_create_audit_logs_table', 1);

-- Dumping data for table svrms.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table svrms.reviews: ~1 rows (approximately)
INSERT INTO `reviews` (`review_id`, `application_id`, `officer_id`, `review_content`, `recommendation`, `self_check_completed`, `submitted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, 'Kawasan sesuai untuk di jadikan kilang di dalam zon kilang dan perindustrian', 'SUPPORTED', 1, '2026-03-10 15:49:42', '2026-03-10 15:49:42', '2026-03-10 15:49:42'),
	(2, 2, 2, 'didapati tapak tidak sesuai untuk dibangunkan.', 'NOT_SUPPORTED', 1, '2026-03-10 17:00:49', '2026-03-10 17:00:49', '2026-03-10 17:00:49'),
	(3, 3, 6, 'Siasatan telah dijalankan kawasan sesuai untuk tujuan pembangunan', 'SUPPORTED', 1, '2026-03-10 17:24:47', '2026-03-10 17:24:47', '2026-03-10 17:24:47');

-- Dumping data for table svrms.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('FX0DXasEL82w2g4CNr1g11HsblMVWL6r1un93Ana', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUF4WkpaOEVsaENUM2FMaWZ3akJmdVkweWdEb1F3VmFXT3pwbjRqdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9maWxpbmdzLzMiO3M6NToicm91dGUiO3M6MTI6ImZpbGluZ3Muc2hvdyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1773192997);

-- Dumping data for table svrms.sites: ~7 rows (approximately)
INSERT INTO `sites` (`site_id`, `application_id`, `mukim`, `bpk`, `luas`, `google_lat`, `google_long`, `map`, `lot`, `lembaran`, `kategori_tanah`, `status_tanah`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 1, 'ASAHAN', 'LOT 2.3', 0.2000, 2.29489600, 102.41063500, NULL, '1024', 'Map Sheet 233', 'Free hold', 'free hold', 'REGISTERED', 1, '2026-03-10 15:44:47', '2026-03-10 15:44:47'),
	(2, 2, 'ASAHAN', '101', 2.0000, 2.29489600, 102.41063500, NULL, '103', '1123', 'PERTANIAN', 'Free Hold', 'REGISTERED', 1, '2026-03-10 16:56:39', '2026-03-10 16:56:39'),
	(3, 3, 'BEMBAN', '212', 10.0000, 2.29489600, 102.41063500, NULL, '1025', 'map sheet 234', 'Pertanian', 'Free Hold', 'REGISTERED', 1, '2026-03-10 17:20:48', '2026-03-10 17:20:48');

-- Dumping data for table svrms.site_visits: ~8 rows (approximately)
INSERT INTO `site_visits` (`site_visit_id`, `application_id`, `officer_id`, `visit_date`, `finding_north`, `photos_north`, `findings_south`, `photos_south`, `findings_east`, `photo_east`, `finding_west`, `photo_west`, `attachments`, `activity`, `facility`, `entrance_way`, `parit`, `tree`, `topography`, `land_use_zone`, `density`, `recommend_road`, `parking`, `anjakan`, `social_facility`, `location_data`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, '2026-03-10', 'Semak Samun', '["photos/hoE1y1DzcyXzp0jBaB8nNKuXFL3TwQWk7zGvyxxI.png"]', 'Semak Samun', '["photos/nUN2aCWrAF0zRdv6FZTdPVVdxUrEln8R5SSzgxe0.png"]', 'Semak Samun', '["photos/aNGvpQEZ2QMFaDbKqJLyWj79iZYGC7vKLLOO8spG.png"]', 'Semak Samun', '["photos/wF8qkAKmBMdlcvKFhYpljrSXYtatDxmGIekGUbL6.png"]', NULL, 'kawasan lapang', 'tiada', 'terdapat laluan keluarmasuk', 'tiada', 'Semak Samun', 'berbukit', 'Pertanian', '10 keluarga', 1, NULL, '2 meter', 'tiada', '2.29489600, 102.41063500', 'COMPLETED', '2026-03-10 15:48:31', '2026-03-10 15:48:31'),
	(2, 2, 2, '2026-03-11', 'kawasan lapang', '["photos/CMMatHk8j0TP0GYtWAJktdMbhNl1kzIzzLwWsdpE.png"]', 'kawasan lapang', '["photos/qf2FTk3Difcb8SSUTL9Nf6vTisRpJCev5mxuWRgV.png"]', 'kawasan lapang', '["photos/nVcwYta7opimmLSnJ0TCKkeUeEXOuScb9YhsgSDs.png"]', 'kawasan lapang', '["photos/4lyjGrHN3VweicnUqpGH3C8iEwpAiKzWdYflhRt4.png"]', NULL, 'kawasan lapang', 'terdapat longkang tanah.', 'terdapat laluan keluarmasuk', 'longkang tanah', 'Semak Samun', 'berbukit', 'Pertanian', '20 orang', 1, NULL, '2 meter', 'Tiada Keperluan', '2.29489600, 102.41063500', 'COMPLETED', '2026-03-10 16:58:43', '2026-03-10 16:58:43'),
	(3, 3, 6, '2026-03-11', 'Kawasan Lapang', '["photos/NbDRBR3DbhxMN9wH8X6z4ZTmCnoixkTa8ruu0E03.png"]', 'Kawasan Lapang', '["photos/HBwZtEfkEjhzl4mgyxBOED9U4wtCm0WoVJk3OZgP.png"]', 'Kawasan Lapang', '["photos/PguzgWE0740cYHeNUWkWFwc7CG1VskWP0gsf5ASf.png"]', 'Kawasan Lapang', '["photos/ImTTHVuwfA8zkzivNTNQDpClJmi2x5QelMeT4EY4.png"]', NULL, 'kawasan lapang kawasan baru', 'terdapat longkang tanah.', 'terdapat laluan keluarmasuk', 'longkang tanah', 'Semak Samun', 'berbukit', 'Pertanian', '20 orang', 1, NULL, '2 meter', 'Tiada Keperluan', '2.29489600, 102.41063500', 'COMPLETED', '2026-03-10 17:23:45', '2026-03-10 17:23:45');

-- Dumping data for table svrms.users: ~6 rows (approximately)
INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `department`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Nadia', 'nadia@mpjasin.gov.my', '2026-03-10 00:04:10', '$2y$12$V8xOnOE/eB03mgcucPzHnOASfLZOU5f0bCIxea9ZuZ8f9Tg.UYSLa', 'Clerk', 'Registration', 1, 'O5i3PCFfcw25vv7lUkYwKKiECX9Y8uZHuIe2PQEgyrWky5InwPUYUYo3w7YP', '2026-03-10 00:04:10', '2026-03-10 00:16:35'),
	(2, 'Nazrin', 'nazrin@mpjasin.gov.my', '2026-03-10 00:04:10', '$2y$12$HQ9KhN1E.RjQiu3N6maYMeFeIspgAp2vmuk/6GW9reXOvDABgHz4q', 'Officer', 'Site Operations', 1, 'rGbql5VwF1P8Dw6jqLnRJKTsbnl8h0hrir3kWMZdRXeDoLxXfaXLoYR7X6qy', '2026-03-10 00:04:10', '2026-03-10 00:15:03'),
	(3, 'Mohd Asraf', 'ad@mpjasin.gov.my', '2026-03-10 00:04:10', '$2y$12$aUWiii7OzDBDHJ1746UOv.hgSnShnHMJPY6vOGXXuqfTWU4Zz8kTG', 'Assistant Director', 'Administration', 1, 'kjNWw7oQuoDB01ZPPSMG9JrbmrvSJ2SfuktfGCEH9oUoY9qCAsJ39OO6X7Dj', '2026-03-10 00:04:10', '2026-03-10 00:13:09'),
	(4, 'Hafidh Bin Sulaiman', 'hafidh@mpjasin.gov.my', '2026-03-10 00:04:10', '$2y$12$6nNcUE0ZHyB1v9cxTiVobuMgBv0dCKQgth.LuDxBbU7G.FZkV9cwG', 'Director', 'Management', 1, 'SYtdApNUigm415BZlBGQrsnWtasY7zV9EH3f2blPIcx5ljiX3V6BKjiIc41i', '2026-03-10 00:04:10', '2026-03-10 00:14:10'),
	(5, 'System Administrator', 'admin@mpjasin.gov.my', '2026-03-10 00:04:10', '$2y$12$k4D7SkEGGWdzhdnww4CvcObIWq/CRT6pe4WsMspE/xNMTmnp.ufD2', 'Admin', 'IT Services', 1, 'i61UZB0aH8j4XvJHVIU7qxMTU5qOmIw9m0SEG3Ft0RowMPlshR1a6IZ2mmkc', '2026-03-10 00:04:10', '2026-03-10 15:25:40'),
	(6, 'khairudin', 'din@mpjasin.gov.my', NULL, '$2y$12$JIvC2dNRNWM3z8eTxN1PtO/oDvF3YWgS0x2jPZxTGFNAGqj4Q8zC.', 'Officer', 'Site Operations', 1, NULL, '2026-03-10 00:15:51', '2026-03-10 00:15:51');

-- Dumping data for table svrms.verifications: ~3 rows (approximately)
INSERT INTO `verifications` (`verify_id`, `application_id`, `assistant_director_id`, `verification_status`, `remarks`, `verified_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 'VERIFIED', 'Penelitian mendapati sesuai untuk di cadangkan sebuah kilang untuk dibangunkan.', '2026-03-10 15:51:56', '2026-03-10 15:51:56', '2026-03-10 15:51:56'),
	(2, 2, 3, 'REJECTED', 'Setuju dengan cadangan pegawai penyiasat didapati terdapat masalah pada lokasi yang dipohon', '2026-03-10 17:07:37', '2026-03-10 17:07:37', '2026-03-10 17:07:37'),
	(3, 3, 3, 'VERIFIED', 'semakan telah dibuat dan dirujuk untuk pengesahan', '2026-03-10 17:26:17', '2026-03-10 17:26:17', '2026-03-10 17:26:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
