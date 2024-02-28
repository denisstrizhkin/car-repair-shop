import MySQLdb
import os

DB_HOST=os.environ["DB_HOST"]
DB_PORT=int(os.environ["DB_PORT"])
DB_NAME=os.environ["DB_NAME"]
DB_USER=os.environ["DB_USER"]
DB_PASSWD=os.environ["DB_PASSWD"]
db = MySQLdb.connect(host=DB_HOST,    # your host, usually localhost
                     port=DB_PORT,
                     user=DB_USER,         # your username
                     passwd=DB_PASSWD,  # your password
                     db=DB_NAME)        # name of the data base
cur = db.cursor()

with open("./schema.sql", mode="r", encoding="utf8") as f:
    schema = f.readlines()
cur.execute(''.join(schema))
db.close()
