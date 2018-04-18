#!/usr/bin/env ruby
exec 'mysql -u fjellAdmin -p123 IT350 < backups/sqlBackup.sql'
