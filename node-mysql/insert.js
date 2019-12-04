var mysql = require('mysql');
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "nosql_test"
});

function update (con){
  var timeDiffUpdate, endTimeUpdate, startTimeUpdate;
  startTimeUpdate = new Date();
  var sql= "UPDATE students SET matricula=FLOOR(RAND()*(100-1+1)+1), email=CONCAT(FLOOR(RAND()*(100-1+1)+1),'@gmail.com') WHERE 1";
  con.query(sql, function (err, result) {
    if (err) throw err;
    //console.log("Number of records updated: " + result.affectedRows);
    endTimeUpdate = new Date();
    timeDiffUpdate = (endTimeUpdate - startTimeUpdate);
    console.log("Instance of update: ", timeDiffUpdate, " ms");
  });
}
function insert (con){
  var k,i,j, values=[];
  var sql= "INSERT INTO students (matricula,email) VALUES ?";
  for(k=1;k<41;k++){
    //
    for(i=0;i<250;i++){
      for(j=0;j<100;j++){
        values.push([i*k,j*k+"@gmail.com"]);
      }
    }
    con.query(sql, [values], function (err, result) {
      if (err) throw err;
      //console.log("Number of records inserted: " + result.affectedRows);
    });
    values=[];
  }
}

function deleteData (con){
  var timeDiffDelete, endTimeDelete, startTimeDelete;
  startTimeDelete = new Date();
  var sql="DELETE FROM `students` WHERE 1";
  con.query(sql, function (err, result) {
    if (err) throw err;
    //console.log("Number of records updated: " + result.affectedRows);
    endTimeDelete = new Date();
    timeDiffDelete = (endTimeDelete - startTimeDelete);
    console.log("Instance of deleteData: ", timeDiffDelete, " ms");
  });
}

function select (con){
  var timeDiffSelect, endTimeSelect, startTimeSelect;
  startTimeSelect = new Date();
  var sql="SELECT * FROM `students`";
  con.query(sql, function (err, result) {
    if (err) throw err;
    //console.log("Number of records updated: " + result.affectedRows);
    endTimeSelect = new Date();
    timeDiffSelect = (endTimeSelect - startTimeSelect);
    console.log("Instance of Select: ", timeDiffSelect, " ms");
  });
}

console.time('Tempo de leitura do script: ');
con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    var timeDiffInsertion=0, timeDiffUpdate=0, timeDiffDelete=0, t;

    for(t=0;t<2;t++){
      //bloco de inserção
      startTimeInsertion = new Date();
      insert(con);
      endTimeInsertion = new Date();
      timeDiffInsertion += (endTimeInsertion - startTimeInsertion);
      //fim do bloco de inserção

      //inicio do bloco de atualização
      update(con);
      //console.log("Execution time (hr): ", hrend[0], hrend[1]/1000000);
      //fim do bloco de atualização
      
      //bloco de seleção
      select(con);
      //

      //inicio do bloco de remocao
      //var hrstartD = process.hrtime();
      deleteData(con);
      //var hrendD = process.hrtime(hrstartD);
      //fim do bloco de atualização
    }
    
    console.log((timeDiffInsertion/2) + " ms - Average Insertion time");
});

console.timeEnd('Tempo de leitura do script: ');
