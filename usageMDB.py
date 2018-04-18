#!/usr/bin/env python

import sys
from pymongo import MongoClient

client = MongoClient('localhost',27017)
db = client['it350']
print (db.command("serverStatus"))
