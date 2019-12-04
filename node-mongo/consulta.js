var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";

MongoClient.connect(url, function(err, db) {
  if (err) throw err;
  var dbo = db.db("nosql-test");
  var query = { };
  console.time('find time: ');
  dbo.collection("students").find(query).toArray(function(err, result) {
    if (err) throw err;
    //console.log(result);
    db.close();
  });
  console.timeEnd('find time: ');
});