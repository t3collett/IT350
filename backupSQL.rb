#!/usr/bin/env ruby
exec 'mysqldump -u fjellAdmin -p123 IT350 > backups/sqlBackup.sql'
