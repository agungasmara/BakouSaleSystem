<template>
	<section id="content">
		<!--breadcrumbs start-->
		<div id="breadcrumbs-wrapper">
			<!-- Search for small screen -->
			<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
			  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
			</div>
			<div class="container">
			  <div class="row">
			    <div class="col s10 m6 l6">
			      <h5 class="breadcrumbs-title">Categories</h5>
			      <!-- <ol class="breadcrumbs">
			        <li><a href="index.html">Dashboard</a>
			        </li>
			        <li><a href="#">List</a>
			        </li>
			        <li class="active">Attributes</li>
			      </ol> -->
			      	<v-breadcrumbs>
			        	<v-icon slot="divider">/</v-icon>
		        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
		          			{{ item.text }}
		        		</v-breadcrumbs-item>
		      		</v-breadcrumbs>
			    </div>
			    <div class="col s2 m6 l6">
			      	<router-link to="/admin/categories/add" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="primary">Create New</v-btn></router-link>
			    </div>
			  </div>
			</div>
		</div>
		<!--breadcrumbs end-->

		<div>
			<v-app id="inspire">
				<!-- <v-breadcrumbs>
			        <v-icon slot="divider">chevron_right</v-icon>
		        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">
		          		{{ item.text }}
		        	</v-breadcrumbs-item>
			    </v-breadcrumbs> -->

				<v-card>
				  
			      <v-card-title>
			        <v-spacer>
			        	<div>
			                Categories List
			            </div>
			        </v-spacer>
			        <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
			      </v-card-title>
				    <v-data-table v-bind:headers="headers" :items="categories" v-bind:search="search" class="elevation-1" >
						<template slot="items" slot-scope="props">
							<td v-for="index in headers" :class="index.class">
								<img v-if="index.value=='image'" :src="props.item.image ? props.item.image:'/images/icon/no-image.png'" style="width: auto;max-width: 30px;height: auto;max-height: 30px;">
								<div v-else-if="index.text=='Status'">
									<span>
										{{ active[props.item[index.value]] }}
									</span>
								</div>
								<div v-else-if="index.text=='Action'">
									<span style="cursor:pointer;color:blue;" @click="editData(props.item[index.value])">
										<i class="material-icons">edit</i>
									</span>
									&nbsp;
									<span style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item[index.value],props.item.name)">
										<i class="material-icons">delete_forever</i>
									</span>
								</div>
								<div v-else>
									<span v-if="props.item[index.parent]">
										{{props.item[index.parent]}} ->
									</span>
									<span>
										{{ props.item[index.value] }}
									</span>
								</div>
							</td>
						</template>
						<!-- <template slot="items" slot-scope="props">
							<td v-for="index in headers" :class="index.class">
								<img v-if="index.value=='image'" :src="props.item.image ? props.item.image:'/images/icon/no-image.png'" style="width: auto;max-width: 30px;height: auto;max-height: 30px;">
								<div v-else-if="index.text=='Action'">
									<span style="cursor:pointer;color:blue;" @click="editData(props.item[index.value])"">
										<i class="material-icons">edit</i>
									</span>
									&nbsp;
									<span style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item[index.value],props.item.name)">
										<i class="material-icons">delete_forever</i>
									</span>
								</div>
								<div v-else>
									<span v-if="props.item[index.parent]">
										{{props.item[index.parent]}} =>
									</span>
									<span>
										{{ props.item[index.value] }}
									</span>
								</div>
							</td>
						</template> -->
						<template slot="pageText" slot-scope="{ pageStart, pageStop }">
				          From {{ pageStart }} to {{ pageStop }}
				        </template>
				    </v-data-table>
			    </v-card>
			    <v-layout row justify-center>
			      <v-dialog v-model="dialog" persistent max-width="290">
			        <v-card>
			          <v-card-title class="headline">Message</v-card-title>
			          	<v-card-text>
			          		{{ deleteMessage }} {{ settingID }}?
			          	</v-card-text>
			          <v-card-actions>
			            <v-spacer></v-spacer>
			            <v-btn color="green darken-1" flat @click="deleteItem(settingID,0)">Cancle</v-btn>
			            <v-btn color="green darken-1" flat @click="deleteItem(settingID,1)">Agree</v-btn>
			          </v-card-actions>
			        </v-card>
			      </v-dialog>
			    </v-layout>
			</v-app>
		</div>
	</section>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	export default{
		data(){
			return{
				deleteMessage:'',
				settingName:'',
				settingID:'',
				dialog:false,
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
				headers: [
			        { text: 'Category ID',align: 'left',value: 'category_id'},
			        { text: 'Category Name',align:'left', value: 'name',parent:'parent_name'},
			        { text: 'Type',align:'left', value: 'type' },
			        { text: 'Status',align:'left', value: 'status' },
			        { text: 'Sort Order',align:'left', value: 'sort_order' },
			        { text: 'Action', value: 'category_id',align:'center',sortable:false }
			    ],
			    active:[
					'Inactive',
					'Acitve',
				],
				categories:[],
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Categories',
			          disabled: false
			        },
			        {
			          text: 'List',
			          disabled: true
			        }
			    ]
			}
		},
		created(){
			this.fetchSettings()
			document.title = 'Categories';
		},
		methods:{
			fetchSettings(){
				axios.get('/admin/api/categories').then(response=>{
					this.categories=response.data;
				});
			},
			confirmDel(id,name){
				this.deleteMessage='Are you sure you want to delete setting with ID:'
				this.dialog=true;
				this.settingName=name
				this.settingID=id
			},
			deleteItem(id,opt){
				if(opt==1){
					this.deleteMessage='Deleting...'
					axios.delete('/admin/api/categories/'+id).then((res)=>{
						
						if(res.data.deleted==true){
							this.deleteMessage='Delete Successfully'
							this.dialog=false
							this.fetchSettings()
						}
						
					})
				}else{
					this.dialog=false
				}
			},
			editData(id){
				//this.components.push(id)
				this.$router.push('/admin/categories/edit/'+id)
			}
		}
	}
</script>