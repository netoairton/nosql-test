var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/nosql-test";

MongoClient.connect(url, function(err, db) {
  if (err) throw err;
  console.log("Database created!");
  db.close();
});