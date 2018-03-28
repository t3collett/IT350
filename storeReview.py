import sys
from pymongo import MongoClient


if len(sys.argv) == 4:
	itemId = sys.argv[1]
	username = sys.argv[2]
	with open('review.txt', 'r') as myfile:
		data = myfile.read()

	client = MongoClient()
	db = client['it350']
	coll = db['fjellProducts']
	coll.insert_one(
		{
			"itemId": itemId,"username" : username,"review" : data}
			)
	return 2