var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";

MongoClient.connect(url, function(err, db) {
  if (err) throw err;
  var dbo = db.db("nosql-test");
  var myquery = {};
  console.time('update time: ');
  var newvalues = {$set: {matricula: Math.floor((Math.random() * 1000) + 1), email: ''+Math.floor((Math.random() * 1000) + 1)+'@gmail.com'} };
  dbo.collection("students").updateMany(myquery, newvalues, function(err, res) {
    if (err) throw err;
    console.log(res.result.nModified + " document(s) updated");
    db.close();
    console.timeEnd('update time: ');
  });
  
});