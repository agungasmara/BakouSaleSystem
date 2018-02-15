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
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/tax_rate/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'geo_zone_id',	type:'select',	 text:'Geo Zone',items:'geo_zone',	},
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Name'	},
					{	class:'xs12 sm6 md6',	 key:'rate',	type:'text',	 text:'Rate'	},
					{	class:'xs12 sm6 md6',	 key:'type',	type:'text',	 text:'Type'	},
					{	class:'xs12 sm6 md6',	 key:'date_added',	type:'date',	 text:'Date Added',menu:'date_added'	},
					{	class:'xs12 sm6 md6',	 key:'date_modified',	type:'date',	 text:'Date Modified',value:'',menu:'date_modified'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required'
				    ],
				    rate: [
				      (v) => !!v || 'Rate is required'
				    ],
				    type: [
				      (v) => !!v || 'Type is required'
				    ],
				    geo_zone_id: [v => !!v || 'Item is required'],
					date_added: [
				      (v) => !!v || 'Date Added is required'
				    ],
				    date_modified: [
				      (v) => !!v || 'Date Modeified is required'
				    ]
				},
				data:{
					name:'',
					rate:'',
					type:'',
					geo_zone_id:0,
					date_added: '',
					date_modified: ''
				},
				select:{
					geo_zone:[],
					date_added:false,
					date_modified:false
				},
				breadcrumbTitle:'Tax Rate',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Rate',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/tax_rate/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
			this.getGeoZone()
		},
		methods:{
			getGeoZone(){
				axios.get('/api/getGeoZone').then((res)=>{
					this.select.geo_zone=res.data
				})
			},
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			}
		}
	}
</script>