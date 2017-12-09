@extends('frontend.layout.layout')
@section('content')
	<main class="site-main">
	    <v-app>
	      <v-content>
	        <v-container>
	        	Hello world
	        	<div class="display-4 grey--text text--darken-1">Light 112sp</div>
	        	<v-badge>asdf</v-badge>
	        </v-container>
	      </v-content>
	    </v-app>

	    <input type="text" id="search-app"/>
	</main>
	<script>
		var elasticsearch = require('.node_modules/elasticsearch');
		var client = new elasticsearch.Client({
		  host: 'localhost:9200',
		  log: 'trace'
		});

	    // var client = new elasticsearch.Client({
	    //     host: 'localhost:9200'
	    // });
	    
	    (function () {
	        new Vue({
	            el: "#search-app",
	            data: {
	                name: "renowned",
	                suggestions: [],
	            },
	            ready: function () {
	                client.search({
	                    // body: {
	                    //     query: {
	                    //         match: {
	                    //             suggested_tags: 'home decoration'
	                    //         }
	                    //     }
	                    // }
	                    index: "store",
		                type: "product",
		                body: {
		                          "size": 5,
		                            "sort": [
		                          {"popular": {"order": "desc"}}
		                      ],
		                      "query": {
		                            "query_string": {
		                            "query": (searchText == '' || searchText == ' ')? '*' : searchText+"*",
		                            "fields": ["name"]
		                        }
		                      }
		                      ,
		                      "aggs": {
		                          "categories": {
		                              "terms": {
		                                  "field": "categories.cat_id",
		                                  "size": 5 // limit number result distinct
		                              },
		                              "aggs": {
		                                  "tops": {
		                                      "top_hits": {
		                                          "size": 5
		                                      }
		                                  }
		                              }
		                          }
		                      }// end aggs
		                }// end body
	                }, function (err, response) {
	                    mydata = response.hits.hits;
	                    this.suggestions = response.hits.hits;
	                    //this.suggestions.push(response.hits.hits);
	                    console.log(mydata);
	                });
	            }
	        });
	    })();
	</script>
	<script src="https://unpkg.com/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
@endsection
