import sys
from pymongo import MongoClient


if len(sys.argv) == 2:
	itemId = sys.argv[1]
	client = MongoClient()
	db = client['it350']
	coll = db['fjellProducts']
	cursor = coll.find({"itemId": itemId})
	with open('reviews.txt', 'w') as the_file:
		for document in cursor:
			the_file.write(str(document))

	return 1
