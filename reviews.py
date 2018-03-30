#!/usr/bin/python

import sys
from pymongo import MongoClient


if len(sys.argv) == 2:
	itemId = sys.argv[1]
	client = MongoClient('localhost', 27017)
	db = client['it350']
	coll = db['fjellProducts']
	cursor = coll.find({"itemId": itemId})
	with open('reviews.txt', 'w') as the_file:
		for document in cursor:
			print str(document)
			the_file.write(str(document))
