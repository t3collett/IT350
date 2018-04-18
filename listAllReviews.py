#!/usr/bin/python
import sys
from pymongo import MongoClient

client = MongoClient('localhost', 27017)
db = client['it350']
coll = db['fjellProducts']
cursor = coll.find()
for document in cursor:
	print(str(document))