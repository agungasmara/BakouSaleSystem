// ./elasticsearch.js
var es = require('elasticsearch');

var client = new es.Client({
  host: 'localhost:9200'
  ,log: 'trace'
});

function search (myIndex, myType, searchText)
  return client.search({
    index: myIndex,
    type: myType,
    body: {
      fields: {},
      query: {
        match: {
          file_content: searchText
        }
      }
    }
  }).then(function (resp) {
      return hits = resp.hits.hits;
  }, function (err) {
    console.trace(err.message);
});

export { search }