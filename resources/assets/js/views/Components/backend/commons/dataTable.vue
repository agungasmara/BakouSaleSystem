<template>
<v-card>
			  
  <v-card-title>
    <v-spacer>
    	<div>
            <router-link to="/admin/settings/add" replace><v-btn color="primary">Create New</v-btn></router-link>
        </div>
    </v-spacer>
    <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
  </v-card-title>
	<v-data-table v-bind:headers="dataHeader" :items="dataValue" v-bind:search="search" class="elevation-1" >
		<template slot="items" slot-scope="props">
			<td v-for="value in props.item">
				{{ value }}
			</td>
		</template>
		<template slot="pageText" slot-scope="{ pageStart, pageStop }">
          From {{ pageStart }} to {{ pageStop }}
        </template>
    </v-data-table>
</v-card>
</template>

<script>
	export default{
		props:['dataHeader','dataValue'],
		data(){
			return{
				colName:[],
				colValue:[],

				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
			}
		},
		mounted(){
			this.colName=this.dataHeader
			this.colValue=this.dataValue
		}
	}
</script>