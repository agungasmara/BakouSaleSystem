<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="id"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
			v-bind:back-url="backUrl"
		></normal-form>
	</v-app>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/manufacturers/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm6 md6',	 key:'store_id',	type:'select',	 text:'Store',count:0,items:'storesItems'	},
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Name',count:50	},
					{	class:'xs12 sm6 md6',	 key:'image',	type:'image',text:'Image'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 100 || 'Title must be less than 100 characters'
				    ],
				    store_id: [
				      (v) => !!v || 'Store is required'
				    ]
				},
				data:{
					name:' ',
					store_id:'',
					image: ''
				},
				select:{
					storesItems:[]
				},
				breadcrumbTitle:'Manufacturers',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Manufacturers',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/manufacturers/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
			this.getStore()
		},
		methods:{
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			},
			getStore(){
				axios.get('/api/getStore').then((res)=>{
					this.select.storesItems=res.data
				})
			}
		}
	}
</script>