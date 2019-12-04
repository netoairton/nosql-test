var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";

MongoClient.connect(url, function(err, db) {
    if (err) throw err;
    var dbo = db.db("nosql-test");
    var lista =[];
    var obj;
    console.time('insertion time: ');
    for(i=0;i<1000;i++){
        for(j=0;j<1000;j++){
            obj= {matricula: i,
                email: ""+j+"@gmail.com"};
            lista.push(obj);
        }
    }

    dbo.collection("students").insertMany(lista, function(err, res) {
        if (err) throw err;
        console.log("Number of documents inserted: " + res.insertedCount);
        db.close();
    });

    console.timeEnd('insertion time: ');
    
});
