-- add table prefix if you have one
DROP TABLE IF EXISTS esparkinfo_imageuploader_imageupload_comment_store;
DROP TABLE IF EXISTS esparkinfo_imageuploader_imageupload_comment;
DROP TABLE IF EXISTS esparkinfo_imageuploader_imageupload_store;
DROP TABLE IF EXISTS esparkinfo_imageuploader_imageupload;
DELETE FROM core_resource WHERE code = 'esparkinfo_imageuploader_setup';
DELETE FROM core_config_data WHERE path like 'esparkinfo_imageuploader/%';